<?php

use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// Route::get('/leave/approve/{id}/{token}', [EmployeesController::class, 'approveViaEmail'])->name('leave_approve');
// Route::get('/leave/reject/{id}/{token}', [EmployeesController::class, 'rejectViaEmail'])->name('leave_reject');
Route::get('login', [EmployeesController::class, 'showLoginForm'])->name('login');
Route::post('login', [EmployeesController::class, 'login'])->name('login.submit');
Route::get('logout', [EmployeesController::class, 'logout'])->name('logout');

Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin.adminlogin');
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.adminlogin.submit');
Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function(){
    Route::get('/create', [EmployeesController::class, 'create'])->name('employees_create');
});

Route::post('/leave-requests', [EmployeesController::class, 'store'])->name('employees_store');
Route::get('/leave-requests/approve/{id}', [EmployeesController::class, 'approve'])->name('leave_approve');
Route::get('/leave-requests/reject/{id}', [EmployeesController::class, 'reject'])->name('leave_reject');
Route::get('/leave-requestssss', [EmployeesController::class, 'index'])->name('leave_requests.index');
Route::post('/leave-requests/{id}/update-status', [EmployeesController::class, 'updateStatus'])->name('leave_requests.update_status');
Route::get('/leave-requests/get', [EmployeesController::class, 'getLeaveRequests'])->name('get_leave_requests'); 
// Route::get('/leave-requests/approve/{id}', [EmployeesController::class, 'approve'])->name('leave_approve');







