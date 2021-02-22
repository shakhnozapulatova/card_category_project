<?php


namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class JsonRequest extends FormRequest
{
    abstract public function rules (): array;

    final public function authorize() : bool
    {
        return true;
    }

    final protected function failedValidation(Validator $validator) : void
    {
        throw new ValidationException(
            $validator,
            response()->json($validator->errors(), 422)
        );
    }

    abstract public function getDto();
}
