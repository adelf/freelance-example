<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\JobApplyRequest;
use App\Http\Requests\JobPostRequest;
use App\Services\JobsService;

final class JobsController extends Controller
{
    /** @var \App\Services\JobsService */
    private $service;

    public function __construct(JobsService $service)
    {
        $this->service = $service;
    }

    public function post(JobPostRequest $request)
    {
        return [
            'id' => $this->service->post($request->getClientId(), $request->getJobDescription()),
        ];
    }

    public function apply(JobApplyRequest $request)
    {
        $this->service->apply($request->getDto());

        return ['ok' => 1];
    }

    public function get($id)
    {
        return [
            'id' => $this->service->getById($id)->getId(),
        ];
    }
}