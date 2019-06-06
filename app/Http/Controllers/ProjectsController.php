<?php

namespace App\Http\Controllers;

use App\Mail\ProjectCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        // $projects = \App\Project::all();
        //for api response
        // //return $projects;
        // dump($projects);
        //$projects = Project::where('user_id', auth()->id())->get();
        $projects = auth()->user()->projects;

        return view('projects/index', compact('projects'));
    }

    public function show(Project $project)
    {
        /*
        no need cuz of model view binding
        $project = Project::findOrFail($id);
         */
        // abort_unless(auth()->user()->owns($project), 403);

        //from now on this are the policy
        $this->authorize('view', $project);

        //   if(\Gate::denies('view',$project)){
        //       abort(403);
        //   }

        //   abort_if(\Gate::denies('view',$project),403);

        return view('/projects/show', compact('project'));
    }

    public function create()
    {

        return view('projects/create');
    }

    public function store()
    {

        // $project = new Project();

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();

        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);

        $validatedProject = $this->vaildateProject();

        $validatedProject['user_id'] = auth()->id();

        // Project::create(request(['title','description']));
        $project = Project::create($validatedProject);
        \Mail::to("ahslucky12@gmail.com")->send(new ProjectCreated($project));

        return redirect('/projects');

        //return request()->all();
    }

    public function edit(Project $project) //example.com/projects/1/edit

    {
        // $project = Project::findOrFail($id);

        //authorize user
        $this->authorize('view', $project);
        return view('projects/edit', compact('project'));
    }

    public function update(Project $project)
    {
        // $project = Project::findOrFail($id);
        // $project->title = request('title');
        // $project->description = request('description');
        // $project->save();

        //authorize user
        $this->authorize('view', $project);

        // $validatedProject = request()->validate([
        //     'title' => ['required', 'min:3', 'max:255'],
        //     'description' => ['required', 'min:3'],
        // ]);
        // $project->update($validatedProject);

        $project->update($this->vaildateProject());

        return redirect('/projects');
        // dd(request()->all());
    }

    public function destroy(Project $project)
    {
        //dd('Hello i am called');
        // $project = Project::findOrFail($id)->delete();
        $project->delete();
        return redirect('/projects');
    }

    protected function vaildateProject() {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
        ]);
    }
}
