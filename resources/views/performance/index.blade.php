@extends('layouts.app')

@section('content')

@php
    // We add this block to keep our UI elements looking perfect, 
    // while making the Progress Bar and the Table dynamic based on real database records!
    $cycle = [
        'name' => 'Q1 2026 Performance Review',
        'dates' => 'Jan 1, 2026 - Apr 30, 2026',
        'completed' => $reviews->count(),
        'total' => $employees->count() > 0 ? $employees->count() : 1,
        'progress_percent' => $employees->count() > 0 ? ($reviews->count() / $employees->count()) * 100 : 0
    ];
    
    $competencies = [
        ['id' => 1, 'name' => 'Work Quality', 'weight' => '25%'],
        ['id' => 2, 'name' => 'Timeliness', 'weight' => '20%'],
        ['id' => 3, 'name' => 'Teamwork', 'weight' => '20%'],
        ['id' => 4, 'name' => 'Communication', 'weight' => '20%'],
        ['id' => 5, 'name' => 'Initiative', 'weight' => '15%'],
    ];

    $distribution = [
        ['dept' => 'Sales', 'score' => 95, 'color' => 'bg-[#22C55E]'],
        ['dept' => 'HR', 'score' => 88, 'color' => 'bg-[#0B1C3D]'],
        ['dept' => 'Engineering', 'score' => 85, 'color' => 'bg-[#F59E0B]'],
        ['dept' => 'Marketing', 'score' => 82, 'color' => 'bg-[#3B82F6]'],
        ['dept' => 'Finance', 'score' => 80, 'color' => 'bg-[#EF4444]'],
    ];
@endphp

