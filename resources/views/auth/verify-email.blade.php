<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-6 bg-[#f4f5f7]">

        <div class="mb-8 flex items-center space-x-2">
            <div
                class="w-10 h-10 bg-[#0052cc] rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/20">
                H</div>
            <span class="font-bold text-xl text-[#172b4d] tracking-tight">HabitApp</span>
        </div>

        <div
            class="w-full max-w-md bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#dfe1e6] p-8 md:p-10 text-center">

            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 text-[#0052cc] rounded-full mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-[#172b4d] mb-4">Check your inbox</h2>

            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div
                    class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700 font-semibold animate-pulse">
                    {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <div class="flex flex-col space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-[#0052cc] hover:bg-[#0747a6] text-white font-bold py-3 px-4 rounded-lg transition-all shadow-md shadow-blue-500/20 text-sm">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-400 hover:text-[#172b4d] font-medium transition-colors">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

        <p class="mt-8 text-sm text-gray-400 font-medium italic">
            Waiting for verification...
        </p>
    </div>
</x-guest-layout>
