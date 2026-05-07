@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
    <p class="text-slate-600 mt-1">Welcome back! Here's what's happening with your organization today.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-6 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Today's Attendance
        </div>
        
        <div class="flex items-center justify-between">
            @php
                $totalAttendance = $presentToday + $absentToday + $lateToday;
                $totalAttendance = $totalAttendance > 0 ? $totalAttendance : 1; // Prevent division by zero
                
                $pctPresent = round(($presentToday / $totalAttendance) * 100);
                $pctAbsent = round(($absentToday / $totalAttendance) * 100);
                $pctLate = round(($lateToday / $totalAttendance) * 100);
                
                // Calculate where the colors should stop on the circle
                $stop1 = $pctPresent;
                $stop2 = $pctPresent + $pctAbsent;
            @endphp
            
            <div class="relative w-32 h-32 rounded-full flex items-center justify-center" 
                 style="background: conic-gradient(#10b981 0% {{ $stop1 }}%, #ef4444 {{ $stop1 }}% {{ $stop2 }}%, #f59e0b {{ $stop2 }}% 100%);">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center flex-col shadow-inner">
                    <span class="text-xl font-black text-slate-800">{{ $totalActive }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total</span>
                </div>
            </div>

            <div class="space-y-3 flex-1 ml-8">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm"></span>
                        <span class="text-slate-600 font-medium">Present</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $presentToday }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500 shadow-sm"></span>
                        <span class="text-slate-600 font-medium">Absent</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $absentToday }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-amber-500 shadow-sm"></span>
                        <span class="text-slate-600 font-medium">Late</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $lateToday }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Pending Leave Requests
            </div>
            <a href="{{ route('leave.index') }}" class="text-xs font-bold text-emerald-500 hover:text-emerald-600 transition">View All</a>
        </div>
        
        <div class="space-y-3">
            @forelse($pendingLeaves as $leave)
            <div class="bg-slate-50 border border-slate-100 hover:border-emerald-200 rounded-lg p-3 flex justify-between items-start transition cursor-pointer">
                <div>
                    <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</p>
                    <p class="text-xs text-slate-500 font-medium">{{ $leave->leave_type }}</p>
                    <p class="text-[11px] text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($leave->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</p>
                </div>
                <span class="bg-amber-100 text-amber-700 border border-amber-200 text-[10px] font-bold px-2 py-1 rounded shadow-sm">{{ $leave->days_requested }}d</span>
            </div>
            @empty
            <div class="text-center py-6">
                <svg class="w-10 h-10 text-slate-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-sm font-medium text-slate-400">All caught up!</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-4 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Upcoming Reviews
        </div>
        <div class="space-y-3">
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-3 flex gap-3 items-start">
                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <p class="text-sm font-semibold text-slate-800 leading-tight">Pedro Alvarez</p>
                    <p class="text-xs text-slate-500">Engineering</p>
                    <p class="text-xs text-slate-400 mt-1">Due: Apr 18, 2026</p>
                </div>
            </div>
            <div class="bg-slate-50 border border-slate-100 rounded-lg p-3 flex gap-3 items-start">
                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <p class="text-sm font-semibold text-slate-800 leading-tight">Rosa Mendoza</p>
                    <p class="text-xs text-slate-500">Finance</p>
                    <p class="text-xs text-slate-400 mt-1">Due: Apr 20, 2026</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6 flex flex-col items-center justify-center text-center">
        <div class="w-full flex justify-start items-center gap-2 mb-4 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Next Payroll Due
        </div>
        <div class="w-32 h-32 rounded-full bg-[#ECFDF5] border-4 border-[#D1FAE5] flex flex-col items-center justify-center mb-4 shadow-sm">
            <span class="text-4xl font-black text-emerald-600">3</span>
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider mt-1">Days</span>
        </div>
        <p class="text-sm font-semibold text-slate-800">April 18, 2026</p>
        <p class="text-xs text-slate-500">Semi-Monthly Period 1</p>
    </div>

    <div class="lg:col-span-2 bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                New Hires (Last 30 Days)
            </div>
            <a href="{{ route('employees.index') }}" class="text-xs font-bold text-emerald-500 hover:text-emerald-600 transition">View Directory</a>
        </div>
        <div class="space-y-3">
            @forelse($newHires as $hire)
            <div class="bg-slate-50 border border-slate-100 hover:border-emerald-200 rounded-lg p-3 flex justify-between items-center transition cursor-pointer">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-[#0B1C3D] text-white shadow-sm font-extrabold text-sm flex items-center justify-center">
                        {{ $hire->initials }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">{{ $hire->first_name }} {{ $hire->last_name }}</p>
                        <p class="text-xs text-slate-500 font-medium">{{ $hire->position }}</p>
                    </div>
                </div>
                <div class="text-xs font-bold text-slate-400 border border-slate-200 px-2 py-1 rounded bg-white">
                    Hired {{ \Carbon\Carbon::parse($hire->hire_date)->format('M d, Y') }}
                </div>
            </div>
            @empty
            <div class="text-center py-6">
                <p class="text-sm font-medium text-slate-400">No new hires in the last 30 days.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="lg:col-span-3 bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-slate-900 leading-tight">12-Month Trends</h3>
        <p class="text-xs font-medium text-slate-500 mb-4">Headcount, attendance rate, and overtime hours</p>
        
        <div class="w-full h-48 border-l border-b border-slate-300 relative mt-4">
            <div class="absolute w-full h-full flex flex-col justify-between">
                <div class="border-t border-dashed border-slate-200 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-200 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-200 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-200 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-200 w-full h-0"></div>
            </div>
            
            <div class="absolute -left-8 h-full flex flex-col justify-between text-[10px] font-bold text-slate-400 py-1 items-end">
                <span>180</span>
                <span>135</span>
                <span>90</span>
                <span>45</span>
                <span>0</span>
            </div>

            <div class="absolute -bottom-6 w-full flex justify-between text-[10px] font-bold text-slate-400 px-2">
                <span>Apr 25</span><span>May 25</span><span>June 25</span><span>July 25</span>
                <span>Aug 25</span><span>Sept 25</span><span>Oct 25</span><span>Nov 25</span>
                <span>Dec 25</span><span>Jan 26</span><span>Feb 26</span><span>March 26</span>
            </div>

            <svg class="absolute top-0 left-0 w-full h-full drop-shadow-md" preserveAspectRatio="none" viewBox="0 0 100 100">
                <polyline points="0,20 10,20 20,20 30,19 40,18 50,17 60,16 70,15 80,16 90,15 100,12" fill="none" stroke="#10B981" stroke-width="1.5"/>
                <circle cx="0" cy="20" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="10" cy="20" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="20" cy="20" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="30" cy="19" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="40" cy="18" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="50" cy="17" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="60" cy="16" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="70" cy="15" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="80" cy="16" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="90" cy="15" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
                <circle cx="100" cy="12" r="1.5" fill="#10B981" class="stroke-white stroke-2" />
            </svg>
        </div>

        <div class="flex justify-center items-center gap-8 mt-10 text-[11px] font-bold uppercase tracking-wider">
            <div class="flex items-center gap-1.5 text-slate-500">
                <span class="w-3 h-1 bg-slate-300 rounded-full"></span> Headcount
            </div>
            <div class="flex items-center gap-1.5 text-emerald-600">
                <span class="w-3 h-1 bg-emerald-500 rounded-full"></span> Attendance Rate
            </div>
            <div class="flex items-center gap-1.5 text-amber-500">
                <span class="w-3 h-1 bg-amber-500 rounded-full"></span> Overtime
            </div>
        </div>
    </div>
</div>
@endsection