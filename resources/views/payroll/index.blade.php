@extends('layouts.app')

@section('content')
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Payroll Processing</h1>
        <p class="text-slate-500 font-medium mt-1 text-sm">Process and manage employee payroll</p>
    </div>
    <div class="bg-[#F1F5F9] text-slate-600 px-4 py-2 rounded-lg text-sm font-bold border border-slate-200">
        Status: Draft
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <span class="text-sm font-bold text-slate-700">Pay Period:</span>
        <div class="border border-slate-300 rounded-md px-3 py-2 flex items-center gap-4 bg-white cursor-pointer min-w-[250px]">
            <span class="text-sm font-medium text-slate-700">April 1-15, 2026 (Semi-Monthly)</span>
            <svg class="w-4 h-4 text-slate-500 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('payroll.download-payslips') }}" class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-slate-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Download Payslips
        </a>
        <a href="{{ route('payroll.email-payslips') }}" class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-slate-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            Email Payslips
        </a>
        <a href="{{ route('payroll.bir-form') }}" class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-slate-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            BIR Form 2316
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between h-32">
        <span class="text-slate-500 text-sm font-bold">Total Gross Pay</span>
        <span class="text-2xl font-black text-slate-900">₱{{ number_format($summary['gross_pay'] ?? 0, 2) }}</span>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between h-32">
        <span class="text-slate-500 text-sm font-bold">Total Deductions</span>
        <span class="text-2xl font-black text-[#EF4444]">₱{{ number_format($summary['deductions'] ?? 0, 2) }}</span>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between h-32">
        <span class="text-slate-500 text-sm font-bold">Total Net Pay</span>
        <span class="text-2xl font-black text-[#22C55E]">₱{{ number_format($summary['net_pay'] ?? 0, 2) }}</span>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between h-32">
        <span class="text-slate-500 text-sm font-bold">Employees Paid</span>
        <span class="text-2xl font-black text-slate-900">{{ $summary['employees'] ?? 0 }}</span>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
    <div class="p-6 border-b border-slate-100">
        <h2 class="text-base font-bold text-slate-900">Payroll Register</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white border-b border-slate-200">
                    <th class="py-4 px-6 text-xs font-bold text-slate-700">Employee Name</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-right">Gross Pay</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-right">SSS</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-right">PhilHealth</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-right">Pag-IBIG</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-right">Tax</th>
                    <th class="py-4 px-6 text-xs font-bold text-slate-700 text-right">Net Pay</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($payrolls as $pay)
                <tr class="hover:bg-slate-50 transition">
                    <td class="py-4 px-6 text-sm font-bold text-slate-900">{{ $pay['name'] }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-slate-700 text-right">₱{{ number_format($pay['gross'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-[#EF4444] text-right">-₱{{ number_format($pay['sss'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-[#EF4444] text-right">-₱{{ number_format($pay['philhealth'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-[#EF4444] text-right">-₱{{ number_format($pay['pagibig'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-[#EF4444] text-right">-₱{{ number_format($pay['tax'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-bold text-[#22C55E] text-right">₱{{ number_format($pay['net'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-slate-50 border-t-2 border-slate-200">
                    <td class="py-4 px-6 text-sm font-extrabold text-slate-900">TOTAL</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-slate-900 text-right">₱{{ number_format($totals['gross'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-[#EF4444] text-right">-₱{{ number_format($totals['sss'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-[#EF4444] text-right">-₱{{ number_format($totals['philhealth'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-[#EF4444] text-right">-₱{{ number_format($totals['pagibig'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-[#EF4444] text-right">-₱{{ number_format($totals['tax'], 2) }}</td>
                    <td class="py-4 px-6 text-sm font-extrabold text-[#22C55E] text-right">₱{{ number_format($totals['net'], 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="flex justify-end items-center gap-6">
    <button class="text-slate-700 text-sm font-bold hover:text-slate-900 transition">
        Save as Draft
    </button>
    
    <form action="{{ route('payroll.finalize') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="bg-[#22C55E] hover:bg-emerald-600 text-white px-6 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Finalize Payroll
        </button>
    </form>
</div>
@endsection