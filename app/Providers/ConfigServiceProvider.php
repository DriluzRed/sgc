<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $config = DB::table('configurations')->get();
        // $config = $config->pluck('value', 'key');
        // View::share('config', $config);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
