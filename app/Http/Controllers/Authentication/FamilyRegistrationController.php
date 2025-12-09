<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FamilyRegistrationController extends Controller
{
    public function showForm() 
    {
        $patients = DB::table('Patient')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->select('Patient.PatientID', 'Users.FirstName', 'Users.LastName')
            ->get();

        return view('Users.auth.familyRegistration', compact('patients'));
    }

    public function register(Request $request) 
    {
        $request->validate([
            'FirstName'   => 'required',
            'LastName'    => 'required',
            'Email'       => 'required|email|unique:Users,Email',
            'Password'    => 'required|min:6',
            'Phone'       => 'nullable',
            'Address'     => 'nullable',
            'DateOfBirth' => 'nullable|date',
            'ProfileImage'  => 'nullable|url',
            'PatientID'   => 'required',
            'Relationship'=> 'required'
        ]);

        $userID = DB::table('Users')->insertGetId([
            'FirstName'   => $request->FirstName,
            'LastName'    => $request->LastName,
            'Email'       => $request->Email,
            'Password'    => Hash::make($request->Password),
            'Phone'       => $request->Phone,
            'Address'     => $request->Address,
            'DateOfBirth' => $request->DateOfBirth,
            'ProfileImage'=> $request->ProfileImage ?? 'default.png',
            //'created_at'  => now(),
            //'updated_at'  => now()
        ], 'UserID');

        DB::table('FamilyMember')->insert([
            'UserID'      => $userID,
            'PatientID'   => $request->PatientID,
            'Relationship'=> $request->Relationship,
            'is_approved' => 0
        ]);

        return redirect('/login')->with('message', 'Account created! Awaiting approval.');
    }
}
