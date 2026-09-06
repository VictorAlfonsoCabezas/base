<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Cart;

class ViewComposerServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //estado para que se muestre en el menu de navegacion
        View::composer('layapa.estado', function ($view) {
            $view->with('carritoCount', Cart::getContent()->count());
        });
        //mostrar en el lado derecho el resumen de lo que se pide
        View::composer('layapa.resumen', function ($view) {
            $view->with('carritoCount', Cart::getContent()->count());
        });
    }

}
