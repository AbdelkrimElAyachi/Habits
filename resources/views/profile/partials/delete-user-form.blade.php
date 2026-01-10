<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-[#BF2600]">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-[#DE350B]">
            {{ __('Once your account is deleted, all data will be permanently removed. This action cannot be undone.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-[#DE350B] hover:bg-[#BF2600] text-white px-4 py-2 rounded-md text-sm font-semibold transition shadow-sm">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-[#172B4D]">
                {{ __('Confirm Account Deletion') }}
            </h2>

            <p class="mt-3 text-sm text-[#5E6C84] leading-relaxed">
                {{ __('Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1"
                    for="confirm_password">Password</label>
                <input id="confirm_password" name="password" type="password"
                    class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none"
                    placeholder="Enter password to confirm" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-4 py-2 text-sm font-semibold text-[#42526E] hover:bg-[#EBECF0] rounded-md transition">
                    {{ __('Cancel') }}
                </button>

                <button type="submit"
                    class="bg-[#DE350B] hover:bg-[#BF2600] text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                    {{ __('Confirm Deletion') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
