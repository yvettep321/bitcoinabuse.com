<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use GuzzleHttp\Client;

class Recaptcha implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		if (config('site.always_pass_captcha'))
		{
			return true;
		}

		// This is a hack to solve the issue of spark calling the validator
		// twice when when registering a new user. If you call this
		// validator twice it fails the second time because
		// the code is a duplicate.
		if (isset($GLOBALS['G_RECAPTCHA_RESULT']))
		{
			return $GLOBALS['G_RECAPTCHA_RESULT'];
		}

		// return true;
		$client = new Client();

		$response = $client->post(
			'https://www.google.com/recaptcha/api/siteverify',
			['form_params'=>
				[
					'secret' => config('site.recaptcha_private_key'),
					'response' => $value
				 ]
			]
		);

		$body = json_decode((string)$response->getBody());
		$GLOBALS['G_RECAPTCHA_RESULT'] = $body->success;
		return $body->success;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'Check the box "I\'m not a robot"';
	}
}
