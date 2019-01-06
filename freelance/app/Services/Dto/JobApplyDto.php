<?php

namespace App\Services\Dto;

final class JobApplyDto
{
    /** @var int */
    private $jobId;

    /** @var int */
    private $freelancerId;

    /** @var string */
    private $coverLetter;

    public function __construct(int $jobId, int $freelancerId, string $coverLetter)
    {
        $this->jobId = $jobId;
        $this->freelancerId = $freelancerId;
        $this->coverLetter = $coverLetter;
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }

    public function getFreelancerId(): int
    {
        return $this->freelancerId;
    }

    public function getCoverLetter(): string
    {
        return $this->coverLetter;
    }
}