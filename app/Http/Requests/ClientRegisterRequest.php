<?php

namespace App\Http\Requests;

use App\Domain\ValueObjects\Email;

final class ClientRegisterRequest extends JsonRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }

    public function getEmail(): Email
    {
        return Email::create($this['email']);
    }
}