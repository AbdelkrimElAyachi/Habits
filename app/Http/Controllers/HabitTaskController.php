<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Task;
use Illuminate\Http\Request;

class HabitTaskController extends Controller
{

    public function store(Request $request, Habit $habit)
    {
        // authorize
        $this->authorize('manage', $habit);

        // validate
        $request->validate([
            'body' => 'required|string',
            'time' => 'nullable|date_format:H:i',
        ]);

        // add task
        $habit->tasks()->create(['body' => $request->body, 'time' => $request->time]);

        return redirect()->route('habits.show', $habit->id);
    }

    public function update(Request $request, Habit $habit, Task $task)
    {
         // authorize
         $this->authorize('manage', $habit);

        // validate incoming data (allow null body for delete behavior)
        $request->validate([
            'body' => 'nullable|string',
            'time' => 'nullable|date_format:H:i',
            'is_complete' => 'sometimes|boolean',
        ]);

        // if body has no text, delete task
        if(!$request->body || strlen($request->body) === 0) {
            $task->delete();

            return redirect()->route('habits.show', $habit->id);
        }

        // collect changed fields (handle time change even if body didn't change)
        $updates = [];

        if($request->body !== $task->body) {
            $updates['body'] = $request->body;
        }

        if($request->has('time')) {
            $existingTime = $task->time ? $task->time->format('H:i') : null;
            if($existingTime !== $request->time) {
                $updates['time'] = $request->time;
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
