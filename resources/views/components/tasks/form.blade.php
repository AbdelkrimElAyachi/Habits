@props(['habit', 'task'])

<form id="taskUpdateForm" action="{{ route('tasks.update', ['habit' => $habit->id, 'task' => $task->id]) }}"
    method="POST">
    @csrf
    @method('PATCH')

    <div class="flex justify-between space-x-2 items-center">
        <div class="flex-1">
            <x-tasks.input name="body" :completed="$task->is_complete" :body="$task->body" />
            <div class="text-[11px] text-[#6B778C] mt-1 flex items-center space-x-2">
                @if($task->due_at)
                    <span>Due: {{ $task->due_at->format('M j, Y') }}</span>
                    <span class="text-xs bg-[#F4F5F7] text-[#172B4D] px-2 py-0.5 rounded">{{ $task->due_at->format('H:i') }}</span>
                @else
                    <span>Due: —</span>
                @endif
            </div>
        </div>

        <input type="datetime-local" 
       name="due_at" 
       value="{{ optional($task->due_at)->format('Y-m-d\TH:i') }}"
       class="ml-2 input w-64 min-w-[250px] border-[#DFE1E6] rounded-lg text-sm" />

        <x-tasks.checkbox name="is_complete" :completed="$task->is_complete" />
    </div>
</form>

