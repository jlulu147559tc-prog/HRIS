<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Show the Login Page
    public function login()
    {
        return view('auth.login');
    }

    // 2. Process the Login Attempt
    public function authenticate(Request $request)
    {
        // Check that they filled out the form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log them in!
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if the user is the HR Officer
            if ($user->email === 'juan@company.com') {
                session(['is_hr_officer' => true]);
                session(['hr_2fa_verified' => false]); // Pending 2FA
                
                return redirect()->route('2fa');
            }

            // Set role state in session for standard employee
            session(['is_hr_officer' => false]);
            session(['employee_2fa_verified' => false]); // Pending 2FA
            
            return redirect()->route('employee.2fa');
        }

        // If it fails, send them back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // 3. Process the Logout (SECURED WITH BACK-BUTTON PROTECTION)
    public function logout(Request $request)
    {
        // Forget our custom session role keys upon logout
        $request->session()->forget(['is_hr_officer', 'hr_2fa_verified', 'employee_2fa_verified']);
        
        // Log out the user from Laravel's Auth system
        Auth::logout();

        // Destroy the entire session data in the server
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent "session fixation" attacks
        $request->session()->regenerateToken();

        // Redirect back to login
        return redirect('/login');
    }

    // 4. Process HR Officer 2FA Verification
    public function verifyTwoFactor(Request $request)
    {
        // Add your 2FA verification logic here...
        // Set verification state
        session(['hr_2fa_verified' => true]);

        return redirect()->route('dashboard');
    }

    // 5. Process Employee 2FA Verification
    public function verifyEmployeeTwoFactor(Request $request)
    {
        // Add your 2FA verification logic here...
        // Set verification state
        session(['employee_2fa_verified' => true]);

        return redirect()->intended('/employee/dashboard');
    }

    // ----------------------------------------------------
    // Placeholders for your 2FA routes so they don't break
    // ----------------------------------------------------
    public function twoFactor()
    {
        return view('auth.2fa'); 
    }

    public function employeeTwoFactor()
    {
        return view('auth.employee-2fa'); 
    }
}