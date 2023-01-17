<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        //dd($projects);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        // pass the types to the view
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        //dd($request->all());

        // validate data
        $val_data = $request->validated();

        // save the input cover_image
        //$cover_image = Storage::put('uploads', $val_data['cover_image']);

        // replace the value of cover_image inside $val_data
        //$val_data['cover_image'] = $cover_image;

        // check if the request has a cover_image field
        if ($request->hasFile('cover_image')) {
            $cover_image = Storage::put('uploads', $val_data['cover_image']);
            $val_data['cover_image'] = $cover_image;
        }

        // generate project slug
        $project_slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $project_slug;

        // create project
        $project = Project::create($val_data);

        // redirect
        return to_route('admin.projects.index')->with('message', "Project id: $project->id Added Successfully");
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
        return view('admin.projects.edit', compact('project', 'types'));
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
        // validate the data
        $val_data = $request->validated();

        // update the slug
        $project_slug = Project::generateSlug($val_data['title']);
        $val_data['slug'] = $project_slug;

        // check if the request has a cover_image field
        if ($request->hasFile('cover_image')) {

            // check if the current post has an image, if yes, delete it.
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $cover_image = Storage::put('uploads', $val_data['cover_image']);
            $val_data['cover_image'] = $cover_image;
        }

        // update the resource
        $project->update($val_data);

        // redirect to index page
        return to_route('admin.projects.index')->with('message', "Project id: $project->id Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project Deleted Successfully');

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
    }
}
