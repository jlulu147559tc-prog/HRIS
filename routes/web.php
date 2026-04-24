<?php use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/2fa', [AuthController::class, 'twoFactor'])->name('2fa');
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReportController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/employees', [EmployeeController::class, 'emp'])->name('employees.index');

// New Routes for the remaining modules
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('/performance', [PerformanceController::class, 'index'])->name('performance.index');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');