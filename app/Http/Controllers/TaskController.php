<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::orderBy('due_date')->get();
        return view('tasks.index', compact('tasks'));
    }

   
    public function create()
    {
        return view('tasks.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'task_name'   => 'required|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:Pending,Completed',
            'due_date'    => 'nullable|date',
        ]);

        Task::create($request->only(['task_name', 'description', 'status', 'due_date']));

        return redirect()->route('tasks.index')->with('success', 'Task added successfully!');
    }

    public function show(Task $task)
    {
        return redirect()->route('tasks.index');
    }

  
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

  
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name'   => 'required|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:Pending,Completed',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($request->only(['task_name', 'description', 'status', 'due_date']));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    
    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'Pending' ? 'Completed' : 'Pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Status updated!');
    }
}