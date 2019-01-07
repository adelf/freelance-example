<?php

namespace App\Http\Requests;

use App\Domain\ValueObjects\JobDescription;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class JobPostRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'clientId' => 'required|uuid',
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function getClientId(): UuidInterface
    {
        return Uuid::fromString($this['clientId']);
    }

    public function getJobDescription(): JobDescription
    {
        return JobDescription::create($this['title'], $this['description']);
    }
}