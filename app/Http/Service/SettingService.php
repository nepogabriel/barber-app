<?php

namespace App\Http\Service;

use App\Models\Module;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use stdClass;

class SettingService
{
    public const CODE_GENERAL = 'genereal';
    public const CODE_FOOTER = 'footer';

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

        $setting = Setting::query()
        ->select('value')
        ->where('key', '=', $key)
        ->first();

        if (isset($setting->value))
            $value = $setting->value;

        return $value;
    }

    public function editSetting(string $code, array $request): void
    {
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'token')
                continue;

            $key_table = $code . '_' . $key;

            Setting::updateOrCreate(
                ['key' => $key_table],
                ['code' => $code, 'key' => $key_table, 'value' => $value]
            );
        }
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