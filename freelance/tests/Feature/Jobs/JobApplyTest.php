<?php

namespace Tests\Feature;

use Tests\TestCase;

class JobApplyTest extends TestCase
{
    use CreateEntitiesTrait;

    public function testApply()
    {
        $response = $this->postJson('/api/jobs/apply', [
            'jobId' => $this->createJob('apply.job@client.test'),
            'freelancerId' => $this->createFreelancer('apply.job@freelancer.test'),
            'coverLetter' => 'cover letter',
        ]);

        $response->assertOk();
    }

    public function testValidation()
    {
        $response = $this->postJson('/api/jobs/apply', [
            'jobId' => 'not a number',
            'freelancerId' => 'not a number',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => ['jobId', 'freelancerId'],
        ]);
    }

    public function testSameFreelancer()
    {
        $job = $this->createJob('apply.job.same@client.test');
        $freelancer = $this->createFreelancer('apply.job.same@freelancer.test');

        $response = $this->postJson('/api/jobs/apply', [
            'jobId' => $job,
            'freelancerId' => $freelancer,
            'coverLetter' => 'cover letter',
        ]);

        $response->assertOk();

        $response = $this->postJson('/api/jobs/apply', [
            'jobId' => $job,
            'freelancerId' => $freelancer,
            'coverLetter' => 'another cover letter',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure(['error']);
    }
}
