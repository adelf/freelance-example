<?php

namespace App\Domain\Entities;

use App\Domain\Events\Freelancer\FreelancerAppliedForJob;
use App\Domain\Events\Freelancer\FreelancerRegistered;
use Doctrine\ORM\Mapping AS ORM;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;

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

    protected function __construct(Email $email, Money $hourRate)
    {
        parent::__construct();

        $this->email = $email;
        $this->hourRate = $hourRate;

        $this->record(new FreelancerRegistered($this->getId()));
    }

    public static function register(Email $email, Money $hourRate): Freelancer
    {
        return new Freelancer($email, $hourRate);
    }

    /**
     * @param Job $job
     * @param string $coverLetter
     * @throws \App\Exceptions\BusinessException
     */
    public function apply(Job $job, string $coverLetter)
    {
        $job->addProposal(new Proposal($this, $this->hourRate, $coverLetter));

        $this->record(new FreelancerAppliedForJob($this->getId(), $job->getId()));
    }

    public function equals(Freelancer $other): bool
    {
        return $this->email->equals($other->email);
    }
}