<?php

namespace App\Http\Controllers;

use App\Models\Task; // Pārliecinies, ka tavs modelis ir pareizi importēts
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        return Task::all();
    }

    // Create a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,completed', // pievieno statusu validāciju
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    // Get a specific task
    public function show(Task $task)
    {
        return $task;
    }

    // Update a specific task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'status' => 'string|in:pending,completed',
        ]);

        $task->update($request->all());
        return response()->json($task, 200);
    }

    // Delete a specific task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
