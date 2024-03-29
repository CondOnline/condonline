<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register Services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap Services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', 'App\Http\Views\NotificationViewComposer@compose');
    }
}
