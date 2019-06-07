@extends('layouts.master')

@section('content')

<h2>Create a Project</h2>

<div>

    <form id="createProject" action="/projects" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Project Title</label>
            <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : '' }}" id="title"
                name="title" placeholder="Project title" value="{{old('title')}}">
        </div>

        <div class="form-group">
            <label for="description">Project Description</label>
            <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : '' }}" id="description"
                name="description" rows="3" placeholder="Project Discription">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success" type="submit">Create Project</button>
        </div>
        @include('errors')

    </form>
</div>

@endsection
