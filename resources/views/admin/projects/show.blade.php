@extends('layouts.admin')

@section('content')
    <h1 class="my-3">{{ $project->title }}</h1>

    <div class="card" style="width: 40%">
        @if ($project->image)
            @if (str_contains($project->image, 'http'))
                <img class="card-img-top" src="{{ $project->image }}">
            @else
                <img class="card-img-top" src="{{ asset('storage/' . $project->image) }}">
            @endif
        @else
            <div class="m-3">N/A</div>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $project->title }}</h5>
            <h6 class="card-subtitle text-muted mb-2">
                @if ($project->type)
                    {{$project->type->name}}
                @else
                    
                @endif</h6>
            <p class="card-text">{{ $project->description }}</p>
            <div>
                <span>Code link: </span>
                <a href="{{ $project->code_link }}" target="_blank" class="card-link">{{ $project->code_link }}</a>
            </div>
            <div>
                <span>Preview link: </span>
                <a href="{{ $project->preview_link }}" target="_blank" class="card-link">{{ $project->preview_link }}</a>
            </div>
            <ul class="list-unstyled d-flex gap-1 mt-3">
                @forelse ($project->technologies as $technology)
                    <li class="badge bg-dark">{{ $technology->name }}</li>
                @empty
                    No tags
                @endforelse
            </ul>

        </div>
    </div>



    <div class="my-3">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Return to all projects</a>
        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning text-white">Edit</a>

        <!-- Modal trigger button -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $project->id }}">
            Delete
        </button>

        <!-- Modal Body -->
        <div class="modal fade text-dark" id="modalId-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">Project id:
                            {{ $project->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This is a destructive operation, do you want to delete this project?
                        <div class="mt-2"><strong>Project title: {{ $project->title }}</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
