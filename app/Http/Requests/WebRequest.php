<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
class WebRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
      $response = response()->json(['data' => [],
                'success' => false,
                'message' => 'The given data is invalid',
                'errors' => $validator->errors()
             ], 422);
             throw new ValidationException($validator, $response);
    }
}
