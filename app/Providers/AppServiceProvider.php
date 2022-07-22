<?php

namespace App\Providers;

use App\Models\{
    Prefeitura,
    Servico
};
use App\Observers\{
    PrefeituraObserver,
    ServicoObserver,
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
        Servico::observe(ServicoObserver::class);
    }
}
