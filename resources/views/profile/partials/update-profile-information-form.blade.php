<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-[#172B4D]">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-[#5E6C84]">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1"
                for="name">Name</label>
            <input id="name" name="name" type="text"
                class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D]"
                value="{{ old('name', $user->name) }}" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1" for="email">Email
                Address</label>
            <input id="email" name="email" type="email"
                class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D]"
                value="{{ old('email', $user->email) }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <br/>
            <br/>
            <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide mb-1" for="email">
                Phone Number</label>
            <input id="phone" name="phone" type="text"
                class="w-full px-3 py-2 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D]"
                value="{{ old('phone', $user->phone) }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                    <p class="text-sm text-yellow-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="font-bold underline hover:text-yellow-900 ml-1">
                            {{ __('Resend verification email') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-[#0052CC] hover:bg-[#0747A6] text-white px-4 py-2 rounded-md text-sm font-semibold transition shadow-sm">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
