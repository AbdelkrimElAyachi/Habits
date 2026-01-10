@props(['completed' => false, 'body' => '', 'disabled' => false])

<input type="text"
    class="w-full outline-none border-transparent border-b border-b-gray-200 focus-visible:border-b-2 focus-visible:border-indigo-500 text-gray-900 bg-white input {{ $completed ? 'line-through text-gray-500' : '' }}"
    value="{{ $body }}" id="task-input" {!! $attributes !!} {{ $disabled ? 'disabled' : '' }}>
