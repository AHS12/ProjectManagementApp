<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {

        return view('welcome')->with([

            'tasks' => [
                'task1',
                'task2',
                'task 3',
            ],
            'foo' => request('title'),

        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
