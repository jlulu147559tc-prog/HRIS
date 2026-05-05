@extends('layouts.employee')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Performance</h1>
    <p class="text-slate-500 font-medium mt-1">Track your performance evaluations and goals</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-[#10B981] p-6 mb-6 flex flex-wrap items-center justify-between relative overflow-hidden gap-6">
    <div class="flex items-center gap-6">
        <div class="w-24 h-24 rounded-full border-4 border-[#10B981] flex flex-col items-center justify-center bg-[#F0FDF4] text-[#10B981]">
            <span class="text-2xl font-black leading-none">{{ $data['latest']['score'] }}</span>
            <span class="text-[10px] font-bold uppercase tracking-wider mt-1">Score</span>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-1">Latest Performance Review</p>
            <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $data['latest']['period'] }}</h3>
            <p class="text-sm font-medium text-slate-500">Reviewed by: {{ $data['latest']['reviewer'] }}</p>
        </div>
    </div>
    
    <div class="flex gap-16 md:pr-8">
        <div>
            <p class="text-xs font-bold text-slate-400 mb-2">Rating</p>
            <span class="px-4 py-1.5 rounded-md text-xs font-bold bg-[#10B981] text-white flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                {{ $data['latest']['rating'] }}
            </span>
        </div>
        <div>
            <p class="text-xs font-bold text-slate-400 mb-2">Review Date</p>
            <p class="text-sm font-bold text-slate-900 mt-1.5">{{ $data['latest']['date'] }}</p>
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
            @foreach($data['competencies'] as $comp)
            <div>
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-slate-800">{{ $comp['name'] }}</span>
                        <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded">{{ $comp['weight'] }}</span>
                    </div>
                    <span class="text-sm font-black text-[#10B981]">{{ $comp['score'] }}</span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2">
                    <div class="bg-[#0B1C3D] h-2 rounded-full" style="width: {{ $comp['score'] }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col">
        <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Performance Overview
        </div>
        <div class="flex-1 flex items-center justify-center relative">
            <svg width="200" height="200" viewBox="0 0 200 200" class="overflow-visible">
                <polygon points="100,10 185,70 155,170 45,170 15,70" fill="none" stroke="#E2E8F0" stroke-width="1"/>
                <polygon points="100,32.5 163.7,77.5 141.2,152.5 58.7,152.5 36.2,77.5" fill="none" stroke="#E2E8F0" stroke-width="1"/>
                <polygon points="100,55 142.5,85 127.5,135 72.5,135 57.5,85" fill="none" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="100" y2="10" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="185" y2="70" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="155" y2="170" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="45" y2="170" stroke="#E2E8F0" stroke-width="1"/>
                <line x1="100" y1="100" x2="15" y2="70" stroke="#E2E8F0" stroke-width="1"/>
                
                <polygon points="100,15 175,70 145,160 55,165 20,75" fill="rgba(16, 185, 129, 0.4)" stroke="#10B981" stroke-width="2"/>
            </svg>
            <span class="absolute top-2 text-[10px] text-slate-500">Work Quality</span>
            <span class="absolute right-6 top-1/3 text-[10px] text-slate-500 hidden sm:block">Timeliness</span>
            <span class="absolute right-12 bottom-6 text-[10px] text-slate-500 hidden sm:block">Teamwork</span>
            <span class="absolute left-10 bottom-6 text-[10px] text-slate-500 hidden sm:block">Communication</span>
            <span class="absolute left-6 top-1/3 text-[10px] text-slate-500 hidden sm:block">Initiative</span>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
    <div class="flex items-center gap-2 mb-6 text-sm font-bold text-slate-800">
        <svg class="w-5 h-5 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
        Goals & Objectives (2026)
    </div>
    <div class="space-y-6">
        @foreach($data['goals'] as $goal)
        <div>
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h4 class="text-sm font-bold text-slate-900">{{ $goal['title'] }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Deadline: {{ $goal['deadline'] }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold {{ $goal['color'] }}">{{ $goal['status'] }}</span>
            </div>
            <div class="flex justify-between text-xs font-bold text-slate-700 mb-2">
                <span>Progress</span><span>{{ $goal['progress'] }}%</span>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2">
                <div class="bg-[#0B1C3D] h-2 rounded-full" style="width: {{ $goal['progress'] }}%"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-[#F0FDF4] border border-[#DCFCE7] rounded-xl p-6">
        <div class="flex items-center gap-2 mb-4 text-sm font-bold text-[#16A34A]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            Strengths
        </div>
        <ul class="space-y-3 text-sm text-slate-700 font-medium">
            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#16A34A] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Consistently exceeds sales targets</li>
            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#16A34A] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Strong client relationship management</li>
            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#16A34A] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Excellent communication and presentation skills</li>
            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-[#16A34A] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Proactive in identifying new opportunities</li>
        </ul>
    </div>
    <div class="bg-[#FFFBEB] border border-[#FEF3C7] rounded-xl p-6">
        <div class="flex items-center gap-2 mb-4 text-sm font-bold text-[#D97706]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Areas for Improvement
        </div>
        <ul class="space-y-3 text-sm text-slate-700 font-medium">
            <li class="flex items-start gap-2"><span class="text-[#D97706] mt-0.5">→</span> Time management during peak periods</li>
            <li class="flex items-start gap-2"><span class="text-[#D97706] mt-0.5">→</span> Documentation and reporting timeliness</li>
        </ul>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
    <h2 class="text-sm font-bold text-slate-800 mb-6">Performance History</h2>
    <div class="space-y-4">
        @foreach($data['history'] as $record)
        <div class="flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-slate-200 transition">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-white border border-slate-200 text-slate-400 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">{{ $record['period'] }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $record['date'] }}</p>
                </div>
            </div>
            <div class="text-right flex items-center gap-6">
                <div>
                    <p class="text-xs font-medium text-slate-500 hidden sm:block">Overall Score</p>
                    <p class="text-lg font-black {{ $record['color'] }}">{{ $record['score'] }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold border border-emerald-200 bg-emerald-50 text-emerald-600 hidden sm:block">
                    {{ $record['rating'] }}
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection