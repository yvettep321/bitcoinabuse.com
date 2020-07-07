<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Recaptcha;


class StoreContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                 => 'required|between:3,100',
            'email'                => 'required|email',
            'message'              => 'required|between:10,1000',
            'g-recaptcha-response' => [new Recaptcha]
        ];
    }
}
