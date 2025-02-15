<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Settings\GeneralSettings;
use Spatie\LaravelSettings\SettingsContainer;
use Filament\Facades\Filament;

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
        //App::setLocale('ar');
        //app(SettingsContainer::class)->register(GeneralSettings::class);
//        Filament::serving(function () {
//            Filament::registerStyles([
//                asset('css/filament-rtl.css'),
//            ]);
//        });
    }
}
