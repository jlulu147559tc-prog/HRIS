<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Central - Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Alpine.js here -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#2A3B55] min-h-screen flex flex-col justify-center items-center p-6 text-slate-800">

    <!-- Auth Card Container -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 lg:p-10">
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-slate-300">
        © 2026 HR Central. All rights reserved.
    </div>

</body>
</html>