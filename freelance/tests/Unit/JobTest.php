<?php

namespace Tests\Unit;

use App\Domain\Entities\Client;
use App\Domain\Entities\Freelancer;
use App\Domain\Entities\Job;
use App\Domain\Events\Job\JobPosted;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\JobDescription;
use App\Domain\ValueObjects\Money;
use App\Exceptions\BusinessException;
use Tests\UnitTestCase;

class JobTest extends UnitTestCase
{
    public function testCreate()
    {
        $someEmail = Email::create('test@test.com');

        $client = new Client($someEmail);
        $job = Job::post($client, JobDescription::create('Simple job', 'Do nothing'));

        $this->assertEventsHas($job->releaseEvents(), JobPosted::class);

        //$this->assertEquals(0, $job->getProposalsCount());
    }

    public function testApply()
    {
        $job = $this->createJob();
        $freelancer = $this->createFreelancer();

        $freelancer->apply($job, 'cover letter');

        //$this->assertEquals(1, $job->getProposalsCount());
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

    private function createClient(): Client
    {
        return new Client($this->createEmail());
    }

    private function createFreelancer(): Freelancer
    {
        return new Freelancer($this->createEmail(), Money::dollars(50));
    }

    private function createEmail(): Email
    {
        static $i = 0;

        return Email::create("test$i@test.test");
    }
}
