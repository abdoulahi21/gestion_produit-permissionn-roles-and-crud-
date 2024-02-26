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
                        <a href="{{ route('client.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('client.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="nom" class="col-md-4 col-form-label text-md-end text-start">Nom</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}">
                                @if ($errors->has('nom'))
                                    <span class="text-danger">{{ $errors->first('nom') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="prenom" class="col-md-4 col-form-label text-md-end text-start">Prenom</label>
                            <div class="col-md-6">
                                <input class="form-control @error('prenom') is-invalid @enderror" id="" name="prenom" {{ old('prenom') }}>
                                @if ($errors->has('prenom'))
                                    <span class="text-danger">{{ $errors->first('prenom') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="adresse" class="col-md-4 col-form-label text-md-end text-start">Adresse</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="" name="adresse" {{ old('adresse') }}>
                                @if ($errors->has('adresse'))
                                    <span class="text-danger">{{ $errors->first('adresse') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="numeroTelephone" class="col-md-4 col-form-label text-md-end text-start">Phone</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control @error('numeroTelephone') is-invalid @enderror" id="" name="numeroTelephone" {{ old('numeroTelephone') }}>
                                @if ($errors->has('numeroTelephone'))
                                    <span class="text-danger">{{ $errors->first('numeroTelephone') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="sexe" class="col-md-4 col-form-label text-md-end text-start">Sexe</label>
                            <div class="col-md-6">
                                    <select name="sexe" id="" class="form-control">
                                        <option>Genre</option>
                                        <option>Masculin</option>
                                        <option>Feminin</option>
                                    </select>
                                @if ($errors->has('sexe'))
                                    <span class="text-danger">{{ $errors->first('sexe') }}</span>
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

