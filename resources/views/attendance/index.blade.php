@extends('layouts.app')

@section('content')
<!-- Header -->
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Attendance & Time Tracking</h1>
    <p class="text-slate-400 font-bold mt-1 text-sm">Monitor employee attendance and working hours</p>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Regular Hours -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-xs font-extrabold text-slate-900 mb-2">Total Regular Hours</h3>
        <p class="text-4xl font-extrabold text-slate-900">{{ $summary['regular_hours'] }}</p>
        <p class="text-xs text-slate-500 font-medium mt-2">This week</p>
    </div>

    <!-- Overtime -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-xs font-extrabold text-slate-900 mb-2">Total Overtime</h3>
        <p class="text-4xl font-extrabold text-amber-500">{{ $summary['overtime'] }}</p>
        <p class="text-xs text-slate-500 font-medium mt-2">Extra hours worked</p>
    </div>

    <!-- Tardiness -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-xs font-extrabold text-slate-900 mb-2">Total Tardiness</h3>
        <p class="text-4xl font-extrabold text-amber-500">{{ $summary['tardiness'] }}</p>
        <p class="text-xs text-slate-500 font-medium mt-2">Hours Lost</p>
    </div>
</div>

<!-- Date Picker Mockup -->
<div class="flex items-center gap-3 mb-4">
    <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
    <button class="bg-slate-200 text-slate-700 px-4 py-2 rounded-md text-xs font-bold flex items-center gap-2">
        Current Week (Apr 14-18, 2026)
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>
</div>

<!-- Weekly Matrix Table -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="border-b-2 border-slate-800">
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Employee</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Mon, Apr 14</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Tue, Apr 15</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Wed, Apr 16</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Thu, Apr 17</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Fri, Apr 18</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceMatrix as $row)
                <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                    <!-- Employee Name -->
                    <td class="py-6 px-6 align-top">
                        <span class="font-extrabold text-slate-900 text-sm block mt-2">{{ $row['name'] }}</span>
                    </td>

                    <!-- Loop through the days (mon, tue, wed, thu, fri) -->
                    @foreach(['mon', 'tue', 'wed', 'thu', 'fri'] as $day)
                        @php $entry = $row['schedule'][$day]; @endphp
                        <td class="py-6 px-6 align-top space-y-1">
                            
                            <!-- Status Badge Logic -->
                            @if($entry['status'] === 'Present')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#DCFCE7] text-[#16A34A] mb-1">Present</span>
                            @elseif($entry['status'] === 'Late')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#FFEDD5] text-[#F97316] mb-1">Late</span>
                            @elseif($entry['status'] === 'Undertime')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#FEF3C7] text-[#D97706] mb-1">Undertime</span>
                            @elseif($entry['status'] === 'Absent')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#FEE2E2] text-[#DC2626] mb-1">Absent</span>
                            @endif

                            <!-- Time & Hours -->
                            <div class="text-[11px] font-medium text-slate-800 leading-tight block">{{ $entry['time'] }}</div>
                            <div class="text-[11px] font-medium text-slate-500 block">{{ $entry['hours'] }}</div>
                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection