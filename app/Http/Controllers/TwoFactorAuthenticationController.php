<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\TwoFactorAuthenticationTrait;

class TwoFactorAuthenticationController extends Controller
{
    use TwoFactorAuthenticationTrait;

    public function index()
    {
        return  Inertia::render('Auth/TwoFactorAuthentication');
    }

    public function verifyCode(Request $request)
    {
        // dd($request->code);
        $validate = $request->validate([
            'code' => 'required'
        ]);
        $verify = $this->checkVerificationToken("+13318710383", $request->code);
        dump($verify);
        return redirect()->route('dashboard');
    }
}
