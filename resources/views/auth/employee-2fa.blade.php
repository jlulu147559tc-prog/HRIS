@extends('layouts.guest')

@section('content')
<div class="text-center mb-8">
    <div class="w-16 h-16 bg-[#ECFDF5] rounded-full mx-auto flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
    </div>
    <h1 class="text-2xl font-bold text-[#0F172A]">HR Central</h1>
    <p class="text-sm text-slate-500 mt-1">Two-Factor Authentication</p>
</div>

<div class="bg-slate-50 p-1.5 rounded-lg flex mb-8">
    <button class="flex-1 bg-white shadow-sm text-sm font-bold text-slate-800 py-2.5 rounded-md transition">Authenticator App</button>
    <button class="flex-1 text-sm font-medium text-slate-500 py-2.5 hover:text-slate-700 transition">SMS</button>
</div>

<form action="/employee/dashboard" method="GET" class="space-y-6">
    <div class="text-center">
        <label class="block text-sm font-bold text-[#0F172A] mb-4">Enter your 6-digit verification code</label>
        
        <div class="flex justify-center gap-2 mb-4" x-data="otpForm()">
            <template x-for="(input, index) in length" :key="index">
                <input type="text" maxlength="1" 
                       class="w-12 h-12 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition bg-white"
                       x-model="value[index]"
                       @input="handleInput($event, index)"
                       @keydown.backspace="handleBackspace($event, index)"
                       :id="'otp-' + index">
            </template>
        </div>

        <div class="flex items-center justify-center gap-2 text-sm text-slate-500 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Code expires in <span class="font-bold text-slate-700">1:58</span></span>
        </div>

        <a href="#" class="text-sm font-bold text-slate-500 hover:text-[#10B981] transition">Resend code</a>
    </div>

    <button type="submit" class="w-full bg-[#94A3B8] hover:bg-slate-500 text-white font-bold py-3 px-4 rounded-lg transition mt-4 shadow-sm">
        Verify & Sign In
    </button>
</form>

<div class="mt-6 bg-[#F0FDF4] border border-[#DCFCE7] rounded-lg p-4 flex items-center justify-center gap-2">
    <svg class="w-4 h-4 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
    <p class="text-xs font-medium text-slate-600">Your account is protected with 2-step verification</p>
</div>

<div class="mt-8 text-center">
    <a href="/login" class="text-sm font-bold text-slate-500 hover:text-slate-800 transition">&larr; Back to login</a>
</div>

<script>
function otpForm() {
    return {
        length: 6,
        value: Array(6).fill(''),
        handleInput(e, index) {
            const input = e.target;
            if (input.value && index < this.length - 1) {
                document.getElementById(`otp-${index + 1}`).focus();
            }
        },
        handleBackspace(e, index) {
            if (!e.target.value && index > 0) {
                document.getElementById(`otp-${index - 1}`).focus();
            }
        }
    }
}
</script>
@endsection