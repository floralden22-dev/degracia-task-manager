<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('due_date')->get();

        $totalTasks = $tasks->count();
        $pendingTasks = $tasks->where('status', 'Pending')->count();
        $completedTasks = $tasks->where('status', 'Completed')->count();

        $overdueTasks = $tasks->filter(function ($task) {
            return $task->due_date &&
                   $task->status === 'Pending' &&
                   $task->due_date < now()->toDateString();
        })->count();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'overdueTasks'
        ));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect('/tasks')
            ->with('success', 'Task has been added to your list.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect('/tasks')
            ->with('success', 'Task details have been updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks')
            ->with('success', 'Task has been removed from your list.');
    }
}