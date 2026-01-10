<x-app-layout>
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-[#172B4D]">My Habits</h1>
                <p class="text-sm text-[#5E6C84]">Track and manage your daily routines.</p>
            </div>
            <a href="{{ route('habits.create') }}"
                class="bg-[#0052CC] hover:bg-[#0747A6] text-white px-4 py-2 rounded-md text-sm font-semibold transition shadow-sm">
                + Create Habit
            </a>
        </div>
    </div>

    @if (session('status'))
        <div id="flash-message"
            class="flex items-center p-4 mb-6 text-sm text-[#0052CC] bg-[#DEEBFF] border border-[#B3D4FF] rounded-md"
            role="alert">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($habits as $habit)
            <div
                class="bg-white border border-[#DFE1E6] rounded-lg p-5 hover:border-[#4C9AFF] transition-colors group relative flex flex-col h-full">
                <div class="mb-4">
                    <div class="flex items-start justify-between">
                        <h3 class="text-lg font-bold text-[#172B4D]">
                            <a href="{{ route('habits.show', $habit->id) }}"
                                class="hover:text-[#0052CC] transition-colors">
                                {{ $habit->title }}
                            </a>
                        </h3>
                    </div>
                    <div class="h-1 w-12 bg-[#4C9AFF] rounded-full mt-1.5"></div>
                </div>

                <div class="text-sm text-[#42526E] leading-relaxed flex-grow mb-6">
                    {{ Str::limit($habit->description, 100) }}
                </div>

                <div class="flex items-center justify-between mt-auto pt-4 border-t border-[#F4F5F7]">
                    <span class="text-[10px] uppercase font-bold text-[#6B778C] tracking-widest">Active Habit</span>

                    <button class="text-xs text-[#EB5757] hover:bg-[#FFEBE6] px-2 py-1 rounded transition-colors"
                        id="delete-btn" data-habit="{{ json_encode($habit->only(['id', 'title'])) }}">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white border-2 border-dashed border-[#DFE1E6] rounded-xl">
                <div class="w-16 h-16 bg-[#F4F5F7] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-[#A5ADBA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-[#172B4D]">No habits yet</h3>
                <p class="text-[#5E6C84] mb-6">Start building your routine today.</p>
                <a href="{{ route('habits.create') }}" class="text-[#0052CC] font-bold hover:underline">Track your first
                    habit →</a>
            </div>
        @endforelse
    </div>

    @vite(['resources/js/habit-delete.js'])
</x-app-layout>
