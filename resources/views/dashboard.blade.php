@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
    <p class="text-slate-600 mt-1">Welcome back! Here's what's happening with your organization today.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Widget 1: Today's Attendance -->
    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-6 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            Today's Attendance
        </div>
        
        <div class="flex items-center justify-between">
            <!-- CSS Donut Chart (Approximating 87% green, 5% red, 8% yellow) -->
            <div class="relative w-32 h-32 rounded-full flex items-center justify-center" 
                 style="background: conic-gradient(#10b981 0% 88%, #ef4444 88% 92%, #f59e0b 92% 100%);">
                <div class="w-24 h-24 bg-white rounded-full"></div>
            </div>

            <!-- Legend -->
            <div class="space-y-3 flex-1 ml-8">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-slate-600 font-medium">Present</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $data['attendance']['present'] }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="text-slate-600 font-medium">Absent</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $data['attendance']['absent'] }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="text-slate-600 font-medium">Late</span>
                    </div>
                    <span class="font-bold text-slate-800">{{ $data['attendance']['late'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Widget 2: Pending Leave Requests -->
    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-4 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Pending Leave Requests
        </div>
        <div class="space-y-3">
            @foreach($data['pending_leaves'] as $leave)
            <div class="bg-slate-200 rounded-lg p-3 flex justify-between items-start">
                <div>
                    <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $leave['name'] }}</p>
                    <p class="text-xs text-slate-600">{{ $leave['type'] }}</p>
                    <p class="text-xs text-slate-600">{{ $leave['dates'] }}</p>
                </div>
                <span class="bg-slate-300 text-slate-700 text-xs font-bold px-2 py-1 rounded">{{ $leave['duration'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Widget 3: Upcoming Reviews -->
    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-4 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Upcoming Reviews
        </div>
        <div class="space-y-3">
            @foreach($data['upcoming_reviews'] as $review)
            <div class="bg-slate-200 rounded-lg p-3 flex gap-3 items-start">
                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <p class="text-sm font-semibold text-slate-800 leading-tight">{{ $review['name'] }}</p>
                    <p class="text-xs text-slate-600">{{ $review['dept'] }}</p>
                    <p class="text-xs text-slate-600 mt-1">Due: {{ $review['due'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Widget 4: Next Payroll Due (Spans 1 column) -->
    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6 flex flex-col items-center justify-center text-center">
        <div class="w-full flex justify-start items-center gap-2 mb-4 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Next Payroll Due
        </div>
        <div class="w-32 h-32 rounded-full bg-[#E5F3D6] flex flex-col items-center justify-center mb-4">
            <span class="text-3xl font-black text-slate-800">{{ $data['payroll']['days_left'] }}</span>
            <span class="text-sm font-bold text-slate-800">Days</span>
        </div>
        <p class="text-sm font-semibold text-slate-800">{{ $data['payroll']['date'] }}</p>
        <p class="text-xs text-slate-600">{{ $data['payroll']['period'] }}</p>
    </div>

    <!-- Widget 5: New Hires (Spans 2 columns) -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <div class="flex items-center gap-2 mb-4 text-sm font-semibold text-slate-700">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            New Hires (Last 30 Days)
        </div>
        <div class="space-y-3">
            @foreach($data['new_hires'] as $hire)
            <div class="bg-slate-200 rounded-lg p-3 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-400 text-slate-900 font-bold flex items-center justify-center">
                        {{ $hire['initials'] }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800">{{ $hire['name'] }}</p>
                        <p class="text-xs text-slate-600">{{ $hire['role'] }}</p>
                    </div>
                </div>
                <div class="text-sm text-slate-500">{{ $hire['date'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Widget 6: 12-Month Trends (Spans 3 columns) -->
    <div class="lg:col-span-3 bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
        <h3 class="text-sm font-bold text-slate-900 leading-tight">12-Month Trends</h3>
        <p class="text-xs font-bold text-slate-700 mb-4">Headcount, attendance rate, and overtime hours</p>
        
        <!-- Mock Line Chart area -->
        <div class="w-full h-48 border-l border-b border-slate-300 relative mt-4">
            <!-- Grid Lines -->
            <div class="absolute w-full h-full flex flex-col justify-between">
                <div class="border-t border-dashed border-slate-300 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-300 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-300 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-300 w-full h-0"></div>
                <div class="border-t border-dashed border-slate-300 w-full h-0"></div>
            </div>
            
            <!-- Y-Axis Labels -->
            <div class="absolute -left-6 h-full flex flex-col justify-between text-[10px] text-slate-500 py-1 items-end">
                <span>180</span>
                <span>135</span>
                <span>90</span>
                <span>45</span>
                <span>0</span>
            </div>

            <!-- X-Axis Labels -->
            <div class="absolute -bottom-6 w-full flex justify-between text-[10px] text-slate-500 px-2">
                <span>Apr 25</span><span>May 25</span><span>June 25</span><span>July 25</span>
                <span>Aug 25</span><span>Sept 25</span><span>Oct 25</span><span>Nov 25</span>
                <span>Dec 25</span><span>Jan 26</span><span>Feb 26</span><span>March 26</span>
            </div>

            <!-- Mock Data Line (SVG) -->
            <svg class="absolute top-0 left-0 w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                <polyline points="0,20 10,20 20,20 30,19 40,18 50,17 60,16 70,15 80,16 90,15 100,12" fill="none" stroke="#f59e0b" stroke-width="0.5"/>
                <!-- Dots -->
                <circle cx="0" cy="20" r="1" fill="#f59e0b" />
                <circle cx="10" cy="20" r="1" fill="#f59e0b" />
                <circle cx="20" cy="20" r="1" fill="#f59e0b" />
                <circle cx="30" cy="19" r="1" fill="#f59e0b" />
                <circle cx="40" cy="18" r="1" fill="#f59e0b" />
                <circle cx="50" cy="17" r="1" fill="#f59e0b" />
                <circle cx="60" cy="16" r="1" fill="#f59e0b" />
                <circle cx="70" cy="15" r="1" fill="#f59e0b" />
                <circle cx="80" cy="16" r="1" fill="#f59e0b" />
                <circle cx="90" cy="15" r="1" fill="#f59e0b" />
                <circle cx="100" cy="12" r="1" fill="#f59e0b" />
            </svg>
        </div>

        <!-- Legend -->
        <div class="flex justify-center items-center gap-6 mt-10 text-xs font-bold">
            <div class="flex items-center gap-1 text-slate-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg> Headcount
            </div>
            <div class="flex items-center gap-1 text-emerald-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> Attendance Rate (%)
            </div>
            <div class="flex items-center gap-1 text-amber-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg> Overtime (hrs)
            </div>
        </div>
    </div>
</div>
@endsection