<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class JsonRequest extends FormRequest
{
    public function authorize()
    {
        // Don't check authorization in request classes
        return true;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->json()->all();
    }
}