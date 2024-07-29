<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Intern; // Assuming interns are assigned tasks
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Assuming interns are authenticated users

class TaskController extends Controller
{
    public function index()
    {
        $intern = Auth::user()->intern; // Assuming Intern is your user model
        $tasks = Task::where('intern_id', $intern->id)->get();
        return view('tasks.index', compact('intern', 'tasks'));
    }

    public function create()
    {
        $interns = Intern::all(); // For assigning tasks to specific interns
        return view('tasks.create', compact('interns'));
    }

    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->intern_id = $request->intern_id; // Assign to specific intern
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit($taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return abort(404);
        }
        $interns = Intern::all(); // For re-assigning tasks
        return view('tasks.edit', compact('task', 'interns'));
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return abort(404);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->intern_id = $request->intern_id; // Update assigned intern
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function markComplete($taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return abort(404);
        }

        $task->completed = true;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task marked as complete!');
    }

    public function assignedTasks()
    {
        $intern = Auth::user()->intern; // Assuming Intern is your user model
        $tasks = Task::where('intern_id', $intern->id)->where('completed', false)->get();
        return view('tasks.assigned', compact('intern', 'tasks'));
    }

    public function completedTasks()
    {
        $intern = Auth::user()->intern; // Assuming Intern is your user model
        $tasks = Task::where('intern_id', $intern->id)->where('completed', true)->get();
        return view('tasks.completed', compact('intern', 'tasks'));
    }

    public function approachingDeadlineTasks()
    {
        $intern = Auth::user()->intern; // Assuming Intern is your user model
        $tasks = Task::where('intern_id', $intern->id)
                    ->where('due_date', '<', now()->addDays(7))
                    ->where('completed', false)
                    ->get();
        return view('tasks.approaching-deadline', compact('intern', 'tasks'));
    }

    public function destroy($taskId)
    {
        $task = Task::find($taskId);
        if (!$task) {
            return abort(404);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
