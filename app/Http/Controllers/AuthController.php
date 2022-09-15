<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'exists:users'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['numeric', 'digits:10'],
            'address' => 'required',
        ]);
        $data = $request->all();
        $check = $this->createUser($data);
        // echo "<pre>";
        // print_r($check);
        // exit;
        if ($check) {
            event(new Registered($check));
            return redirect()->route('verification.notice')->withSuccess('Successfully Registered.');
        } else {
            return redirect("login")->withFailure('Something went wrong');
        }
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function verifyResend()
    {
        return "Verification Resend";
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function logout()
    {
        return "Logged Out";
    }

    public function forgotPassword()
    {
        return view('auth.passwords.email');
    }

    public function passwordResetEmail()
    {
        return "Password Reset Email Sent";
    }

    public function passwordReset()
    {
        return view('auth.passwords.reset');
    }

    public function passwordUpdate()
    {
        return "Password Reset";
    }

    public function createUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile' => $data['mobile'],
            'address' => $data['address'],
        ]);
    }
}
