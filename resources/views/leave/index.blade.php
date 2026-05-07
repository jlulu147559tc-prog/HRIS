@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="mb-6 bg-[#ECFDF5] border border-[#10B981] text-[#10B981] px-4 py-3 rounded-lg flex items-center gap-2 font-bold text-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-start mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Leave Management</h1>
        <p class="text-slate-500 font-medium mt-1 text-sm">Manage employee leave requests and balances</p>
    </div>
    <button class="bg-[#22C55E] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Apply for Leave
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
    <div class="flex items-center gap-2 mb-6">
        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <h2 class="text-base font-bold text-slate-900">Leave Calendar - April 2026</h2>
    </div>

    <div class="space-y-3">
        @foreach($calendar ?? [] as $event)
        <div class="bg-[#F9FAFB] rounded-r-lg p-4 flex justify-between items-center border-l-4 {{ $event['color'] }}">
            <div>
                <p class="text-sm font-bold text-slate-900">{{ $event['name'] }}</p>
                <p class="text-xs text-slate-500 font-medium">{{ $event['type'] }}</p>
            </div>
            <div class="bg-white border border-slate-200 px-3 py-1 rounded-md text-xs font-bold text-slate-700">
                {{ $event['dates'] }}
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="flex items-center gap-4 mb-4">
    <div class="flex items-center gap-2">
        <span class="text-sm font-bold text-slate-700">Show:</span>
        <div class="bg-white border border-slate-300 rounded-md px-3 py-1.5 flex items-center gap-8 cursor-pointer">
            <span class="text-sm font-medium text-slate-700">All Requests</span>
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>
    <span class="text-sm font-medium text-slate-400">{{ $leaveRequests->count() }} requests</span>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200">
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Employee</th>
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Leave Type</th>
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Dates</th>
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Days</th>
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Reason</th>
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Status</th>
                <th class="py-4 px-6 text-xs font-bold text-slate-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($leaveRequests as $req)
            <tr class="hover:bg-slate-50 transition">
                <td class="py-4 px-6 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#0B1C3D] text-white flex items-center justify-center text-xs font-bold">
                        {{ $req->employee->initials }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $req->employee->first_name }} {{ $req->employee->last_name }}</p>
                        <p class="text-xs text-slate-500">Applied: {{ \Carbon\Carbon::parse($req->applied_date)->format('M d, Y') }}</p>
                    </div>
                </td>
                <td class="py-4 px-6">
                    <span class="px-3 py-1 rounded-full text-xs font-bold border border-slate-200 bg-slate-50 text-slate-700">
                        {{ $req->leave_type }}
                    </span>
                </td>
                <td class="py-4 px-6">
                    <p class="text-sm font-medium text-slate-700">{{ \Carbon\Carbon::parse($req->start_date)->format('M d, Y') }}</p>
                    <p class="text-sm font-medium text-slate-500">to {{ \Carbon\Carbon::parse($req->end_date)->format('M d, Y') }}</p>
                </td>
                <td class="py-4 px-6 text-sm font-medium text-slate-700">{{ $req->days_requested }}</td>
                <td class="py-4 px-6 text-sm font-medium text-slate-500">{{ $req->reason }}</td>
                <td class="py-4 px-6">
                    @if($req->status == 'Pending')
                        <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#F59E0B]/20 bg-[#FFFBEB] text-[#F59E0B]">Pending</span>
                    @elseif($req->status == 'Approved')
                        <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#10B981]/20 bg-[#ECFDF5] text-[#10B981]">Approved</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#EF4444]/20 bg-[#FEF2F2] text-[#EF4444]">Rejected</span>
                    @endif
                </td>
                <td class="py-4 px-6">
                    @if($req->status == 'Pending')
                        <div class="flex gap-2">
                            <form action="{{ route('hr.leave.status', $req->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Approved">
                                <button type="submit" class="w-8 h-8 rounded border border-[#22C55E] text-[#22C55E] flex items-center justify-center hover:bg-emerald-50 transition" title="Approve">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </form>
                            <form action="{{ route('hr.leave.status', $req->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Rejected">
                                <button type="submit" class="w-8 h-8 rounded border border-[#EF4444] text-[#EF4444] flex items-center justify-center hover:bg-red-50 transition" title="Reject">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <span class="text-xs text-slate-400 font-medium border border-slate-200 px-3 py-1 rounded-md bg-slate-50">Processed</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden p-6">
    <h2 class="text-base font-bold text-slate-900 mb-6">Leave Balances</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-slate-200">
                <th class="pb-3 text-sm font-bold text-slate-700">Employee</th>
                <th class="pb-3 text-sm font-bold text-slate-700">Vacation Leave</th>
                <th class="pb-3 text-sm font-bold text-slate-700">Sick Leave</th>
                <th class="pb-3 text-sm font-bold text-slate-700">Emergency Leave</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($balances ?? [] as $balance)
            <tr class="hover:bg-slate-50 transition">
                <td class="py-4 text-sm font-bold text-slate-900">{{ $balance['name'] }}</td>
                <td class="py-4">
                    <span class="text-sm font-bold text-[#16A34A]">{{ $balance['vacation'] }}</span>
                </td>
                <td class="py-4">
                    <span class="text-sm font-bold text-[#F97316]">{{ $balance['sick'] }}</span>
                </td>
                <td class="py-4">
                    <span class="text-sm font-bold text-[#64748B]">{{ $balance['emergency'] }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection