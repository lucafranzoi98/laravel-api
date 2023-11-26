@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-3">
            {{ __('Dashboard') }}
        </h1>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->name }}{{ __(' Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="row row-cols-3 g-3">
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fa-solid fa-desktop"></i> Projects</h5>
                                            <h6 class="card-subtitle mb-2 text-muted ">Stats</h6>
                                            <p class="card-text">Total number: {{ $total_projects }}</p>
                                            <a class="text-decoration-none btn btn-primary"
                                                href="{{ route('admin.projects.index') }}">See all projects</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fa-solid fa-user"></i> Users</h5>
                                            <h6 class="card-subtitle mb-2 text-muted ">Stats</h6>
                                            <p class="card-text">Total number: {{ $total_users }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fa-solid fa-bars-progress"></i> Types</h5>
                                            <h6 class="card-subtitle mb-2 text-muted ">Stats</h6>
                                            <p class="card-text">Total number: {{ $total_types }}</p>
                                            <a class="text-decoration-none btn btn-primary"
                                                href="{{ route('admin.types.index') }}">See all types</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fa-solid fa-microchip"></i> Technologies</h5>
                                            <h6 class="card-subtitle mb-2 text-muted ">Stats</h6>
                                            <p class="card-text">Total number: {{ $total_technologies }}</p>
                                            <a class="text-decoration-none btn btn-primary"
                                                href="{{ route('admin.technologies.index') }}">See all technologies</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
