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
        $url = url('/');

        $setting_service = new SettingService();
        $settings = $setting_service->getSettings();

        if ($settings) {
            $url .= $settings->logo_header;

            View::share('template_client', $settings->template_client);
            View::share('logo_header', $settings->logo_header);
        }
    }
}
