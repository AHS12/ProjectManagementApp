@extends('layout')


@section('content')
<div>
    <h3><a class="btn btn-success" href="/projects/create">New Project</a></h3>
</div>


@if (session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <p>{{session('message')}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<b>Projects</b>
<table class="table table-sm table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Details</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>

        <ul>
            <tr>
                @foreach ($projects as $project)
                <th>
                    <div><a href="/projects/{{$project->id}}">{{$project->title}}</a>
                </th>
                <td><a class="btn btn-info" href="/projects/{{$project->id}}">More</a></td>
                <td><a class="btn btn-success" href="/projects/{{$project->id}}/edit">Edit</a></td>
                <td>
                    <form action="/projects/{{$project->id}}" method="POST">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </div>
                    </form>
                </td>
                </div>
            </tr>
            @endforeach
        </ul>

    </tbody>
</table>

@endsection
