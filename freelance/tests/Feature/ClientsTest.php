<?php

namespace Tests\Feature;

use Tests\TestCase;

class ClientsTest extends TestCase
{
    public function testRegister()
    {
        $response = $this->postJson('/api/clients/register', [
            'email' => 'create@client.test',
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
        ]);

        $checkResponse = $this->get('/api/clients/' . $response->getData()->id);

        $checkResponse->assertOk();
    }

    public function testValidation()
    {
        $response = $this->postJson('/api/clients/register', [
            'email' => 'wrong@email',
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => ['email']
        ]);
    }
}
