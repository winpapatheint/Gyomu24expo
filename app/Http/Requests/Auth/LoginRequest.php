<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

          $loginset = array("login" => "user",                   
                            "admin/login" => "admin",                   
                            "hcompany/login" => "hcompany",                   
                            "host/login" => "host"
                        );
        $route = request()->route()->uri;

        // print_r($loginset[$route]);die;
        if ($route == 'login') {
            $authattempt = ! Auth::attempt(['email' => $this->email, 'password' => $this->password, 'role' => "user"], $this->filled('remember'));
            if ($authattempt) {
                $authattempt = ! Auth::attempt(['email' => $this->email, 'password' => $this->password, 'role' => "host"], $this->filled('remember'));
            }
        } else {
            $authattempt = ! Auth::attempt(['email' => $this->email, 'password' => $this->password, 'role' => $loginset[$route]], $this->filled('remember'));
        }

        // print_r($authattempt);die;

        if ($authattempt) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // print_r(Auth::user()->role);die();

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
