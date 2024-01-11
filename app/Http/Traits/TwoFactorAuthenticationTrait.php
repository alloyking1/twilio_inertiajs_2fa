<?php

namespace App\Http\Traits;

use Twilio\Rest\Client;

trait TwoFactorAuthenticationTrait
{

    // protected $token = env("TWILIO_AUTH_TOKEN");
    $sid = env("TWILIO_ACCOUNT_SID");

    public function createVerificationService()
    {
        // dd(env("TWILIO_ACCOUNT_SID"));
        dd($this->sid);
        $sid = env('TWILIO_ACCOUNT_SID');
        $twilio = new Client($this->sid, $this->token);
        $service = $twilio->verify->v2->services
            ->create("Two Step Verification Service");
        return $service->id;
        // print($service->sid);
    }

    /**
     * send token and redirect to 2FA page
     *
     * @return void
     */
    public function sendVerificationToken()
    {
        $service = $this->createVerificationService();
        return redirect()->route('phone.verify');
    }

    public function checkVerificationToken()
    {
    }
}
