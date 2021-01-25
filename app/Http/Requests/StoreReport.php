<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Recaptcha;
use App\Rules\BitcoinAddress;
use Illuminate\Validation\Rule;

class StoreReport extends FormRequest
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
			'address'              => ['required', new BitcoinAddress, Rule::notIn(['19cLzeMHrLXRpF5tfQDqMMDSuHq9VoXJXf'])],
			'abuse_type_id'        => 'required|exists:abuse_types,id', // must be a valid abuse_type_id
			'abuse_type_other'     => 'required_if:abuse_type_id,99|max:191', // if abuse_type_id is other, then must specify
			'abuser'               => 'required|between:3,100',
			'description'          => 'required|between:10,2000',
			'email'				   => 'exclude_unless:optin,true|email',
			'g-recaptcha-response' => [new Recaptcha]
		];
	}

	public function validationData()
	{
		// Modify the incoming address.
		$modified = str_replace('*', '', $this->request->get('address'));
		if ($modified !== $this->request->get('address'))
		{
			$this->request->set('description', $this->request->get('description') . "\n\nAddress may appear as \"{$this->request->get('address')}\".");
			$this->request->set('address', $modified);
		}

		return parent::validationData();
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
