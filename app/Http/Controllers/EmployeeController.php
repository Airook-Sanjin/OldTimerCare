<?php
//* This is where we will handle Doctor's, Caregiver's,Admin's, Supervisor's dashboards and functionality
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
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
    public function doctorhome(){
        $user = auth()->user();
        $userID= auth()->user()->UserID;
        $isEmployee = DB::table('Employee')->where('UserID',$userID)->first();
        return view('Users.Doctor.home',compact('user'));
    }
    public function caregiverhome(){
        $user = auth()->user();
        $userID= auth()->user()->UserID;
        $isEmployee = DB::table('Employee')->where('UserID',$userID)->first();
        return view('Users.Caregiver.home',compact('user'));
    }/**
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
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
