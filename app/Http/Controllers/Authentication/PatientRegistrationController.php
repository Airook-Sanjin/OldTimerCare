<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class PatientRegistrationController extends Controller
{
    public function showForm() 
    {
        return view('Users.auth.patientRegistration');
    }
    
    public function register(Request $request) 
    {
        $request->validate([
            'FirstName'     => 'required',
            'LastName'      => 'required',
            'Email'         => 'required|email|unique:Users,Email',
            'Password'      => 'required|min:6', // lower case p
            'Phone'         => 'nullable',
            'Address'       => 'nullable',
            'DateOfBirth'   => 'nullable|date',
            'ProfileImage'  => 'nullable|url'
        ]);

        $user = Users::create([
            'FirstName'   => $request->FirstName,
            'LastName'    => $request->LastName,
            'Email'       => $request->Email,
            'Password'    => $request->Password,  // lower case p
            'Phone'       => $request->Phone,
            'Address'     => $request->Address,
            'DateOfBirth' => $request->DateOfBirth,
            'ProfileImage'=> $request->ProfileImage ?? 'default.png',
            // 'created_at'  => now(), //! I commented these out cause apparently it will give us errors donw the line
            // 'updated_at'  => now()
        ], 'UserID');

        $defaultDoctorID = 9; // EmployeeID of your doctor
        $defaultCaregiverID = 10; // EmployeeID of your doctor

        DB::table('Patient')->insert([
            'UserID'      => $user->UserID,
            'DoctorID'    => $defaultDoctorID,
            'CaregiverID' => $defaultCaregiverID,
            'Total'       => 0,
            'is_approved' => 0
        ]);

        return redirect('/login')->with('message', 'Account created! Awaiting approval.');
    }
}
