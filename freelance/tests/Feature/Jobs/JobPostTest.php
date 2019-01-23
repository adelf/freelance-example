<?php

namespace Tests\Feature;

use Tests\Feature\Traits\CreateEntitiesTrait;
use Tests\TestCase;

class JobPostTest extends TestCase
{
    use CreateEntitiesTrait;

    public function testPost()
    {
        $clientId = $this->createClient('job@client.test');
        $response = $this->postJson('/api/jobs/post', [
            'clientId' => $clientId,
            'title' => 'job title',
            'description' => 'job description',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
        ]);

        $checkResponse = $this->get('/api/jobs/' . $response->getData()->id);

        $checkResponse->assertOk();

        $checkResponse->assertJsonStructure([
            'client_id', 'title', 'description'
        ]);

        $this->assertEquals($clientId, $checkResponse->getData()->client_id);
        $this->assertEquals('job title', $checkResponse->getData()->title);
        $this->assertEquals('job description', $checkResponse->getData()->description);
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
