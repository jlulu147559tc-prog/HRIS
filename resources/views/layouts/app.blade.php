<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Central - HRIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add this Alpine.js script right here -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex text-slate-800 h-screen overflow-hidden">

    <!-- Persistent Left Sidebar -->
    <aside class="w-64 bg-[#0B1C3D] text-white flex flex-col justify-between h-full shadow-xl z-10">
        <div>
            <!-- Logo -->
            <div class="flex items-center gap-3 p-6 mb-4">
                <div class="w-10 h-10 rounded-full border-2 border-emerald-500 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h1 class="text-2xl font-bold tracking-tight">HR Central</h1>
            </div>

            <!-- Navigation -->
            <!-- Navigation -->
            <nav class="px-4 space-y-1">
                
                <!-- Dashboard -->
                <a href="/" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('/') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                
                <!-- Employees -->
                <a href="/employees" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('employees*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Employees
                </a>

                <!-- Attendance -->
                <a href="/attendance" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('attendance*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Attendance
                </a>

                <!-- Leave -->
                <a href="/leave" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('leave*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Leave
                </a>

                <!-- Payroll -->
                <a href="/payroll" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('payroll*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Payroll
                </a>

                <!-- Performance -->
                <a href="/performance" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('performance*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    Performance
                </a>

                <!-- Reports -->
                <a href="/reports" class="flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->is('reports*') ? 'bg-[#1B844A] text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-800 font-medium' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Reports
                </a>
                
            </nav>
        </div>

        <!-- User Profile -->
        <!-- User Profile (with Dropdown) -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            
            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95"
                 class="absolute bottom-full left-4 mb-2 w-56 bg-white rounded-lg shadow-lg border border-slate-200 overflow-hidden text-slate-800 z-50"
                 style="display: none;">
                
                <div class="px-4 py-3 border-b border-slate-100">
                    <span class="text-sm font-bold text-slate-900">My Account</span>
                </div>
                
                <div class="py-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profile Settings
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Security & MFA
                    </a>
                </div>
                
                <div class="border-t border-slate-100 py-1">
                    <!-- The href="/login" acts as the front-end logout redirect -->
                    <a href="/login" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Log Out
                    </a>
                </div>
            </div>

            <!-- Clickable Profile Button -->
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
    </aside> <!-- End of your existing aside tag -->

    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-8">
        @yield('content')
    </main>

</body>
</html>