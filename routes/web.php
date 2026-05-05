<?php

use Illuminate\Support\Facades\Route;

// Import all Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeePortalController;

// ---------------------------------------------------------
// Authentication Routes
// ---------------------------------------------------------
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/2fa', [AuthController::class, 'twoFactor'])->name('2fa');


// ---------------------------------------------------------
// HR Officer / Admin Dashboard Routes
// ---------------------------------------------------------
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/employees', [EmployeeController::class, 'emp'])->name('employees.index');
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');



// ---------------------------------------------------------
// Employee Self-Service Portal Routes
// ---------------------------------------------------------
Route::get('/employee/dashboard', [EmployeePortalController::class, 'index'])->name('employee.dashboard');
Route::get('/employee/attendance', [EmployeePortalController::class, 'attendance'])->name('employee.attendance');
Route::get('/employee/leave', [EmployeePortalController::class, 'leave'])->name('employee.leave');
Route::get('/employee/payslips', [EmployeePortalController::class, 'payslips'])->name('employee.payslips');
Route::get('/employee/performance', [EmployeePortalController::class, 'performance'])->name('employee.performance');

// ---------------------------------------------------------
// Employee Self-Service Portal Routes
// ---------------------------------------------------------
Route::get('/employee/2fa', [App\Http\Controllers\AuthController::class, 'employeeTwoFactor'])->name('employee.2fa');
Route::get('/employee/dashboard', [EmployeePortalController::class, 'index'])->name('employee.dashboard');
Route::get('/employee/attendance', [EmployeePortalController::class, 'attendance'])->name('employee.attendance');
Route::get('/employee/leave', [EmployeePortalController::class, 'leave'])->name('employee.leave');
Route::get('/employee/payslips', [EmployeePortalController::class, 'payslips'])->name('employee.payslips');
Route::get('/employee/performance', [EmployeePortalController::class, 'performance'])->name('employee.performance');