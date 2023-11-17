<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('image')) {
            $path = Storage::put('projects_images', $request->image);
            $val_data['image'] = $path;
        }

        $project = Project::create($val_data);
        $project->technologies()->sync($request->technologies);
        return to_route('admin.projects.index')->with('message', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $technologies = Technology::all();
        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        if ($request->has('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $newImage = $request->image;
            $path = Storage::put('projects_images', $newImage);
            $val_data['image'] = $path;
        }

        if (!Str::is($project->getOriginal('title'), $request->title)) {
            $val_data['slug'] = $project->generateSlug($request->title);
        }

        $project->update($val_data);
        $project->technologies()->sync($request->technologies);
        return to_route('admin.projects.index')->with('message', 'Project edit successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if (!is_null($project->image)) {
            Storage::delete($project->image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully!');
    }

    public function trash(Project $project)
    {
        $projects = Project::onlyTrashed()->orderByDesc('id')->paginate('10');
        return view('admin.projects.trash', compact('projects'));
    }

    public function restore($slug)
    {
        Project::withTrashed()->where('slug', $slug)->restore();
        return to_route('admin.projects.trash')->with('message', 'Project restored successfully');
    }

    public function forceDelete($slug)
    {
        $collection = Project::withTrashed()->where('slug', $slug)->get();
        $project = $collection[0];
        
        if ($project->technologies) {
            $project->technologies()->detach();
        }
        
        $project->forceDelete();
        return to_route('admin.projects.trash')->with('message', 'Project deleted successfully');
    }
}
