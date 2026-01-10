<x-app-layout>
    <header class="mb-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <nav class="flex items-center text-sm font-semibold tracking-tight">
                <a href="{{ route('habits.index') }}"
                    class="text-[#5E6C84] hover:text-[#0052CC] transition-colors">Dashboard</a>
                <svg class="w-5 h-5 mx-2 text-[#A5ADBA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-[#172B4D]">{{ $habit->title }}</span>
            </nav>

            <div class="flex items-center space-x-3">
                <a href="{{ route('habits.edit', $habit->id) }}"
                    class="px-4 py-2 bg-white border border-[#DFE1E6] text-[#42526E] text-sm font-bold rounded-lg hover:bg-[#F4F5F7] hover:text-[#172B4D] transition shadow-sm">
                    Edit Habit
                </a>
            </div>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row gap-10">
        <div class="flex-grow lg:w-2/3 space-y-10">

            <section>
                <div class="flex items-center mb-3">
                    <h3 class="text-[11px] font-bold text-[#6B778C] uppercase tracking-[0.15em]">Quick Add Task</h3>
                </div>
                <div
                    class="bg-white border-2 border-[#DFE1E6] rounded-xl focus-within:border-[#4C9AFF] focus-within:shadow-lg focus-within:shadow-blue-500/10 transition-all overflow-hidden group">
                    <form action="{{ route('tasks.store', $habit->id) }}" method="POST">
                        @csrf
                        <div class="flex items-center px-4">
                            <span class="text-[#A5ADBA] group-focus-within:text-[#4C9AFF]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </span>
                            <input type="text" name="body" placeholder="What needs to be done today?"
                                autocomplete="off"
                                class="w-full border-none focus:ring-0 bg-transparent py-5 text-[#172B4D] placeholder:text-[#A5ADBA] text-base font-medium">
                        </div>
                    </form>
                </div>
            </section>

            <section>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[11px] font-bold text-[#6B778C] uppercase tracking-[0.15em]">Tasks to Complete</h3>
                    <span
                        class="px-2 py-0.5 bg-[#DEEBFF] text-[#0052CC] text-[10px] font-bold rounded-full">{{ count($incompletedTasks) }}</span>
                </div>

                <div class="space-y-3">
                    @forelse ($incompletedTasks as $task)
                        <div
                            class="bg-white border border-[#DFE1E6] rounded-xl p-4 hover:border-[#4C9AFF] hover:shadow-md transition-all group active:scale-[0.99]">
                            <x-tasks.form :habit="$habit" :task="$task" />
                        </div>
                    @empty
                        <div class="py-10 text-center border-2 border-dashed border-[#DFE1E6] rounded-xl">
                            <p class="text-sm text-[#5E6C84]">All caught up for today! 🎉</p>
                        </div>
                    @endforelse
                </div>
            </section>

            @if (count($completedTasks))
                <section>
                    <div class="flex items-center space-x-3 mb-4">
                        <h3 class="text-[11px] font-bold text-[#6B778C] uppercase tracking-[0.15em] opacity-60">
                            Completed</h3>
                        <div class="flex-grow h-px bg-[#DFE1E6]"></div>
                    </div>

                    <div class="space-y-3">
                        @foreach ($completedTasks as $task)
                            <div
                                class="bg-[#FAFBFC] border border-[#DFE1E6] rounded-xl p-4 opacity-60 hover:opacity-100 grayscale-[0.5] hover:grayscale-0 transition-all group">
                                <x-tasks.form :habit="$habit" :task="$task" />
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <div class="lg:w-1/3 space-y-6">
            <div class="bg-white border border-[#DFE1E6] rounded-2xl shadow-sm p-6 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-24 h-24 -mr-8 -mt-8 bg-[#F4F5F7] rounded-full"></div>

                <div class="relative z-10">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-[#DEEBFF] text-[#0052CC] rounded-lg mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="text-md font-bold text-[#172B4D] uppercase">About</h4>
                    </div>

                    <p class="text-sm text-[#42526E] leading-relaxed mb-8">
                        {{ $habit->description ?: 'No description provided for this habit.' }}
                    </p>

                    <button
                        class="w-full flex items-center justify-center text-xs font-bold text-[#DE350B] py-2.5 bg-white border border-[#FFBDAD] rounded-lg hover:bg-[#FFEBE6] transition-colors"
                        id="delete-btn" data-habit="{{ json_encode($habit->only(['id', 'title'])) }}">
                        <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Habit
                    </button>
                </div>
            </div>

            <div class="bg-white border border-[#DFE1E6] rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-[#DFE1E6] bg-[#FAFBFC] flex items-center justify-between">
                    <h4 class="text-xs font-bold text-[#172B4D] uppercase tracking-widest">Log</h4>
                    <span class="text-[10px] text-[#A5ADBA] font-bold uppercase">{{ count($habit->activities) }}
                        Events</span>
                </div>
                <div class="p-6">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @forelse ($habit->activities as $activity)
                                <li>
                                    <div class="relative pb-8">
                                        @if (!$loop->last)
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-[#F4F5F7]"
                                                aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span
                                                    class="h-8 w-8 rounded-full bg-[#F4F5F7] flex items-center justify-center ring-4 ring-white">
                                                    <div class="w-2 h-2 rounded-full bg-[#4C9AFF]"></div>
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div class="text-xs text-[#172B4D]">
                                                    <x-activities.log :activity="$activity"></x-activities.log>
                                                </div>
                                                <div
                                                    class="whitespace-nowrap text-right text-[10px] font-bold text-[#A5ADBA] uppercase">
                                                    {{ $activity->created_at->diffForHumans(null, true) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <p class="text-xs text-[#A5ADBA] italic text-center">No activity yet.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @vite(['resources/js/habit-delete.js', 'resources/js/task-update.js'])
</x-app-layout>
