<?php

namespace App\Http\Controllers\Authentication;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLogin() {
        return view('Users.auth.login');
    }

    public function login(Request $request) 
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required|string'
        ]);

        $credentials = [
            'Email' => $request->Email,
            'password' => $request->Password // lowercase key, uppercase input
        ];


    if (!Auth::attempt($credentials)) {
        return back()->withErrors(['Email' => 'Invalid credentials']);
    }

    // Login successful
    $request->session()->regenerate(); //! Important for security
    $user = Auth::user();

    // return redirect()->intended('/dashboard');


        // Detect roles
        $isEmployee = DB::table('Employee')->where('UserID', $user->UserID)->first();
        $isPatient  = DB::table('Patient')->where('UserID', $user->UserID)->first();
        $isFamily   = DB::table('FamilyMember')->where('UserID', $user->UserID)->first();

        if ($isPatient && !$isPatient->is_approved) {
            Auth::logout();
            return back()->withErrors(['Email' => 'Your patient account is awaiting approval.']);
        }
        

        if ($isFamily && !$isFamily->is_approved) {
            Auth::logout();
            return back()->withErrors(['Email' => 'Your family member account is awaiting approval.']);
        }
        

        return redirect()->intended(route('dashboard')); 
    }

    public function logout() 
    {
        Auth::logout();
        // session()->forget('logged_in_user');
        return redirect()->route('login');
    }
}
