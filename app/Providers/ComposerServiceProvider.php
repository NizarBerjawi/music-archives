<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

       View::composer(
           'artists.index', 'App\Http\ViewComposers\ArtistComposer'
       );

       View::composer(
           'artists.create', 'App\Http\ViewComposers\CountryComposer'
       );

       View::composer(
           'artists.create', 'App\Http\ViewComposers\LabelComposer'
       );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
