@props(['habit', 'task'])

<div class="task-container" data-task-id="{{ $task->id }}">
    {{-- 1. DISPLAY MODE (Shown by default) --}}
    <div class="task-display flex justify-between items-center w-full">
        <div class="flex items-center space-x-3 flex-1">
            {{-- In form.blade.php inside the task-display div --}}
            <x-tasks.checkbox 
                name="is_complete" 
                :completed="$task->is_complete" 
                data-url="{{ route('tasks.update', ['habit' => $habit->id, 'task' => $task->id]) }}"
                class="task-status-checkbox" 
            />
            <div>
                <p class="text-sm font-medium {{ $task->is_complete ? 'line-through text-[#A5ADBA]' : 'text-[#172B4D]' }}">
                    {{ $task->body }}
                </p>
                <div class="text-[11px] text-[#6B778C] flex items-center space-x-2">
                    @if($task->due_at)
                        <span>Due: {{ $task->due_at->format('M j, H:i') }}</span>
                    @else
                        <span>Due: —</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Dropdown Toggle --}}
        <div class="flex items-center ml-4 space-x-2">
            {{-- Edit Button --}}
            <button type="button" 
                    class="edit-toggle-btn flex items-center space-x-1 px-2 py-1 rounded-md text-[#6B778C] hover:bg-[#DEEBFF] hover:text-[#0052CC] transition-all group/edit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <span class="text-[10px] font-bold uppercase tracking-wider hidden group-hover/edit:block">Edit</span>
            </button>
        </div>
    </div>

    {{-- 2. EDIT MODE (Hidden by default) --}}
    <form class="task-edit-form hidden mt-4 pt-4 border-t border-[#F4F5F7]" 
          action="{{ route('tasks.update', ['habit' => $habit->id, 'task' => $task->id]) }}" 
          method="POST">
        @csrf
        @method('PATCH')
        
        <div class="space-y-4">
            <input type="text" name="body" value="{{ $task->body }}" 
                   class="w-full border-[#DFE1E6] rounded-lg text-sm focus:ring-[#0052CC] focus:border-[#0052CC]">
            
            <div class="flex items-center space-x-2">
                <input type="datetime-local" name="due_at" 
                       value="{{ optional($task->due_at)->format('Y-m-d\TH:i') }}"
                       class="flex-1 border-[#DFE1E6] rounded-lg text-sm">
                
                <button type="submit" class="bg-[#0052CC] text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#0747A6] transition">
                    Save Changes
                </button>
                <button type="button" class="cancel-edit-btn text-[#42526E] px-3 py-2 text-xs font-bold">
                    Cancel
                </button>
            </div>
        </div>
    </form>
</div>
