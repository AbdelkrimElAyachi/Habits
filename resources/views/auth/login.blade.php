<x-guest-layout>
    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-7/12 bg-[#0747a6] p-16 items-center justify-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl -ml-32 -mb-32"></div>

            <div class="relative z-10 w-full max-w-lg">
                <h1 class="text-4xl font-bold text-white mb-6 tracking-tight">
                    Manage your habits with the precision of a software team.
                </h1>

                <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20 shadow-2xl">
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    </div>
                    <div class="space-y-4">
                        <div class="h-8 bg-white/20 rounded w-3/4"></div>
                        <div
                            class="h-20 bg-white/10 rounded w-full border border-white/10 flex items-center justify-center">
                            <span class="text-white/40 font-mono text-xs italic">Habit Stats Grid Mockup</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <div class="h-8 bg-blue-400/40 rounded"></div>
                            <div class="h-8 bg-blue-400/20 rounded"></div>
                            <div class="h-8 bg-blue-400/60 rounded"></div>
                            <div class="h-8 bg-blue-400/30 rounded"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-8 bg-white shadow-[-10px_0_15px_-3px_rgba(0,0,0,0.05)]">
            <div class="w-full max-w-sm">
                <div class="mb-10 flex items-center space-x-2">
                    <div
                        class="w-10 h-10 bg-[#0052cc] rounded-lg flex items-center justify-center text-white font-bold">
                        H</div>
                    <span class="font-bold text-xl text-[#172b4d]">HabitApp</span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-[#172b4d]">Log in to your account</h2>
                    <p class="text-gray-500 text-sm mt-1">Enter your details to continue.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email"
                            class="block text-xs font-semibold text-gray-700 uppercase mb-1 tracking-wide">Email</label>
                        <input type="email" name="email" id="email" required autofocus
                            class="w-full px-3 py-2 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-md focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none"
                            placeholder="name@company.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="password"
                                class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Password</label>
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-[#0052cc] hover:underline">Forgot?</a>
                        </div>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-md focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 text-[#0052cc] border-gray-300 rounded focus:ring-[#4c9aff]">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Keep me logged in</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#0052cc] hover:bg-[#0747a6] text-white font-semibold py-2.5 px-4 rounded-md transition-colors shadow-sm text-sm">
                        Log In
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600">
                        New to HabitApp? <a href="{{ route('register') }}"
                            class="text-[#0052cc] font-medium hover:underline">Create an account</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
