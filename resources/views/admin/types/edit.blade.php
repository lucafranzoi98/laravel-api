@extends('layouts.admin')

@section('content')
    <h1 class="my-3">Edit type:{{ $type->name }}</h1>

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
            <form action="{{ route('admin.types.update', $type->slug) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        id="name" value="{{ $type->name }}" required maxlength="50">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <a href="{{ route('admin.types.index') }}" class="btn btn-danger">Don't save</a>
                <button type="submit" class="btn btn-primary">Save changes</button>

            </form>
        </div>
    </div>
@endsection
