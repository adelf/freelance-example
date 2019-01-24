<?php

namespace App\Domain\ValueObjects;

use Doctrine\ORM\Mapping AS ORM;

/** @ORM\Embeddable */
final class Money
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $amount;

    private function __construct(int $amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Money value cannot be negative');
        }

        $this->amount = $amount;
    }

    public static function dollars(float $amount): Money
    {
        return new Money(round($amount * 100));
    }

    public static function cents(int $amount): Money
    {
        return new Money($amount);
    }

    public function equals(Money $other): bool
    {
        return $this->amount === $other->amount;
    }
}