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
        $q = $request->get('q');

        $query = Habit::where('user_id', auth()->id())
            ->withCount(['tasks', 'tasks as completed_tasks_count' => function ($query) {
                $query->where('is_complete', true);
            }]);

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $habits = $query->get();

        // aggregate stats
        $totalHabits = $habits->count();
        $totalTasks = $habits->sum('tasks_count');
        $completedTasks = $habits->sum('completed_tasks_count');
        $completionRate = $totalTasks ? (int) round($completedTasks / $totalTasks * 100) : 0;

        // per-habit consistency score 0-10
        $habits->transform(function ($habit) {
            $habit->consistency = $habit->tasks_count ? (int) round(($habit->completed_tasks_count / $habit->tasks_count) * 10) : null;
            return $habit;
        });

        return view('habits.index', compact('habits', 'totalHabits', 'totalTasks', 'completedTasks', 'completionRate'));
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
