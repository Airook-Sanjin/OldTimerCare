<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controllers;

use Illuminate\Http\Request;


class Dashboard extends Controller
{
    public function Dash (){
        return view('Skeletons.homebase');
    }

}
