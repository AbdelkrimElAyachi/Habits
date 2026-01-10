<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#172B4D]">Account Settings</h1>
        <p class="text-sm text-[#5E6C84]">Manage your personal identity, security credentials, and data.</p>
    </div>

    <div class="space-y-6 max-w-4xl">
        <div class="bg-white border border-[#DFE1E6] rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="bg-white border border-[#DFE1E6] rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="bg-[#FFF0F0] border border-[#FFBDAD] rounded-lg overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
