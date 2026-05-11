@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div x-data="{ activeTab: 'headcount' }">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Reports & Analytics</h1>
            <p class="text-slate-500 font-medium mt-1 text-sm">Generate insights and export HR data reports</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('reports.export.csv') }}" class="bg-[#0B1C3D] text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-slate-800 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                Export CSV Report
            </a>
        </div>
    </div>

    <form action="{{ route('reports.index') }}" method="GET" class="bg-white p-6 rounded-xl border border-slate-200 mb-6 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-widest">Report Type</label>
                <select x-model="activeTab" class="w-full border-slate-200 rounded-lg text-sm font-bold text-slate-700 focus:ring-[#22C55E] focus:border-[#22C55E] cursor-pointer">
                    <option value="headcount">Headcount Report</option>
                    <option value="attendance">Attendance Report</option>
                    <option value="leave">Leave Report</option>
                    <option value="payroll">Payroll Report</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-widest">Start Date</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="w-full border-slate-200 rounded-lg text-sm font-bold text-slate-700 focus:ring-[#22C55E] focus:border-[#22C55E]">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2 tracking-widest">End Date</label>
                <div class="flex gap-2">
                    <input type="date" name="end_date" value="{{ $endDate }}" class="w-full border-slate-200 rounded-lg text-sm font-bold text-slate-700 focus:ring-[#22C55E] focus:border-[#22C55E]">
                    <button type="submit" class="bg-[#22C55E] text-white px-6 rounded-lg font-bold text-sm hover:bg-emerald-600 transition cursor-pointer shadow-sm">Filter</button>
                </div>
            </div>
        </div>
    </form>

    <div class="bg-slate-100 p-1 rounded-xl flex mb-8 border border-slate-200">
        <button @click="activeTab = 'headcount'" :class="activeTab === 'headcount' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-2.5 rounded-lg text-sm font-bold transition flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Headcount
        </button>
        <button @click="activeTab = 'attendance'" :class="activeTab === 'attendance' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-2.5 rounded-lg text-sm font-bold transition flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Attendance
        </button>
        <button @click="activeTab = 'leave'" :class="activeTab === 'leave' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-2.5 rounded-lg text-sm font-bold transition flex items-center justify-center gap-2 cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Leave
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 mb-6" x-text="activeTab.charAt(0).toUpperCase() + activeTab.slice(1) + ' Trend'"></h3>
            <div class="h-[250px]">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 mb-6">Distribution Breakdown</h3>
            <div class="max-w-[280px] mx-auto">
                <canvas id="distributionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Distribution Pie Chart Data (Real Department Data)
        const ctxDist = document.getElementById('distributionChart').getContext('2d');
        new Chart(ctxDist, {
            type: 'pie',
            data: {
                labels: {!! json_encode($deptDistribution->pluck('department')) !!},
                datasets: [{
                    data: {!! json_encode($deptDistribution->pluck('total')) !!},
                    backgroundColor: ['#22C55E', '#0B1C3D', '#F59E0B', '#3B82F6', '#EF4444', '#A855F7'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: true,
                plugins: { 
                    legend: { 
                        position: 'bottom',
                        labels: { boxWidth: 12, font: { weight: 'bold', size: 10 } }
                    } 
                } 
            }
        });

        // 2. Trend Line Chart (Example Trend)
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: ['Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'],
                datasets: [{
                    label: 'Total Employees',
                    data: [150, 155, 152, 160, 165, 172],
                    borderColor: '#22C55E',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#22C55E'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: false, grid: { display: false } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection