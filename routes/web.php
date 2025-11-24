<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientRegistrationController;
use App\Http\Controllers\FamilyRegistrationController;
use App\Http\Controllers\AdminApprovalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Skeletons.homebase');
});

// Family member
Route::get('/family/home', [FamilyMemberController::class, 'home']);


// Login + Logout
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration
Route::get('/register/patient', [PatientRegistrationController::class, 'showForm'])->name('register.patient');
Route::post('/register/patient', [PatientRegistrationController::class, 'register']);

Route::get('/register/family', [FamilyRegistrationController::class, 'showForm'])->name('register.family');
Route::post('/register/family', [FamilyRegistrationController::class, 'register']);

// Admin approval panel
Route::get('/admin/approvals', [AdminApprovalController::class, 'index'])->name('admin.approvals');

// Approve actions
Route::post('/admin/approve/patient/{id}', [AdminApprovalController::class, 'approvePatient']);
Route::post('/admin/approve/family/{id}', [AdminApprovalController::class, 'approveFamily']);

// Reject actions
Route::post('/admin/reject/patient/{id}', [AdminApprovalController::class, 'rejectPatient']);
Route::post('/admin/reject/family/{id}', [AdminApprovalController::class, 'rejectFamily']);
