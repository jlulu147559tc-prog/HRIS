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
Route::get('/employee/2fa', [AuthController::class, 'employeeTwoFactor'])->name('employee.2fa');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ---------------------------------------------------------
// HR Officer / Admin Dashboard Routes
// ---------------------------------------------------------
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

// Leave Routes
Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
Route::post('/leave', [LeaveController::class, 'store'])->name('hr.leave.store');
Route::post('/leave/{id}/status', [LeaveController::class, 'updateStatus'])->name('hr.leave.status');

Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');

// Performance Routes
Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
Route::post('/performance', [PerformanceController::class, 'store'])->name('hr.performance.store');

// Reports Routes
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/export-csv', [ReportController::class, 'exportCsv'])->name('reports.export.csv'); 

// Payroll Utilities
Route::post('/payroll/finalize', [PayrollController::class, 'finalizePayroll'])->name('payroll.finalize');
Route::get('/payroll/download-payslips', [PayrollController::class, 'downloadPayslips'])->name('payroll.download-payslips');
Route::get('/payroll/email-payslips', [PayrollController::class, 'emailPayslips'])->name('payroll.email-payslips');
Route::get('/payroll/bir-form', [PayrollController::class, 'downloadBirForm'])->name('payroll.bir-form');

// Employee Management
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');


// ---------------------------------------------------------
// Employee Self-Service Portal Routes (SECURE/PROTECTED)
// ---------------------------------------------------------
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

    // Profile Settings
    Route::get('/employee/profile', [EmployeePortalController::class, 'profile'])->name('employee.profile');
    Route::put('/employee/profile/update', [EmployeePortalController::class, 'updateProfile'])->name('employee.profile.update'); // <-- NEW: Added the update route
});