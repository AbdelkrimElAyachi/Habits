@php
    $layout = auth()->check() ? 'app' : 'guest';
@endphp

<x-dynamic-component :component="$layout . '-layout'">
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="mb-10">
            <span class="section-badge mb-4">Legal</span>
            <h1 class="text-4xl font-extrabold text-[#172B4D] mb-2">Terms of Service</h1>
            <p class="text-[#5E6C84]">Effective Date: January 13, 2026</p>
        </div>

        <div class="card space-y-8 text-[#42526E] leading-relaxed">
            <section>
                <h2 class="text-xl font-bold text-[#172B4D] mb-4">1. Acceptance</h2>
                <p>By accessing HabitApp, you agree to be bound by these terms and our automated habit-tracking system.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-[#172B4D] mb-4">2. Accountability</h2>
                <p>This application is a tool for personal growth. Users are responsible for maintaining their own streaks and configuring their SMTP settings to receive notifications.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-[#172B4D] mb-4">3. Data Deletion</h2>
                <p>You have the right to delete your account at any time. This will purge all associated habits, tasks, and activity logs from our database.</p>
            </section>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center font-bold text-[#0052CC] hover:underline">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</x-dynamic-component>