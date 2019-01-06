<?php

namespace App\Domain\Entities;
use Doctrine\ORM\Mapping AS ORM;

abstract class Entity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}