<?php

namespace App\Services;

use App\Domain\Entities\Freelancer;
use App\Domain\Entities\Job;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Exceptions\ServiceException;
use App\Infrastructure\StrictObjectManager;
use App\Services\Dto\JobApplyDto;
use Illuminate\Contracts\Events\Dispatcher;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class FreelancersService extends BaseService
{
    /** @var StrictObjectManager */
    private $entityManager;

    public function __construct(StrictObjectManager $entityManager, Dispatcher $dispatcher)
    {
        parent::__construct($dispatcher);
        $this->entityManager = $entityManager;
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

        $this->dispatchEvents($freelancer->releaseEvents());

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

        $this->dispatchEvents($freelancer->releaseEvents());

        $this->entityManager->flush();
    }

    public function getById(UuidInterface $id): Freelancer
    {
        /** @var Freelancer $freelancer */
        $freelancer = $this->entityManager->findOrFail(Freelancer::class, $id);

        return $freelancer;
    }
}