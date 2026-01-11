<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HabitTaskController extends Controller
{

    public function store(Request $request, Habit $habit)
    {
        // authorize
        $this->authorize('manage', $habit);

        // validate
        $request->validate([
            'body' => 'required|string',
            'due_at' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        // add task (store due_at as full datetime string or null)
        $habit->tasks()->create([
            'body' => $request->body,
            'due_at' => $request->due_at ? Carbon::createFromFormat('Y-m-d\TH:i', $request->due_at) : null,
        ]);

        return redirect()->route('habits.show', $habit->id);
    }

    public function update(Request $request, Habit $habit, Task $task)
    {
         // authorize
         $this->authorize('manage', $habit);

        // validate incoming data (allow null body for delete behavior)
        $request->validate([
            'body' => 'nullable|string',
            'due_at' => 'nullable|date_format:Y-m-d\TH:i',
            'is_complete' => 'sometimes|boolean',
        ]);

        // if body has no text, delete task
        if(!$request->body || strlen($request->body) === 0) {
            $task->delete();

            return redirect()->route('habits.show', $habit->id);
        }

        // collect changed fields (handle due_at change even if body didn't change)
        $updates = [];

        if($request->body !== $task->body) {
            $updates['body'] = $request->body;
        }

        if($request->has('due_at')) {
            $existing = $task->due_at ? $task->due_at->format('Y-m-d\TH:i') : null;
            $incoming = $request->due_at;
            if($existing !== $incoming) {
                $updates['due_at'] = $incoming ? Carbon::createFromFormat('Y-m-d\TH:i', $incoming) : null;
            }
        }

        if(! empty($updates)) {
            $task->update($updates);

            // track activity
            $task->trackActivity('updated_task');

            return response()->json(['message' => 'task updated'], 200);
        }

        // complete or incomplete task
        $this->completeOrIncomplete($request, $task);

        return response()->json(['message' => 'task updated'], 200);

    }

    private function completeOrIncomplete(Request $request, Task $task)
    {
        // when the request has is_complete or the user is checked
        if($request->is_complete) {
            $task->complete();
        }elseif(! $request->is_complete && $task->is_complete === true) { // uncheck only if the request has no is_complete
            $task->inComplete();                                          // and the previous state of the task is true
        }
    }

}
