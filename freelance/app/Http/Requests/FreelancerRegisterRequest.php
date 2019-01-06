<?php

namespace App\Http\Requests;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Money;

final class FreelancerRegisterRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'hourRate' => 'required|numeric',
        ];
    }

    public function getEmail(): Email
    {
        return Email::create($this['email']);
    }

    public function getHourRate(): Money
    {
        return Money::dollars($this['hourRate']);
    }
}