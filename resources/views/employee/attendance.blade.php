@extends('layouts.employee')

@section('content')

@if(session('success'))
    <div class="mb-6 bg-[#ECFDF5] border border-[#10B981] text-[#10B981] px-4 py-3 rounded-lg flex items-center gap-2 font-bold text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-6 bg-[#FEF2F2] border border-[#EF4444] text-[#EF4444] px-4 py-3 rounded-lg flex items-center gap-2 font-bold text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('error') }}
    </div>
@endif

<div class="flex justify-between items-start mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Attendance</h1>
        <p class="text-slate-500 font-medium mt-1">View your attendance records and work hours</p>
    </div>
    <div class="border border-slate-300 bg-white rounded-md px-4 py-2 flex items-center gap-6 shadow-sm cursor-pointer hover:bg-slate-50 transition">
        <span class="text-sm font-bold text-slate-700">April 2026</span>
        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <svg class="w-4 h-4 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-xs font-bold">Days Worked</span>
        </div>
        <h3 class="text-2xl font-black text-slate-900">{{ $data['summary']['worked'] }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <svg class="w-4 h-4 text-[#0B1C3D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-xs font-bold">Regular Hours</span>
        </div>
        <h3 class="text-2xl font-black text-slate-900">{{ $data['summary']['regular'] }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <svg class="w-4 h-4 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-xs font-bold">Overtime</span>
        </div>
        <h3 class="text-2xl font-black text-[#10B981]">{{ $data['summary']['overtime'] }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <svg class="w-4 h-4 text-[#F59E0B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-xs font-bold">Late Instances</span>
        </div>
        <h3 class="text-2xl font-black text-[#F59E0B]">{{ $data['summary']['late'] }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <svg class="w-4 h-4 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-xs font-bold">Perfect Days</span>
        </div>
        <h3 class="text-2xl font-black text-[#10B981]">{{ $data['summary']['perfect'] }}</h3>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <svg class="w-4 h-4 text-[#0B1C3D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-xs font-bold">On-Time Rate</span>
        </div>
        <h3 class="text-2xl font-black text-slate-900">{{ $data['summary']['rate'] }}</h3>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-[#10B981] p-6 mb-8 flex flex-wrap items-center justify-between gap-6">
    <div class="flex items-center gap-6">
        <div class="w-12 h-12 rounded-full bg-[#ECFDF5] text-[#10B981] flex items-center justify-center border border-[#10B981]/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-1">Today's Status</p>
            <p class="text-xl font-black text-slate-900">{{ $data['today']['status'] }}</p>
        </div>
    </div>
    <div class="text-center border-l border-r border-slate-100 px-8 lg:px-12">
        <p class="text-xs font-bold text-slate-400 mb-1">Time In</p>
        <p class="text-xl font-black text-[#10B981]">{{ $data['today']['time_in'] }}</p>
    </div>
    <div class="text-center pr-8 lg:pr-12">
        <p class="text-xs font-bold text-slate-400 mb-1">Current Duration</p>
        <p class="text-xl font-black text-slate-900">{{ $data['today']['duration'] }}</p>
    </div>
    
    <form action="{{ route('employee.attendance.punch') }}" method="POST" class="ml-auto">
        @csrf
        <button type="submit" class="bg-[#0B1C3D] hover:bg-slate-800 text-white px-8 py-3 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Punch In / Out
        </button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
    <div class="p-6 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-900">Attendance History</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-white border-b border-slate-200">
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Date</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Day</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Time In</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Time Out</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Hours Worked</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($data['history'] as $row)
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-4 px-6 text-sm font-bold text-slate-900">{{ $row['date'] }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-slate-500">{{ $row['day'] }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-slate-700">{{ $row['time_in'] }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-slate-700">{{ $row['time_out'] }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-slate-700">{{ $row['hours_worked'] }}</td>
                    <td class="py-4 px-6">
                        @if($row['status'] === 'Present')
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border border-[#10B981]/20 bg-[#F0FDF4] text-[#10B981]">Present</span>
                        @elseif($row['status'] === 'Late')
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border border-[#F59E0B]/20 bg-[#FFFBEB] text-[#F59E0B]">Late</span>
                        @else
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border border-[#DC2626]/20 bg-[#FEF2F2] text-[#DC2626]">{{ $row['status'] }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="bg-[#F8FAFC] border border-[#CBD5E1] rounded-xl p-5 flex items-start gap-4">
    <div class="w-6 h-6 rounded-full border-2 border-[#10B981] text-[#10B981] flex items-center justify-center flex-shrink-0 mt-0.5">
        <span class="text-xs font-bold block pb-0.5">!</span>
    </div>
    <div>
        <h4 class="text-sm font-bold text-slate-800 mb-1">Attendance Policy Reminder</h4>
        <p class="text-sm text-slate-500 font-medium">Regular work hours are 8:00 AM - 5:00 PM. Late arrivals beyond 8:15 AM will be marked as tardy. Please coordinate with your manager for any schedule adjustments.</p>
    </div>
</div>
@endsection