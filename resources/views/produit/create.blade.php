@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Add New Product
                    </div>
                    <div class="float-end">
                        <a href="{{ route('produit.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('produit.store') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="mb-3 row">
                            <label for="nom" class="col-md-4 col-form-label text-md-end text-start">Photo</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" value="{{ old('photo') }}">
                                @if ($errors->has('photo'))
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nom" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}">
                                @if ($errors->has('nom'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Prix</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('description') is-invalid @enderror" id="prix" name="prix">{{ old('prix') }}</input>
                                @if ($errors->has('prix'))
                                    <span class="text-danger">{{ $errors->first('prix') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="description" class="col-md-4 col-form-label text-md-end text-start">Quantite</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('quantite') is-invalid @enderror" id="" name="quantite">{{ old('quantite') }}</input>
                                @if ($errors->has('quantite'))
                                    <span class="text-danger">{{ $errors->first('quantite') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="categories_id" class="col-md-4 col-form-label text-md-end text-start">Categorie</label>
                            <div class="col-md-6">
                                <select type="number" class="form-control @error('categories_id') is-invalid @enderror" id="" name="categories_id">{{ old('categories_id') }}
                                  @foreach($categorie as $ct)
                                      <option value="{{$ct->id}}">{{$ct->libelle}}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('categories_id'))
                                    <span class="text-danger">{{ $errors->first('categories_id') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Product">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
