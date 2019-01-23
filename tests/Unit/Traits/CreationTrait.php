<?php

namespace Tests\Unit\Traits;

use App\Domain\Entities\Client;
use App\Domain\Entities\Freelancer;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait CreationTrait
{
    private function createUuid(): UuidInterface
    {
        return Uuid::uuid4();
    }

    private function createEmail(): Email
    {
        static $i = 0;

        return Email::create("test$i@test.test");
    }

    private function createClient(): Client
    {
        return Client::register($this->createUuid(), $this->createEmail());
    }

    private function createFreelancer(): Freelancer
    {
        return Freelancer::register($this->createUuid(), $this->createEmail(), Money::dollars(42));
    }
}