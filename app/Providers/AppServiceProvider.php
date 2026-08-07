<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Corrige l'erreur "1071 La clé est trop longue" avec MySQL/MariaDB
        // en utf8mb4 sur les versions un peu anciennes (fréquent avec WAMP)
        Schema::defaultStringLength(191);
    }
}
