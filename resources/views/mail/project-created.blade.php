@component('mail::message')

#New Project: {{$project->title}}

{{-- The body of your message. --}}
{{$project->description}}

@component('mail::button', ['url' => url('/projects/'.$project->id)])
View Your Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
