<?php

namespace App\Services;

use App\Domain\Entities\Client;
use App\Domain\ValueObjects\Email;
use App\Infrastructure\MultiDispatcher;
use App\Infrastructure\StrictObjectManager;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ClientsService
{
    /** @var StrictObjectManager */
    private $entityManager;

    /** @var MultiDispatcher */
    private $dispatcher;

    public function __construct(StrictObjectManager $entityManager, MultiDispatcher $dispatcher)
    {
        $this->entityManager = $entityManager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Return client's id.
     *
     * @param \App\Domain\ValueObjects\Email $email
     * @return UuidInterface
     */
    public function register(Email $email): UuidInterface
    {
        $client = Client::register(Uuid::uuid4(), $email);

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        $this->dispatcher->multiDispatch($client->releaseEvents());

        return $client->getId();
    }
}