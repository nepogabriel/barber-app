<?php

namespace App\Providers;

use App\Infra\LaravelSession;
use App\Interfaces\SessionInterface;
use App\View\Composers\SettingsComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SessionInterface::class,
            fn() => new LaravelSession(app(Request::class))
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', SettingsComposer::class);
    }
}
