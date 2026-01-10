<x-app-layout>
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-[#172B4D]">Dashboard</h1>
            <p class="text-[#5E6C84] mt-1 font-medium">Welcome back! Here is how your routines are looking today.</p>
        </div>
        <a href="{{ route('habits.create') }}"
            class="inline-flex items-center justify-center bg-[#0052CC] hover:bg-[#0747A6] text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-all shadow-lg shadow-blue-500/20 active:scale-95">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create New Habit
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white border border-[#DFE1E6] rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-[#6B778C] uppercase tracking-[0.15em]">Total Habits</span>
                <div class="p-2 bg-[#DEEBFF] text-[#0052CC] rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-3xl font-bold text-[#172B4D]">{{ $totalHabits ?? 0 }}</div>
        </div>

        <div class="bg-white border border-[#DFE1E6] rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-[#6B778C] uppercase tracking-[0.15em]">Total tasks</span>
                <div class="p-2 bg-[#EAE6FF] text-[#403294] rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-3xl font-bold text-[#172B4D]">{{ $totalTasks ?? 0 }}</div>
        </div>

        <div class="bg-white border border-[#DFE1E6] rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-[#6B778C] uppercase tracking-[0.15em]">Completed</span>
                <div class="p-2 bg-[#E3FCEF] text-[#006644] rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 text-3xl font-bold text-[#172B4D]">{{ $completedTasks ?? 0 }}</div>
        </div>

        <div class="bg-[#172B4D] border border-[#172B4D] rounded-xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold text-[#A5ADBA] uppercase tracking-[0.15em]">Global Score</span>
                <span class="text-[#36B37E] text-xs font-bold">{{ $completionRate ?? 0 }}%</span>
            </div>
            <div class="mt-4">
                <div class="w-full h-2 bg-[#253858] rounded-full overflow-hidden">
                    <div class="h-full bg-[#36B37E] shadow-[0_0_10px_#36B37E]"
                        style="width: {{ $completionRate ?? 0 }}%"></div>
                </div>
                <p class="mt-3 text-[11px] text-[#A5ADBA] font-medium leading-tight">Great job! You're above your weekly
                    average.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($habits as $habit)
            <div
                class="bg-white border border-[#DFE1E6] rounded-2xl transition-all duration-300 hover:border-[#4C9AFF] hover:shadow-xl hover:-translate-y-1 group flex flex-col h-full overflow-hidden">
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="p-2 bg-[#F4F5F7] rounded-lg group-hover:bg-[#DEEBFF] group-hover:text-[#0052CC] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span
                            class="px-2 py-1 bg-[#E3FCEF] text-[#006644] text-[10px] font-bold uppercase tracking-wider rounded">On
                            Track</span>
                    </div>

                    <h3
                        class="text-xl font-bold text-[#172B4D] group-hover:text-[#0052CC] transition-colors leading-tight">
                        <a href="{{ route('habits.show', $habit->id) }}">
                            {{ $habit->title }}
                        </a>
                    </h3>

                    <p class="mt-3 text-sm text-[#5E6C84] leading-relaxed">
                        {{ Str::limit($habit->description, 90) }}
                    </p>
                </div>

                <div class="px-6 py-4 bg-[#FAFBFC] border-t border-[#DFE1E6] flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="flex -space-x-2">
                            <div class="w-6 h-6 rounded-full bg-[#4C9AFF] border-2 border-white"></div>
                            <div class="w-6 h-6 rounded-full bg-[#36B37E] border-2 border-white"></div>
                        </div>
                        <span class="text-[11px] font-bold text-[#6B778C] uppercase tracking-tighter">Consistency
                            {{ $habit->consistency ?? '—' }}/10</span>
                    </div>

                    <button
                        class="text-[#DE350B] hover:bg-[#FFEBE6] p-1.5 rounded-lg transition-colors opacity-0 group-hover:opacity-100"
                        id="delete-btn" data-habit="{{ json_encode($habit->only(['id', 'title'])) }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        @empty
            <div
                class="col-span-full py-20 text-center bg-[#FAFBFC] border-2 border-dashed border-[#DFE1E6] rounded-2xl">
                <div
                    class="w-20 h-20 bg-white shadow-sm border border-[#DFE1E6] rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-[#A5ADBA]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-[#172B4D]">Establish your first routine</h3>
                <p class="text-[#5E6C84] mt-2 mb-8 max-w-xs mx-auto">Success is the sum of small efforts, repeated day
                    in and day out.</p>
                <a href="{{ route('habits.create') }}"
                    class="inline-flex items-center px-6 py-3 bg-[#0052CC] text-white font-bold rounded-xl hover:bg-[#0747A6] transition shadow-xl shadow-blue-500/20">
                    Get Started
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        @endforelse
    </div>

    @vite(['resources/js/habit-delete.js'])
</x-app-layout>
