<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        /*-------- fetching all -----
        | $projects = \App\Project::all();
         *-------------------------------------------------------------------*/
        /* #region api response */
        //for api response
        // //return $projects;
        // dump($projects);
        /* #endregion */

        /*-------- Without Eloquent -----
        | $projects = Project::where('user_id', auth()->id())->get();
         *-------------------------------------------------------------------*/

        $projects = auth()->user()->projects;

        return view('projects/index', compact('projects'));
    }

    public function show(Project $project)
    {
        /* #region old way */
        /*
        no need cuz of model view binding
        $project = Project::findOrFail($id);
         */
        /* #endregion */

        // with standered way
        // abort_unless(auth()->user()->owns($project), 403);

        //from now on this are the policy
        $this->authorize('view', $project);

        /* #region using Gate */
        //   if(\Gate::denies('view',$project)){
        //       abort(403);
        //   }

        //   abort_if(\Gate::denies('view',$project),403);

        /* #endregion */

        return view('/projects/show', compact('project'));
    }

    public function create()
    {

        return view('projects/create');
    }

    public function store()
    {
        /* #region Ways of creating a Project */
        // $project = new Project();

        // $project->title = request('title');
        // $project->description = request('description');

        // $project->save();

        // Project::create([
        //     'title' => request('title'),
        //     'description' => request('description')
        // ]);

        // Project::create(request(['title','description']));

        /* #endregion */

        /* #region Sending a mail directly from controller..but there are better ways */
        //  $project = Project::create($validatedProject);
        //  Mail::to($project->user->email)->send(new ProjectCreated($project));

        /* #endregion*/

        $validatedProject = $this->vaildateProject();
        $validatedProject['user_id'] = auth()->id();

        Project::create($validatedProject);

        /* #region firing Custom event from controller */
        //either we fire our custom event in here controller or use the eloquent model auto fire event :3
        // $project = Project::create($validatedProject);
        // event(new ProjectWasCreated($project));

        /* #endregion */

        //Sending a flash msg via session
        flashMsg('Your Project Has Been Created!!');
        return redirect('/projects');
    }

    public function edit(Project $project) //example.com/projects/1/edit

    {
        /* #region old system */
        /*----------------- Dont need since we are using route model binding -----
        | $project = Project::findOrFail($id);
         *-------------------------------------------------------------------*/
        /* #endregion */

        //authorize user
        $this->authorize('view', $project);
        return view('projects/edit', compact('project'));
    }

    public function update(Project $project)
    {
        /* #region Old way */
        /*--------------------Other way of update ---------------------------
        |$project = Project::findOrFail($id);
        |$project->title = request('title');
        |$project->description = request('description');
        |$project->save();
         *-------------------------------------------------------------------*/
        /* #endregion */

        //authorize user
        $this->authorize('view', $project);

        /* #region update */
        /*--------------------update without validatProject function ---------------------------
        |$validatedProject = request()->validate([
        |  'title' => ['required', 'min:3', 'max:255'],
        |  'description' => ['required', 'min:3'],
        | ]);
        | $project->update($validatedProject);
         *-------------------------------------------------------------------*/
        /* #endregion */

        $project->update($this->vaildateProject());

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        /* #region Old way */
        /*--------------------Other way of destroy ---------------------------
        |$project = Project::findOrFail($id)->delete();
         *-------------------------------------------------------------------*/
        /* #endregion */

        $project->delete();
        return redirect('/projects');
    }

    protected function vaildateProject()
    {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
        ]);
    }

    /* #region Should use Autoload helper */
    //we should use them in helper file
    // protected function flashMsg($msg){
    //    return session()->flash('message', $msg);
    // }
    /* #endregion */
}
