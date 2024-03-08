@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la commande #{{ $commande->id }}</h1>
        <form action="{{ route('commande.update', $commande->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="client_id">Client :</label>
                <select name="client_id" id="client_id" class="form-control">
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}" {{ $commande->client_id == $client->id ? 'selected' : '' }}>{{ $client->nom }} {{ $client->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $commande->date }}">
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($commande->produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->prix }}</td>
                        <td><input type="number" name="quantites[{{ $produit->id }}]" value="{{ $produit->pivot->quantite }}"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
@endsection

