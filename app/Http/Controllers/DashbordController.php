<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    //
    public function index()
    {

        $totalClients = Client::count();
        $totalProduits = Produit::count();
        $nbClientsMasculin = Client::where('sexe', 'Masculin')->count();
        $nbClientsFeminin = Client::where('sexe', 'Feminin')->count();

        return view('dashbord', [
            'totalClients' => $totalClients,
            'totalProduits' => $totalProduits,
            'nbClientsMasculin' => $nbClientsMasculin,
            'nbClientsFeminin' => $nbClientsFeminin,
        ]);
    }
}
