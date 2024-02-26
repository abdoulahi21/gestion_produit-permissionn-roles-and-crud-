@extends('layouts.app')

@section('content')
    @can('create-commandes')
        <a href="{{ route('commande.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Commande</a>
    @endcan

    <h1>Facture de commande</h1>
    @foreach($commande as $cm)


    <div>
        <strong>Nom Prenom:</strong>{{$commande->clients->nom}} {{$commande->clients->prenom}}<br>
        <strong>Adresse:</strong>{{$commande->clients->adresse}}<br>
        <strong>Téléphone:</strong>{{$commande->clients->numeroTelephone}}<br>
        <strong>Date de commande:</strong>{{$commande->date}}<br>
    </div>
    <br>
    <table>
        <thead>
        <tr>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$commande->produits->nom}}</td>
            <td>{{$commande->produits->prix}}Fcfa</td>
            <td>x{{$commande->produits->quantite}}</td>
            <td>20 €</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
            <td><strong>35 €</strong></td>
        </tr>
        </tbody>
    </table>
    @endforeach
@endsection
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
