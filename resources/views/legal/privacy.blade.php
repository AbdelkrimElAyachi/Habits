@php
    $layout = auth()->check() ? 'app' : 'guest';
@endphp

<x-dynamic-component :component="$layout . '-layout'">
    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="mb-10">
            <span class="section-badge mb-4">Compliance</span>
            <h1 class="text-4xl font-extrabold text-[#172B4D] mb-2">Privacy Policy</h1>
            <p class="text-[#5E6C84]">Last updated: January 13, 2026</p>
        </div>

        <div class="card space-y-8 text-[#42526E] leading-relaxed">
            <section>
                <h2 class="text-xl font-bold text-[#172B4D] mb-4">1. Data Collection</h2>
                <p>We collect account details (name, email) and your habit tracking data to provide the core service functions.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-[#172B4D] mb-4">2. Timezone Data</h2>
                <p>Because accurate reminders depend on your location, we specifically utilize the <code>Africa/Casablanca</code> timezone settings for our notification engine.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-[#172B4D] mb-4">3. Notifications</h2>
                <p>Your email is used solely for sending task reminders via our background scheduler. We do not sell your data to third parties.</p>
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