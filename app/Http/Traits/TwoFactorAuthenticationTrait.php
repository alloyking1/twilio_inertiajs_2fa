<?php

namespace App\Http\Traits;

use Twilio\Rest\Client;

trait TwoFactorAuthenticationTrait
{

    protected $twilioSid;
    protected $twilioAuthToken;
    protected $twilioVerificationServiceToken;
    protected $twilio;

    public function __construct()
    {
        $this->twilioSid = env("TWILIO_ACCOUNT_SID");
        $this->twilioAuthToken = env("TWILIO_AUTH_TOKEN");
        $this->twilioVerificationServiceToken = env("TWILIO_VERIFICATION_SERVICE_TOKEN");
        $this->twilio =  new Client($this->twilioSid, $this->twilioAuthToken);
    }

    // public function createVerificationService()
    // {
    //     $twilio = new Client($this->twilioSid, $this->twilioAuthToken);
    //     $service = $twilio->verify->v2->services
    //         ->create("Two Step Verification Service");
    //     return $service->sid;
    // }

    public function sendVerificationToken($userPhoneNumber)
    {
        $verification = $this->twilio->verify->v2->services($this->twilioVerificationServiceToken)
            ->verifications
            ->create($userPhoneNumber, "sms");
        return redirect()->route('phone.verify')->with('message', 'OTP sent');
    }

    public function checkVerificationToken($userPhoneNumber, $code)
    {
        $verification_check = $this->twilio->verify->v2->services($this->twilioVerificationServiceToken)
            ->verificationChecks
            ->create(
                [
                    "to" => "$userPhoneNumber",
                    "code" => "$code"
                ]
            );
        return true;
    }
}
