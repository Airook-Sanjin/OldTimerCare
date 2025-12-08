<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\EmployeeSchedule;
use Carbon\Carbon;

class Roster extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        // dd($request->month, gettype($request->month));
        $excludeIDs=[1,2];
        $employees = DB::table('Employee')
    ->join('Users', 'Users.UserID', '=', 'Employee.UserID')
    ->whereNotIn('Employee.RoleID', $excludeIDs)
    ->select(
        'Employee.EmployeeID',
        'Employee.RoleID',
        'Users.UserID',
        'Users.FirstName',
        'Users.LastName'
    )
    ->get();

    $employeeRoles = DB::table('Employee')
    ->join('Role', 'Role.RoleID', '=', 'Employee.RoleID')
    ->join('Users', 'Users.UserID', '=', 'Employee.UserID')
    ->select('Employee.EmployeeID', 'Users.FirstName', 'Role.Role')
    ->get();

    $patients = DB::table('Patient')
    ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
    ->select('Patient.PatientID', 'UsersFirstName')->get();

    $raw = DB::table('EmployeeSchedules')->get();

    $scheduled = [];

    foreach ($raw as $row) {
    $scheduled[date('Y-m-d', strtotime($row->date))][$row->TimeslotId] = $row->EmployeeID;
    }
        
        $timeslots = DB::table('Timeslots')->orderBy('start_time')->get();

        $monthInp= trim($request->month ?? '');
        $monthInp= preg_replace('/[^\d-]/', '', $monthInp);

        if(preg_match('/^\d{4}-\d{2}$/',$monthInp)){
            $date = Carbon::createFromFormat('Y-m-d', $monthInp . '-01')->startOfMonth();
        }else{
            $date = Carbon::now()->startOfMonth();
        }
        $user= auth()->user();
        // dd('monthInp', $monthInput, $monthInput . '-01');


        return view('Users.RosterCreate',compact('user','date','employees','timeslots','scheduled','employeeRoles','patients'));
    }
    public function assign(Request $request){
       

        $assignments = $request->input('assign');
        $date= $request->input('date');

        foreach ($assignments as $timeslotId => $employeeId) {
        if ($employeeId) {
            EmployeeSchedule::create([
                'TimeslotId' => $timeslotId,
                'EmployeeID' => $employeeId,
                'date' => $date, // or a specific date from form
            ]);
        }
    }

    return redirect()->back()->with('success', 'Assignments saved!');

    }
    
}

