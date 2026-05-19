@extends('layouts.app') @section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Profile Settings</h1>
        <p class="text-slate-500 font-medium mt-1">Manage your HR administrator account details.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-8 bg-[#0B1C3D] text-white flex flex-col md:flex-row items-center gap-6 relative">
            <div class="w-24 h-24 bg-[#22C55E] rounded-full flex items-center justify-center text-3xl font-bold border-4 border-slate-50 shadow-inner">
                {{ substr($user->first_name ?? 'H', 0, 1) }}{{ substr($user->last_name ?? 'R', 0, 1) }}
            </div>
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-black">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <p class="text-emerald-400 font-bold text-sm">{{ $user->position ?? 'HR Officer' }}</p>
                <p class="text-slate-400 text-xs mt-1">Member since {{ $meta['joined'] ?? 'N/A' }}</p>
            </div>
        </div>

        <form action="#" method="POST" class="p-8">
            @csrf 
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                
                <div class="space-y-6">
                    <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Employment</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Employee ID</p>
                            <p class="text-sm font-black text-slate-900">{{ $user->employee_id ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Department</p>
                            <p class="text-sm font-black text-slate-900">{{ $user->department ?? 'HR' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Date Hired</p>
                            <p class="text-sm font-black text-slate-900">{{ $user->hire_date ? \Carbon\Carbon::parse($user->hire_date)->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Tenure</p>
                            <p class="text-sm font-bold text-emerald-600">{{ $meta['tenure'] ?? 'N/A' }}</p>
                        </div>
                        <span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-md uppercase">Active</span>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Contact</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Email Address (Read Only)</p>
                            <p class="text-sm font-bold text-slate-600">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Phone Number</p>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border-slate-200 rounded-lg text-sm font-bold text-slate-700 p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Home Address</p>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="w-full border-slate-200 rounded-lg text-sm font-bold text-slate-700 p-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Age</p>
                            <p class="text-sm font-black text-slate-900">{{ $meta['age'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Education</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">School Graduated</p>
                            <p class="text-sm font-black text-slate-900">{{ $user->school ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Course Completed</p>
                            <p class="text-sm font-black text-slate-900">{{ $user->course ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-6 border-t border-slate-100 flex justify-end gap-3">
                <button type="submit" class="bg-[#0B1C3D] hover:bg-slate-800 text-white px-10 py-3 rounded-lg font-bold text-sm transition shadow-lg active:transform active:scale-95">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection