<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required'
        ]);

        $credentials = [
            'Email' => $request->Email,
            'Password' => $request->Password
        ];

        $user = DB::table('Users')->where('Email', $request->Email)->first();
        if (!$user || !Hash::check($request->Password, $user->Password)) {
            return back()->withErrors(['Email' => 'Invalid credentials']);
        }

        // Detect role via subtype tables
        $isEmployee = DB::table('Employee')->where('UserID', $user->UserID)->first();
        $isPatient  = DB::table('Patient')->where('UserID', $user->UserID)->first();
        $isFamily   = DB::table('FamilyMember')->where('UserID', $user->UserID)->first();

        if ($isPatient && !$isPatient->is_approved) {
            return back()->withErrors(['Email' => 'Your patient account is awaiting approval.']);
        }

        if ($isFamily && !$isFamily->is_approved) {
            return back()->withErrors(['Email' => 'Your family member account is awaiting approval.']);
        }

        session(['logged_in_user' => $user->UserID]);

        return redirect('/'); 
    }

    public function logout() 
    {
        session()->forget('logged_in_user');
        return redirect('/login');
    }
}
