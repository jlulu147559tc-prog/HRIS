@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Reports & Analytics</h1>
        <p class="text-slate-500 font-medium mt-1 text-sm">Generate insights and export HR data reports</p>
    </div>
    <div class="flex gap-3">
        <button class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-slate-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Export CSV
        </button>
        <button class="bg-[#0B1C3D] text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-slate-800 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export PDF
        </button>
    </div>
</div>

<!-- Filters Bar -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-4 flex flex-wrap lg:flex-nowrap gap-6 items-end">
    <div class="flex-1">
        <label class="block text-xs font-bold text-slate-700 mb-2">Report Type</label>
        <div class="border border-slate-300 rounded-md px-3 py-2 flex items-center justify-between cursor-pointer">
            <span class="text-sm font-medium text-slate-700">Headcount Report</span>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>
    <div class="flex-1">
        <label class="block text-xs font-bold text-slate-700 mb-2">Start Date</label>
        <div class="border border-slate-300 rounded-md px-3 py-2 flex items-center justify-between">
            <span class="text-sm font-medium text-slate-700">{{ $filters['start_date'] }}</span>
            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
    </div>
    <div class="flex-1">
        <label class="block text-xs font-bold text-slate-700 mb-2">End Date</label>
        <div class="border border-slate-300 rounded-md px-3 py-2 flex items-center justify-between">
            <span class="text-sm font-medium text-slate-700">{{ $filters['end_date'] }}</span>
            <svg class="w-4 h-4 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
    </div>
</div>

<!-- Tabs -->
<div class="bg-slate-200 rounded-xl p-1 mb-6 flex items-center justify-between overflow-x-auto">
    <div class="bg-white text-slate-900 shadow-sm rounded-lg px-6 py-2.5 text-sm font-bold flex items-center gap-2 flex-1 justify-center whitespace-nowrap cursor-pointer">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        Headcount
    </div>
    <div class="text-slate-600 hover:text-slate-900 px-6 py-2.5 text-sm font-bold flex items-center gap-2 flex-1 justify-center whitespace-nowrap cursor-pointer transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Attendance
    </div>
    <div class="text-slate-600 hover:text-slate-900 px-6 py-2.5 text-sm font-bold flex items-center gap-2 flex-1 justify-center whitespace-nowrap cursor-pointer transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        Leave
    </div>
    <div class="text-slate-600 hover:text-slate-900 px-6 py-2.5 text-sm font-bold flex items-center gap-2 flex-1 justify-center whitespace-nowrap cursor-pointer transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Payroll
    </div>
    <div class="text-slate-600 hover:text-slate-900 px-6 py-2.5 text-sm font-bold flex items-center gap-2 flex-1 justify-center whitespace-nowrap cursor-pointer transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
        Performance
    </div>
</div>

