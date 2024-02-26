@extends('layouts.app')

@section('content')


    <div class="row justify-content-center ">
        <div class="col-md-8">

            <div class="card shadow-lg p-3 mb-5 bg-body-tertiary">
                <div class="card-header">
                    <div class="float-start">
                        Commande
                    </div>
                    <div class="float-end">
                        <a href="{{ route('commande.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('commande.store')}}" method="post" id="order-form">
                       @csrf
                        <!-- Conteneur pour les détails des produits -->
                        <div id="product-details">
                            <div class="mb-3 row">
                                <label for="categories_id" class="col-md-4 col-form-label text-md-end text-start">Full Name</label>
                                <div class="col-md-3">
                                    <select type="number" class="form-control @error('') is-invalid @enderror" id="" name="">
                                        <option>choose...</option>
                                      @foreach($clients as $client)
                                          <option value="{{$client->id}}">{{$client->nom}} {{$client->prenom}}</option>
                                      @endforeach
                                    </select>
                                    @if ($errors->has('full name'))
                                        <span class="text-danger">{{ $errors->first('full name') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                   <input type="date" name="date" class="form-control @error('photo') is-invalid @enderror">
                                    @if ($errors->has('date'))
                                        <span class="text-danger">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Champs pour le premier produit -->
                            <div class="product">
                                <select type="text" class="@error('') is-invalid @enderror" >
                                    <option>Nom Produit</option>
                                    @foreach($produits as $p )
                                        <option value="{{$p->id}}">{{$p->nom}}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="products[0][quantite]" placeholder="Quantité">

                                <!-- Autres champs pour les détails du produit -->
                                <button type="button" class="remove-product btn btn-danger"><i class="bi bi-trash"></i> </button>
                                <br>
                            </div>
                        </div>

                        <button type="button" id="add-product" class="btn btn-warning">Ajouter un produit</button>

                        <!-- Bouton de soumission du formulaire -->
                        <button type="submit" class="btn btn-success">Passer la commande</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            // Créer un nouveau champ de produit et l'ajouter au formulaire
            var productContainer = document.getElementById('product-details');
            var productIndex = productContainer.querySelectorAll('.product').length;

            var newProduct = document.createElement('div');
            newProduct.classList.add('product');
            newProduct.innerHTML = `
            <input type="text" name="products[${productIndex}][nom]" placeholder="Nom du produit">
            <input type="number" name="products[${productIndex}][quantite]" placeholder="Quantité">
            <!-- Autres champs pour les détails du produit -->
            <button type="button" class="remove-product btn btn-danger"><i class="bi bi-trash"></i></button>
        `;

            productContainer.appendChild(newProduct);
        });

        // Gérer la suppression d'un champ de produit
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-product')) {
                event.target.closest('.product').remove();
            }
        });
    </script>
@endsection
