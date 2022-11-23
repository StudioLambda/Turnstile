<?php

declare(strict_types=1);

namespace LambdaStudio\Turnstile;

use Illuminate\Support\ServiceProvider;
use LambdaStudio\Turnstile\Contracts\Turnstile as TurnstileContract;

class TurnstileServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/turnstile.php', 'turnstile'
        );

        $this->app->bind(TurnstileContract::class, Turnstile::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/turnstile.php' => config_path('turnstile.php'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'turnstile');
    }
}
