<?php

namespace App\Http\Requests;

use App\Services\Dto\JobApplyDto;

final class JobApplyRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'jobId' => 'required|int',
            'freelancerId' => 'required|int',
            //'coverLetter' => optional
        ];
    }

    public function getDto(): JobApplyDto
    {
        return new JobApplyDto(
            $this['jobId'],
            $this['freelancerId'],
            $this->get('coverLetter', '')
        );
    }
}