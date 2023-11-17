<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index (){
        return response()->json([
            'status' => 'Success',
            'result' => Project::with('type', 'technologies')->orderByDesc('id')->paginate(9)
        ]);
    }
}
