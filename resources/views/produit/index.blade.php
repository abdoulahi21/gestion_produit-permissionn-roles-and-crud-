@extends('layouts.app')

@section('content')
    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary">
        <div class="card-header">Product List</div>
        <div class="card-body">
            @can('create-produit')
                <a href="{{ route('produit.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Product</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantite</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($produit as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                        @if($product->photo)
                            <img src="{{ asset('storage/images/'.$product->photo) }}" style="height: 50px;width:50px;">
                        @else
                            <span>No image found!</span>
                        @endif
                        </td>
                        <td>{{ $product->nom}}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->prix}}</td>
                        <td>{{ $product->quantite}}</td>
                        <td>
                            <form action="{{ route('produit.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('produit.show', $product->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                @can('edit-produit')
                                    <a href="{{ route('produit.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                @endcan

                                @can('delete-produit')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this product?');"><i class="bi bi-trash"></i> Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Product Found!</strong>
                        </span>
                    </td>
                @endforelse
                </tbody>
            </table>

            {{ $produit->links() }}

        </div>
    </div>
@endsection
