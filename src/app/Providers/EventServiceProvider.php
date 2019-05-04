<?php

namespace App\Providers;

use App\Events\PublishProcessor;
use App\Listeners\MessageSubscriber;
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
        PublishProcessor::class => [
            MessageSubscriber::class,
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

        // Facadeを利用した例
        //Event::listen(
        //    PublishProcessor::class,
        //    MessageSubscriber::class
        //);

        // DIコンテナを利用した例
        //$this->app['events']->listen(
        //    PublishProcessor::class,
        //    MessageSubscriber::class
        //);
    }
}
