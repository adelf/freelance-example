<?php

namespace App\Http\Controllers\Read;

use App\Http\Controllers\Controller;
use App\ReadModels\Job;
use Ramsey\Uuid\UuidInterface;

final class JobsController extends Controller
{
    public function get(UuidInterface $id)
    {
        return Job::findOrFail($id);
    }

    public function getWithProposals(UuidInterface $id)
    {
        return Job::with('proposals')->findOrFail($id);
    }
}