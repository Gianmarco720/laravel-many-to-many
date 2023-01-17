@extends('layouts.admin')

@section('content')
    <h1>Projects</h1>

    @include('partials.error-session')

    <a class="btn btn-primary m-3" href="{{ route('admin.projects.create') }}" role="button">New Project</a>
    <div class="table-responsive">
        <table class="table table-striped
    table-hover	
    table-borderless
    table-primary
    align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($projects as $project)
                    <tr class="table-primary">
                        <td scope="row">{{ $project->id }}</td>
                        <td>
                            @if ($project->cover_image)
                                <img width="50" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
                            @else
                                <div class="placeholder p-5 bg-secondary d-flex align-items-center justify-content-center"
                                    style="width:100px">Placeholder</div>
                            @endif
                        </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->slug }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.projects.show', $project->slug) }}"
                                role="button"><i class="fas fa-eye fa-sm fa-fw"></i></a>
                            <a class="btn btn-primary" href="{{ route('admin.projects.edit', $project->slug) }}"
                                role="button"><i class="fas fa-pencil fa-sm fa-fw"></i></a>

                            <!-- Modal trigger button -->
                            <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                data-bs-target="#deleteProject-{{ $project->slug }}">
                                <i class="fas fa-trash fa-sm fa-fw"></i>
                            </button>
                            @include('partials.projects-modal')
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No Projects Yet</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
@endsection
