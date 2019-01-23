<?php

namespace App\Http\Controllers\Write;

use App\Http\Controllers\Controller;
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
}