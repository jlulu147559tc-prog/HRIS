@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Add New Employee</h1>
    <p class="text-slate-500 font-medium mt-1">Register a newly hired employee to the system.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 max-w-2xl">
    <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Full Name</label>
                <input type="text" name="name" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Employee ID</label>
                <input type="text" name="employee_id" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Department</label>
                <input type="text" name="department" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Position</label>
                <input type="text" name="position" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address</label>
                <input type="email" name="email" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Initial Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Status</label>
                <select name="status" class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:border-[#10B981] focus:ring focus:ring-emerald-100 focus:outline-none" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
            <a href="{{ route('employees.index') }}" class="px-5 py-2.5 rounded-lg text-sm border border-slate-300 text-slate-700 hover:bg-slate-50 font-bold transition">Cancel</a>
            <button type="submit" class="px-5 py-2.5 rounded-lg text-sm bg-[#10B981] hover:bg-emerald-600 text-white font-bold shadow-sm transition">Save Employee</button>
        </div>
    </form>
</div>
@endsection