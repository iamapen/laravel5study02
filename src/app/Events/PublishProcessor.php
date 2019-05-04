<?php

namespace App\Events;

/**
 * Class PublishProcessor
 *
 * イベント自体の表現と、データ送信、両方の役割を担う。
 * immutalbeに作る。
 * @package App\Events
 */
class PublishProcessor
{
    private $int;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $int)
    {
        $this->int = $int;
    }

    public function getInt(): int
    {
        return $this->int;
    }
}
