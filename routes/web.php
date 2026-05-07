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
// The pages where you type your credentials
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/2fa', [AuthController::class, 'twoFactor'])->name('2fa');
Route::get('/employee/2fa', [AuthController::class, 'employeeTwoFactor'])->name('employee.2fa');

// The actions that actually process the login and logout
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ---------------------------------------------------------
// HR Officer / Admin Dashboard Routes
// ---------------------------------------------------------
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// UPDATED: Changed 'emp' to 'index'
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Finalize Payroll Route
Route::post('/payroll/finalize', [PayrollController::class, 'finalizePayroll'])->name('payroll.finalize');

// Utility routes for Payroll Processing actions
Route::get('/payroll/download-payslips', [PayrollController::class, 'downloadPayslips'])->name('payroll.download-payslips');
Route::get('/payroll/email-payslips', [PayrollController::class, 'emailPayslips'])->name('payroll.email-payslips');
Route::get('/payroll/bir-form', [PayrollController::class, 'downloadBirForm'])->name('payroll.bir-form');

// Add this right under Route::get('/leave', ...)
Route::post('/leave/{id}/status', [LeaveController::class, 'updateStatus'])->name('hr.leave.status');

// Show Add Employee Form
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');

// Save New Employee
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');


// ---------------------------------------------------------
// Employee Self-Service Portal Routes (SECURE/PROTECTED)
// ---------------------------------------------------------
// By wrapping these in "middleware('auth')", Laravel will automatically 
// kick users back to the login page if they try to access these URLs without signing in first!
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/employee/dashboard', [EmployeePortalController::class, 'index'])->name('employee.dashboard');
    
    // Attendance
    Route::get('/employee/attendance', [EmployeePortalController::class, 'attendance'])->name('employee.attendance');
    Route::post('/employee/attendance/punch', [EmployeePortalController::class, 'punchClock'])->name('employee.attendance.punch');
    
    // Leave
    Route::get('/employee/leave', [EmployeePortalController::class, 'leave'])->name('employee.leave');
    Route::post('/employee/leave', [EmployeePortalController::class, 'storeLeave'])->name('employee.leave.store');
    
    // Payslips & Performance
    Route::get('/employee/payslips', [EmployeePortalController::class, 'payslips'])->name('employee.payslips');
    Route::get('/employee/performance', [EmployeePortalController::class, 'performance'])->name('employee.performance');
});