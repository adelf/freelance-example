<?php

namespace App\Services\Dto;

use Ramsey\Uuid\UuidInterface;

final class JobApplyDto
{
    /** @var UuidInterface */
    private $jobId;

    /** @var UuidInterface */
    private $freelancerId;

    /** @var string */
    private $coverLetter;

    public function __construct(UuidInterface $jobId, UuidInterface $freelancerId, string $coverLetter)
    {
        $this->jobId = $jobId;
        $this->freelancerId = $freelancerId;
        $this->coverLetter = $coverLetter;
    }

    public function getJobId(): UuidInterface
    {
        return $this->jobId;
    }

    public function getFreelancerId(): UuidInterface
    {
        return $this->freelancerId;
    }

    public function getCoverLetter(): string
    {
        return $this->coverLetter;
    }
}