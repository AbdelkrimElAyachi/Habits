@props(['habit', 'task'])

<form id="taskUpdateForm" action="{{ route('tasks.update', ['habit' => $habit->id, 'task' => $task->id]) }}"
    method="POST">
    @csrf
    @method('PATCH')

    <div class="flex justify-between space-x-2 items-center">
        <x-tasks.input name="body" :completed="$task->is_complete" :body="$task->body" />

        <input type="time" name="time" value="{{ optional($task->time)->format('H:i') }}" class="ml-2 input w-28" />

        <x-tasks.checkbox name="is_complete" :completed="$task->is_complete" />
    </div>
</form>
