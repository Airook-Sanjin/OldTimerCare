<?php

namespace App\Http\Controllers;
use App\Models\Users;
use App\Http\Controllers\Controllers;

use Illuminate\Http\Request;


class Dashboard extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function Dash (){
        $user= auth()->user();
        
        return view('Users.Patient.Home',compact('user')
        
        );
    }

}
