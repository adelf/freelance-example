<?php

namespace Tests\Feature;

trait CreateEntitiesTrait
{
    protected function createClient($email): int
    {
        $response = $this->postJson('/api/clients/register', [
            'email' => $email,
        ]);

        return $response->getData()->id;
    }

    protected function createFreelancer($email): int
    {
        $response = $this->postJson('/api/freelancers/register', [
            'email' => $email,
            'hourRate' => 50,
        ]);

        return $response->getData()->id;
    }

    protected function createJob($clientsEmail): int
    {
        $response = $this->postJson('/api/jobs/post', [
            'clientId' => $this->createClient($clientsEmail),
            'title' => 'job title',
            'description' => 'job description',
        ]);

        return $response->getData()->id;
    }
}