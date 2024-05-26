<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Functions\Helper;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toSearch = isset($_GET['toSearch']) ? $_GET['toSearch'] : null;

        if ($toSearch) {
            $project = Project::where('title', 'LIKE', '%' . $toSearch . '%')->paginate(7);
        } else {
            $project = Project::orderBy('id', 'asc')->paginate(7);
        }

        $direction = 'asc';
        return view('admin.projects.index', compact('project', 'direction', 'toSearch'));
    }

    public function orderBy($direction, $column)
    {
        $toSearch = isset($_GET['toSearch']) ? $_GET['toSearch'] : null;

        $direction = $direction === 'desc' ? 'asc' : 'desc';

        if ($toSearch) {
            $project = Project::where('title', 'LIKE', '%' . $toSearch . '%')->orderBy($column, $direction)->paginate(7);
        } else {
            $project = Project::orderBy($column, $direction)->paginate(7);
        }

        return view('admin.projects.index', compact('project', 'direction', 'toSearch', 'column'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $route =  route('admin.project.store');
        $method = 'POST';
        $project = null;
        return view('admin.projects.create_edit', compact('route', 'method', 'project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valData = $request->validate(
            [
                'title' => 'required|min:5|max:100',
                'description' => 'required|min:10|max:1000',
                'github' => 'required|max:100',
                'type_id' => 'exists:types,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio.',
                'title.min' => 'Il titolo deve contenere almeno :min caratteri.',
                'title.max' => 'La descrizione non può superare i :max caratteri.',
                'description.min' => 'La descrizione deve contenere almeno :min caratteri.',
                'description.max' => 'La descrizione non può superare i :max caratteri.',
                'github.max' => 'La descrizione non può superare i :max caratteri.',
            ]
        );

        $new_project = new Project();
        $valData['slug'] = Helper::makeSlug($valData['title'], new Project());
        $new_project->fill($valData);
        $new_project->save();

        return redirect()->route('admin.project.index', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $route =  route('admin.project.update', $project);
        $method = 'PUT';
        return view('admin.projects.create_edit', compact('project', 'route', 'method', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $valData = $request->validate(
            [
                'title' => 'required|min:5|max:100',
                'description' => 'required|min:10|max:1000',
                'github' => 'required|max:100',
                'type_id' => 'exists:types,id',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio.',
                'title.min' => 'Il titolo deve contenere almeno :min caratteri.',
                'title.max' => 'La descrizione non può superare i :max caratteri.',
                'description.min' => 'La descrizione deve contenere almeno :min caratteri.',
                'description.max' => 'La descrizione non può superare i :max caratteri.',
                'github.max' => 'La descrizione non può superare i :max caratteri.',
            ]
        );
        if ($valData['title'] === $project->title) {
            $valData['slug'] = $project->slug;
        } else {
            $valData['slug'] = Helper::makeSlug($valData['title'], new Project());
        }
        $project->update($valData);
        return redirect()->route('admin.project.index')->with('success', 'Progetto aggiornato con successo.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.project.index')->with('deleted', 'Il progetto ' . $project->title . ' e stato eliminato');
    }
}
