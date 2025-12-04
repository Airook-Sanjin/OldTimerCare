<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class Roster extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user= auth()->user();
        return view('Users.RosterCreate',compact('user'));
    }
}
