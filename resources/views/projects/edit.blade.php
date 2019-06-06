@extends('layout')


@section('content')
<h2>The Edit Page</h2>

<div>
    <form action="/projects/{{$project->id}}" method="POST">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Project Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$project->title}}">
        </div>

        <div class="form-group">
            <label for="description">Project Description</label>
            <textarea class="form-control" id="description" name="description"
                rows="3">{{$project->description}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Update Project</button>
        </div>

        @include('errors')
    </form>

    <form action="/projects/{{$project->id}}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="form-group">
            <button class="btn btn-danger" type="submit">Delete Project</button>
        </div>


    </form>
</div>

@endsection
