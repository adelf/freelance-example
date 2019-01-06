<?php

namespace App\Domain\ValueObjects;

use Doctrine\ORM\Mapping AS ORM;

/** @ORM\Embeddable */
final class Email
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    private function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email ' . $email . ' is not valid');
        }

        $this->email = $email;
    }

    public static function create(string $email)
    {
        return new static($email);
    }

    public function email(): string
    {
        return $this->email;
    }

    public function equals(Email $other): bool
    {
        return $this->email === $other->email;
    }
}