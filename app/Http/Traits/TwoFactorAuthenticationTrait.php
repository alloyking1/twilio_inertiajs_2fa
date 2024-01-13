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

    public function sendVerificationToken($userPhoneNumber)
    {
        $verification = $this->twilio->verify->v2->services($this->twilioVerificationServiceToken)
            ->verifications
            ->create($userPhoneNumber, "sms");

        session(['phoneVerified' => $verification->status]);
        return redirect()->route('phone.verify')->with('message', 'OTP sent');
    }

    public function checkVerificationToken($userPhoneNumber, $code)
    {
        $verification = $this->twilio->verify->v2->services($this->twilioVerificationServiceToken)
            ->verificationChecks
            ->create(
                [
                    "to" => $userPhoneNumber,
                    "code" => $code
                ]
            );

        session(['phoneVerified' => $verification->status]);
        return true;
    }
}
