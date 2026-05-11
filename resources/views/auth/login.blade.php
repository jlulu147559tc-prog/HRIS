@extends('layouts.guest')

@section('content')
<div x-data="{ role: 'employee' }">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-[#ECFDF5] rounded-full mx-auto flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-[#10B981]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <h1 class="text-2xl font-bold text-[#0F172A]">HR Central</h1>
        <p class="text-sm text-slate-500 mt-1">Sign in to your account</p>
    </div>

    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
        @csrf 
        @error('email')
            <div class="bg-[#FEF2F2] border border-[#EF4444] text-[#EF4444] px-4 py-3 rounded-lg text-sm font-bold mb-2">
                {{ $message }}
            </div>
        @enderror
        
        <div>
            <label class="block text-sm font-bold text-[#0F172A] mb-2">Login As</label>
            <div class="grid grid-cols-2 gap-3">
                <div @click="role = 'employee'" 
                     :class="role === 'employee' ? 'border-[#10B981] bg-[#F0FDF4]' : 'border-slate-200 bg-white'"
                     class="border rounded-xl p-3 cursor-pointer transition">
                    <p class="font-bold text-slate-900 text-sm">Employee</p>
                    <p class="text-xs text-slate-500 mt-0.5">Access employee portal</p>
                </div>
                <div @click="role = 'hr'" 
                     :class="role === 'hr' ? 'border-[#10B981] bg-[#F0FDF4]' : 'border-slate-200 bg-white'"
                     class="border rounded-xl p-3 cursor-pointer transition">
                    <p class="font-bold text-slate-900 text-sm">HR Officer</p>
                    <p class="text-xs text-slate-500 mt-0.5">Access HR dashboard</p>
                </div>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-[#0F172A] mb-1.5">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@company.com" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition text-sm">
        </div>

        <div>
            <label class="block text-sm font-bold text-[#0F172A] mb-1.5">Password</label>
            <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:border-[#10B981] focus:ring-1 focus:ring-[#10B981] transition text-sm">
        </div>

        <button type="submit" class="w-full bg-[#1E293B] hover:bg-slate-800 text-white font-bold py-3 px-4 rounded-lg transition mt-4">
            Sign In
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="#" class="text-sm font-bold text-[#10B981] hover:text-emerald-600 transition">Forgot Password?</a>
    </div>

    <script>
        (function () {
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function () {
                window.history.pushState(null, "", window.location.href);
            };
        })();
    </script>
</div>
@endsection