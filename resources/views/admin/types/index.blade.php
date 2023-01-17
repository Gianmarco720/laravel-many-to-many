@extends('layouts.admin')

@section('content')
    <h1>Types</h1>

    @include('partials.error-session')

    <a class="btn btn-primary m-3" href="{{ route('admin.types.create') }}" role="button">New Type</a>
    <div class="table-responsive">
        <table
            class="table table-striped
                    table-hover	
                    table-borderless
                    table-primary
                    align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($types as $type)
                    <tr class="table-primary">
                        <td scope="row">{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.types.show', $type->slug) }}" role="button"><i
                                    class="fas fa-eye fa-sm fa-fw"></i></a>
                            <a class="btn btn-primary" href="{{ route('admin.types.edit', $type->slug) }}" role="button"><i
                                    class="fas fa-pencil fa-sm fa-fw"></i></a>

                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                data-bs-target="#deleteType-{{ $type->slug }}">
                                <i class="fas fa-trash fa-sm fa-fw"></i>
                            </button>
                            @include('partials.types-modal')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
