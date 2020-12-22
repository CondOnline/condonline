<?php

namespace App\Providers;

use App\Models\Circular;
use App\Models\document;
use App\Models\Order;
use App\Observers\CircularObserver;
use App\Observers\DocumentObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application Services.
     *
     * @return void
     */
    public function boot()
    {
        if(App::environment('production'))
            URL::forceScheme('https');

        Order::observe(OrderObserver::class);
        User::observe(UserObserver::class);
        document::observe(DocumentObserver::class);
        Circular::observe(CircularObserver::class);
    }
}
