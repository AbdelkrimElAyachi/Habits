<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">

        <nav class="mb-6">
            <a href="{{ route('habits.show', $habit->id) }}"
                class="text-sm font-medium text-[#5E6C84] hover:text-[#0052CC] flex items-center transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Habit Details
            </a>
        </nav>

        <div class="bg-white border border-[#DFE1E6] rounded-lg shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-[#DFE1E6] bg-[#FAFBFC]">
                <h2 class="text-xl font-bold text-[#172B4D]">Edit Habit</h2>
                <p class="text-sm text-[#5E6C84] mt-1">Refine your goals or update the description of your routine.</p>
            </div>

            <form action="{{ route('habits.update', $habit->id) }}" method="POST" class="p-8 space-y-8">
                @csrf
                @method('PATCH')

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide" for="title">
                        Habit Title
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $habit->title) }}"
                        class="w-full px-4 py-3 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D] @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-[#DE350B] text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="block text-xs font-bold text-[#42526E] uppercase tracking-wide" for="description">
                        Description & Motivation
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-3 bg-[#F4F5F7] border-2 border-[#DFE1E6] rounded-md focus:bg-white focus:border-[#4C9AFF] focus:ring-0 transition-all text-sm outline-none text-[#172B4D] @error('description') border-red-500 @enderror">{{ old('description', $habit->description) }}</textarea>
                    @error('description')
                        <p class="text-[#DE350B] text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-[#F4F5F7]">
                    <a href="{{ route('habits.show', $habit->id) }}"
                        class="px-4 py-2 text-sm font-semibold text-[#42526E] hover:bg-[#EBECF0] rounded-md transition-colors">
                        Cancel
                    </a>

                    <button type="submit"
                        class="bg-[#0052CC] hover:bg-[#0747A6] text-white px-6 py-2 rounded-md text-sm font-bold transition shadow-sm shadow-blue-500/20">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
