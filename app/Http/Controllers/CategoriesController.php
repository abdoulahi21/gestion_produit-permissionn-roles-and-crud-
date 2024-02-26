<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Produit;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-categories|delete-categories', ['only' => ['index','show']]);
        $this->middleware('permission:create-categories', ['only' => ['create','store']]);
        $this->middleware('permission:edit-clients', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-categories', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('categorie.index', [
            'categorie' => Categories::latest()->paginate(3),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        //
        Categories::create($request->all());
        return redirect()->route('categorie.index')
            ->withSuccess('New categorie is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, Categories $categories)
    {
        //
        $categories->update($request->all());
        return redirect()->route('categorie.index')
            ->withSuccess('categori is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        //
        $categories->delete();
        return redirect()->route('categorie.index')
            ->withSuccess('categori is deleted successfully.');
    }
}
