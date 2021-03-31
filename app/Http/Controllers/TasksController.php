<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::listItems();
        return view('list', compact('tasks'));
    }

    public function saveTask(Request $request)
    {
        $task_name = $request->input('task_name');
        $task = Task::saveTask($task_name);

        if (!is_null($task)) {
            return 'Task is saved! <a href="/">Go back to tasks list.</a>';
        }
        return 'Unable to save task <a href="/">Go back to tasks list</a>';
    }

    public function markComplete(Request $request)
    {
        dd($request->all());
    }

    public function markIncomplete(Request $request)
    {
        dd($request->all());
    }

}