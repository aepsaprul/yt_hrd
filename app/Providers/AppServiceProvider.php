<?php

namespace App\Providers;

use App\Models\Informasi;
use App\Models\NavAccess;
use App\Models\NavMain;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('*', function ($view)
        {
            if (Auth::check()) {
                $current_nav_main = NavMain::whereHas('navAccess' , function ($query) { $query->where('karyawan_id', Auth::user()->karyawan_id)->where('tampil', 'y'); })->get();
                $current_menu = NavAccess::whereHas('navSub' , function ($query) { $query->where('link', '!=', '#'); })->where('karyawan_id', Auth::user()->karyawan_id)->where('tampil', 'y')->get();
                $current_informasi = Informasi::where('publish', 'y')->get();
                $current_count_informasi = count($current_informasi);

                // view
                $view->with('current_nav_mains', $current_nav_main);
                $view->with('current_menus', $current_menu);
                $view->with('current_informasis', $current_informasi);
                $view->with('current_count_informasis', $current_count_informasi);
            }else {
                $view->with('current_nav_mains', null);
                $view->with('current_menus', null);
                $view->with('current_informasis', null);
                $view->with('current_count_informasis', null);
            }
        });
    }
}
