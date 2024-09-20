<?php

namespace App\Http\Service;

use App\Models\Setting;

class SettingService
{

    public function getSettings(): mixed
    {
        $settings = Setting::query()->get();

        if ($settings)
            return $settings[0];

        return false;
    }
}