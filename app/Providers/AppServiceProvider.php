<?php

namespace App\Providers;

use App\Http\Service\SettingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $settingService = new SettingService();
        $settings = $settingService->getSettings();
        View::share('template_client', $settings->template_client);
        View::share('logo_header', $settings->logo_header);
    }
}
