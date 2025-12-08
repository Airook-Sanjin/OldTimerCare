<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function home(){   
        $user = auth()->user();

        $familymember = DB::table('FamilyMember')
            ->where('UserID', $user->UserID)
            ->first();


        $patient = DB::table('Patient')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Patient.PatientID', $familymember->PatientID)
            ->select(
                'Patient.*',
                'Users.FirstName',
                'Users.LastName',
                'Users.ProfileImage'
            )
            ->first();

        $caregivers = DB::table('Employee')
            ->join('Users', 'Users.UserID', '=', 'Employee.UserID')
            ->join('Patient', 'Patient.CaregiverID', '=', 'Employee.EmployeeID')
            ->where('Patient.PatientID', $familymember->PatientID)
            ->select(
                'Employee.EmployeeID',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS CaregiverName")
            )
            ->get();

        $appointments = DB::table('Appointments')
            ->join('Patient', 'Patient.PatientID', '=', 'Appointments.PatientID')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Appointments.PatientID', $familymember->PatientID)
            ->whereDate('Appointments.Date', '>', now()->toDateString()) // future only
            ->orderBy('Appointments.Date', 'asc')
            ->select(
                'Appointments.Date',
                'Appointments.Notes',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
            )
            ->get();

        return view('Users.family.home', compact('user','familymember','patient','caregivers','appointments'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyMember $familyMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyMember $familyMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyMember $familyMember)
    {
        //
    }
}
