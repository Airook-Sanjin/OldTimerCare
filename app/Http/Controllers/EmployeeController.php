<?php
//* This is where we will handle Doctor's, Caregiver's,Admin's, Supervisor's dashboards and functionality
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller{
    public function adminhome(){
        $user = auth()->user();
        $userID= auth()->user()->UserID;
        $isEmployee = DB::table('Employee')->where('UserID',$userID)->first();
        return view('Users.Admin.home',compact('user'));
    }
    public function supervisorhome(){
        $user = auth()->user();
        $userID= auth()->user()->UserID;
        $isEmployee = DB::table('Employee')->where('UserID',$userID)->first();
        return view('Users.Supervisor.home',compact('user'));
    }
    
    // block of code below allows for the us to show the patients the doctor has
    public function doctorhome() {
        $user = auth()->user();

        // Get the doctor's employee record
        $doctor = DB::table('Employee')->where('UserID', $user->UserID)->first();

        // Get all patients assigned to this doctor
        $patients = DB::table('Patient')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Patient.DoctorID', $doctor->EmployeeID)
            ->select(
                'Patient.PatientID',
                'Users.ProfileImage',
                'Patient.Total',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
            )
            ->get();

        $appointment = 0;

        // Get all upcoming appointments for this caregiver (example)
        $appointments = DB::table('Appointments')
            ->join('Patient', 'Patient.PatientID', '=', 'Appointments.PatientID')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Appointments.DoctorID', $doctor->EmployeeID)
            ->whereDate('Appointments.Date', '>', now()->toDateString()) // <-- FUTURE DAYS ONLY
            ->orderBy('Appointments.Date', 'asc')
            ->select(
                'Appointments.Date',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
            )
            ->get();


        $todaysAppointments = DB::table('Appointments')
            ->join('Patient', 'Patient.PatientID', '=', 'Appointments.PatientID')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Appointments.DoctorID', $doctor->EmployeeID)
            ->whereDate('Appointments.Date', now()->toDateString())
            ->where('Appointments.Date', '>=', now())  // full datetime compare
            ->orderBy('Appointments.Date', 'asc')
            ->select(
                'Appointments.Date',
                'Appointments.Notes',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
            )
            ->get();
            // dd(now());

        return view('Users.Doctor.home', compact('user', 'patients', 'appointments', 'todaysAppointments'));
    }
    public function createAppointment(Request $request){
        $request->validate([
            'patient_id' => 'required|integer',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Get the doctor's employee record
        $doctor = DB::table('Employee')->where('UserID', $user->UserID)->first();

        // Get caregiver assigned to this patient
        $caregiverID = DB::table('Patient')
            ->where('PatientID', $request->patient_id)
            ->value('CaregiverID');

        // Insert appointment
        DB::table('Appointments')->insert([
            'PatientID' => $request->patient_id,
            'DoctorID' => $doctor->EmployeeID,
            'CaregiverID' => $caregiverID, // <-- IMPORTANT NEW FIELD
            'Date' => \Carbon\Carbon::parse($request->date)->format('Y-m-d H:i:s'),
            'Notes' => $request->note,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Appointment added successfully!');
    }

    public function caregiverhome(){
        $user = auth()->user();

        $caregiver = DB::table('Employee')->where('UserID', $user->UserID)->first();

        $patients = DB::table('Patient')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Patient.CaregiverID', $caregiver->EmployeeID)
            ->select(
                'Patient.PatientID',
                'Users.FirstName',
                'Users.LastName',
                'Users.ProfileImage',
                'Users.UserID',
                'Patient.Total'
            )
            ->get();

        $appointment = 0;

        // Get all upcoming appointments for this caregiver (example)
        $appointments = DB::table('Appointments')
            ->join('Patient', 'Patient.PatientID', '=', 'Appointments.PatientID')
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->where('Appointments.CaregiverID', $caregiver->EmployeeID)
            ->whereDate('Appointments.Date', '>', now()->toDateString()) // <-- FUTURE DAYS ONLY
            ->orderBy('Appointments.Date', 'asc')
            ->select(
                'Appointments.Date',
                'Users.ProfileImage',
                DB::raw("Users.FirstName || ' ' || Users.LastName AS PatientName")
            )
            ->get();

        return view('Users.Caregiver.home', compact('user', 'patients','appointments'));
    }

    
}
