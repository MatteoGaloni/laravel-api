<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with("type", "technologies")->paginate(4);
        // $types = Type::all();

        $response = [
            'success' => true,
            'results' => $projects,
            // 'types' => $types,
            'message' => 'Everything is going to be ok',
        ];
        return response()->json($response);
    }

    public function show($id)
    {
        $project = Project::with("type", "technologies")->find($id);

        $response = [
            'success' => true,
            'results' => $project,
            'message' => 'Everything is going to be ok',
        ];
        return response()->json($response);
    }
}
