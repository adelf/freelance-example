<?php

namespace App\Services;

use App\Domain\Entities\Freelancer;
use App\Domain\Entities\Job;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Infrastructure\MultiDispatcher;
use App\Infrastructure\StrictObjectManager;
use App\Services\Dto\JobApplyDto;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class FreelancersService
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
     * Return freelancers's id.
     *
     * @param \App\Domain\ValueObjects\Email $email
     * @param \App\Domain\ValueObjects\Money $hourRate
     * @return UuidInterface
     */
    public function register(Email $email, Money $hourRate): UuidInterface
    {
        $freelancer = Freelancer::register(Uuid::uuid4(), $email, $hourRate);

        $this->entityManager->persist($freelancer);
        $this->entityManager->flush();

        $this->dispatcher->multiDispatch($freelancer->releaseEvents());

        return $freelancer->getId();
    }

    /**
     * @param \App\Services\Dto\JobApplyDto $dto
     * @throws \App\Exceptions\Job\SameFreelancerProposalException
     */
    public function apply(JobApplyDto $dto)
    {
        /** @var Freelancer $freelancer */
        $freelancer = $this->entityManager->findOrFail(Freelancer::class, $dto->getFreelancerId());

        /** @var Job $job */
        $job = $this->entityManager->findOrFail(Job::class, $dto->getJobId());

        $freelancer->apply($job, $dto->getCoverLetter());

        $this->dispatcher->multiDispatch($freelancer->releaseEvents());

        $this->entityManager->flush();
    }
}