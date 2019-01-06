<?php

namespace App\Services;

use App\Domain\Entities\Client;
use App\Domain\ValueObjects\Email;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\StrictEntityManager;

final class ClientsService
{
    /** @var StrictEntityManager */
    private $entityManager;

    public function __construct(StrictEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Return client's id.
     *
     * @param \App\Domain\ValueObjects\Email $email
     * @return int
     */
    public function register(Email $email): int
    {
        $client = new Client($email);

        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return $client->getId();
    }

    public function getById(int $id): Client
    {
        /** @var Client $client */
        $client = $this->entityManager->findOrFail(Client::class, $id);

        return $client;
    }
}