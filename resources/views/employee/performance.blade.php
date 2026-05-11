@extends('layouts.employee')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Performance</h1>
    <p class="text-slate-500 font-medium mt-1">Track your performance evaluations and goals</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-[#10B981] p-6 mb-6 flex flex-wrap items-center justify-between relative overflow-hidden gap-6">
    <div class="flex items-center gap-6">
        @if($data['latest'])
            <div class="w-24 h-24 rounded-full border-4 border-[#10B981] flex flex-col items-center justify-center bg-[#F0FDF4] text-[#10B981]">
                <span class="text-2xl font-black leading-none">{{ number_format($data['latest']->composite_score, 1) }}</span>
                <span class="text-[10px] font-bold uppercase tracking-wider mt-1">Score</span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 mb-1">Latest Performance Review</p>
                <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $data['latest']->review_month }}</h3>
                <p class="text-sm font-medium text-slate-500">Status: {{ $data['latest']->status }}</p>
            </div>
        @else
            <div class="w-24 h-24 rounded-full border-4 border-slate-200 flex flex-col items-center justify-center bg-slate-50 text-slate-400">
                <span class="text-lg font-black">N/A</span>
                <span class="text-[10px] font-bold uppercase tracking-wider mt-1">Score</span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 mb-1">Latest Performance Review</p>
                <h3 class="text-base font-bold text-slate-500 mb-1">No Reviews Found</h3>
                <p class="text-xs font-medium text-slate-400">Your evaluations will appear here once submitted by HR.</p>
            </div>
        @endif
    </div>
    
    <div class="flex gap-16 md:pr-8">
        <div>
            <p class="text-xs font-bold text-slate-400 mb-2">Rating Grade</p>
            <span class="px-4 py-1.5 rounded-md text-xs font-bold bg-[#10B981] text-white flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                {{ $data['latest'] ? ($data['latest']->composite_score >= 90 ? 'Excellent' : 'Satisfactory') : 'N/A' }}
            </span>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-2">Review Date</p>
            <p class="text-sm font-bold text-slate-900 mt-1.5">
                @if($data['latest'])
                    {{ \Carbon\Carbon::parse($data['latest']->review_date)->format('M j, Y') }}
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>
    <span class="absolute top-6 right-6 px-3 py-1 rounded-full text-[10px] font-bold bg-[#ECFDF5] text-[#10B981] hidden md:block">Completed</span>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
            <svg class="w-5 h-5 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            Competency Scores
        </div>
        <div class="space-y-5">
            @forelse($data['competencies'] as $comp)
            <div>
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-slate-800">{{ $comp['name'] }}</span>
                        <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded">{{ $comp['weight'] }}</span>
                    </div>
                    <span class="text-sm font-black text-[#10B981]">{{ $comp['score'] }}%</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-[#0B1C3D] h-2 rounded-full transition-all duration-1000" style="width: {{ $comp['score'] }}%"></div>
                </div>
            </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-slate-400 text-sm font-medium">No reviews recorded yet for this period.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
        <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Performance Overview
        </div>
        <div class="flex-1 flex items-center justify-center relative">
            
            @php
                // Logic to calculate dynamic radar points based on real database scores
                // 100 center is (100,100). Points are calculated relative to that.
                $q = $data['latest']->work_quality ?? 0;
                $t = $data['latest']->timeliness ?? 0;
                $tw = $data['latest']->teamwork ?? 0;
                $c = $data['latest']->communication ?? 0;
                $i = $data['latest']->initiative ?? 0;

                // Simple math to map 0-100 score to SVG coordinates
                $p1 = "100," . (100 - ($q * 0.9)); // Work Quality (Top)
                $p2 = (100 + ($t * 0.85)) . "," . (100 - ($t * 0.3)); // Timeliness (Right-Top)
                $p3 = (100 + ($tw * 0.55)) . "," . (100 + ($tw * 0.7)); // Teamwork (Right-Bottom)
                $p4 = (100 - ($c * 0.55)) . "," . (100 + ($c * 0.7)); // Communication (Left-Bottom)
                $p5 = (100 - ($i * 0.85)) . "," . (100 - ($i * 0.3)); // Initiative (Left-Top)
                
                $points = "$p1 $p2 $p3 $p4 $p5";
            @endphp

            <svg width="200" height="200" viewBox="0 0 200 200" class="overflow-visible">
                <polygon points="100,10 185,70 155,170 45,170 15,70" fill="none" stroke="#E2E8F0" stroke-width="1"/>
                <polygon points="100,32.5 163.7,77.5 141.2,152.5 58.7,152.5 36.2,77.5" fill="none" stroke="#E2E8F0" stroke-width="1"/>
                <polygon points="100,55 142.5,85 127.5,135 72.5,135 57.5,85" fill="none" stroke="#E2E8F0" stroke-width="1"/>
                
                <line x1="100" y1="100" x2="100" y2="10" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="185" y2="70" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="155" y2="170" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="45" y2="170" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="15" y2="70" stroke="#E2E8F0" stroke-width="1"/>
                
                <polygon points="{{ $points }}" fill="rgba(16, 185, 129, 0.4)" stroke="#10B981" stroke-width="2">
                   <animate attributeName="points" dur="1s" from="100,100 100,100 100,100 100,100 100,100" to="{{ $points }}" />
                </polygon>
            </svg>

            <span class="absolute top-2 text-[10px] font-bold text-slate-500">Work Quality</span>
            <span class="absolute right-6 top-1/3 text-[10px] font-bold text-slate-500 hidden sm:block">Timeliness</span>
            <span class="absolute right-12 bottom-6 text-[10px] font-bold text-slate-500 hidden sm:block">Teamwork</span>
            <span class="absolute left-10 bottom-6 text-[10px] font-bold text-slate-500 hidden sm:block">Communication</span>
            <span class="absolute left-6 top-1/3 text-[10px] font-bold text-slate-500 hidden sm:block">Initiative</span>
        </div>
    </div>
</div>
@endsection