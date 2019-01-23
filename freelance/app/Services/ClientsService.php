<?php

namespace App\Services;

use App\Domain\Entities\Client;
use App\Domain\ValueObjects\Email;
use App\Infrastructure\StrictObjectManager;
use Illuminate\Contracts\Events\Dispatcher;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ClientsService extends BaseService
{
    /** @var StrictObjectManager */
    private $entityManager;

    public function __construct(StrictObjectManager $entityManager, Dispatcher $dispatcher)
    {
        parent::__construct($dispatcher);
        $this->entityManager = $entityManager;
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

        $this->dispatchEvents($client->releaseEvents());

        return $client->getId();
    }

    public function getById(UuidInterface $id): Client
    {
        /** @var Client $client */
        $client = $this->entityManager->findOrFail(Client::class, $id);

        return $client;
    }
}