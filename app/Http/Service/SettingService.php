<?php

namespace App\Http\Service;

use App\Models\Setting;

class SettingService
{

    public function getTemplateClient(): mixed
    {
        $settings = Setting::query()->get();

        if ($settings)
            return $settings[0]->template_client;

        return false;
    }
}