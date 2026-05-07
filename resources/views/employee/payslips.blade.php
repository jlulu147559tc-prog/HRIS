@extends('layouts.employee')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Payslips</h1>
    <p class="text-slate-500 font-medium mt-1">View and download your salary slips</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
    <h2 class="text-sm font-bold text-slate-800 mb-6">Year-to-Date Summary (2026)</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
            <p class="text-xs font-bold text-slate-500 mb-2">Total Gross Pay</p>
            <p class="text-2xl font-black text-slate-800">{{ $data['ytd']['gross'] }}</p>
        </div>
        <div class="bg-[#FEF2F2] rounded-xl p-5 border border-[#FEE2E2]">
            <p class="text-xs font-bold text-slate-500 mb-2">Total Deductions</p>
            <p class="text-2xl font-black text-[#EF4444]">{{ $data['ytd']['deductions'] }}</p>
        </div>
        <div class="bg-[#F0FDF4] rounded-xl p-5 border border-[#DCFCE7]">
            <p class="text-xs font-bold text-slate-500 mb-2">Total Net Pay</p>
            <p class="text-2xl font-black text-[#10B981]">{{ $data['ytd']['net'] }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
    <h2 class="text-sm font-bold text-slate-800 mb-6">Payslip History</h2>
    <div class="space-y-4">
        @foreach($data['history'] as $slip)
        <div class="flex items-center justify-between p-4 rounded-xl border border-slate-200 hover:border-emerald-300 hover:shadow-sm transition group bg-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center group-hover:bg-emerald-50 group-hover:text-emerald-500 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">{{ $slip['period'] }}</h4>
                    <p class="text-xs text-slate-500 mt-0.5">Pay Date: {{ $slip['date'] }}</p>
                </div>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-xs font-medium text-slate-500">Net Pay</p>
                    <p class="text-sm font-bold text-[#10B981]">{{ $slip->amount }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-[#10B981] text-white tracking-wide uppercase">{{ $slip->status }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-[#F8FAFC] border border-[#CBD5E1] rounded-xl p-5 flex items-start gap-4">
    <svg class="w-5 h-5 text-slate-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
    <div>
        <h4 class="text-sm font-bold text-slate-800 mb-1">Payslip Information</h4>
        <p class="text-sm text-slate-500">Payslips are generated every 15th and end of the month. You can download your payslips in PDF format for your records. For questions about your payroll, please contact the HR department.</p>
    </div>
</div>
@endsection