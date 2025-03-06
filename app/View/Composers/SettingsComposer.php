<?php

namespace App\View\Composers;

use App\Http\Service\SettingService;
use Illuminate\View\View;

class SettingsComposer
{
    public function __construct(
        protected SettingService $settingService
    ) {}

    public function compose(View $view)
    {
        $settings = $this->settingService->getSettings();

        $view->with('template_client', $settings->template_client);
        $view->with('logo_header', $settings->logo_header);
    }
}