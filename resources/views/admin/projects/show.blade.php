@extends('layouts.admin')

@section('content')

    @if ($project->cover_image)
        <img width="140" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
    @else
        <div class="placeholder p-5 bg-secondary d-flex align-items-center justify-content-center" style="width:100px">
            Placeholder</div>
    @endif

    <!-- Show the project's title -->
    <h1 class="pt-2 pb-2 border-bottom">{{ $project->title }}</h1>

    <!-- Show the project's slug -->
    <h3 class="pb-2">{{ $project->slug }}</h3>

    <!-- Show the project's category -->
    <div class="category">
        <strong>Project type: </strong>
        {{ $project->type ? $project->type->name : 'Project type not selected' }}
    </div>

    <!-- Show the project's technology -->
    <div class="technologies">
        <strong>Technologies used: </strong>
        @if (count($project->technologies) > 0)
            @foreach ($project->technologies as $technology)
                <span>#{{ $technology->name }}</span>
            @endforeach
        @else
            <span>No technology associated to the current project</span>
        @endif
    </div>

    <!-- Show the project's body -->
    <div class="content mt-3">
        {{ $project->body }}
    </div>

@endsection
