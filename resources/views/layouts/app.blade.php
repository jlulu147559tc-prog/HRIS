<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    
    <title>HR Central - HRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" class="bg-slate-50 flex text-slate-800 h-screen overflow-hidden">

    <div x-show="sidebarOpen" 
         x-transition.opacity 
         @click="sidebarOpen = false" 
         class="fixed inset-0 z-20 bg-slate-900/60 backdrop-blur-sm lg:hidden"
         style="display: none;"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-30 w-64 bg-[#0B1C3D] text-white flex flex-col justify-between h-full shadow-2xl transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
        
        <div>
            <div class="flex items-center justify-between p-6 mb-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full border-2 border-emerald-500 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight">HR Central</h1>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="px-4 space-y-1">
                <a href="/" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('/') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                
                <a href="/employees" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('employees*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Employees
                </a>

                <a href="/attendance" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('attendance*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Attendance
                </a>

                <a href="/leave" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('leave*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Leave
                </a>

                <a href="/payroll" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('payroll*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Payroll
                </a>

                <a href="/performance" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('performance*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    Performance
                </a>

                <a href="/reports" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('reports*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Reports
                </a>
            </nav>
        </div>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-4 mb-2 w-56 bg-white rounded-lg shadow-xl border border-slate-200 overflow-hidden text-slate-800 z-50"
                 style="display: none;">
                
                <div class="px-4 py-3 border-b border-slate-100">
                    <span class="text-sm font-bold text-slate-900">My Account</span>
                </div>
                
                <div class="py-1">
                    <a href="{{ route('hr.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Profile Settings</a>
                    <a href="{{ route('hr.security') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">Security & MFA</a>
                </div>
                
                <div class="border-t border-slate-100 py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition text-left">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <button @click="open = !open" class="w-full border-t border-slate-700 p-6 flex items-center gap-4 hover:bg-slate-800 transition text-left focus:outline-none cursor-pointer">
                <div class="w-12 h-12 bg-[#22C55E] rounded-full flex items-center justify-center text-white font-bold text-lg border-2 border-[#4ADE80]">
                    JD
                </div>
                <div>
                    <div class="font-bold text-white leading-tight">Juan Dela Cruz</div>
                    <div class="text-slate-400 text-sm mt-0.5">HR Officer</div>
                </div>
            </button>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <header class="bg-white shadow-sm z-10 px-8 py-4 flex items-center justify-between border-b border-slate-200">
            <div class="flex items-center gap-3">
                <h1 class="hidden lg:block text-2xl font-black text-[#0B1C3D]">Welcome back, Juan!</h1>
                <span class="lg:hidden text-xl font-bold text-[#0B1C3D]">HR Central</span>
            </div>
            
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-[#0B1C3D] focus:outline-none p-1 border border-slate-200 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 lg:p-8 bg-slate-50">
            @yield('content')
        </main>
    </div>
</body>
</html>