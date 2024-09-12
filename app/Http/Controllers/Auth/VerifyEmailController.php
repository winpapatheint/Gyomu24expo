<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserRegister;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request , $id , $hash)
    {
        $user = User::where('id',$id)->first();

        if (! hash_equals((string) $id,
                          (string) $user->getKey())) {
            return false;
        }

        if (! hash_equals((string) $hash,
                          sha1($user->getEmailForVerification()))) {
            return false;
        }

        Auth::login($user);

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Notification case 6
        $admin = User::where('role','admin')->get();
        Notification::send($admin, new NewUserRegister($admin));


        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
