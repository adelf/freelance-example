<?php

namespace Tests\Unit;

use App\Domain\Entities\Job;
use App\Domain\Events\Job\JobPosted;
use App\Domain\ValueObjects\JobDescription;
use Tests\Unit\Traits\CreationTrait;
use Tests\UnitTestCase;

class JobPostTest extends UnitTestCase
{
    use CreationTrait;

    public function testPost()
    {
        $client = $this->createClient();
        $job = Job::post($this->createUuid(), $client, JobDescription::create('Simple job', 'Do nothing'));

        $this->assertEventsHas(JobPosted::class, $job->releaseEvents());
    }
}
