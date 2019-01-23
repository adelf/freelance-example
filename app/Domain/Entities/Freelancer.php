<?php

namespace App\Domain\Entities;

use App\Domain\Events\Freelancer\FreelancerAppliedForJob;
use App\Domain\Events\Freelancer\FreelancerRegistered;
use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 */
final class Freelancer extends EntityWithEvents
{
    /**
     * @var Email
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Email", columnPrefix = false)
     */
    private $email;

    /**
     * @var Money
     * @ORM\Embedded(class = "App\Domain\ValueObjects\Money")
     */
    private $hourRate;

    protected function __construct(UuidInterface $id, Email $email, Money $hourRate)
    {
        parent::__construct($id);

        $this->email = $email;
        $this->hourRate = $hourRate;
    }

    public static function register(UuidInterface $id, Email $email, Money $hourRate): Freelancer
    {
        $freelancer = new Freelancer($id, $email, $hourRate);
        $freelancer->record(new FreelancerRegistered($freelancer->getId()));

        return $freelancer;
    }

    /**
     * @param Job $job
     * @param string $coverLetter
     * @throws \App\Exceptions\Job\SameFreelancerProposalException
     */
    public function apply(Job $job, string $coverLetter)
    {
        $job->addProposal($this, $this->hourRate, $coverLetter);

        $this->record(new FreelancerAppliedForJob($this->getId(), $job->getId()));
    }

    public function equals(Freelancer $other): bool
    {
        return $this->id->equals($other->id);
    }
}