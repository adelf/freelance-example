<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Constraints\EventsHas;

abstract class UnitTestCase extends TestCase
{
    protected function assertEventsHas(string $eventClass, array $events)
    {
        static::assertThat($events, new EventsHas($eventClass));
    }
}