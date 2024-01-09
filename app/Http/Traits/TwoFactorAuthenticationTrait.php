<?php

namespace App\Http\Traits;

trait TwoFactorAuthenticationTrait
{

    public function createVerificationService()
    {
    }

    /**
     * send token and redirect to 2FA page
     *
     * @return void
     */
    public function sendVerificationToken()
    {
        return redirect()->route('phone.verify');
    }

    public function checkVerificationToken()
    {
    }
}
