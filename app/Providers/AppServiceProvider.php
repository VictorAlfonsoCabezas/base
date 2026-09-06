<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Menu;
use App\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

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
        View::composer("layouts.app", function ($view) {
            $menus = Menu::getMenu(true);
            foreach ($menus as $key => $value) {
                $ruta = '/' . request()->path();
                if ($value['url'] == '#') {
                    $menus[$key]['padre'] = false;
                    $menus[$key]['hijo'] = false;
                    foreach ($value['submenu'] as $key2 => $submenu) {
                        if ($ruta == $submenu['url']) {
                            $menus[$key]['padre'] = true;
                            $menus[$key]['submenu'][$key2]['padre'] = false;
                            $menus[$key]['submenu'][$key2]['hijo'] = true;
                        } else {
                            $menus[$key]['submenu'][$key2]['padre'] = false;
                            $menus[$key]['submenu'][$key2]['hijo'] = false;
                        }
                    }
                } else {
                    $value[$key]['padre'] = false;
                    $value[$key]['hijo'] = false;
                    if ($ruta == $value['url']) {
                        $menus[$key]['padre'] = true;
                        $menus[$key]['hijo'] = false;
                    } else {
                        $menus[$key]['padre'] = false;
                        $menus[$key]['hijo'] = false;
                    }
                }
            }
            $view->with('menusComposer', $menus);
        });
        View::share('layouts');
    }
}
