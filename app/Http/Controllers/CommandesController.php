<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandeRequest;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\ProduitCommande;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public function store(Request $request)
    {
        $request->validate([
            'clients_id' => 'required|exists:clients,id',
            'date' => 'required',
            'products' => 'required|array',
            'products.*.nom' => 'required|exists:produits,id',
            'products.*.quantite' => 'required|integer|min:1',
        ]);

        $commande = new Commande();
        $commande->clients_id = $request->clients_id;
        $commande->date = $request->date;
        $commande->save();

        foreach ($request->products as $product) {
            $commande->produits()->attach($product['nom'], ['quantite' => $product['quantite']]);
        }

        return redirect()->route('commande.index')->with('success', 'Commande ajoutée avec succès.');
    }
    public function downloadPDF(string $id)
    {
        $commande= Commande::find($id);

        $pdf = PDF::loadView('commande.viewPdf', array('commande' =>  $commande))
            ->setPaper('a4', 'portrait');

        return $pdf->download('commandes-details.pdf');
    }
    public function viewPDF(string $id)
    {
        $commande = Commande::find($id);

        $pdf = PDF::loadView('commande.viewPdf', array('commande' =>  $commande))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();

    }



    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
        return view('commande.viewPdf', [
            'commande' => $commande
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $produits=Produit::all();
        $clients=Client::all();
        $commande=Commande::find($id);
        return view('commande.edit', [
            'commande' => $commande,
            'clients'=>$clients,
            'produits'=>$produits
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommandeRequest $request, $id)
    {
        // Récupérer la commande à modifier
        $commande = Commande::findOrFail($id);

        // Mettre à jour les données de la commande
        $commande->client_id = $request->input('client_id');
        $commande->date = $request->input('date');
        $commande->save();

        // Mettre à jour les quantités des produits dans la commande
        foreach ($request->input('quantites') as $produitId => $quantite) {
            $commande->produits()->updateExistingPivot($produitId, ['quantite' => $quantite]);
        }

        return redirect()->route('commande.index')->with('success', 'La commande a été modifiée avec');
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
