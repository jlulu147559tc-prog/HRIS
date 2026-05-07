@extends('layouts.employee')

@section('content')
<div x-data="{ isModalOpen: false }"> 

    @if(session('success'))
        <div class="mb-4 bg-[#ECFDF5] border border-[#10B981] text-[#10B981] px-4 py-3 rounded-lg flex items-center gap-2 font-bold text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-start mb-8 mt-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Leave</h1>
            <p class="text-slate-500 font-medium mt-1">Manage your leave requests and balances</p>
        </div>
        <button @click="isModalOpen = true" class="bg-[#22C55E] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Apply for Leave
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @foreach($data['balances'] as $balance)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-sm font-bold text-slate-900 mb-6">{{ $balance['type'] }}</h3>
            
            <div class="flex justify-between items-end mb-4">
                <div>
                    <span class="text-4xl font-black {{ $balance['text_color'] }}">{{ $balance['available'] }}</span>
                    <p class="text-xs font-medium text-slate-500 mt-1">days available</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-500">Used: <span class="text-slate-700">{{ $balance['used'] }}</span></p>
                    <p class="text-xs font-bold text-slate-500">Total: <span class="text-slate-700">{{ $balance['total'] }}</span></p>
                </div>
            </div>

            <div class="w-full bg-slate-100 rounded-full h-2.5 mb-2 relative overflow-hidden">
                <div class="bg-[#0B1C3D] h-2.5 rounded-full" style="width: {{ $balance['utilized_percent'] }}%"></div>
            </div>
            <p class="text-xs font-medium text-slate-500 text-right">{{ $balance['utilized_percent'] }}% utilized</p>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-[#10B981] p-6 mb-8 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <div class="w-12 h-12 rounded-full bg-[#ECFDF5] text-[#10B981] flex items-center justify-center border border-[#10B981]/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 mb-1">Upcoming Approved Leave</p>
                <h3 class="text-xl font-bold text-slate-900">{{ $data['upcoming']['type'] }} - {{ $data['upcoming']['dates'] }}</h3>
                <p class="text-sm font-medium text-slate-500 mt-1">{{ $data['upcoming']['days'] }} days | {{ $data['upcoming']['reason'] }}</p>
            </div>
        </div>
        <span class="px-4 py-1.5 rounded-full text-xs font-bold border border-[#10B981]/20 bg-[#ECFDF5] text-[#10B981] flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
            {{ $data['upcoming']['status'] }}
        </span>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-base font-bold text-slate-900">Leave History</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-white border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Leave Type</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Dates</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Days</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Reason</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Applied Date</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Status</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Approved By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($data['history'] as $row)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-6 text-sm font-bold text-slate-900">{{ $row->leave_type }}</td>
                        <td class="py-4 px-6">
                            <p class="text-sm font-medium text-slate-700">{{ \Carbon\Carbon::parse($row->start_date)->format('M d, Y') }}</p>
                            <p class="text-sm font-medium text-slate-500">to {{ \Carbon\Carbon::parse($row->end_date)->format('M d, Y') }}</p>
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-slate-700">{{ $row->days_requested }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-slate-500">{{ $row->reason }}</td>
                        <td class="py-4 px-6 text-sm font-medium text-slate-700">{{ \Carbon\Carbon::parse($row->applied_date)->format('M d, Y') }}</td>
                        <td class="py-4 px-6">
                            @if($row->status == 'Pending')
                                <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#F59E0B]/20 bg-[#FFFBEB] text-[#F59E0B] flex items-center w-max gap-1">
                                    Pending
                                </span>
                            @elseif($row->status == 'Approved')
                                <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#10B981]/20 bg-[#ECFDF5] text-[#10B981] flex items-center w-max gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    Approved
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#EF4444]/20 bg-[#FEF2F2] text-[#EF4444] flex items-center w-max gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-sm font-medium text-slate-500">{{ $row->approved_by ?? 'Waiting...' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-[#F8FAFC] border border-[#CBD5E1] rounded-xl p-6 mb-8">
        <h3 class="text-sm font-bold text-slate-800 mb-4">Leave Policy Guidelines</h3>
        <ul class="space-y-3 text-sm font-medium text-slate-500">
            <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                Leave requests should be submitted at least 3 days in advance
            </li>
            <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                Emergency leave can be filed on the same day with proper documentation
            </li>
            <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                Unused leave credits may be carried over to the next year (max 5 days)
            </li>
            <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                Sick leave requires a medical certificate for absences exceeding 3 days
            </li>
            <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                Leave approval is subject to business requirements and team availability
            </li>
        </ul>
    </div>

    <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
        <div @click.away="isModalOpen = false" class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-900">Apply for Leave</h3>
                <button @click="isModalOpen = false" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('employee.leave.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Leave Type</label>
                    <select name="leave_type" required class="w-full rounded-lg border-slate-200 focus:border-[#10B981] focus:ring focus:ring-[#10B981]/20 text-sm font-medium text-slate-700">
                        <option value="Vacation Leave">Vacation Leave</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Emergency Leave">Emergency Leave</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" required class="w-full rounded-lg border-slate-200 focus:border-[#10B981] focus:ring focus:ring-[#10B981]/20 text-sm font-medium text-slate-700">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">End Date</label>
                        <input type="date" name="end_date" required class="w-full rounded-lg border-slate-200 focus:border-[#10B981] focus:ring focus:ring-[#10B981]/20 text-sm font-medium text-slate-700">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Reason</label>
                    <textarea name="reason" rows="3" required class="w-full rounded-lg border-slate-200 focus:border-[#10B981] focus:ring focus:ring-[#10B981]/20 text-sm font-medium text-slate-700 placeholder-slate-400" placeholder="Briefly explain your reason for leave..."></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="isModalOpen = false" class="flex-1 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-lg transition text-sm">Cancel</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#10B981] hover:bg-[#059669] text-white font-bold rounded-lg transition text-sm">Submit Request</button>
                </div>
            </form>
        </div>
    </div>

</div> 
@endsection