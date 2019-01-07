<?php

namespace Tests\Unit;

use App\Domain\Entities\Client;
use App\Domain\Events\Client\ClientRegistered;
use Tests\Unit\Traits\CreationTrait;
use Tests\UnitTestCase;

class ClientTest extends UnitTestCase
{
    use CreationTrait;

    public function testRegister()
    {
        $client = Client::register($this->createEmail());

        $this->assertEventsHas(ClientRegistered::class, $client->releaseEvents());
    }
}
