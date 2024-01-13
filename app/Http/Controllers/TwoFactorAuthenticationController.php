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
        $validate = $request->validate([
            'code' => 'required'
        ]);

        try {
            $this->checkVerificationToken(auth()->user()->phone, $request->code);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
