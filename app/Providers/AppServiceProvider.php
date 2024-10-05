<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL; // Asegúrate de importar esta clase

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
        // Define the gate to check if a user is logged in
        Gate::define('logged-in', function ($user = null) {
            return $user == null;
        });

        // Forzar que todas las URLs generadas usen HTTPS en ambientes que no sean locales
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
