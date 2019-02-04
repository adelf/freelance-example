<?php

namespace App\Services;

use App\Domain\Entities\Client;
use App\Domain\Entities\Job;
use App\Domain\ValueObjects\JobDescription;
use App\Infrastructure\MultiDispatcher;
use App\Infrastructure\StrictObjectManager;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class JobsService
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

        $job = Job::post(Uuid::uuid4(), $client, $description);

        $this->entityManager->persist($job);
        $this->entityManager->flush();

        $this->dispatcher->multiDispatch($job->releaseEvents());

        return $job->getId();
    }
}