<x-guest-layout>
    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-7/12 bg-[#0747a6] p-16 items-center justify-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-80 h-80 bg-white/5 rounded-full blur-3xl -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl -ml-40 -mb-40"></div>

            <div class="relative z-10 w-full max-w-lg">
                <h1 class="text-4xl font-bold text-white mb-6 tracking-tight">
                    Confirm your identity to <br /> access sensitive settings.
                </h1>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl">
                    <div class="flex items-center justify-between mb-6">
                        <div class="h-2 w-12 bg-white/40 rounded"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div class="space-y-4">
                        <div class="h-3 bg-white/20 rounded w-full"></div>
                        <div class="h-3 bg-white/10 rounded w-3/4"></div>
                        <div class="pt-2 flex space-x-2">
                            <div class="h-2 w-2 rounded-full bg-green-400 animate-pulse"></div>
                            <div class="h-2 bg-white/5 rounded w-24"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-8 bg-white shadow-[-10px_0_15px_-3px_rgba(0,0,0,0.02)]">
            <div class="w-full max-w-sm">
                <div class="mb-10 flex items-center space-x-2">
                    <div
                        class="w-10 h-10 bg-[#0052cc] rounded-lg flex items-center justify-center text-white font-bold text-xl">
                        H</div>
                    <span class="font-bold text-xl text-[#172b4d]">HabitApp</span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-[#172b4d]">Security Checkpoint</h2>
                    <p class="text-gray-500 text-sm mt-3 leading-relaxed">
                        {{ __('This is a secure area. Please confirm your password before continuing to your account settings.') }}
                    </p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="password"
                            class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Verification
                            Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none"
                            placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="pt-2 flex flex-col space-y-4">
                        <button type="submit"
                            class="w-full bg-[#0052cc] hover:bg-[#0747a6] text-white font-bold py-3 px-4 rounded-lg transition-all shadow-md shadow-blue-500/20 text-sm">
                            {{ __('Confirm Access') }}
                        </button>

                        <a href="{{ url()->previous() }}"
                            class="text-center text-sm text-gray-400 hover:text-gray-600 font-medium transition-colors">
                            Cancel and go back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
