<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function twoFactor()
    {
        return view('auth.2fa');
    }

    public function employeeTwoFactor()
    {
        return view('auth.employee-2fa');
    }
}