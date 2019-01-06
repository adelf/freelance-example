<?php

namespace App\Domain\Entities;

abstract class EntityWithEvents extends Entity
{
    private $events = [];

    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    protected function record($event)
    {
        $this->events[] = $event;
    }
}