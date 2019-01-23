<?php

namespace App\Domain\Entities;

use App\Domain\Events\Client\ClientRegistered;
use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Email;
use Ramsey\Uuid\UuidInterface;

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

    protected function __construct(UuidInterface $id, Email $email)
    {
        parent::__construct($id);

        $this->email = $email;
    }

    public static function register(UuidInterface $id, Email $email): Client
    {
        $client = new Client($id, $email);
        $client->record(new ClientRegistered($client->getId()));

        return $client;
    }
}