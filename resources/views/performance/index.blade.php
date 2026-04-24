@extends('layouts.app')

@section('content')
<!-- Header Section -->
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Performance Evaluation</h1>
        <p class="text-slate-500 font-medium mt-1 text-sm">Track and manage employee performance reviews</p>
    </div>
    <button class="bg-[#22C55E] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Create New Review
    </button>
</div>

<!-- Active Cycle Card -->
<div class="bg-white rounded-xl shadow-sm border border-[#22C55E] p-6 mb-8 relative overflow-hidden">
    <div class="flex justify-between items-start mb-6">
        <div class="flex gap-4 items-center">
            <div class="w-12 h-12 rounded-lg bg-[#DCFCE7] flex items-center justify-center text-[#16A34A]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-900">{{ $cycle['name'] }}</h2>
                <p class="text-sm font-medium text-slate-500">{{ $cycle['dates'] }}</p>
            </div>
        </div>
        <span class="px-3 py-1 rounded-full text-xs font-bold bg-[#DCFCE7] text-[#16A34A] border border-[#16A34A]/20">
            Active Cycle
        </span>
    </div>
    
    <div>
        <div class="flex justify-between text-sm font-bold text-slate-700 mb-2">
            <span>Progress</span>
            <span>{{ $cycle['completed'] }} of {{ $cycle['total'] }} completed</span>
        </div>
        <div class="w-full bg-slate-200 rounded-full h-2.5">
            <div class="bg-[#0B1C3D] h-2.5 rounded-full" style="width: {{ $cycle['progress_percent'] }}%"></div>
        </div>
    </div>
</div>

<!-- Evaluation Competencies Section -->
<div class="mb-8">
    <div class="flex items-center gap-2 mb-4">
        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
        <h2 class="text-base font-bold text-slate-900">Evaluation Competencies</h2>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-3">
        @foreach($competencies as $comp)
        <div class="bg-[#F9FAFB] rounded-lg p-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold">
                    {{ $comp['id'] }}
                </div>
                <span class="text-sm font-bold text-slate-900">{{ $comp['name'] }}</span>
            </div>
            <div class="text-xs font-bold text-slate-600 bg-white px-3 py-1 rounded border border-slate-200">
                Weight: <span class="text-slate-900">{{ $comp['weight'] }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Employee Performance Scores Table -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-900">Employee Performance Scores</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Employee</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Department</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Work Quality</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Timeliness</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Teamwork</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Communication</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Initiative</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Composite Score</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($scores as $score)
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-4 px-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#0B1C3D] text-white flex items-center justify-center text-xs font-bold">
                            {{ $score['initials'] }}
                        </div>
                        <span class="text-sm font-bold text-slate-900 whitespace-nowrap">{{ $score['name'] }}</span>
                    </td>
                    <td class="py-4 px-6 text-sm font-medium text-slate-500">{{ $score['dept'] }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-[#22C55E] text-center">{{ $score['c1'] }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-[#22C55E] text-center">{{ $score['c2'] }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-[#22C55E] text-center">{{ $score['c3'] }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-[#22C55E] text-center">{{ $score['c4'] }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-[#22C55E] text-center">{{ $score['c5'] }}</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-[#22C55E] text-center">{{ $score['composite'] }}</td>
                    <td class="py-4 px-6 text-center">
                        @if($score['status'] === 'Completed')
                            <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#16A34A]/20 bg-[#DCFCE7] text-[#16A34A]">Completed</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#F97316]/20 bg-[#FFEDD5] text-[#F97316]">Pending</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Department Performance Distribution Chart -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
    <div class="flex items-center gap-2 mb-8">
        <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        <h2 class="text-base font-bold text-slate-900">Department Performance Distribution</h2>
    </div>

    <!-- Chart Container -->
    <div class="relative pl-24 pr-4 py-4 border-b border-l border-slate-300 ml-4">
        <!-- Grid Lines (Vertical) -->
        <div class="absolute inset-0 left-24 flex justify-between pointer-events-none">
            <div class="h-full border-l border-dashed border-slate-200"></div>
            <div class="h-full border-l border-dashed border-slate-200"></div>
            <div class="h-full border-l border-dashed border-slate-200"></div>
            <div class="h-full border-l border-dashed border-slate-200"></div>
            <div class="h-full border-l border-dashed border-slate-200"></div>
        </div>

        <!-- Bars -->
        <div class="space-y-6 relative z-10">
            @foreach($distribution as $dist)
            <div class="flex items-center group">
                <!-- Y-Axis Label -->
                <div class="absolute left-0 w-20 text-right pr-4 text-xs font-bold text-slate-600 truncate">
                    {{ $dist['dept'] }}
                </div>
                <!-- Bar -->
                <div class="w-full bg-transparent h-10 rounded-r-md flex items-center">
                    <div class="h-full {{ $dist['color'] }} rounded-r-md transition-all duration-500 hover:opacity-90" style="width: {{ $dist['score'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- X-Axis Labels -->
        <div class="absolute -bottom-6 left-24 right-4 flex justify-between text-xs font-bold text-slate-500">
            <span>0</span>
            <span>25</span>
            <span>50</span>
            <span>75</span>
            <span>100</span>
        </div>
    </div>
    <!-- Bottom spacing for x-axis labels -->
    <div class="h-8"></div>
</div>
@endsection