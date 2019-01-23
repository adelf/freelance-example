<?php

namespace App\Http\Controllers\Write;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRegisterRequest;
use App\Services\ClientsService;

final class ClientsController extends Controller
{
    /** @var \App\Services\ClientsService */
    private $service;

    public function __construct(ClientsService $service)
    {
        $this->service = $service;
    }

    public function register(ClientRegisterRequest $request)
    {
        return [
            'id' => $this->service->register($request->getEmail()),
        ];
    }
}