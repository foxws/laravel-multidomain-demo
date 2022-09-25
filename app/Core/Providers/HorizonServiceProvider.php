<?php

namespace App\Core\Providers;

use Bouncer;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        // Horizon::routeMailNotificationsTo('example@example.com');
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');

        // Horizon::night();
    }

    /**
     * Overload authorization method from \Laravel\Horizon\HorizonApplicationServiceProvider
     * to allow access to Horizon without having a logged in user.
     *
     * @return void
     */
    protected function authorization()
    {
        Horizon::auth(function ($request) {
            return Bouncer::is($request->user())->a('super-admin');
        });
    }
}
