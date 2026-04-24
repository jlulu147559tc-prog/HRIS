@extends('layouts.guest')

@section('content')
<!-- Wrap the content in Alpine.js state -->
<div x-data="{ method: 'sms' }">
    
    <!-- Logo & Header -->
    <div class="text-center mb-6">
        <div class="w-16 h-16 bg-[#ECFDF5] rounded-full mx-auto flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <h1 class="text-2xl font-bold text-[#0F172A]">HR Central</h1>
        <p class="text-sm text-slate-500 mt-1">Two-Factor Authentication</p>
    </div>

    <!-- Interactive Toggle Tabs -->
    <div class="bg-slate-100 p-1 rounded-lg flex mb-8">
        <!-- Authenticator App Tab -->
        <button 
            @click="method = 'app'" 
            :class="method === 'app' ? 'bg-white text-[#0F172A] shadow-sm font-bold cursor-default' : 'text-slate-500 hover:text-slate-700 font-medium cursor-pointer'"
            class="flex-1 text-center rounded-md py-2 text-sm transition-all duration-200">
            Authenticator App
        </button>
        
        <!-- SMS Tab -->
        <button 
            @click="method = 'sms'" 
            :class="method === 'sms' ? 'bg-white text-[#0F172A] shadow-sm font-bold cursor-default' : 'text-slate-500 hover:text-slate-700 font-medium cursor-pointer'"
            class="flex-1 text-center rounded-md py-2 text-sm transition-all duration-200">
            SMS
        </button>
    </div>

    <!-- Verification Inputs -->
    <!-- Verification Inputs -->
    <div class="text-center mb-6" x-data="{
        // Move to the next box when a number is typed
        handleInput(e, nextRef) {
            if (e.target.value.length === 1 && nextRef) {
                $refs[nextRef].focus();
            }
        },
        // Move to the previous box when Backspace is pressed on an empty box
        handleBackspace(e, prevRef) {
            if (e.key === 'Backspace' && e.target.value.length === 0 && prevRef) {
                $refs[prevRef].focus();
            }
        }
    }">
        <label class="block text-sm font-bold text-[#0F172A] mb-4">Enter your 6-digit verification code</label>
        <div class="flex justify-center gap-2 sm:gap-3">
            <input type="text" maxlength="1" x-ref="box1" @input="handleInput($event, 'box2')" 
                class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition-all">
            
            <input type="text" maxlength="1" x-ref="box2" @input="handleInput($event, 'box3')" @keydown="handleBackspace($event, 'box1')" 
                class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition-all">
            
            <input type="text" maxlength="1" x-ref="box3" @input="handleInput($event, 'box4')" @keydown="handleBackspace($event, 'box2')" 
                class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition-all">
            
            <input type="text" maxlength="1" x-ref="box4" @input="handleInput($event, 'box5')" @keydown="handleBackspace($event, 'box3')" 
                class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition-all">
            
            <input type="text" maxlength="1" x-ref="box5" @input="handleInput($event, 'box6')" @keydown="handleBackspace($event, 'box4')" 
                class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition-all">
            
            <input type="text" maxlength="1" x-ref="box6" @keydown="handleBackspace($event, 'box5')" 
                class="w-10 h-12 sm:w-12 sm:h-14 text-center text-xl font-bold rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition-all">
        </div>
    </div>
    <!-- Timer & Resend (Changes based on SMS or App) -->
    <div class="text-center mb-8">
        <div class="flex items-center justify-center gap-1.5 text-sm text-slate-500 mb-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Code expires in 1:38
        </div>
        
        <!-- Only show 'Resend code' if SMS is selected -->
        <div x-show="method === 'sms'" x-transition>
            <button type="button" class="text-sm font-bold text-slate-600 hover:text-slate-900 transition">Resend code</button>
        </div>
    </div>

    <!-- Actions -->
    <a href="/" class="block w-full text-center bg-[#818C99] text-white font-bold py-3 px-4 rounded-lg mb-6 hover:bg-slate-500 transition">
        Verify & Sign In
    </a>

    <!-- Security Badge -->
    <div class="bg-[#F0FDF4] border border-[#DCFCE7] rounded-lg p-3 flex items-center justify-center gap-2 mb-6 text-sm text-[#16A34A] font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        Your account is protected with 2-step verification
    </div>

    <div class="text-center">
        <a href="/login" class="text-sm font-bold text-[#1E293B] hover:text-slate-600 transition">← Back to login</a>
    </div>
    
</div>
@endsection