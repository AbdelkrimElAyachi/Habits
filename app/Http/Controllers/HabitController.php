<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HabitController extends Controller
{
    public function index(Request $request)
    {
        // optional search query
        $q = $request->input('q');

        // base query for current user's habits
        $query = Habit::whereBelongsTo(auth()->user());

        if ($q) {
            $query->where(function ($s) use ($q) {
                $s->where('title', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
            });
        }
        
        // eager-load task counts (total and completed) to avoid N+1
        $habits = $query->withCount([
            'tasks',
            'tasks as completed_tasks_count' => function ($q) {
                $q->where('is_complete', true);
            }
        ])->get();

        // compute stats based on filtered habits
        $totalHabits = $habits->count();
        $totalTasks = $habits->sum('tasks_count');
        $completedTasks = $habits->sum('completed_tasks_count');
        $completionRate = $totalTasks ? (int) round($completedTasks / $totalTasks * 100) : 0;

        // compute per-habit consistency scaled to 0..10
        foreach ($habits as $habit) {
            $total = $habit->tasks_count;
            $completed = $habit->completed_tasks_count;
            $habit->consistency = $total ? (int) round($completed / $total * 10) : null;
        }

        return view('habits.index', [
            'habits' => $habits,
            'totalHabits' => $totalHabits,
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'completionRate' => $completionRate,
        ]);
    }

    public function create()
    {
        return view('habits.create');
    }

    public function store(StoreHabitRequest $request)
    {
        $habit = $request->user()
                        ->habits()
                        ->create($request->validated());

        return redirect(route('habits.show', $habit->id));
    }

    public function show(Habit $habit)
    {
        // ‌authorization
        $this->authorize('view', $habit);

        $completedTasks = $habit->tasks()->where('is_complete', true)->get();
        $incompletedTasks = $habit->tasks()->where('is_complete', false)->get();

        return view('habits.show', compact('habit', 'completedTasks', 'incompletedTasks'));
    }

    public function edit(Habit $habit)
    {
         // ‌authorization
         $this->authorize('update', $habit);

        return view('habits.edit', compact('habit'));
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
         // ‌authorization
         $this->authorize('update', $habit);

        $habit->update($request->validated());

        return redirect(route('habits.show', $habit->id));
    }

    public function destroy(Habit $habit)
    {
         // ‌authorization
        if(Gate::denies('delete', $habit)) {
            return abort(403);
        }

        $title = $habit->title;

        $habit->delete();

        session()->flash('status', "{$title} has been deleted");
        return response()->json(200);
    }
}
