@extends('layout')

@section('content')

<div class="card">
    <h5 class="card-header">Project Details</h5>
    <div class="card-body">
        <h5 class="card-title">{{$project->title}}</h5>
        <p class="card-text">{{$project->description}}</p>
    </div>
</div>
<br>

@if ($project->tasks->count())
<div class="card">
    <h5 class="card-header">Included Task List</h5>
    <div class="card-body">

        <div>
            <h4><i></i></h4>
            @foreach ($project->tasks as $task)
            <div>
                <form action="/completed-tasks/{{$task->id}}" method="post">
                    @if ($task->completed)
                    @method('DELETE')
                    @endif
                    {{-- @method('PATCH') --}}
                    {{ csrf_field() }}
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="completed" name="completed"
                            onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                        <label class="form-check-label card-text {{$task->completed ? 'is-completed' : ''}}"
                            for="completed"> {{$task->description}}</label>
                    </div>
                </form>
            </div>
            @endforeach

        </div>

    </div>
</div>
@endif
<br>

<div class="card">
    <h5 class="card-header">Create New Task</h5>
    <div class="card-body">
        <form action="/projects/{{$project->id}}/tasks" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="description">Task Description</label>
                <input type="text" class="form-control" id="description" name="description">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Create Task</button>
            </div>

            @include('errors')
        </form>
    </div>
</div>

<br>

<div>
    <a class="btn btn-primary" href="/projects/{{$project->id}}/edit">Edit Project</a>
</div>
<br>
<div>

    <form action="/projects/{{$project->id}}" method="POST">
        @method('DELETE')
        {{ csrf_field() }}
        <div class="form-group">
            <button class="btn btn-danger" type="submit">Delete Project</button>
        </div>
    </form>
</div>


@endsection
