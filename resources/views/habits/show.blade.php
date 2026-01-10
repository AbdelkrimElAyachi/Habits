<x-app-layout>
    <header class="mb-8">
        <div class="flex items-center justify-between">
            <nav class="flex items-center text-sm font-medium text-[#5E6C84]">
                <a href="{{ route('habits.index') }}" class="hover:text-[#0052CC] transition">Home</a>
                <svg class="w-4 h-4 mx-2 text-[#A5ADBA]" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                </svg>
                <span class="text-[#172B4D] truncate max-w-[200px]">{{ $habit->title }}</span>
            </nav>
            <div class="flex items-center space-x-3">
                <a href="{{ route('habits.edit', $habit->id) }}"
                    class="px-4 py-2 bg-white border border-[#DFE1E6] text-[#42526E] text-sm font-bold rounded-md hover:bg-[#F4F5F7] transition shadow-sm">
                    Edit Habit
                </a>
            </div>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-grow lg:w-2/3 space-y-8">

            <section>
                <h3 class="text-xs font-bold text-[#42526E] uppercase tracking-widest mb-3">Add Task</h3>
                <div
                    class="bg-white border-2 border-[#DFE1E6] rounded-lg focus-within:border-[#4C9AFF] transition-all overflow-hidden">
                    <form action="{{ route('tasks.store', $habit->id) }}" method="POST">
                        @csrf
                        <input type="text" name="body" placeholder="Type a task and press Enter..."
                            autocomplete="off"
                            class="w-full border-none focus:ring-0 bg-transparent px-4 py-4 text-[#172B4D] placeholder:text-[#A5ADBA] text-sm">
                    </form>
                </div>
            </section>

            @if (count($incompletedTasks))
                <section>
                    <h3 class="text-xs font-bold text-[#42526E] uppercase tracking-widest mb-3">Tasks to Complete</h3>
                    <div class="space-y-3">
                        @foreach ($incompletedTasks as $task)
                            <div
                                class="bg-white border border-[#DFE1E6] rounded-lg p-4 hover:border-[#4C9AFF] transition group">
                                <x-tasks.form :habit="$habit" :task="$task" />
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if (count($completedTasks))
                <section>
                    <h3 class="text-xs font-bold text-[#42526E] uppercase tracking-widest mb-3 opacity-60">Completed
                    </h3>
                    <div class="space-y-3">
                        @foreach ($completedTasks as $task)
                            <div class="bg-[#FAFBFC] border border-[#DFE1E6] rounded-lg p-4 opacity-75 grayscale-[0.5]">
                                <x-tasks.form :habit="$habit" :task="$task" />
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <div class="lg:w-1/3 space-y-6">
            <div class="bg-white border border-[#DFE1E6] rounded-lg p-6">
                <div class="mb-4">
                    <h4 class="text-sm font-bold text-[#172B4D] uppercase tracking-widest">About this Habit</h4>
                    <div class="h-1 w-8 bg-[#0052CC] mt-1 rounded-full"></div>
                </div>
                <p class="text-sm text-[#42526E] leading-relaxed mb-6">
                    {{ $habit->description ?: 'No description provided for this habit.' }}
                </p>

                <button
                    class="w-full text-xs font-bold text-[#DE350B] py-2 border border-[#FFBDAD] rounded hover:bg-[#FFF0F0] transition"
                    id="delete-btn" data-habit="{{ json_encode($habit->only(['id', 'title'])) }}">
                    Delete Habit
                </button>
            </div>

            <div class="bg-white border border-[#DFE1E6] rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-[#DFE1E6] bg-[#FAFBFC]">
                    <h4 class="text-xs font-bold text-[#172B4D] uppercase tracking-widest">Recent Activity</h4>
                </div>
                <div class="p-6">
                    @forelse ($habit->activities as $activity)
                        <div
                            class="flex justify-between items-start py-3 {{ !$loop->last ? 'border-b border-[#F4F5F7]' : '' }}">
                            <div class="text-xs text-[#172B4D]">
                                <x-activities.log :activity="$activity"></x-activities.log>
                            </div>
                            <span class="text-[10px] font-medium text-[#A5ADBA] whitespace-nowrap ml-4">
                                {{ $activity->created_at->diffForHumans(null, true) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-[#A5ADBA] italic text-center">No activity recorded yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/habit-delete.js', 'resources/js/task-update.js'])
</x-app-layout>
