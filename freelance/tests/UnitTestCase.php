<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Tests\Constraints\EventsHas;

abstract class UnitTestCase extends TestCase
{
    protected function assertEventsHas(array $events, string $eventClass)
    {
        static::assertThat($events, new EventsHas($eventClass));
    }
}