<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Ramsey\Uuid\UuidInterface;

abstract class EntityWithEvents
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    private $events = [];

    protected function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

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

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}