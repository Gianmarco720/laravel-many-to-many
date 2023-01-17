@extends('layouts.admin')

@section('content')
    <h1>Create A New Project</h1>

    @include('partials.error-any')

    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="My New Project" aria-describedby="titleHelper" value="{{ old('title') }}">
            <small id="titleHelper" class="text-muted">Add a title for your new project, max 100 characters, must be
                unique</small>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Add a cover image</label>
            <input type="file" name="cover_image" id="cover_image"
                class="form-control @error('cover_image') is-invalid @enderror" placeholder=""
                aria-describedby="coverImageHelper">
            <small id="coverImageHelper" class="text-muted">Add a cover image for your project</small>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Choice the type of project</label>
            <select class="form-select @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
                <option selected>Select one</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach

            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror

        <div class="mb-3">
            <label for="body" class="form-label">Project Description</label>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="5"
                value="{{ old('body') }}"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
