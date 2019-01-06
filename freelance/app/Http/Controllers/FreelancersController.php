<?php

namespace App\Http\Controllers;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Http\Requests\FreelancerRegisterRequest;
use App\Services\FreelancersService;

final class FreelancersController extends Controller
{
    /** @var \App\Services\FreelancersService */
    private $service;

    public function __construct(FreelancersService $service)
    {
        $this->service = $service;
    }

    public function register(FreelancerRegisterRequest $request)
    {
        return [
            'id' => $this->service->register(
                Email::create($request['email']),
                Money::dollars($request['hourRate'])),
        ];
    }

    public function get($id)
    {
        return [
            'id' => $this->service->getById($id)->getId(),
        ];
    }
}