<?php

namespace Tests\Unit;

use App\Domain\Entities\Job;
use App\Domain\Events\Freelancer\FreelancerAppliedForJob;
use App\Domain\ValueObjects\JobDescription;
use App\Exceptions\BusinessException;
use Tests\Unit\Traits\CreationTrait;
use Tests\UnitTestCase;

class JobApplyTest extends UnitTestCase
{
    use CreationTrait;

    public function testApply()
    {
        $job = $this->createJob();
        $freelancer = $this->createFreelancer();

        $freelancer->apply($job, 'cover letter');

        $this->assertEventsHas(FreelancerAppliedForJob::class, $freelancer->releaseEvents());
    }

    public function testApplySameFreelancer()
    {
        $job = $this->createJob();
        $freelancer = $this->createFreelancer();

        $freelancer->apply($job, 'cover letter');

        $this->expectException(BusinessException::class);

        $freelancer->apply($job, 'another cover letter');
    }

    private function createJob(): Job
    {
        return Job::post(
            $this->createClient(),
            JobDescription::create('Simple job', 'Do nothing'));
    }
}
