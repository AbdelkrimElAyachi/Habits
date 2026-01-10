<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HabitApp — Build Better Systems</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-[#172B4D]">

    <nav class="flex items-center justify-between px-6 py-6 max-w-7xl mx-auto w-full">
        <div class="flex items-center space-x-2">
            <div
                class="w-9 h-9 bg-[#0052CC] rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/20">
                H</div>
            <span class="font-bold text-xl tracking-tight">HabitApp</span>
        </div>

        <div class="space-x-4 flex items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm font-semibold text-[#42526E] hover:text-[#0052CC]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-[#42526E] hover:text-[#0052CC]">Log
                        in</a>
                    <a href="{{ route('register') }}"
                        class="bg-[#0052CC] text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-md shadow-blue-500/20 hover:bg-[#0747A6] transition">Get
                        Started</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 pt-20 pb-32">
        <div class="text-center">
            <span
                class="bg-[#DEEBFF] text-[#0052CC] text-[11px] font-bold uppercase tracking-[0.2em] px-3 py-1 rounded-full">New:
                Version 2.0 is live</span>
            <h1 class="mt-8 text-5xl md:text-7xl font-extrabold tracking-tighter leading-tight">
                Structure creates <span class="text-[#0052CC]">focus.</span>
            </h1>
            <p class="mt-6 text-xl text-[#42526E] max-w-2xl mx-auto leading-relaxed">
                Stop relying on willpower. HabitApp helps you build high-performance routines with a system designed for
                clarity and consistency.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="w-full sm:w-auto bg-[#0052CC] text-white px-8 py-4 rounded-xl font-bold shadow-xl shadow-blue-500/25 hover:scale-105 transition-all duration-200">
                    Start tracking for free
                </a>
                <a href="#features"
                    class="w-full sm:w-auto px-8 py-4 text-[#42526E] font-semibold hover:bg-[#F4F5F7] rounded-xl transition">
                    See how it works
                </a>
            </div>
        </div>

        <div class="mt-20 relative">
            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent z-10"></div>
            <div class="bg-[#F4F5F7] rounded-2xl border border-[#DFE1E6] p-4 shadow-2xl">
                <div
                    class="bg-white rounded-xl border border-[#DFE1E6] h-96 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('images/app-image.png') }}" alt="HabitApp Demo" class="object-cover h-full">
                </div>
            </div>
        </div>
    </main>

    <section id="features" class="bg-[#F4F5F7] py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="space-y-4">
                    <div
                        class="w-12 h-12 bg-[#0052CC] rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Smart Tracking</h3>
                    <p class="text-[#42526E] leading-relaxed">Organize your habits into actionable tasks and track your
                        daily consistency with zero friction.</p>
                </div>

                <div class="space-y-4">
                    <div
                        class="w-12 h-12 bg-[#36B37E] rounded-xl flex items-center justify-center text-white shadow-lg shadow-green-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Detailed Analytics</h3>
                    <p class="text-[#42526E] leading-relaxed">Visualize your progress with activity logs and performance
                        streaks to stay motivated longer.</p>
                </div>

                <div class="space-y-4">
                    <div
                        class="w-12 h-12 bg-[#6554C0] rounded-xl flex items-center justify-center text-white shadow-lg shadow-purple-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Secure by Default</h3>
                    <p class="text-[#42526E] leading-relaxed">Your data belongs to you. We use enterprise-grade
                        encryption to keep your routines private.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-20 px-6 border-t border-[#DFE1E6]">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center space-x-2 opacity-50">
                <div class="w-6 h-6 bg-[#172B4D] rounded flex items-center justify-center text-white font-bold text-xs">
                    H</div>
                <span class="font-bold text-sm tracking-tight">HabitApp</span>
            </div>
            <p class="text-sm text-[#6B778C]">© {{ date('Y') }} HabitApp. Built for high performers.</p>
            <div class="flex space-x-6">
                <a href="#" class="text-sm text-[#6B778C] hover:text-[#0052CC]">Privacy</a>
                <a href="#" class="text-sm text-[#6B778C] hover:text-[#0052CC]">Terms</a>
            </div>
        </div>
    </footer>

</body>

</html>
