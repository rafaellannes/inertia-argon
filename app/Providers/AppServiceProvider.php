<?php

namespace App\Providers;

use App\Models\{
    Prefeitura
};
use App\Observers\{
    PrefeituraObserver
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Prefeitura::observe(PrefeituraObserver::class);
    }
}
