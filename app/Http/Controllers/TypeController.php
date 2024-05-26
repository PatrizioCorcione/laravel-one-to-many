<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Functions\Helper;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valData = $request->validate(
            [
                'type' => 'required|min:2|max:20|unique:types',
            ],
            [
                'type.required' => 'Il tipo è obbligatorio.',
                'type.min' => 'Il nome deve contenere almeno :min caratteri.',
                'type.max' => 'Il nome non può superare i :max caratteri.',
                'type.unique' => 'Il nome non può essere gia presente.',
            ]
        );

        $new_type = new Type();
        $new_type->type = $valData['type'];
        $new_type->slug = Helper::makeSlug($valData['type'], new Type());
        $new_type->save();

        return redirect()->route('admin.technologies.index', $new_type);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $valData = $request->validate(
            [
                'type' => 'required|min:2|max:20',
            ],
            [
                'type.required' => 'Il nome è obbligatorio.',
                'type.min' => 'Il nome deve contenere almeno :min caratteri.',
                'type.max' => 'Il nome non può superare i :max caratteri.',
            ]
        );

        if ($valData['type'] === $type->technologies) {
            $valData['slug'] = $type->slug;
        } else {
            $valData['slug'] = Helper::makeSlug($valData['type'], new Type());
        }

        $type->update($valData);


        return redirect()->route('admin.technologies.index')->with('success', 'Tipo aggiornata con successo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.technologies.index')->with('deleted', 'Il tipologia ' . $type->type . ' e stato eliminata');
    }
}
