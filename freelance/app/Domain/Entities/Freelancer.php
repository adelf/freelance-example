<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;

/**
 * @ORM\Entity()
 */
final class Freelancer extends EntityWithEvents
{
    /**
     * @var Email
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Email", columnPrefix = false)
     */
    private $email;

    /**
     * @var Money
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Money")
     */
    private $hourRate;

    public function __construct(Email $email, Money $hourRate)
    {
        $this->email = $email;
        $this->hourRate = $hourRate;
    }

    public function makeProposal(string $coverLetter): Proposal
    {
        return new Proposal($this, $this->hourRate, $coverLetter);
    }

    public function equals(Freelancer $other): bool
    {
        return $this->email->equals($other->email);
    }
}