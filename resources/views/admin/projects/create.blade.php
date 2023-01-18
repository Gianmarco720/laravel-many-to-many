@extends('layouts.admin')

@section('content')
    <h1>Create A New Project</h1>

    @include('partials.error-any')

    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Crete title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="My New Project" aria-describedby="titleHelper" value="{{ old('title') }}">
            <small id="titleHelper" class="text-muted">Add a title for your new project, max 100 characters, must be
                unique</small>
        </div>

        {{-- Insert a cover image --}}
        <div class="mb-3">
            <label for="cover_image" class="form-label">Add a cover image</label>
            <input type="file" name="cover_image" id="cover_image"
                class="form-control @error('cover_image') is-invalid @enderror" placeholder=""
                aria-describedby="coverImageHelper">
            <small id="coverImageHelper" class="text-muted">Add a cover image for your project</small>
        </div>

        {{-- Select the project's type --}}
        <div class="mb-3">
            <label for="" class="form-label">Choice the type of project</label>
            <select class="form-select @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
                <option selected>Select one</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach

            </select>
        </div>
        @include('partials.type-error')

        {{-- Select the project's technology --}}
        <div class="mb-3">
            <label for="" class="form-label">Technologies</label>
            <select multiple class="form-select form-select-sm" name="technologies[]" id="technologies">
                <option value="" disabled>Select a technology</option>
                @forelse ($technologies as $technology)
                    <option value="{{ $technology->id }}"
                        {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>{{ $technology->name }}
                    </option>
                @empty
                    <option value="">Sorry, no technologies available</option>
                @endforelse

                {{-- @forelse ($technologies as $technology)
                    @if ($errors->any())
                        <option value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                            {{ $technology->name }}</option>
                    @else
                        <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                    @endif

                @empty
                    <option value="">Sorry, no technologies available</option>
                @endforelse --}}
            </select>
        </div>

        {{-- Create the project's description --}}
        <div class="mb-3">
            <label for="body" class="form-label">Project Description</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="5"
                value="{{ old('body') }}"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
