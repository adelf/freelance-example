<?php

namespace App\Services;

use App\Domain\Entities\Freelancer;
use App\Domain\Entities\Job;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\StrictEntityManager;
use App\Services\Dto\JobApplyDto;

final class FreelancersService
{
    /** @var StrictEntityManager */
    private $entityManager;

    public function __construct(StrictEntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Return freelancers's id.
     *
     * @param \App\Domain\ValueObjects\Email $email
     * @param \App\Domain\ValueObjects\Money $hourRate
     * @return int
     */
    public function register(Email $email, Money $hourRate): int
    {
        $freelancer = new Freelancer($email, $hourRate);

        $this->entityManager->persist($freelancer);
        $this->entityManager->flush();

        return $freelancer->getId();
    }

    /**
     * @param \App\Services\Dto\JobApplyDto $dto
     */
    public function apply(JobApplyDto $dto)
    {
        /** @var Job $job */
        $job = $this->entityManager->findOrFail(Job::class, $dto->getJobId());

        /** @var Freelancer $freelancer */
        $freelancer = $this->entityManager->findOrFail(Freelancer::class, $dto->getFreelancerId());

        $freelancer->apply($job, $dto->getCoverLetter());

        $this->entityManager->flush();
    }

    public function getById(int $id): Freelancer
    {
        /** @var Freelancer $freelancer */
        $freelancer = $this->entityManager->findOrFail(Freelancer::class, $id);

        return $freelancer;
    }
}