<?php

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Email;

/**
 * @ORM\Entity()
 */
final class Client extends EntityWithEvents
{
    /**
     * @var Email
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Email", columnPrefix = false)
     */
    private $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }
}