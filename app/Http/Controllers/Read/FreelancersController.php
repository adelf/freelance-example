<?php

namespace App\Http\Controllers\Read;

use App\Http\Controllers\Controller;
use App\ReadModels\Freelancer;
use Ramsey\Uuid\UuidInterface;

final class FreelancersController extends Controller
{
    public function get(UuidInterface $id)
    {
        return Freelancer::findOrFail($id);
    }
}