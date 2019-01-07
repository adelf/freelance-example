<?php

namespace Tests\Unit;

use App\Domain\Entities\Freelancer;
use App\Domain\Events\Freelancer\FreelancerRegistered;
use App\Domain\ValueObjects\Money;
use Tests\Unit\Traits\CreationTrait;
use Tests\UnitTestCase;

class FreelancerTest extends UnitTestCase
{
    use CreationTrait;

    public function testRegister()
    {
        $freelancer = Freelancer::register($this->createEmail(), Money::dollars(42));

        $this->assertEventsHas(FreelancerRegistered::class, $freelancer->releaseEvents());
    }
}