<div x-data="{ isModalOpen: false }">

    @if(session('success'))
        <div class="mb-6 bg-[#ECFDF5] border border-[#10B981] text-[#10B981] px-4 py-3 rounded-lg flex items-center gap-2 font-bold text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Performance Evaluation</h1>
            <p class="text-slate-500 font-medium mt-1 text-sm">Track and manage employee performance reviews</p>
        </div>
        <button @click="isModalOpen = true" class="bg-[#22C55E] hover:bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create New Review
        </button>
    </div>

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
                <div class="bg-[#0B1C3D] h-2.5 rounded-full transition-all duration-1000" style="width: {{ $cycle['progress_percent'] }}%"></div>
            </div>
        </div>
    </div>

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

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h2 class="text-base font-bold text-slate-900">Employee Performance Scores</h2>
            <span class="text-xs font-bold text-slate-400">{{ $reviews->count() }} Reviews Found</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Employee</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700">Month</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Work Quality</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Timeliness</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Teamwork</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Comm.</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Initiative</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Composite Score</th>
                        <th class="py-4 px-6 text-xs font-bold text-slate-700 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reviews as $review)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="py-4 px-6 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#0B1C3D] text-white flex items-center justify-center text-xs font-bold">
                                {{ $review->employee->initials }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 whitespace-nowrap">{{ $review->employee->first_name }} {{ $review->employee->last_name }}</p>
                                <p class="text-xs text-slate-500">{{ $review->employee->department }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-sm font-bold text-slate-900">{{ $review->review_month }}</td>
                        <td class="py-4 px-6 text-sm font-bold text-slate-700 text-center">{{ $review->work_quality }}</td>
                        <td class="py-4 px-6 text-sm font-bold text-slate-700 text-center">{{ $review->timeliness }}</td>
                        <td class="py-4 px-6 text-sm font-bold text-slate-700 text-center">{{ $review->teamwork }}</td>
                        <td class="py-4 px-6 text-sm font-bold text-slate-700 text-center">{{ $review->communication }}</td>
                        <td class="py-4 px-6 text-sm font-bold text-slate-700 text-center">{{ $review->initiative }}</td>
                        <td class="py-4 px-6 text-sm font-black text-[#22C55E] text-center">{{ number_format($review->composite_score, 1) }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($review->status === 'Completed')
                                <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#16A34A]/20 bg-[#DCFCE7] text-[#16A34A]">Completed</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold border border-[#F97316]/20 bg-[#FFEDD5] text-[#F97316]">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-8 text-center text-sm font-bold text-slate-400">
                            No performance reviews have been created yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <div class="flex items-center gap-2 mb-8">
            <svg class="w-5 h-5 text-[#22C55E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            <h2 class="text-base font-bold text-slate-900">Department Performance Distribution</h2>
        </div>

        <div class="relative pl-24 pr-4 py-4 border-b border-l border-slate-300 ml-4">
            <div class="absolute inset-0 left-24 flex justify-between pointer-events-none">
                <div class="h-full border-l border-dashed border-slate-200"></div>
                <div class="h-full border-l border-dashed border-slate-200"></div>
                <div class="h-full border-l border-dashed border-slate-200"></div>
                <div class="h-full border-l border-dashed border-slate-200"></div>
                <div class="h-full border-l border-dashed border-slate-200"></div>
            </div>

            <div class="space-y-6 relative z-10">
                @foreach($distribution as $dist)
                <div class="flex items-center group">
                    <div class="absolute left-0 w-20 text-right pr-4 text-xs font-bold text-slate-600 truncate">
                        {{ $dist['dept'] }}
                    </div>
                    <div class="w-full bg-transparent h-10 rounded-r-md flex items-center">
                        <div class="h-full {{ $dist['color'] }} rounded-r-md transition-all duration-500 hover:opacity-90" style="width: {{ $dist['score'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="absolute -bottom-6 left-24 right-4 flex justify-between text-xs font-bold text-slate-500">
                <span>0</span><span>25</span><span>50</span><span>75</span><span>100</span>
            </div>
        </div>
        <div class="h-8"></div>
    </div>

    <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
        <div @click.away="isModalOpen = false" class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden border border-slate-200">
            
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-[#0B1C3D] text-white">
                <h3 class="text-lg font-extrabold tracking-tight">Create Performance Review</h3>
                <button @click="isModalOpen = false" class="text-slate-400 hover:text-white transition cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('hr.performance.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Select Employee</label>
                        <select name="employee_id" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] focus:ring focus:ring-[#10B981]/20 text-sm font-bold text-slate-700 p-2.5">
                            <option value="">Choose an employee...</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->first_name }} {{ $emp->last_name }} ({{ $emp->department }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Review Month</label>
                        <input type="text" name="review_month" value="{{ date('F Y') }}" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] focus:ring focus:ring-[#10B981]/20 text-sm font-bold text-slate-700 p-2.5">
                    </div>
                </div>

                <div>
                    <div class="flex items-center gap-2 border-b border-slate-100 pb-2 mb-4">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <h4 class="text-sm font-bold text-slate-900">Score Metrics (1-100)</h4>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Work Quality</label>
                            <input type="number" name="work_quality" min="0" max="100" placeholder="0" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] text-sm font-bold p-2 text-center text-[#15A34A]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Timeliness</label>
                            <input type="number" name="timeliness" min="0" max="100" placeholder="0" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] text-sm font-bold p-2 text-center text-[#15A34A]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Teamwork</label>
                            <input type="number" name="teamwork" min="0" max="100" placeholder="0" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] text-sm font-bold p-2 text-center text-[#15A34A]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Comm.</label>
                            <input type="number" name="communication" min="0" max="100" placeholder="0" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] text-sm font-bold p-2 text-center text-[#15A34A]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Initiative</label>
                            <input type="number" name="initiative" min="0" max="100" placeholder="0" required class="w-full rounded-lg border-slate-300 focus:border-[#10B981] text-sm font-bold p-2 text-center text-[#15A34A]">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex gap-3 justify-end">
                    <button type="button" @click="isModalOpen = false" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-lg transition text-sm">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-[#15A34A] hover:bg-emerald-600 text-white shadow-sm font-bold rounded-lg transition text-sm">Save & Calculate Score</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection