<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PatientController extends Controller
{
 
    public function index(){   
        $user = auth()->user();
// -------------gets date
        $date = Carbon::now()->startOfMonth();
// --------------

        $patient = DB::table('Patient')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Patient.UserID', $user->UserID)
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
            ->where('Patient.PatientID', $patient->PatientID)
            ->select(
                'Employee.EmployeeID',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS CaregiverName")
            )
            ->get();

        $c = 0;
        $appointment = 0;

        // Get all upcoming appointments for this caregiver (example)
        $appointments = DB::table('Appointments')
            ->join('Patient', 'Patient.PatientID', '=', 'Appointments.PatientID')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Appointments.PatientID', $patient->PatientID) 
            ->whereDate('Appointments.Date', '>', now()->toDateString())
            ->orderBy('Appointments.Date', 'asc')
            ->select(
                'Appointments.Date',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
            )
            ->get();



        return view('Users.patient.home', compact('user','date','patient','appointments','caregivers'));
    }

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
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
