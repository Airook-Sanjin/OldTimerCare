<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controllers;

use Illuminate\Http\Request;


class Dashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Dash (){
        $user= auth()->user();
        
        // Detect roles
        $isEmployee = DB::table('Employee')->where('UserID', $user->UserID)->first();
        $isPatient  = DB::table('Patient')->where('UserID', $user->UserID)->first();
        $isFamily   = DB::table('FamilyMember')->where('UserID', $user->UserID)->first();

        if($isEmployee){
            $Role=(int) ($isEmployee->RoleID ?? 0);
            if ($Role === 1){
                return redirect()->route('Admin.home');
            }
            elseif($Role === 2){
                return redirect()->route('Supervisor.home');
            }
            elseif($Role === 3){
                return redirect()->route('Doctor.home');
            }
            elseif($Role === 4){
                return redirect()->route('Caregiver.home');
            }
            return view('dashboard',compact('user'));}
        if($isPatient){
            return redirect()->route('Patient.home');
        }
        if($isFamily){
           return redirect()->route('family.home'); 
        }

        return view('dashboard',compact('user')
        
        );
    }

}
