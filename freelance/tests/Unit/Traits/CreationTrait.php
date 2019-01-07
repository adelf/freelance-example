<?php

namespace Tests\Unit\Traits;

use App\Domain\Entities\Client;
use App\Domain\Entities\Freelancer;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;

trait CreationTrait
{
    private function createClient(): Client
    {
        return Client::register($this->createEmail());
    }

    private function createFreelancer(): Freelancer
    {
        return Freelancer::register($this->createEmail(), Money::dollars(42));
    }

    private function createEmail(): Email
    {
        static $i = 0;

        return Email::create("test$i@test.test");
    }
}