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
        $setting_service = new SettingService();
        $template_client = $setting_service->getTemplateClient();

        if ($template_client)
            View::share('template_client', $template_client);
    }
}
