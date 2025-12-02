<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminApprovalController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $pendingPatients = DB::table('Patient')
            ->where('is_approved', 0)
            ->join('Users', 'Users.UserID', '=', 'Patient.UserID')
            ->select('Patient.PatientID', 'Users.FirstName', 'Users.LastName', 'Users.Email')
            ->get();

        $pendingFamily = DB::table('FamilyMember')
            ->where('is_approved', 0)
            ->join('Users', 'Users.UserID', '=', 'FamilyMember.UserID')
            ->select('FamilyMember.FamilyMemberID', 'Users.FirstName', 'Users.LastName', 'Users.Email')
            ->get();

        return view('Users.admin.approvalPage', compact('pendingPatients', 'pendingFamily','user'));
    }

    public function approvePatient($id)
    {
        DB::table('Patient')->where('PatientID', $id)->update(['is_approved' => 1]);
        return back();
    }

    public function approveFamily($id)
    {
        DB::table('FamilyMember')->where('FamilyMemberID', $id)->update(['is_approved' => 1]);
        return back();
    }

    public function rejectPatient($id)
    {
        $userID = DB::table('Patient')->where('PatientID', $id)->value('UserID');
        DB::table('Patient')->where('PatientID', $id)->delete();
        DB::table('Users')->where('UserID', $userID)->delete();
        return back();
    }

    public function rejectFamily($id)
    {
        $userID = DB::table('FamilyMember')->where('FamilyMemberID', $id)->value('UserID');
        DB::table('FamilyMember')->where('FamilyMemberID', $id)->delete();
        DB::table('Users')->where('UserID', $userID)->delete();
        return back();
    }
}
