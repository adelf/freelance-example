<?php

namespace App\Services;

use App\Domain\Entities\Client;
use App\Domain\Entities\Job;
use App\Domain\ValueObjects\JobDescription;
use App\Infrastructure\StrictEntityManager;
use Ramsey\Uuid\UuidInterface;

final class JobsService
{
    /** @var StrictEntityManager */
    private $entityManager;

    public function __construct(StrictEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Return job's id.
     *
     * @param UuidInterface $clientId
     * @param \App\Domain\ValueObjects\JobDescription $description
     * @return UuidInterface
     */
    public function post(UuidInterface $clientId, JobDescription $description): UuidInterface
    {
        /** @var Client $client */
        $client = $this->entityManager->findOrFail(Client::class, $clientId);

        $job = Job::post($client, $description);

        $this->entityManager->persist($job);
        $this->entityManager->flush();

        return $job->getId();
    }

    public function getById(UuidInterface $id): Job
    {
        /** @var Job $job */
        $job = $this->entityManager->findOrFail(Job::class, $id);

        return $job;
    }
}