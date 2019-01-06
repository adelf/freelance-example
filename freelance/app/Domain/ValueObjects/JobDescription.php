<?php

namespace App\Domain\ValueObjects;

use Doctrine\ORM\Mapping AS ORM;

/** @ORM\Embeddable */
final class JobDescription
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $description;

    private function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public static function create(string $title, string $description): JobDescription
    {
        return new JobDescription($title, $description);
    }
}