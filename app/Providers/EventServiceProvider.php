<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\Event::class => [
            'App\Listeners\EventListener',
        ],

        \Illuminate\Auth\Events\Attempting::class => [
            'App\Listeners\LogAuthenticationAttempt',
        ],

        \Illuminate\Auth\Events\Login::class => [
            'App\Listeners\LogSuccessfulLogin',
        ],

        \Illuminate\Auth\Events\Logout::class => [
            'App\Listeners\LogSuccessfulLogout',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
