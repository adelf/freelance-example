<?php

namespace Tests\Feature\Traits;

trait CreateEntitiesTrait
{
    protected function createClient($email): string
    {
        $response = $this->postJson('/api/clients/register', [
            'email' => $email,
        ]);

        return $response->getData()->id;
    }

    protected function createFreelancer($email): string
    {
        $response = $this->postJson('/api/freelancers/register', [
            'email' => $email,
            'hourRate' => 50,
        ]);

        return $response->getData()->id;
    }

    protected function createJob($clientsEmail): string
    {
        $response = $this->postJson('/api/jobs/post', [
            'clientId' => $this->createClient($clientsEmail),
            'title' => 'job title',
            'description' => 'job description',
        ]);

        return $response->getData()->id;
    }
}