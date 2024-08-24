<?php

namespace App\Http\Controllers;

use App\Models\Editoriale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EditorialeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EditorialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $editoriales = Editoriale::paginate();

        return view('editoriale.index', compact('editoriales'))
            ->with('i', ($request->input('page', 1) - 1) * $editoriales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $editoriale = new Editoriale();

        return view('editoriale.create', compact('editoriale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EditorialeRequest $request): RedirectResponse
    {
        Editoriale::create($request->validated());

        return Redirect::route('editoriales.index')
            ->with('success', 'Editoriale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $editoriale = Editoriale::find($id);

        return view('editoriale.show', compact('editoriale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $editoriale = Editoriale::find($id);

        return view('editoriale.edit', compact('editoriale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditorialeRequest $request, Editoriale $editoriale): RedirectResponse
    {
        $editoriale->update($request->validated());

        return Redirect::route('editoriales.index')
            ->with('success', 'Editoriale updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Editoriale::find($id)->delete();

        return Redirect::route('editoriales.index')
            ->with('success', 'Editoriale deleted successfully');
    }
}
