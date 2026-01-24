<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHabitRequest;
use App\Http\Requests\UpdateHabitRequest;
use App\Models\Habit;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HabitController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        // Définit la vue par défaut : 'day', 'week', ou 'month'
        $view = $request->get('view', 'day'); 

        // 1. Récupération des Habitudes avec filtrage et comptage
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

        // 2. Statistiques Globales (Aggregate Stats)
        $totalHabits = $habits->count();
        $totalTasks = $habits->sum('tasks_count');
        $completedTasks = $habits->sum('completed_tasks_count');
        $completionRate = $totalTasks ? (int) round($completedTasks / $totalTasks * 100) : 0;

        // Calcul du score de consistance par habitude (0-10)
        $habits->transform(function ($habit) {
            $habit->consistency = $habit->tasks_count 
                ? (int) round(($habit->completed_tasks_count / $habit->tasks_count) * 10) 
                : null;
            return $habit;
        });

        // 3. Logique de l'Historique Dynamique (10 dernières unités)
        $historyArray = $this->generateHistoryData($view);

        return view('habits.index', compact(
            'habits', 
            'totalHabits', 
            'totalTasks', 
            'completedTasks', 
            'completionRate', 
            'historyArray', 
            'view'
        ));
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
        $this->authorize('view', $habit);

        $completedTasks = $habit->tasks()->where('is_complete', true)->get();
        $incompletedTasks = $habit->tasks()->where('is_complete', false)->get();

        return view('habits.show', compact('habit', 'completedTasks', 'incompletedTasks'));
    }

    public function edit(Habit $habit)
    {
         $this->authorize('update', $habit);

        return view('habits.edit', compact('habit'));
    }

    public function update(UpdateHabitRequest $request, Habit $habit)
    {
         $this->authorize('update', $habit);

        $habit->update($request->validated());

        return redirect(route('habits.show', $habit->id));
    }

    public function destroy(Habit $habit)
    {
        if(Gate::denies('delete', $habit)) {
            return abort(403);
        }

        $title = $habit->title;
        $habit->delete();

        session()->flash('status', "{$title} has been deleted");
        return response()->json(200);
    }

    /**
     * Logique privée pour générer les données du graphique
     */
    private function generateHistoryData(string $view): array
    {
        $data = [];
        $now = now();

        for ($i = 9; $i >= 0; $i--) {
            $date = match($view) {
                'week'  => $now->copy()->subWeeks($i)->startOfWeek(),
                'month' => $now->copy()->subMonths($i)->startOfMonth(),
                default => $now->copy()->subDays($i)->startOfDay(),
            };

            $label = match($view) {
                'week'  => "Sem " . $date->format('W'),
                'month' => $date->translatedFormat('M y'),
                default => $date->translatedFormat('d M'),
            };

            $data[$date->format('Y-m-d')] = [
                'label' => $label,
                'completed' => 0,
                'missed' => 0,
                'timestamp' => $date
            ];
        }

        $startDate = Carbon::parse(array_key_first($data));

        $tasks = Task::whereHas('habit', fn($query) => $query->where('user_id', auth()->id()))
            ->where(function($query) use ($startDate) {
                $query->where('finished_at', '>=', $startDate)
                      ->orWhere('due_at', '>=', $startDate);
            })
            ->get();

        foreach ($tasks as $task) {
            foreach ($data as $key => &$bucket) {
                $targetDate = $bucket['timestamp'];

                $isSamePeriod = match($view) {
                    'week'  => ($task->finished_at?->isSameWeek($targetDate) || $task->due_at?->isSameWeek($targetDate)),
                    'month' => ($task->finished_at?->isSameMonth($targetDate) || $task->due_at?->isSameMonth($targetDate)),
                    default => ($task->finished_at?->isSameDay($targetDate) || $task->due_at?->isSameDay($targetDate)),
                };

                if ($isSamePeriod) {
                    if ($task->is_complete && $task->finished_at) {
                        $matchCompleted = match($view) {
                            'week'  => $task->finished_at->isSameWeek($targetDate),
                            'month' => $task->finished_at->isSameMonth($targetDate),
                            default => $task->finished_at->isSameDay($targetDate),
                        };
                        if ($matchCompleted) $bucket['completed']++;
                    }

                    if (!$task->is_complete && $task->due_at && $task->due_at->isPast()) {
                        $matchMissed = match($view) {
                            'week'  => $task->due_at->isSameWeek($targetDate),
                            'month' => $task->due_at->isSameMonth($targetDate),
                            default => $task->due_at->isSameDay($targetDate),
                        };
                        if ($matchMissed) $bucket['missed']++;
                    }
                }
            }
        }

        return array_map(function($item) {
            unset($item['timestamp']);
            return $item;
        }, array_values($data));
    }
}
