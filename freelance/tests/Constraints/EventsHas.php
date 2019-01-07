<?php

namespace Tests\Constraints;

use PHPUnit\Framework\Constraint\Constraint;

/**
 * Asserts whether or not events array has event of needed class.
 */
class EventsHas extends Constraint
{
    /**
     * @var string
     */
    private $eventClass;

    public function __construct(string $eventClass)
    {
        parent::__construct();

        $this->eventClass = $eventClass;
    }

    /**
     * Returns a string representation of the object.
     */
    public function toString(): string
    {
        return \sprintf(
            'contains event "%s"',
            $this->eventClass
        );
    }

    protected function matches($events): bool
    {
        return count(array_filter($events, function($event){
            return $event instanceof $this->eventClass;
        })) > 0;
    }

    protected function failureDescription($other): string
    {
        return 'events ' . $this->toString();
    }
}
