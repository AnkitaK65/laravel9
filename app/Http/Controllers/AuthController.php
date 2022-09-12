<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser()
    {
        return "logged in User";
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser()
    {
        return "registered";
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
}
