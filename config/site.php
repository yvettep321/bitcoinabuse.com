<?php

return [

    'admin-emails' => [
    	env('ADMIN_EMAIL')
    ],
    'support-email' => env('SUPPORT_EMAIL'),

    'always_pass_captcha' => env('ALWAYS_PASS_CAPTCHA'),
    'recaptcha_public_key' => env('RECAPTCHA_PUBLIC_KEY'),
    'recaptcha_private_key' => env('RECAPTCHA_PRIVATE_KEY'),

    'banned_words' => explode(' ', env('BANNED_WORDS')),
    'banned_countries' => explode(' ', env('BANNED_COUNTRIES')),

];
