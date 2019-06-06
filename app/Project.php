<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\ProjectCreated;
use Illuminate\Support\Facades\Mail;

class Project extends Model
{
    //i like u laravel
    // protected $fillable = [
    //     'title','description'
    // ];

    //i know what i am doing :3
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        /* #region email */
         /*------------------------------------------------- Send Email Model hookes -----
         |this mail will be sent after the project is created
         |so the event will fire after the creation of project
         *-------------------------------------------------------------------*/
        /* #endregion */
        static::created(function ($project) {
            Mail::to($project->user->email)->send(new ProjectCreated($project));
        });
    }

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
