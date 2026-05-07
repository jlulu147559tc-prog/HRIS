<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Portal - HR Central</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
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
            <div class="flex items-center justify-between p-6 mb-4 border-b border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#10B981] flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold tracking-tight leading-tight">HR Central</h1>
                        <p class="text-xs text-[#10B981] font-medium">Employee Portal</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="px-4 space-y-1">
                <a href="/employee/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('employee/dashboard') ? 'bg-[#22C55E] text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Dashboard
                </a>
                <a href="/employee/attendance" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('employee/attendance') ? 'bg-[#22C55E] text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    My Attendance
                </a>
                <a href="/employee/leave" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('employee/leave') ? 'bg-[#22C55E] text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    My Leave
                </a>
                <a href="/employee/payslips" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('employee/payslips') ? 'bg-[#22C55E] text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    My Payslips
                </a>
                <a href="/employee/performance" class="flex items-center gap-3 px-4 py-3 rounded-lg font-bold transition {{ request()->is('employee/performance') ? 'bg-[#22C55E] text-white shadow-sm' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    My Performance
                </a>
            </nav>
        </div>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <div x-show="open" style="display: none;" class="absolute bottom-full left-4 mb-2 w-56 bg-white rounded-lg shadow-lg border border-slate-200 overflow-hidden text-slate-800 z-50">
                <div class="border-t border-slate-100 py-1">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
            <button @click="open = !open" class="w-full border-t border-slate-700 p-6 flex items-center gap-4 hover:bg-slate-800 transition text-left focus:outline-none">
                <div class="w-10 h-10 bg-[#10B981] rounded-full flex items-center justify-center text-white font-bold text-sm">
                    {{ auth()->user()->initials ?? 'ME' }}
                </div>
                <div>
                    <div class="font-bold text-white leading-tight text-sm">
                        {{ auth()->user()->first_name ?? 'User' }} {{ auth()->user()->last_name ?? '' }}
                    </div>
                    <div class="text-slate-400 text-xs mt-0.5">
                        {{ auth()->user()->position ?? 'Employee' }}
                    </div>
                </div>
            </button>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#F8FAFC]">
        
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-8 shrink-0">
            
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-800 focus:outline-none p-1 rounded-md hover:bg-slate-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                <h1 class="lg:hidden text-lg font-bold tracking-tight text-[#0B1C3D]">Employee Portal</h1>

                <button class="hidden lg:block text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative text-slate-400 hover:text-slate-600 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-white text-[10px] font-bold flex items-center justify-center">3</span>
                </div>
                <div class="w-8 h-8 rounded-full bg-[#0B1C3D] text-white flex items-center justify-center text-xs font-bold">
                    {{ auth()->user()->initials ?? 'ME' }}
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 lg:p-8">
            @yield('content')
        </main>
        
    </div>

</body>
</html>