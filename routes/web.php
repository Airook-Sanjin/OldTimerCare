<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientController;

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

Route::get('/rehash', function () {
    $users = \App\Models\Users::all();

    foreach ($users as $user) {
        // Directly hash the current plaintext password
        $user->Password = $user->Password;
        $user->save();
    }

    return "All passwords rehashed successfully.";
});

// Login + Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// * User Dashboard Base
Route::get('/dashboard',[Dashboard::class,'Dash'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function(){
    Route::get('/admin/home', [EmployeeController::class, 'adminHome'])->name('Admin.home');
    Route::get('/supervisor/home', [EmployeeController::class, 'supervisorHome'])->name('Supervisor.home');
    Route::get('/doctor/home', [EmployeeController::class, 'doctorHome'])->name('Doctor.home');
    Route::get('/caregiver/home', [EmployeeController::class, 'caregiverHome'])->name('Caregiver.home');
// *family & Patients
    Route::get('/patient/home', [PatientController::class, 'index'])->name('patient.home');
    Route::get('/family/home', [FamilyController::class, 'home'])->name('family.home');
});
// // Family member
// Route::get('/family/home', [FamilyMemberController::class, 'home']);




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

// doctor making appointment
Route::post('/doctor/appointments/create', [EmployeeController::class, 'createAppointment'])
    ->name('doctor.appointments.create');