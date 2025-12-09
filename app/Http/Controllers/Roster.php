<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\EmployeeSchedules;
use Carbon\Carbon;

class Roster extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function Rostercreate(Request $request){
        // dd($request->month, gettype($request->month));
        $excludeIDs=[1];
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
            ->join('EmployeeSchedules','Patient.PatientID','=','EmployeeSchedules.PatientID')
            ->select('Patient.PatientID', 'Users.FirstName','Patient.CaregiverID')->get();

        // dd($patients);
        $raw = DB::table('EmployeeSchedules')->get();

        $scheduled = [];
        $simpleScheduled=[];

        foreach ($raw as $row) {
            $d = date('Y-m-d', strtotime($row->Date));
            $ts = $row->TimeslotId;
            $scheduled[$d][$ts][] = [
            'EmployeeID' => $row->EmployeeID,
            'PatientID' => $row->PatientID ?? null
            ];
            $simpleScheduled[$d][$ts][]=$row->EmployeeID;

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
        // dd($scheduled);


        return view('Users.RosterCreate',compact('user','date','employees','timeslots','scheduled','simpleScheduled','employeeRoles','patients'));
    }
    public function CalendarView(Request $request){
        $user= auth()->user();
        $excludeIDs=[1];
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
            ->join('EmployeeSchedules','Patient.PatientID','=','EmployeeSchedules.PatientID')
            ->select('Patient.PatientID', 'Users.FirstName','Patient.CaregiverID')->get();
        $raw = DB::table('EmployeeSchedules')->get();

        $scheduled = [];
        $simpleScheduled=[];

        foreach ($raw as $row) {
            $d = date('Y-m-d', strtotime($row->Date));
            $ts = $row->TimeslotId;
            $scheduled[$d][$ts][] = [
            'EmployeeID' => $row->EmployeeID,
            'PatientID' => $row->PatientID ?? null
            ];
            $simpleScheduled[$d][$ts][]=$row->EmployeeID;

        }
        
        $timeslots = DB::table('Timeslots')->orderBy('start_time')->get();

        $monthInp= trim($request->month ?? '');
        $monthInp= preg_replace('/[^\d-]/', '', $monthInp);

        if(preg_match('/^\d{4}-\d{2}$/',$monthInp)){
            $date = Carbon::createFromFormat('Y-m-d', $monthInp . '-01')->startOfMonth();
        }else{
            $date = Carbon::now()->startOfMonth();
        }
        return view('Users.RosterCreate',compact('user','date','employees','timeslots','scheduled','simpleScheduled','employeeRoles','patients'));
    }
    public function assignEmployee(Request $request){
       

        $assignments = $request->input('assignEmployee');
        $date= $request->input('date');
        // dd($date);
        foreach($assignments as $role => $RoleAssignments){
            foreach ($RoleAssignments as $timeslotId => $employeeId) {
            if ($employeeId) {
                EmployeeSchedules::create([
                    'TimeslotId' => $timeslotId,
                    'EmployeeID' => $employeeId,
                    'Date' => $date, // or a specific date from form
                    ]);
                }
            }
        }
    

        return redirect()->back()->with('success', 'Assignments saved!');

    }

    public function assignPatient(Request $request){
        $assignments = $request->input('assignPatient',[]);
        $date=$request->input('Patientdate');
        // dd($date);
        foreach($assignments as $timeslotID => $patientAssignments){
            foreach($patientAssignments as $CaregiverID => $PatientID){
                if($PatientID){
                    DB::table('EmployeeSchedules')->updateOrInsert(
                        [
                        'EmployeeID'  => $CaregiverID,
                        'TimeslotId'  => $timeslotID,
                        'Date'        => $date,
                    ],
                    [
                        'PatientID' => $PatientID
                    ]
                    );
                }
            };
        };

        return redirect()->back()->with('success', 'Patient Assignments saved!');
    }

    
}

