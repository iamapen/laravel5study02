<?php

namespace App\Listeners;

use App\Events\PublishProcessor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * 非同期リスナの例
 * @package App\Listeners
 */
class MessageQueueSubscriber implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PublishProcessor $event
     * @return void
     */
    public function handle(PublishProcessor $event)
    {
        \Log::info($event->getInt());
    }
}
