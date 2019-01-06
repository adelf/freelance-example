<?php

namespace App\Http\Requests;

use App\Domain\ValueObjects\JobDescription;

final class JobPostRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'clientId' => 'required|int',
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function getClientId(): int
    {
        return $this['clientId'];
    }

    public function getJobDescription(): JobDescription
    {
        return JobDescription::create($this['title'], $this['description']);
    }
}