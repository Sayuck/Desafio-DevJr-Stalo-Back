<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the user's tasks.
     */
    public function index()
    {
        $user = auth()->user(); // Get the currently authenticated user
        $tasks = $user->tasks; // Get the tasks for the authenticated user
        return response()->json($tasks, 200); // Return a JSON response with the tasks
    }

    /**
     *  store a new task for the user.
     */
    public function store(Request $request)
    {
        $user = auth()->user(); // Get the currently authenticated user
        $data = $request->validate([
            'description' => 'required|string',
            'completed' => 'nullable|boolean',
        ]);

        $task = $user->tasks()->create($data);

        return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return response()->json($task, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $data = $request->validate([
            'title' => 'string',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $task->update($data);
        return response()->json($task, 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task); // Assuming you have a policy set up
        $task->delete();
        return response()->json(['message' => 'Task deleted'], 200);
    }
}
