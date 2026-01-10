<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-[#172B4D]">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-[#5E6C84]">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1"
                for="current_password">Current Password</label>
            <input id="current_password" name="current_password" type="password"
                class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1" for="password">New
                Password</label>
            <input id="password" name="password" type="password"
                class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1"
                for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-[#0052CC] hover:bg-[#0747A6] text-white px-4 py-2 rounded-md text-sm font-semibold transition shadow-sm">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
