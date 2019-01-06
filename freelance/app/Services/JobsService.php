<?php

namespace App\Services;

use App\Domain\Entities\Client;
use App\Domain\Entities\Freelancer;
use App\Domain\Entities\Job;
use App\Domain\ValueObjects\JobDescription;
use App\Infrastructure\StrictEntityManager;
use App\Services\Dto\JobApplyDto;

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
     * @param int $clientId
     * @param \App\Domain\ValueObjects\JobDescription $description
     * @return int
     */
    public function post($clientId, JobDescription $description): int
    {
        /** @var Client $client */
        $client = $this->entityManager->findOrFail(Client::class, $clientId);

        $job = Job::post($client, $description);

        $this->entityManager->persist($job);
        $this->entityManager->flush();

        return $job->getId();
    }

    /**
     * @param \App\Services\Dto\JobApplyDto $dto
     * @throws \App\Exceptions\BusinessException
     */
    public function apply(JobApplyDto $dto)
    {
        /** @var Job $job */
        $job = $this->entityManager->findOrFail(Job::class, $dto->getJobId());

        /** @var Freelancer $freelancer */
        $freelancer = $this->entityManager->findOrFail(Freelancer::class, $dto->getFreelancerId());

        $job->apply($freelancer, $dto->getCoverLetter());

        $this->entityManager->flush();
    }

    public function getById(int $id): Job
    {
        /** @var Job $job */
        $job = $this->entityManager->findOrFail(Job::class, $id);

        return $job;
    }
}