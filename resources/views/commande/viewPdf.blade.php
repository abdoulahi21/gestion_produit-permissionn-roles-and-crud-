@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Commande #{{ $commande->id }}</h1>
        <p><strong>Client:</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}</p>
        <p><strong>Telephone:</strong>{{ $commande->client->numeroTelephone }} </p>
        <p><strong>Adresse:</strong> {{$commande->client->adresse}}</p>
        <p><strong>Date:</strong> {{ $commande->date }}</p>
        <table class="table">
            <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($commande->produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->prix }}</td>
                    <td>{{ $produit->pivot->quantite }}</td>
                    <td>{{ $produit->prix * $produit->pivot->quantite }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                <td>{{ $commande->calculerMontantTotal() }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <button id="printButton" class="btn btn-primary" onclick="printCommande()" >Imprimer</button>
    <style>
        .hidden {
            display: none;
        }
    </style>

    <script>
        function printCommande() {
            // Cacher le bouton imprimer
            document.getElementById('printButton').classList.add('hidden');
            // Lancer l'impression
            window.print();
            // Réafficher le bouton après l'impression (facultatif)
            document.getElementById('printButton').classList.remove('hidden');
        }
    </script>
@endsection

