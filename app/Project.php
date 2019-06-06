<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\ProjectCreated;
use Illuminate\Support\Facades\Mail;
use App\Events\ProjectWasCreated;

class Project extends Model
{
    //i like u laravel
    // protected $fillable = [
    //     'title','description'
    // ];

    //i know what i am doing :3
    protected $guarded = [];

     /* #region email eloquent model hook */

    // protected static function boot()
    // {
    //     parent::boot();


    //      /*------------- Send Email Eloquent Model hookes ------------------
    //      |this mail will be sent after the project is created
    //      |so the created event will fire after the creation of project
    //      *-------------------------------------------------------------------*/

    //     static::created(function ($project) {
    //         Mail::to($project->user->email)->send(new ProjectCreated($project));
    //     });
    // }
    /* #endregion */

    /* #region Auto fire custom event using eloquent */
    protected $dispatchesEvents = [
        'created' => ProjectWasCreated::class
    ];
    /* #endregion */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        /* #region Simple Way */
        // return Task::create([
        //     'project_id' => $this->id,
        //     'description' => $description,
        // ]);
        /* #endregion */
        $this->tasks()->create($task);
    }
}
