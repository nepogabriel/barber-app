<?php

namespace App\View\Composers;

use App\Http\Service\SettingService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingsComposer
{
    public function __construct(
        protected SettingService $settingService
    ) {}

    public function compose(View $view)
    {
        $settings = $this->settingService->getSettings();

        $logo_header_path = $settings->logo_header;

        if ($logo_header_path && Str::startsWith($logo_header_path, 'uploads/')) {
            $logo_header_path = Storage::url($logo_header_path); 
        }

        $view->with('template_client', $settings->template_client);
        $view->with('logo_header', $logo_header_path);
    }
}