@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Attendance & Time Tracking</h1>
    <p class="text-slate-400 font-bold mt-1 text-sm">Monitor employee attendance and working hours</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-xs font-extrabold text-slate-900 mb-2">Total Regular Hours</h3>
        <p class="text-4xl font-extrabold text-slate-900">{{ $summary['regular_hours'] ?? '0.0' }}</p>
        <p class="text-xs text-slate-500 font-medium mt-2">This week</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-xs font-extrabold text-slate-900 mb-2">Total Overtime</h3>
        <p class="text-4xl font-extrabold text-amber-500">{{ $summary['overtime'] ?? '0.0' }}</p>
        <p class="text-xs text-slate-500 font-medium mt-2">Extra hours worked</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-xs font-extrabold text-slate-900 mb-2">Total Tardiness</h3>
        <p class="text-4xl font-extrabold text-amber-500">{{ $summary['tardiness'] ?? '0.0' }}</p>
        <p class="text-xs text-slate-500 font-medium mt-2">Hours Lost</p>
    </div>
</div>

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <form method="GET" action="{{ route('attendance.index') }}">
            <select name="week" onchange="this.form.submit()" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-md text-xs font-bold border-0 focus:outline-none cursor-pointer">
                <option value="current" {{ request('week', 'current') == 'current' ? 'selected' : '' }}>
                    Current Week ({{ \Carbon\Carbon::now()->startOfWeek()->format('M d') }} - {{ \Carbon\Carbon::now()->endOfWeek()->format('M d, Y') }})
                </option>
                <option value="previous" {{ request('week') == 'previous' ? 'selected' : '' }}>
                    Previous Week ({{ \Carbon\Carbon::now()->subWeek()->startOfWeek()->format('M d') }} - {{ \Carbon\Carbon::now()->subWeek()->endOfWeek()->format('M d, Y') }})
                </option>
            </select>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="border-b-2 border-slate-800">
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Employee</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Mon, {{ \Carbon\Carbon::now()->startOfWeek()->format('M d') }}</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Tue, {{ \Carbon\Carbon::now()->startOfWeek()->addDay(1)->format('M d') }}</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Wed, {{ \Carbon\Carbon::now()->startOfWeek()->addDay(2)->format('M d') }}</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Thu, {{ \Carbon\Carbon::now()->startOfWeek()->addDay(3)->format('M d') }}</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 w-1/6">Fri, {{ \Carbon\Carbon::now()->startOfWeek()->addDay(4)->format('M d') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceMatrix as $row)
                <tr class="border-b border-slate-200 hover:bg-slate-50 transition">
                    <td class="py-6 px-6 align-top">
                        <span class="font-extrabold text-slate-900 text-sm block mt-2">{{ $row['name'] }}</span>
                    </td>

                    @foreach(['mon', 'tue', 'wed', 'thu', 'fri'] as $day)
                        @php $entry = $row['schedule'][$day]; @endphp
                        <td class="py-6 px-6 align-top space-y-1 cursor-pointer hover:bg-slate-100/50 transition rounded-md" 
                            onclick="openAttendanceDetails('{{ $row['name'] }}', '{{ strtoupper($day) }}', '{{ $entry['status'] }}', '{{ $entry['time'] }}', '{{ $entry['hours'] }}')">
                            
                            @if($entry['status'] === 'Present')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#DCFCE7] text-[#16A34A] mb-1">Present</span>
                            @elseif($entry['status'] === 'Late')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#FFEDD5] text-[#F97316] mb-1">Late</span>
                            @elseif($entry['status'] === 'Undertime')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#FEF3C7] text-[#D97706] mb-1">Undertime</span>
                            @elseif($entry['status'] === 'Absent')
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#FEE2E2] text-[#DC2626] mb-1">Absent</span>
                            @endif

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

<div id="attendanceModal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-slate-900 bg-opacity-50 transition-opacity" aria-hidden="true" onclick="closeAttendanceDetails()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-6 pt-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-black text-slate-900" id="modal-employee-name">Employee Details</h3>
                <button onclick="closeAttendanceDetails()" class="text-slate-400 hover:text-slate-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="bg-white px-6 py-4 space-y-4">
                <div>
                    <span class="text-[10px] font-black tracking-wider text-slate-400 uppercase">Shift Schedule Day</span>
                    <p class="text-sm font-bold text-slate-900 mt-0.5" id="modal-shift-date">--</p>
                </div>
                <div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-4">
                    <div>
                        <span class="text-[10px] font-black tracking-wider text-slate-400 uppercase">Status</span>
                        <div class="mt-1" id="modal-status-badge"></div>
                    </div>
                    <div>
                        <span class="text-[10px] font-black tracking-wider text-slate-400 uppercase">Hours Rendered</span>
                        <p class="text-sm font-black text-slate-900 mt-1" id="modal-hours-worked">--</p>
                    </div>
                </div>
                <div class="border-t border-slate-100 pt-4">
                    <span class="text-[10px] font-black tracking-wider text-slate-400 uppercase">Time In / Time Out</span>
                    <p class="text-sm font-bold text-slate-800 mt-1" id="modal-time-log">--</p>
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse">
                <button type="button" onclick="closeAttendanceDetails()" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-slate-900 text-base font-bold text-white hover:bg-slate-800 sm:ml-3 sm:w-auto sm:text-xs">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openAttendanceDetails(name, day, status, time, hours) {
        document.getElementById('modal-employee-name').innerText = name;
        document.getElementById('modal-shift-date').innerText = day;
        document.getElementById('modal-time-log').innerText = time;
        document.getElementById('modal-hours-worked').innerText = hours;

        const badgeContainer = document.getElementById('modal-status-badge');
        let statusBadgeHTML = '';

        if (status === 'Present') {
            statusBadgeHTML = `<span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-[#DCFCE7] text-[#16A34A]">Present</span>`;
        } else if (status === 'Late') {
            statusBadgeHTML = `<span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-[#FFEDD5] text-[#F97316]">Late</span>`;
        } else if (status === 'Undertime') {
            statusBadgeHTML = `<span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-[#FEF3C7] text-[#D97706]">Undertime</span>`;
        } else if (status === 'Absent') {
            statusBadgeHTML = `<span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-[#FEE2E2] text-[#DC2626]">Absent</span>`;
        }

        badgeContainer.innerHTML = statusBadgeHTML;
        document.getElementById('attendanceModal').classList.remove('hidden');
    }

    function closeAttendanceDetails() {
        document.getElementById('attendanceModal').classList.add('hidden');
    }
</script>
@endsection