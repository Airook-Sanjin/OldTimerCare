<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use Carbon\Carbon;

class Roster extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        // dd($request->month, gettype($request->month));
        $employees=DB::table('Employee') ->get();
        $timeslots = DB::table('Timeslots') ->get();

        $monthInp= trim($request->month ?? '');
        $monthInp= preg_replace('/[^\d-]/', '', $monthInp);

        if(preg_match('/^\d{4}-\d{2}$/',$monthInp)){
            $date = Carbon::createFromFormat('Y-m-d', $monthInp . '-01')->startOfMonth();
        }else{
            $date = Carbon::now()->startOfMonth();
        }
        $user= auth()->user();
        // dd('monthInp', $monthInput, $monthInput . '-01');


        return view('Users.RosterCreate',compact('user','date','employees','timeslots'));
    }
    
}

