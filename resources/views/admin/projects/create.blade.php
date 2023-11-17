@extends('layouts.admin')

@section('content')
    <h1 class="my-3">Create new project</h1>

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
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" aria-describedby="helpId" placeholder="Type the project title (max: 50 characters)"
                        required maxlength="50">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="image" id="image">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                        rows="3" placeholder="Type the project description"></textarea>
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
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                        <input type="checkbox" class="btn-check" id="check-{{ $technology->id }}" name='technologies[]' value="{{ $technology->id }}" autocomplete="off">
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
                        id="code_link" placeholder="Type the link to the code">
                    @error('code_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Preview Link --}}
                <div class="mb-3">
                    <label for="preview_link" class="form-label">Preview link</label>
                    <input type="text" class="form-control @error('preview_link') is-invalid @enderror"
                        name="preview_link" id="preview_link" placeholder="Type the link to the preview">
                    @error('preview_link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
