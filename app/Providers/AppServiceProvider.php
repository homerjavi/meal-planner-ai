<?php

namespace App\Providers;

use App\Services\AnthropicService;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AnthropicService::class, function ($app) {
            return new AnthropicService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            Js::make('livewire-sortable', 'https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js')->loadedOnRequest(),
        ]);

        // FilamentAsset::register([
        //     Css::make('custom-stylesheet', '/resources/scss/custom.scss'),
        // ]);

        // Filament::registerScripts([
        //     Vite::asset('https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js'),
        // ]);
    }
}
