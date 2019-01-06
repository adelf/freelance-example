<?php

namespace Tests\Feature;

use Tests\TestCase;

class JobPostTest extends TestCase
{
    use CreateEntitiesTrait;

    public function testPost()
    {
        $response = $this->postJson('/api/jobs/post', [
            'clientId' => $this->createClient('job@client.test'),
            'title' => 'job title',
            'description' => 'job description',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
        ]);

        $checkResponse = $this->get('/api/jobs/' . $response->getData()->id);

        $checkResponse->assertOk();
    }

    public function testValidation()
    {
        $response = $this->postJson('/api/jobs/post', [
            'clientId' => 'not a number',
            'title' => '',
            'description' => '',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => ['clientId', 'title', 'description']
        ]);
    }
}
