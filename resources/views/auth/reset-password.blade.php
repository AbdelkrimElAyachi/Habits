<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center p-6 bg-[#f4f5f7]">

        <div class="mb-8 flex items-center space-x-2">
            <div
                class="w-10 h-10 bg-[#0052cc] rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-500/20">
                H
            </div>
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
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-[#172b4d]">Set new password</h2>
                <p class="text-gray-500 text-sm mt-2 font-medium">Almost there. Choose a secure new password for your
                    account.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email"
                        class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Account Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                        required readonly
                        class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg text-gray-400 text-sm cursor-not-allowed outline-none"
                        placeholder="email@example.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">New
                        Password</label>
                    <input id="password" type="password" name="password" required autofocus autocomplete="new-password"
                        class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wide">Confirm New
                        Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="w-full px-4 py-2.5 bg-[#f4f5f7] border-2 border-[#dfe1e6] rounded-lg focus:bg-white focus:border-[#4c9aff] focus:ring-0 transition-all text-sm outline-none"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-[#0052cc] hover:bg-[#0747a6] text-white font-bold py-3 px-4 rounded-lg transition-all shadow-md shadow-blue-500/20 text-sm">
                        {{ __('Update Password') }}
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-8 text-sm text-gray-500 font-medium">
            Protected by HabitApp Security Protocol
        </p>
    </div>
</x-guest-layout>
