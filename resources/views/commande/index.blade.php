@extends('layouts.app')

@section('content')
    @can('create-commandes')
        <a href="{{ route('commande.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Ajouter une commande</a>
    @endcan

    <h1>Facture de commande</h1>
    <br>
    @foreach($commandes as $commande)
        <div>
           <strong>Id Commande:</strong> {{ $commande->id }}<br>
            <strong>Nom Prenom:</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}<br>
            <strong>Adresse:</strong> {{ $commande->client->adresse }}<br>
            <strong>Téléphone:</strong> {{ $commande->client->numeroTelephone }}<br>
            <strong>Date de commande:</strong> {{ $commande->date }}<br>
        </div>
        <br>
        <table>
            <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commande->produits as $produit)
                <tr>
                    <td >{{ $produit->nom }}</td>
                    <td>{{ $produit->prix }}</td>
                    <td>{{ $produit->produits_commandes->quantite }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <form action="{{ route('commande.destroy', $commande->id) }}" method="post">
            @csrf
            @method('delete')
            @can('delete-commandes')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer cette commande ?');"><i class="bi bi-trash"></i> Supprimer</button>
            @endcan
        </form>
        <hr>
    @endforeach

    {{ $commandes->links() }}

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
@endsection
