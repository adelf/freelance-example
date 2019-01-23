<?php

namespace App\Domain\Events;

use Ramsey\Uuid\UuidInterface;

abstract class EventWithId
{
    /** @var UuidInterface */
    private $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}