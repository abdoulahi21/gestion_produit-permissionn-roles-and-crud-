<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalClients = Client::count();
        $totalProduits = Produit::count();
        $nbClientsMasculin = Client::where('sexe', 'Masculin')->count();
        $nbClientsFeminin = Client::where('sexe', 'Feminin')->count();

        return view('home', [
            'totalClients' => $totalClients,
            'totalProduits' => $totalProduits,
            'nbClientsMasculin' => $nbClientsMasculin,
            'nbClientsFeminin' => $nbClientsFeminin,
        ]);

    }
}
