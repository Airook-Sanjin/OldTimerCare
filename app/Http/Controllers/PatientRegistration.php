<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientRegisterController extends Controller
{
    public function showForm() 
    {
        return view('auth.patient_register');
    }

    public function register(Request $request) 
    {
        $request->validate([
            'FirstName'     => 'required',
            'LastName'      => 'required',
            'Email'         => 'required|email|unique:Users,Email',
            'Password'      => 'required|min:6',
            'Phone'         => 'nullable',
            'Address'       => 'nullable',
            'DateOfBirth'   => 'nullable|date',
        ]);

        $userID = DB::table('Users')->insertGetId([
            'FirstName'   => $request->FirstName,
            'LastName'    => $request->LastName,
            'Email'       => $request->Email,
            'Password'    => Hash::make($request->Password),
            'Phone'       => $request->Phone,
            'Address'     => $request->Address,
            'DateOfBirth' => $request->DateOfBirth,
            'created_at'  => now(),
            'updated_at'  => now()
        ], 'UserID');

        DB::table('Patient')->insert([
            'UserID'      => $userID,
            'DoctorID'    => null,
            'CaregiverID' => null,
            'Total'       => 0,
            'is_approved' => 0
        ]);

        return redirect('/login')->with('message', 'Account created! Awaiting approval.');
    }
}
