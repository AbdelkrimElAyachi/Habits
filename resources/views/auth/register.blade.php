<x-guest-layout>
    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-7/12 bg-[#0747a6] p-16 items-center justify-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -ml-20 -mt-20"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl -mr-20 -mb-20"></div>

            <div class="relative z-10 w-full max-w-lg">
                <h1 class="text-4xl font-bold text-white mb-6 tracking-tight leading-tight">
                    Build better habits <br /> with a system that works.
                </h1>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 shadow-2xl">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex space-x-2">
                            <div class="w-2 h-2 rounded-full bg-red-400"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                            <div class="w-2 h-2 rounded-full bg-green-400"></div>
                        </div>
                        <div
                            class="px-3 py-1 rounded-full bg-blue-500/30 text-blue-100 text-[10px] font-semibold uppercase tracking-wider">
                            Real-time Sync
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex-shrink-0"></div>
                            <div class="h-4 bg-white/20 rounded w-full"></div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex-shrink-0"></div>
                            <div class="h-4 bg-white/10 rounded w-2/3"></div>
                        </div>
                        <div class="pt-4 flex justify-end">
                            <div class="h-10 w-32 bg-blue-500 rounded-lg"></div>
                        </div>
                    </div>
                </div>

                <p class="mt-8 text-blue-100/60 font-medium text-sm">
                    Trusted by over 000+ high-performers worldwide.
                </p>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-8 bg-white shadow-[-10px_0_15px_-3px_rgba(0,0,0,0.02)]">
            <div class="w-full max-w-sm">
                <div class="mb-10 flex items-center space-x-2">
                    <div
                        class="w-10 h-10 bg-[#0052cc] rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/20">
                        H</div>
                    <span class="font-bold text-xl text-[#172b4d] tracking-tight">HabitApp</span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-[#172b4d]">Create your account</h2>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name"
                            class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Full Name</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none placeholder:text-gray-400"
                            placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <label for="email"
                            class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Work
                            Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required
                            class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none placeholder:text-gray-400"
                            placeholder="name@company.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <label for="phone"
                            class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">
                            Phone Number</label>
                        <input id="phone" type="phone" name="phone" :value="old('phone')" required
                            class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none placeholder:text-gray-400"
                            placeholder="06XXXXXXXX">
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>

                    <div>
                        <label for="password"
                            class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none"
                            placeholder="Min. 8 characters">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Confirm
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-[#0052cc] hover:bg-[#0747a6] text-white font-bold py-3 px-4 rounded-lg transition-all shadow-md shadow-blue-500/20 text-sm">
                            Get Started →
                        </button>
                    </div>

                    <p class="text-[11px] text-gray-400 text-center leading-relaxed">
                        By signing up, you agree to our <a href="#" class="underline">Terms</a> and <a
                            href="#" class="underline">Privacy Policy</a>.
                    </p>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600 font-medium">
                        Already have an account? <a href="{{ route('login') }}"
                            class="text-[#0052cc] font-bold hover:underline">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
