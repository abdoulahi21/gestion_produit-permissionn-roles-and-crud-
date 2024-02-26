<@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Add New Categorie
                    </div>
                    <div class="float-end">
                        <a href="{{ route('categorie.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('categorie.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="libelle" class="col-md-4 col-form-label text-md-end text-start">Libelle</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror" id="libelle" name="libelle" value="{{ old('libelle') }}">
                                @if ($errors->has('libelle'))
                                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
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

