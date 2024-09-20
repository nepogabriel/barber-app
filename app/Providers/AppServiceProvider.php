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

        if (isset($settings->template_client) && $settings->template_client) {
            View::share('template_client', $settings->template_client);
        } else {
            View::share('template_client', 'default');
        }

        if (isset($settings->logo_header) && $settings->logo_header) {
            $url .= $settings->logo_header;
            View::share('logo_header', $settings->logo_header);
        } else {
            View::share('logo_header', '/img/no_image.png');
        }
    }
}
