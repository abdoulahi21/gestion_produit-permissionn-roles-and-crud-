@extends('layouts.app')

@section('content')
    <div class="card shadow-lg p-3 mb-5 bg-body-tertiary">
        <div class="card-header">Clients List</div>
        <div class="card-body">
            @can('create-clients')
                <a href="{{ route('client.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Product</a>
            @endcan
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($clients as $client)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $client->nom }}</td>
                        <td>{{ $client->prenom }}</td>
                        <td>{{ $client->adresse}}</td>
                        <td>{{ $client->numeroTelephone}}</td>
                        <td>{{ $client->sexe}}</td>
                        <td>
                            <form action="{{ route('client.destroy', $client->id) }}" method="post">
                                @csrf
                                @method('DELETE')


                                @can('edit-clients')
                                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                @endcan

                                @can('delete-clients')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this clients?');"><i class="bi bi-trash"></i> Delete</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No Clients Found!</strong>
                        </span>
                    </td>
                @endforelse
                </tbody>
            </table>

            {{ $clients->links() }}

        </div>
    </div>
@endsection

