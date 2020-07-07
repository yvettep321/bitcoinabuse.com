<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BitcoinAddress;
use Auth;

class StoreReportApi extends StoreReport
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address'              => ['required', new BitcoinAddress],
            'abuse_type_id'        => 'required|exists:abuse_types,id', // must be a valid abuse_type_id
            'abuse_type_other'     => 'required_if:abuse_type_id,99', // if abuse_type_id is other, then must specify
            'abuser'               => 'required|between:3,100',
            'description'          => 'required|between:10,1000',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'abuse_type_other.required_if'  => 'You must specify the type of abuse.',
        ];
    }
}