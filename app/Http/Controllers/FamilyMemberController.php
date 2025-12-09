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
    public function home()
{   
    $user = auth()->user();

    $familymember = DB::table('FamilyMember')
        ->where('UserID', $user->UserID)
        ->first();

    // Get the patient assigned to this family member
    $patient = DB::table('Patient')
        ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
        ->where('Patient.PatientID', $familymember->PatientID)
        ->select(
            'Patient.*',
            'Users.ProfileImage',
            DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
        )
        ->first();

    // Caregivers for this patient
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

    // Upcoming appointments
    $appointments = DB::table('Appointments')
        ->join('Patient', 'Patient.PatientID', '=', 'Appointments.PatientID')
        ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
        ->where('Appointments.PatientID', $familymember->PatientID)
        ->where('Appointments.Date', '>', now())
        ->orderBy('Appointments.Date', 'asc')
        ->select(
            'Appointments.Date',
            'Appointments.Notes',
            'Users.ProfileImage',
            DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
        )
        ->get();

    // Load HomePageID
    $homepage = DB::table('HomePage')
        ->where('PatientID', $familymember->PatientID)
        ->first();

    // If homepage doesn't exist -> empty checklists
    if (!$homepage) {
        return view('Users.family.home', compact(
            'user','familymember','patient','caregivers','appointments'
        ))->with([
            'meals' => [],
            'meds' => []
        ]);
    }

    // NEW: Load Meals
    $meals = DB::table('MealSchedule')
        ->where('HomePageID', $homepage->HomePageID)
        ->orderBy('MealID')
        ->get();

    // NEW: Load Medications
    $meds = DB::table('MedicationSchedule')
        ->where('HomePageID', $homepage->HomePageID)
        ->orderBy('MedID')
        ->get();

    return view('Users.family.home', compact(
        'user',
        'familymember',
        'patient',
        'caregivers',
        'appointments',
        'meals',
        'meds'
    ));
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
