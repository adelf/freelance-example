<?php

namespace App\Domain\Events\Freelancer;

use Ramsey\Uuid\UuidInterface;

final class FreelancerAppliedForJob
{
    /** @var \Ramsey\Uuid\UuidInterface */
    private $freelancerId;

    /** @var \Ramsey\Uuid\UuidInterface */
    private $jobId;

    public function __construct(UuidInterface $freelancerId, UuidInterface $jobId)
    {
        $this->freelancerId = $freelancerId;
        $this->jobId = $jobId;
    }

    public function getFreelancerId(): UuidInterface
    {
        return $this->freelancerId;
    }

    public function getJobId(): UuidInterface
    {
        return $this->jobId;
    }
}