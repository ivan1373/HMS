<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Napomena;
use App\Soba;
use App\Rezervacija;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //broj novih napomena
        view()->composer('administracija.dashboard', function ($view) {
        $napomene = Napomena::where('procitana','0')->count();
        $view->with('napomene', $napomene);
        });

        //broj zavrsenih rezervacija
        view()->composer('administracija.dashboard', function ($view) {
            $rezs = Rezervacija::where('zavrsena','0')->get();

            date_default_timezone_set('Europe/Sarajevo');
            $danas = Carbon::now();
            foreach($rezs as $rez)
            {
                if(Carbon::parse($rez->datum_do) <= $danas)
                {
                    $rez->zavrsena = '1';
                    $rez->save();
                }
            }
            $brojZ = Rezervacija::where('zavrsena','1')->where('naplacena','0')->count();
            $view->with('brojZ', $brojZ); 
        });

        
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
