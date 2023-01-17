@extends('layouts.admin')

@section('content')
    <h1>Create a new type</h1>

    @include('partials.error-session')

    <form action="{{ route('admin.types.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="ex. Coding" aria-describedby="nameHelper" value="{{ old('name') }}">
            <small id="nameHelper" class="text-muted">Add a new project's type</small>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
