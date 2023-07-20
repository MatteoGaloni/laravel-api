<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**d
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $technologies = Technology::all();
        // puoi aggiungere un metodo per visualizzare in ordine cronologico
        return view("admin.projects.index", compact("projects", 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // passa la nuova tabella  con compact()
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.create", compact("types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('img')) {
            $data['img'] = Storage::put('uploads', $request->file('img'));
        }
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();

        if (array_key_exists('technologies', $data)) {
            $newProject->technologies()->sync($data['technologies']);
        } else {
            $newProject->technologies()->detach();
        }
        return to_route("admin.projects.show", $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        if ($project->img != "placeholders/placeholder.png") {
            Storage::delete($project->img);
        }

        $data = $request->validated();
        if ($request->hasFile('img')) {
            $data['img'] = Storage::put('uploads', $request->file('img'));
        }
        $project->fill($data);

        $project->update();
        if (array_key_exists('technologies', $data)) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return to_route("admin.projects.show", compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->delete();
        return to_route("admin.projects.index");
    }
}
