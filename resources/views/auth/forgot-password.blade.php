<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-6 bg-[#f4f5f7]">

        <div class="mb-8 flex items-center space-x-2">
            <div
                class="w-10 h-10 bg-[#0052cc] rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/20">
                H</div>
            <span class="font-bold text-xl text-[#172b4d] tracking-tight">HabitApp</span>
        </div>

        <div
            class="w-full max-w-md bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-[#dfe1e6] p-8 md:p-10">

            <div class="mb-8 text-center">
                <div
                    class="inline-flex items-center justify-center w-14 h-14 bg-blue-50 text-[#0052cc] rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-[#172b4d]">Reset your password</h2>
                <p class="text-gray-500 text-sm mt-3 leading-relaxed font-medium px-2">
                    {{ __('Forgot your password? No problem. Enter your email address and we will send you a reset link.') }}
                </p>
            </div>

            <x-auth-session-status
                class="mb-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 text-sm font-medium"
                :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Registered
                        Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none placeholder:text-gray-400"
                        placeholder="name@company.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-600" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-[#0052cc] hover:bg-[#0747a6] text-white font-bold py-3 px-4 rounded-lg transition-all shadow-md shadow-blue-500/20 text-sm">
                        {{ __('Send Reset Link') }}
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-[#f4f5f7] text-center">
                <a href="{{ route('login') }}" class="text-sm text-[#0052cc] font-bold hover:underline transition-all">
                    ← Back to login
                </a>
            </div>
        </div>

        <p class="mt-8 text-sm text-gray-500 font-medium">
            Secure recovery via HabitApp Auth
        </p>
    </div>
</x-guest-layout>
