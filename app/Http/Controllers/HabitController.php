<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HabitController extends Controller
{
    public function index()
    {
        // fetch user's habits
        $habits = Habit::whereBelongsTo(auth()->user())->get();

        // compute stats
        $habitIds = $habits->pluck('id')->toArray();
        $totalHabits = $habits->count();
        $totalTasks = \App\Models\Task::whereIn('habit_id', $habitIds)->count();
        $completedTasks = \App\Models\Task::whereIn('habit_id', $habitIds)->where('is_complete', true)->count();
        $completionRate = $totalTasks ? (int) round($completedTasks / $totalTasks * 100) : 0;

        // compute per-habit consistency: scale completed/total to 0..10
        foreach ($habits as $habit) {
            $total = $habit->tasks()->count();
            $completed = $habit->tasks()->where('is_complete', true)->count();
            $habit->consistency = $total ? (int) round($completed / $total * 10) : null; // null when no tasks
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
