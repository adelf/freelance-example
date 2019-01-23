<?php

namespace App\Exceptions\Job;

use App\Exceptions\BusinessException;

final class SameFreelancerProposalException extends BusinessException
{
    public function __construct()
    {
        parent::__construct('This freelancer already made a proposal');
    }
}