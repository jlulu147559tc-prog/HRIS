@extends('layouts.app')

@section('content')
<div x-data="{ addEmployeeModal: false }" class="relative">

    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Employee Management</h1>
            <p class="text-slate-400 font-bold mt-1 text-sm">Manage employee information and records</p>
        </div>
        
        <button @click="addEmployeeModal = true" class="bg-[#15A34A] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Add Employee
        </button>
    </div>

    <form method="GET" action="{{ route('employees.index') }}" class="mb-8">
        <div class="bg-[#F3F4F6] rounded-md p-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, ID, or department..." class="bg-transparent border-none outline-none text-slate-900 w-full font-bold placeholder-slate-900">
            
            <button type="submit" class="hidden">Search</button>
        </div>
    </form>

    <div class="w-full bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b-2 border-slate-800 bg-slate-50">
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900">Employee</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900">Employee ID</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900">Department</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900">Position</th>
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $index => $employee)
                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#F9FAFB]' }} hover:bg-slate-50 transition border-b border-slate-100 last:border-0">
                    
                    <td class="py-4 px-6 flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full border-2 border-[#0B1C3D] flex items-center justify-center text-[#0B1C3D] font-extrabold text-sm bg-white">
                            {{ $employee->initials }}
                        </div>
                        <span class="font-bold text-slate-900 text-sm">{{ $employee->first_name }} {{ $employee->last_name }}</span>
                    </td>
                    
                    <td class="py-4 px-6 font-bold text-[#9CA3AF] text-sm">{{ $employee->employee_id }}</td>
                    
                    <td class="py-4 px-6 font-bold text-slate-900 text-sm">{{ $employee->department }}</td>
                    
                    <td class="py-4 px-6 font-bold text-slate-900 text-sm">{{ $employee->position }}</td>
                    
                    <td class="py-4 px-6">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $employee->status == 'Active' ? 'text-[#22C55E] bg-[#DCFCE7] border border-[#22C55E]/20' : 'text-[#EF4444] bg-[#FEE2E2] border border-[#EF4444]/20' }}">
                            {{ $employee->status }}
                        </span>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="addEmployeeModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4" 
         style="display: none;">
         
        <div @click.away="addEmployeeModal = false" 
             class="bg-white rounded-xl shadow-2xl border border-slate-200 w-full max-w-3xl max-h-[90vh] overflow-y-auto p-8">
             
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <h3 class="text-lg font-bold text-slate-900">Register New Employee</h3>
                <button @click="addEmployeeModal = false" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">First Name</label>
                        <input type="text" name="first_name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Last Name</label>
                        <input type="text" name="last_name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Employee ID</label>
                        <input type="text" name="employee_id" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Department</label>
                        <input type="text" name="department" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Position</label>
                        <input type="text" name="position" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Initial Password</label>
                        <input type="password" name="password" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6 mt-8">
                    <button type="button" @click="addEmployeeModal = false" class="px-5 py-2.5 rounded-lg text-xs font-bold border border-slate-300 text-slate-700 hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-xs font-bold bg-[#15A34A] hover:bg-emerald-600 text-white shadow-sm transition">
                        Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection