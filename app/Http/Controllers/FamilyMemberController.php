<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    

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
     public function home()
    {   
        $user = auth()->user();
        return view('Users.family.home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyMember $familyMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyMember $familyMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyMember $familyMember)
    {
        //
    }
}
