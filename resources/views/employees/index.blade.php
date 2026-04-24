@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="flex justify-between items-start mb-8">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Employee Management</h1>
        <p class="text-slate-400 font-bold mt-1 text-sm">Manage employee information and records</p>
    </div>
    <button class="bg-[#15A34A] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        Add Employee
    </button>
</div>

<!-- Search Bar -->
<div class="bg-[#F3F4F6] rounded-md p-4 flex items-center gap-3 mb-8">
    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
    <input type="text" placeholder="Search" class="bg-transparent border-none outline-none text-slate-900 w-full font-bold placeholder-slate-900">
</div>

<!-- Data Table -->
<div class="w-full">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b-2 border-slate-800">
                <th class="py-3 px-4 text-sm font-extrabold text-slate-900">Employee</th>
                <th class="py-3 px-4 text-sm font-extrabold text-slate-900">Employee ID</th>
                <th class="py-3 px-4 text-sm font-extrabold text-slate-900">Department</th>
                <th class="py-3 px-4 text-sm font-extrabold text-slate-900">Position</th>
                <th class="py-3 px-4 text-sm font-extrabold text-slate-900">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
            <!-- Alternating row backgrounds (grey/white) -->
            <tr class="{{ $index % 2 == 0 ? 'bg-[#F9FAFB]' : 'bg-white' }} border-b border-slate-300">
                
                <!-- Avatar & Name -->
                <td class="py-4 px-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full border-2 border-[#0B1C3D] flex items-center justify-center text-[#0B1C3D] font-extrabold text-sm">
                        {{ $employee['initials'] }}
                    </div>
                    <span class="font-extrabold text-slate-900 text-sm">{{ $employee['name'] }}</span>
                </td>
                
                <!-- ID -->
                <td class="py-4 px-4 font-extrabold text-[#9CA3AF] text-sm">{{ $employee['id'] }}</td>
                
                <!-- Department -->
                <td class="py-4 px-4 font-extrabold text-slate-900 text-sm">{{ $employee['dept'] }}</td>
                
                <!-- Position -->
                <td class="py-4 px-4 font-extrabold text-slate-900 text-sm">{{ $employee['position'] }}</td>
                
                <!-- Status -->
                <td class="py-4 px-4 font-extrabold text-sm {{ $employee['status'] == 'Active' ? 'text-[#22C55E]' : 'text-[#EF4444]' }}">
                    {{ $employee['status'] }}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection