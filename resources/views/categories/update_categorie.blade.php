@extends('layouts.master')
@section('content')
<div class="row">
    <div class="card col-md-8 offset-2">
        <h3 class="card-header">
            Modifier <strong class="text-blue">{{ $categorie['nom'] }}</strong>
        </h3>
        <div class="card-body ">
            <!--Form-->
            <form method="post" action="{{ route('categories.update',$categorie) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row ">
                    <div class="form-group col-md-12">
                        <label for="nom">Nom</label>
                        <input type="text" required name="nom" class="form-control" value="{{ $categorie['nom'] ?? old('nom') }}" id="nom" aria-describedby="emailHelp" placeholder="Entrer le nom de la catégorie de voiture">
                        @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="description">Description</label>
                        <textarea type="text" required name="description" class="form-control" id="descrption" aria-describedby="emailHelp" placeholder="Entrer une description">{{ $categorie['description'] ?? old('description') }}
                        </textarea>
                        @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                </div>

                <button type="submit"  class="offset-4 btn btn-outline-success">Modifier cette catégorie</button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>
</div>
@endsection
