<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">

        <nav class="mb-6">
            <a href="{{ route('habits.index') }}"
                class="text-sm font-medium text-[#5E6C84] hover:text-[#0052CC] flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>
        </nav>

        <div class="bg-white border border-[#DFE1E6] rounded-lg shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-[#DFE1E6] bg-[#FAFBFC]">
                <h2 class="text-xl font-bold text-[#172B4D]">Establish a New Habit</h2>
                <p class="text-sm text-[#5E6C84] mt-1">Define your goal and start tracking your consistency today.</p>
            </div>

            <form action="{{ route('habits.store') }}" method="POST" class="p-8 space-y-8">
                @csrf

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide" for="title">
                        What is your new habit?
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="e.g. Read for 30 mins, Morning 5km run..."
                        class="w-full px-4 py-3 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D] placeholder:text-[#A5ADBA] @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-[#DE350B] text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide" for="description">
                        Why is this important? (Optional)
                    </label>
                    <textarea name="description" id="description" rows="4"
                        placeholder="Describe your motivation or specific rules for this habit..."
                        class="w-full px-4 py-3 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D] placeholder:text-[#A5ADBA] @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-[#DE350B] text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-[#F4F5F7]">
                    <a href="{{ route('habits.index') }}"
                        class="px-4 py-2 text-sm font-semibold text-[#42526E] hover:bg-[#EBECF0] rounded-md transition-colors">
                        Cancel
                    </a>

                    <button type="submit"
                        class="bg-[#0052CC] hover:bg-[#0747A6] text-white px-6 py-2 rounded-md text-sm font-bold transition shadow-sm shadow-blue-500/20">
                        Create Habit
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 p-4 bg-[#EAE6FF] border border-[#C0B6F2] rounded-lg flex items-start space-x-3">
            <svg class="w-5 h-5 text-[#403294] mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM5.884 6.68a1 1 0 101.415-1.414L6.586 4.553a1 1 0 00-1.414 1.414l.712.713zM18 8a1 1 0 00-1-1h-1a1 1 0 100 2h1a1 1 0 001-1zM5 8a1 1 0 00-1-1H3a1 1 0 100 2h1a1 1 0 001-1zM8 11a1 1 0 100-2H7a1 1 0 100 2h1zm2 5a1 1 0 100-2v-1a1 1 0 10-2 0v1a1 1 0 100 2h2zm4.586-11.293a1 1 0 00-1.414 1.414l.713.712a1 1 0 101.414-1.414l-.713-.712z">
                </path>
            </svg>
            <div>
                <p class="text-xs font-bold text-[#403294] uppercase tracking-wider">Pro Tip</p>
                <p class="text-sm text-[#403294]">Consistent habits are built by starting small. Focus on one specific
                    action you can do in under 2 minutes.</p>
            </div>
        </div>
    </div>
</x-app-layout>
