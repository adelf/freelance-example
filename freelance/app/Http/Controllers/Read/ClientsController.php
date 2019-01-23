<?php

namespace App\Http\Controllers\Read;

use App\Http\Controllers\Controller;
use App\ReadModels\Client;
use Ramsey\Uuid\UuidInterface;

final class ClientsController extends Controller
{
    public function get(UuidInterface $id)
    {
        return Client::findOrFail($id);
    }
}