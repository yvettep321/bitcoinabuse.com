<?php

namespace App\Providers;

use App\Rules\Recaptcha;
use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'Your Company',
        'product' => 'Your Product',
        'street' => 'PO Box 111',
        'location' => 'Your Town, NY 12345',
        'phone' => '555-555-5555',
    ];

    /**
     * NOTE: Support Email is set below in booted()
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * NOTE: Developers are set below in booted()
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        //
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::sendSupportEmailsTo(config('site.support-email'));
        Spark::developers(config('site.admin-emails'));

        Spark::freePlan();

        Spark::validateUsersWith(function () {
            return [
                'name' => 'required|max:255',
                'grecaptcharesponse' => ['required', new Recaptcha],
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                'terms' => 'required|accepted',
            ];
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }
}
