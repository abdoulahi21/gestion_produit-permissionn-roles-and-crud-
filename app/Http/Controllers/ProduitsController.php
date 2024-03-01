<?php

namespace App\Http\Controllers;

use App\Exports\ProduitsExport;
use App\Http\Requests\ProduitRequest;
use App\Imports\ProduitssImport;
use App\Models\Categories;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProduitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-produit|edit-produit|delete-produit', ['only' => ['index','show']]);
        $this->middleware('permission:create-produit', ['only' => ['create','store']]);
        $this->middleware('permission:edit-produit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-produit', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('produit.index', [
            'produit' => Produit::latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie=Categories::all();
        return view('produit.create',[ 'categorie'=>$categorie]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProduitRequest $request)
    {
        $fileName = time() . '.' . $request->photo->extension();
        $request->photo->storeAs('public/images', $fileName);

        /*$produit = new Produit();
        $produit->nom = $request->input('nom');
        $produit->description = trim($request->input('description'));
        $produit->prix = bcrypt($request->input('prix'));
        $produit->quantite = bcrypt($request->input('quantite'));
        $produit->photo = $fileName;
        $produit->categories_id=bcrypt($request->input('categories_id'));
        $produit->save();
  */
        Produit::create([
            'nom' => $request->input('nom'),
            'description' => trim($request->input('description')),
            'prix' => $request->input('prix'),
            'quantite' => $request->input('quantite'),
            'photo' => $fileName,
            'categories_id'=>$request->input('categories_id')
        ]);
        return redirect()->route('produit.index')
            ->withSuccess('New product is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return view('produit.show', [
            'produit' => $produit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('products.edit', [
            'produit' => $produit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProduitRequest $request, Produit $produit)
    {
        $produit->update($request->all());
        $imageName = '';
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/images', $imageName);
            if ($produit->photo) {
                Storage::delete('public/images/' . $produit->phoyo);
            }
        } else {
            $imageName = $produit->photo;
        }
        $produit->photo=$imageName;
        return redirect()->route('produit.index')
            ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produit.index')
            ->withSuccess('Product is deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new ProduitsExport(), 'produits.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new ProduitssImport(),request()->file('file'));

        return back();
    }
}
