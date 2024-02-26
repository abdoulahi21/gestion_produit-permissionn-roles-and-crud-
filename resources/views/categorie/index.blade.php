@extends('layouts.app')

@section('content')
    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary">
        <div class="card-header">Categorie List</div>
        <div class="card-body">
            @can('create-categories')
                <a href="{{ route('categorie.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Product</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">s#</th>
                    <th scope="col">Libelle</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($categorie as $categories)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $categories->libelle }}</td>
                        <td>
                            <form action="{{ route('categorie.destroy', $categories->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                @can('delete-categories')
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

            {{ $categorie->links() }}

        </div>
    </div>
@endsection

