@extends('layouts.admin')

@section('content')
    <h1 class="my-3">Edit project number: {{ $project->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" value="{{ $project->title }}" required maxlength="50">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3 d-flex">
                    <div class="me-3">
                        <div class="mb-2">Actual image:</div>
                        @if ($project->image)
                            @if (str_contains($project->image, 'http'))
                                <img width="200" src="{{ $project->image }}">
                            @else
                                <img width="200" src="{{ asset('storage/' . $project->image) }}">
                            @endif
                        @else
                            N/A
                        @endif

                    </div>
                    <div>
                        <label for="image" class="form-label">Choose file</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="3">{{ $project->description }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Type --}}
                <div class="mb-3">
                    <label for="type_id" class="form-label">Type</label>
                    <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                        <option selected disabled>Select one</option>
                        @forelse ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>{{ $type->name }}
                            </option>
                        @empty
                            No types avaiable
                        @endforelse
                        @error('type_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </select>
                </div>

                {{-- Technologies --}}
                <div class="form-label">Technologies</div>
                <div class="btn-group mb-3" role="group" id="technologies">
                    @forelse ($technologies as $technology)
                        <input type="checkbox" class="btn-check" id="check-{{ $technology->id }}" name='technologies[]'
                            value="{{ $technology->id }}" autocomplete="off" {{$project->technologies->contains($technology->id) ? 'checked' : ''}}>
                        <label class="btn btn-outline-dark"
                            for="check-{{ $technology->id }}">{{ $technology->name }}</label>
                    @empty
                        No technologies avaiable
                    @endforelse
                    @error('technology')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Code Link --}}
                <div class="mb-3">
                    <label for="code_link" class="form-label">Code link</label>
                    <input type="text" class="form-control @error('code_link') is-invalid @enderror" name="code_link"
                        id="code_link" value="{{ $project->code_link }}">
                    @error('code_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Preview Link --}}
                <div class="mb-3">
                    <label for="preview_link" class="form-label">Preview link</label>
                    <input type="text" class="form-control @error('preview_link') is-invalid @enderror"
                        name="preview_link" id="preview_link" value="{{ $project->preview_link }}">
                    @error('preview_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">Don't save</a>
                <button type="submit" class="btn btn-primary">Save changes</button>

            </form>
        </div>
    </div>
@endsection
