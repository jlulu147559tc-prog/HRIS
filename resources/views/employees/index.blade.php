@extends('layouts.app')

@section('content')
<div x-data="{ addEmployeeModal: false, viewEmployeeModal: false, editEmployeeModal: false, emp: {} }" class="relative">

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
                    <th class="py-4 px-6 text-sm font-extrabold text-slate-900 text-right">Action</th>
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
                    <td class="py-4 px-6 text-right">
                        <button @click="
                            emp = {
                                db_id: '{{ $employee->id }}',
                                first_name: '{{ addslashes($employee->first_name) }}',
                                last_name: '{{ addslashes($employee->last_name) }}',
                                name: '{{ addslashes($employee->first_name) }} {{ addslashes($employee->last_name) }}',
                                id: '{{ $employee->employee_id }}',
                                dept: '{{ addslashes($employee->department) }}',
                                position: '{{ addslashes($employee->position) }}',
                                status: '{{ $employee->status }}',
                                email: '{{ $employee->email ?? '' }}',
                                hire_date: '{{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('F d, Y') : 'N/A' }}',
                                tenure: '{{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->diffForHumans(null, true) : 'N/A' }}',
                                age: '{{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->age . ' years old' : 'N/A' }}',
                                raw_dob: '{{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '' }}',
                                address: '{{ addslashes($employee->address ?? '') }}',
                                phone: '{{ addslashes($employee->phone ?? '') }}',
                                school: '{{ addslashes($employee->school ?? '') }}',
                                course: '{{ addslashes($employee->course ?? '') }}'
                            };
                            viewEmployeeModal = true;
                        " class="text-[#15A34A] hover:text-emerald-700 font-bold text-xs bg-emerald-50 hover:bg-emerald-100 px-3 py-2 rounded-lg transition border border-emerald-200">
                            View Details
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="addEmployeeModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
        <div @click.away="addEmployeeModal = false" class="bg-white rounded-xl shadow-2xl border border-slate-200 w-full max-w-4xl max-h-[90vh] overflow-y-auto p-8">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <h3 class="text-lg font-bold text-slate-900">Register New Employee</h3>
                <button @click="addEmployeeModal = false" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Employment & Account</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">First Name *</label>
                        <input type="text" name="first_name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Last Name *</label>
                        <input type="text" name="last_name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Employee ID *</label>
                        <input type="text" name="employee_id" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Department *</label>
                        <input type="text" name="department" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Position *</label>
                        <input type="text" name="position" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Status *</label>
                        <select name="status" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Email Address *</label>
                        <input type="email" name="email" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Initial Password *</label>
                        <input type="password" name="password" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                </div>

                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2 mt-6">Personal & Educational Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Phone Number</label>
                        <input type="text" name="phone" placeholder="+63 9..." class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Home Address</label>
                        <input type="text" name="address" placeholder="Full street address..." class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">School / University Graduated</label>
                        <input type="text" name="school" placeholder="E.g. University of Mindanao" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Course Completed</label>
                        <input type="text" name="course" placeholder="E.g. BS Information Technology" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
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

    <div x-show="viewEmployeeModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
        <div @click.away="viewEmployeeModal = false" class="bg-white rounded-xl shadow-2xl border border-slate-200 w-full max-w-3xl overflow-hidden">
            
            <div class="bg-[#0B1C3D] p-6 text-white flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full border-2 border-white/20 bg-white/10 flex items-center justify-center text-xl font-black">
                        <span x-text="emp.name ? emp.name.charAt(0) : ''"></span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black tracking-tight" x-text="emp.name"></h2>
                        <p class="text-emerald-400 font-bold text-sm mt-1" x-text="emp.position"></p>
                    </div>
                </div>
                <button @click="viewEmployeeModal = false" class="text-white/50 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="space-y-4">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Employment</h4>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Employee ID</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.id"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Department</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.dept"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Date Hired</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.hire_date"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Tenure</p>
                            <p class="text-sm font-bold text-[#15A34A]" x-text="emp.tenure"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Status</p>
                            <span class="inline-block mt-1 px-3 py-1 rounded-full text-[10px] font-bold" :class="emp.status === 'Active' ? 'text-[#22C55E] bg-[#DCFCE7]' : 'text-[#EF4444] bg-[#FEE2E2]'" x-text="emp.status"></span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Contact</h4>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Email Address</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.email"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Phone Number</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.phone"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Home Address</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.address"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Age</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.age"></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Education</h4>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">School Graduated</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.school"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Course Completed</p>
                            <p class="text-sm font-bold text-slate-900" x-text="emp.course"></p>
                        </div>
                    </div>

                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-4">
                    <button @click="viewEmployeeModal = false" class="px-6 py-2.5 rounded-lg text-sm font-bold border border-slate-300 text-slate-700 hover:bg-slate-50 transition shadow-sm">
                        Close Profile
                    </button>
                    <button @click="viewEmployeeModal = false; editEmployeeModal = true" class="px-6 py-2.5 rounded-lg text-sm font-bold bg-[#15A34A] hover:bg-emerald-600 text-white transition shadow-sm">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="editEmployeeModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4" style="display: none;">
        <div @click.away="editEmployeeModal = false" class="bg-white rounded-xl shadow-2xl border border-slate-200 w-full max-w-4xl max-h-[90vh] overflow-y-auto p-8">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                <h3 class="text-lg font-bold text-slate-900">Edit Employee Profile</h3>
                <button @click="editEmployeeModal = false" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form :action="'/employees/' + emp.db_id" method="POST" class="space-y-6">
                @csrf
                @method('PUT') <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Employment & Account</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">First Name</label>
                        <input type="text" name="first_name" :value="emp.first_name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Last Name</label>
                        <input type="text" name="last_name" :value="emp.last_name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Employee ID</label>
                        <input type="text" :value="emp.id" class="w-full border border-slate-300 bg-slate-100 text-slate-500 rounded-lg p-2.5 text-sm focus:outline-none" disabled>
                        </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Department</label>
                        <input type="text" name="department" :value="emp.dept" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Position</label>
                        <input type="text" name="position" :value="emp.position" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" :value="emp.status" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" :value="emp.email" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none" required>
                    </div>
                </div>

                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2 mt-6">Personal & Educational Details</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" :value="emp.raw_dob" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Phone Number</label>
                        <input type="text" name="phone" :value="emp.phone" placeholder="+63 9..." class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Home Address</label>
                        <input type="text" name="address" :value="emp.address" placeholder="Full street address..." class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">School / University</label>
                        <input type="text" name="school" :value="emp.school" placeholder="E.g. University of Mindanao" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Course Completed</label>
                        <input type="text" name="course" :value="emp.course" placeholder="E.g. BS Information Technology" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#15A34A] focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6 mt-8">
                    <button type="button" @click="editEmployeeModal = false; viewEmployeeModal = true" class="px-5 py-2.5 rounded-lg text-xs font-bold border border-slate-300 text-slate-700 hover:bg-slate-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-lg text-xs font-bold bg-[#15A34A] hover:bg-emerald-600 text-white shadow-sm transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection