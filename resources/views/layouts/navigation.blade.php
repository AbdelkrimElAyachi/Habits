<nav x-data="{ open: false }" class="bg-white border-b border-[#DFE1E6] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div
                            class="w-8 h-8 bg-[#0052CC] rounded flex items-center justify-center text-white font-bold text-lg">
                            H</div>
                        <span class="font-bold text-[#172B4D] tracking-tight hidden md:block text-lg">HabitApp</span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    <a href="/"
                        class="inline-flex items-center px-3 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-[#0052CC] text-[#0052CC]' : 'border-transparent text-[#42526E] hover:text-[#172B4D] hover:border-[#DFE1E6]' }} text-sm font-medium transition duration-150 ease-in-out">
                        Habits
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-[#42526E] hover:text-[#172B4D] transition p-1.5 hover:bg-[#F4F5F7] rounded-md">
                            <div
                                class="w-7 h-7 bg-[#EBECF0] rounded-full flex items-center justify-center mr-2 text-xs font-bold text-[#42526E]">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Settings</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
