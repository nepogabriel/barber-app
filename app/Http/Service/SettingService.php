<?php

namespace App\Http\Service;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

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
}