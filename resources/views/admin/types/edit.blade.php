@extends('layouts.admin')

@section('content')
    <h1>Edit the selected type</h1>

    @include('partials.error-any')

    <form action="{{ route('admin.types.update', $type->slug) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="" aria-describedby="nameHelper" value="{{ old($type->name) }}">
            <small id="nameHelper" class="text-muted">Edit the name your of your type, max 100 characters, must be
                unique</small>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection
