<?php

namespace Tests\Feature;

use Tests\TestCase;

class FreelancersTest extends TestCase
{
    public function testRegister()
    {
        $response = $this->postJson('/api/freelancers/register', [
            'email' => 'create@freelancer.test',
            'hourRate' => '50',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
        ]);

        $checkResponse = $this->get('/api/freelancers/' . $response->getData()->id);

        $checkResponse->assertOk();
    }

    public function testValidation()
    {
        $response = $this->postJson('/api/freelancers/register', [
            'email' => 'wrong@email',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => ['email', 'hourRate']
        ]);
    }
}
