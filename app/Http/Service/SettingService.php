<?php

namespace App\Http\Service;

use App\Models\Module;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use stdClass;

class SettingService
{

    public function getSettings(): mixed
    {
        if (Schema::hasTable('settings')) {
            $settings = Setting::query()->get();

            if (isset($settings[0]) && $settings[0])
                return $settings[0];
        }

        return false;
    }

    public function getSetting(string $key): string
    {
        $value = '';

        $setting = Module::query()
        ->select('value')
        ->where('key', '=', $key)
        ->get();

        if (isset($setting->value))
            $value = $setting->value;
        
        return $value;
    }

    public function editSetting($code, $data)
    {
        //
    }

    public function prepareFields($code, $fields): object
    {
        $data = new stdClass;

        foreach ($fields as $key => $value) {
            if (isset($request->$key)) {
                $data->$key = $request->$key;
            } else {
                $value = $this->getSetting($code . '_' . $key) != '' ? $this->getSetting($code . '_' . $key) : $value;
                $data->$key = $value;
            }
        }

        return $data;
    }
}