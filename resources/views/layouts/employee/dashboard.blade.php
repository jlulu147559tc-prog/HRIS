@extends('layouts.employee')

@section('content')
<div class="flex justify-between items-start mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Welcome back, {{ $data['employee']['name'] }}!</h1>
        <p class="text-slate-500 font-medium mt-1">Here's your HR overview for today, April 15, 2026</p>
    </div>
    <button class="bg-[#22C55E] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 shadow-sm transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        Apply for Leave
    </button>
</div>

<div class="bg-white rounded-2xl border border-emerald-200 p-6 mb-6 flex items-center gap-12 shadow-sm">
    <div class="w-20 h-20 bg-[#0B1C3D] rounded-full text-white flex items-center justify-center text-2xl font-bold border-4 border-white shadow-sm">
        MS
    </div>
    <div class="flex-1 grid grid-cols-4 gap-6">
        <div>
            <p class="text-xs font-bold text-slate-400 mb-1">Employee ID</p>
            <p class="text-sm font-bold text-slate-900">{{ $data['employee']['id'] }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-1">Department</p>
            <p class="text-sm font-bold text-slate-900">{{ $data['employee']['dept'] }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-1">Position</p>
            <p class="text-sm font-bold text-slate-900">{{ $data['employee']['position'] }}</p>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-1">Hire Date</p>
            <p class="text-sm font-bold text-slate-900">{{ $data['employee']['hire'] }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <svg class="w-5 h-5 text-emerald-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h3 class="text-3xl font-black text-slate-900">{{ $data['stats']['worked'] }}</h3>
        <p class="text-xs font-medium text-slate-500 mt-1">Days Worked This Month</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <svg class="w-5 h-5 text-emerald-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h3 class="text-3xl font-black text-slate-900">{{ $data['stats']['vacation'] }}</h3>
        <p class="text-xs font-medium text-slate-500 mt-1">Vacation Leave Balance</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <svg class="w-5 h-5 text-amber-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h3 class="text-3xl font-black text-slate-900">{{ $data['stats']['sick'] }}</h3>
        <p class="text-xs font-medium text-slate-500 mt-1">Sick Leave Balance</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <svg class="w-5 h-5 text-amber-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <h3 class="text-3xl font-black text-slate-900">{{ $data['stats']['pending'] }}</h3>
        <p class="text-xs font-medium text-slate-500 mt-1">Pending Requests</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Upcoming Events
        </div>
        <div class="space-y-4">
            @foreach($data['events'] as $event)
            <div class="flex gap-4 items-start bg-slate-50 rounded-xl p-4 border border-slate-100">
                <div class="w-10 h-10 rounded-lg {{ $event['bg'] }} flex items-center justify-center {{ $event['color'] }} flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $event['icon'] }}"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">{{ $event['title'] }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $event['desc'] }}</p>
                    <p class="text-xs text-slate-400 mt-1 font-medium">{{ $event['date'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Recent Activity
        </div>
        <div class="relative pl-6 space-y-6 before:absolute before:inset-0 before:ml-2.5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
            @foreach($data['activity'] as $act)
            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                <div class="flex items-center justify-center w-5 h-5 rounded-full border-4 border-white bg-emerald-500 absolute -left-6 z-10 shadow-sm"></div>
                <div class="w-full bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <h4 class="text-sm font-bold text-slate-900">{{ $act['title'] }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $act['desc'] }}</p>
                    <p class="text-xs text-slate-400 mt-2 font-medium">{{ $act['time'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
    <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        This Month's Attendance Summary
    </div>
    <div class="grid grid-cols-3 gap-8">
        <div>
            <div class="flex justify-between text-xs font-bold text-slate-600 mb-2">
                <span>Days Present</span><span class="text-slate-900">18 / 20</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2"><div class="bg-[#0B1C3D] h-2 rounded-full" style="width: 90%"></div></div>
        </div>
        <div>
            <div class="flex justify-between text-xs font-bold text-slate-600 mb-2">
                <span>On-Time Rate</span><span class="text-slate-900">95%</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2"><div class="bg-[#0B1C3D] h-2 rounded-full" style="width: 95%"></div></div>
        </div>
        <div>
            <div class="flex justify-between text-xs font-bold text-slate-600 mb-2">
                <span>Total Hours</span><span class="text-slate-900">144 hrs</span>
            </div>
            <div class="w-full bg-slate-200 rounded-full h-2"><div class="bg-[#0B1C3D] h-2 rounded-full" style="width: 90%"></div></div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
    <h3 class="text-sm font-bold text-slate-800 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-4 gap-4">
        <button class="border border-slate-200 rounded-xl p-4 flex flex-col items-center gap-3 hover:bg-slate-50 text-slate-700">
            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-sm font-bold">Apply Leave</span>
        </button>
        <button class="border border-slate-200 rounded-xl p-4 flex flex-col items-center gap-3 hover:bg-slate-50 text-slate-700">
            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="text-sm font-bold">View Payslips</span>
        </button>
        <button class="border border-slate-200 rounded-xl p-4 flex flex-col items-center gap-3 hover:bg-slate-50 text-slate-700">
            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-sm font-bold">Attendance Log</span>
        </button>
        <button class="border border-slate-200 rounded-xl p-4 flex flex-col items-center gap-3 hover:bg-slate-50 text-slate-700">
            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="text-sm font-bold">Update Profile</span>
        </button>
    </div>
</div>
@endsection