<!-- Charts Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    
    <!-- Headcount Trend Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col h-[400px]">
        <h2 class="text-base font-bold text-slate-800 mb-6">Headcount Trend (6 Months)</h2>
        
        <div class="flex-1 relative flex">
            <!-- Y-Axis -->
            <div class="w-10 h-full flex flex-col justify-between text-xs font-bold text-slate-400 pb-8 relative z-10">
                <span>180</span>
                <span>135</span>
                <span>90</span>
                <span>45</span>
                <span>0</span>
            </div>
            
            <!-- Chart Area -->
            <div class="flex-1 relative border-l border-b border-slate-300 pb-8 ml-2">
                <!-- Grid lines -->
                <div class="absolute inset-0 flex flex-col justify-between pb-8">
                    <div class="border-t border-dashed border-slate-200 w-full"></div>
                    <div class="border-t border-dashed border-slate-200 w-full"></div>
                    <div class="border-t border-dashed border-slate-200 w-full"></div>
                    <div class="border-t border-dashed border-slate-200 w-full"></div>
                    <div class="border-t border-dashed border-slate-200 w-full"></div>
                </div>

                <!-- Line (SVG) -->
                <svg class="absolute inset-0 w-full h-[calc(100%-2rem)] overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <polyline points="0,11 20,10 40,10 60,8 80,6 100,5" fill="none" stroke="#EA580C" stroke-width="0.5"/>
                    <circle cx="0" cy="11" r="1.5" fill="white" stroke="#EA580C" stroke-width="0.5" />
                    <circle cx="20" cy="10" r="1.5" fill="white" stroke="#EA580C" stroke-width="0.5" />
                    <circle cx="40" cy="10" r="1.5" fill="white" stroke="#EA580C" stroke-width="0.5" />
                    <circle cx="60" cy="8" r="1.5" fill="white" stroke="#EA580C" stroke-width="0.5" />
                    <circle cx="80" cy="6" r="1.5" fill="white" stroke="#EA580C" stroke-width="0.5" />
                    <circle cx="100" cy="5" r="1.5" fill="white" stroke="#EA580C" stroke-width="0.5" />
                </svg>

                <!-- X-Axis Labels -->
                <div class="absolute bottom-0 left-0 w-full flex justify-between text-[10px] font-bold text-slate-500 translate-y-full pt-2">
                    @foreach($trend as $point)
                        <span class="text-center w-8 -ml-4">{{ $point['month'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-8 flex justify-center items-center gap-6 text-xs font-bold text-slate-700">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                Total Employees
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span class="text-emerald-500">Active</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span class="text-red-500">Inactive</span>
            </div>
        </div>
    </div>

    <!-- Department Distribution Pie Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col h-[400px]">
        <h2 class="text-base font-bold text-slate-800 mb-6">Department Distribution</h2>
        
        <div class="flex-1 flex justify-center items-center relative">
            
            <!-- Pie Chart via Conic Gradient -->
            <!-- 
                 Logic: 
                 Eng: 0-26%
                 Ops: 26-39% (13%)
                 Fin: 39-52% (13%)
                 HR:  52-61% (9%)
                 Mkt: 61-77% (16%)
                 Sal: 77-100% (23%)
            -->
            <div class="w-56 h-56 rounded-full shadow-inner relative border-2 border-white" 
                 style="background: conic-gradient(
                    #1E293B 0% 26%, 
                    #A855F7 26% 39%, 
                    #EF4444 39% 52%, 
                    #3B82F6 52% 61%, 
                    #F59E0B 61% 77%, 
                    #22C55E 77% 100%
                 );">
                 <!-- White borders between slices (Approximation using absolute lines) -->
                 <div class="absolute inset-0 rounded-full" style="background: conic-gradient(from 0deg, transparent 25.5%, white 25.5%, white 26.5%, transparent 26.5%, transparent 38.5%, white 38.5%, white 39.5%, transparent 39.5%, transparent 51.5%, white 51.5%, white 52.5%, transparent 52.5%, transparent 60.5%, white 60.5%, white 61.5%, transparent 61.5%, transparent 76.5%, white 76.5%, white 77.5%, transparent 77.5%, transparent 99.5%, white 99.5%, white 100%);"></div>
            </div>

            <!-- Absolute Positioned Labels to match mockup -->
            <div class="absolute top-[10%] right-[15%] text-xs font-bold text-slate-800">Engineering 26%</div>
            <div class="absolute bottom-[40%] right-[5%] text-xs font-bold text-purple-500">Operations 13%</div>
            <div class="absolute bottom-[10%] right-[30%] text-xs font-bold text-red-500">Finance 13%</div>
            <div class="absolute bottom-[15%] left-[25%] text-xs font-bold text-blue-500">HR 9%</div>
            <div class="absolute top-[60%] left-[5%] text-xs font-bold text-amber-500">Marketing 16%</div>
            <div class="absolute top-[30%] left-[15%] text-xs font-bold text-emerald-500">Sales 22%</div>
        </div>
    </div>

</div>
@endsection