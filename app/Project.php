<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //i like u laravel
    // protected $fillable = [
    //     'title','description'
    // ];

    //i know what i am doing :3
    protected $guarded = [];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        // return Task::create([
        //     'project_id' => $this->id,
        //     'description' => $description,
        // ]);
        $this->tasks()->create($task);
    }
}
