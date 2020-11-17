<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\BeforeCreateTask' => [],
        'App\Events\AfterCreateTask' => [],
        'App\Events\BeforeUpdateTask' => [],
        'App\Events\AfterUpdateTask' => [],
        'App\Events\BeforeDeleteTask' => [],
        'App\Events\BeforeDuplicateTask' => [],
        'App\Events\AfterDuplicateTask' => [],
        'App\Events\CompleteTask' => [],
        'App\Events\RestoreTask' => [],
        'App\Events\BeforeTransformTask' => [],
        'App\Events\AfterTransformTask' => [],

        'App\Events\BeforeCreateCategory' => [],
        'App\Events\AfterCreateCategory' => [],
        'App\Events\BeforeUpdateCategory' => [],
        'App\Events\AfterUpdateCategory' => [],
        'App\Events\BeforeDeleteCategory' => [],
        'App\Events\CompleteCategory' => [],
        'App\Events\RestoreCategory' => [],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
