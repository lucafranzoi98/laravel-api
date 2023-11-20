<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'result' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(9)
        ]);
    }

    public function latest()
    {
        return response()->json([
            'status' => 'Success',
            'result' => Project::with('type', 'technologies')->orderByDesc('id')->take(3)->get()
        ]);
    }

    public function show($slug)
    {
        return response()->json([
            'status' => 'Success',
            'result' => Project::where('slug', $slug)->first()
        ]);
    }
}
