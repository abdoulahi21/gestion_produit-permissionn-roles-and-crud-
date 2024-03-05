<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeRequest;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\ProduitCommande;
use Illuminate\Http\Request;

class CommandesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-commandes|delete-commandes|edit-commandes', ['only' => ['index','show']]);
        $this->middleware('permission:create-commandes', ['only' => ['create','store']]);
        $this->middleware('permission:edit-commandes', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-commandes', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $clients=Client::all();
         $produits=Produit::all();
         $commandes = Commande::latest()->paginate(3);
        return view('commande.index',[
         'commandes' => $commandes,
            'clients'=>$clients,
         'produits'=>$produits,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $clients=Client::all();
        $produits=Produit::all();
        return view('commande.create',['clients'=>$clients,
                 'produits'=>$produits,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(CommandeRequest $request)
    {
        Commande::create($request->all());
        // Créer une nouvelle commande
        $commande = Commande::create([
            'clients_id' => $request->clients_id,
            'date' => $request->date,
        ]);

       /*$commande->produits()->attach($request->input('produits_id'),
           ['quantite'=>$request->input('quantite')]);
       */
       // Attacher les produits à la commande avec leurs quantités
       foreach ($request->produits as $key => $produitId) {
            $commande->produits()->attach($produitId, ['quantite' => $request->input('quantite')[ $key]]);

            // Mettre à jour la quantité du produit
            $produit = Produit::find($produitId);
            $produit->quantite -= $request->input('quantite')[ $key];
            $produit->save();
        }

        return redirect()->route('commande.index')->with('success', 'Commande enregistrée avec succès');
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
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $commme=Commande::find($id);
        $commme->delete();
        return to_route('commande.index')->with('success','Commande suprimmée avec succès');
    }
}
