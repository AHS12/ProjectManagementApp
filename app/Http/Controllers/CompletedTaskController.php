<?php

namespace App\Http\Controllers;

use App\Task;

class CompletedTaskController extends Controller
{
    //
    /*
    This controller just shows some flexibility in the code
    there is no need of this actually
    but yeah we can do this
    and yeah we have to use different route now
    now the methods are way more clean

     */
    public function store(Task $task)
    {
        $task->complete();
        return back();
    }
    public function destroy(Task $task)
    {
        $task->incomplete();
        return back();
    }
}
