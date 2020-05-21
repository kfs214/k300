<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AnimalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
/*        View::composers([
          \App\Http\Composers\AnimalComposer::class => 'home.index',
//          \App\Http\Composers\AnimalComposer::class => 'home.team',
        ]);
*/    }

/*
    public function getLink($query){
      return 'https://www.google.co.jp/search?q=動物占い+' . $query;
    }
*/
}
