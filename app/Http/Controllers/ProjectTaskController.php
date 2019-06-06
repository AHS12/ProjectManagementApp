<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{
    //

    public function store(Project $project)
    {
        // Task::create([
        //     'project_id' => $project->id,
        //     'description' => request('description')
        // ]);

        $validatedTask = request()->validate(['description' => ['required', 'min:3']]);
        $project->addTask($validatedTask);

        return back();
    }

    // public function update(Task $task)
    // {
    //     // dd($task);
    //     /*
    //     easy way
    //     $task->update([
    //     'completed' => request()->has('completed')
    //     ]);

    //      */

    //     /*
    //     moderate way
    //     $task->complete(request()->has('completed'));
    //      */

    //     /*

    //     explained way

    //     if (request()->has('completed')) {
    //     $task->complete();
    //     }

    //     else $task->increment();

    //      */

    //     /*
    //     Setting method way

    //     $method = request()->has('completed') ? 'complete' : 'incomplete';
    //     $task->method();
    //      */

    //    // request()->has('completed') ? $task->complete() : $task->incomplete();
    //    // now i dont need it anymore lol


    //     //return back();
    // }

}
