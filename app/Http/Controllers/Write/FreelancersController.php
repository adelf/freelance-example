<?php

namespace App\Http\Controllers\Write;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreelancerRegisterRequest;
use App\Http\Requests\JobApplyRequest;
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

    /**
     * @param JobApplyRequest $request
     * @return array
     * @throws \App\Exceptions\Job\SameFreelancerProposalException
     */
    public function apply(JobApplyRequest $request)
    {
        $this->service->apply($request->getDto());

        return ['ok' => 1];
    }
}