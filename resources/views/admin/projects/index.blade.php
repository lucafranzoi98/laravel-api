@extends('layouts.admin')

@section('content')
    <h1 class="my-3">All Projects</h1>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Message: </strong> {{ session('message') }}
        </div>
    @endif

    <div class="d-flex justify-content-between">
        <a class="btn btn-primary mb-3" href="{{ route('admin.projects.create') }}">Add Project</a>
        <div>
            <a class="btn btn-success mb-3" href="{{ route('admin.projects.index') }}">All projects</a>
            <a class="btn btn-danger mb-3" href="{{ route('admin.projects.trash') }}">Trash</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            @if ($project->image)
                                @if (str_contains($project->image, 'http'))
                                    <img width="100" src="{{ $project->image }}">
                                @else
                                    <img width="100" src="{{ asset('storage/' . $project->image) }}">
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.projects.show', $project->slug) }}"
                                    class="btn btn-sm btn-primary"><i class="fa-solid fa-magnifying-glass"></i></a>
                                <a href="{{ route('admin.projects.edit', $project->slug) }}"
                                    class="btn btn-sm btn-warning text-white mx-2"><i
                                        class="fa-solid fa-pen-to-square"></i></a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <div class="modal fade text-dark" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">Project id:
                                                    {{ $project->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                This is a destructive operation, do you want to delete this project?
                                                <div class="mt-2"><strong>Project title: {{ $project->title }}</strong>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.projects.destroy', $project->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                No projects
                @endforelse
            </tbody>
        </table>

        {{ $projects->links('pagination::bootstrap-5') }}
    </div>
@endsection
