<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Roster;


use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\PatientRegistrationController;
use App\Http\Controllers\Authentication\FamilyRegistrationController;
use App\Http\Controllers\Authentication\AdminApprovalController;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

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

// Login + Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//* User Dashboard Base


//*  group function to auth (Logged-in User ) each route in here 
Route::middleware('auth')->group(function(){
    //* This is the General Dashboard
    Route::get('/dashboard',[Dashboard::class,'Dash'])->name('dashboard');

    Route::middleware('role:Admin,Supervisor')->group(function(){
        Route::get('/admin/home', [EmployeeController::class, 'adminHome'])->name('Admin.home');

        // Registration
        Route::get('/register/patient', [PatientRegistrationController::class, 'showForm'])->name('register.patient');
        Route::post('/register/patient', [PatientRegistrationController::class, 'register']);

        Route::get('/register/family', [FamilyRegistrationController::class, 'showForm'])->name('register.family');
        Route::post('/register/family', [FamilyRegistrationController::class, 'register']);

        // Admin approval panel
        Route::get('/admin/approvalPage', [AdminApprovalController::class, 'index'])->name('admin.approvalPage');

        // Approve actions
        Route::post('/admin/approve/patient/{id}', [AdminApprovalController::class, 'approvePatient']);
        Route::post('/admin/approve/family/{id}', [AdminApprovalController::class, 'approveFamily']);

        // Reject actions
        Route::post('/admin/reject/patient/{id}', [AdminApprovalController::class, 'rejectPatient']);
        Route::post('/admin/reject/family/{id}', [AdminApprovalController::class, 'rejectFamily']);

        Route::get('/supervisor/home', [EmployeeController::class, 'supervisorHome'])->name('Supervisor.home');
        Route::get('/Users/Rostercreate',[Roster::class, 'Rostercreate'])->name('Rostercreate');


        Route::post('/roster/assignEmployee', [Roster::class, 'assignEmployee'])->name('roster.assignEmployee');
        Route::post('/roster/assignPatient', [Roster::class, 'assignPatient'])->name('roster.assignPatient');

    });
    
    Route::get('/Users/RosterCreate',[Roster::class, 'CalendarView'])->name('CalendarView');
    Route::get('/doctor/home', [EmployeeController::class, 'doctorHome'])->name('Doctor.home');
    Route::get('/caregiver/home', [EmployeeController::class, 'caregiverHome'])->name('Caregiver.home');
// *family & Patients
    Route::get('/patient/home', [PatientController::class, 'index'])->name('Patient.home');
    Route::get('/family/home', [FamilyMemberController::class, 'home'])->name('family.home');
});
// // Family member
// Route::get('/family/home', [FamilyMemberController::class, 'home']);





Route::get('/register/family', [FamilyRegistrationController::class, 'showForm'])->name('register.family');
Route::post('/register/family', [FamilyRegistrationController::class, 'register']);

// Admin approval panel
Route::get('/admin/approvalPage', [AdminApprovalController::class, 'index'])->name('admin.approvalPage');

// Approve actions
Route::post('/admin/approve/patient/{id}', [AdminApprovalController::class, 'approvePatient']);
Route::post('/admin/approve/family/{id}', [AdminApprovalController::class, 'approveFamily']);

// Reject actions
Route::post('/admin/reject/patient/{id}', [AdminApprovalController::class, 'rejectPatient']);
Route::post('/admin/reject/family/{id}', [AdminApprovalController::class, 'rejectFamily']);

// doctor making appointment
Route::post('/doctor/appointments/create', [EmployeeController::class, 'createAppointment'])
    ->name('doctor.appointments.create');

//checklist
Route::post('/meals/update', [EmployeeController::class, 'updateMeals'])->name('meals.update');
Route::post('/meds/update', [EmployeeController::class, 'updateMeds'])->name('meds.update');
