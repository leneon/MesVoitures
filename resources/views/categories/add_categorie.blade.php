@extends('layouts.master')
@section('content')
<div class="row">
    <div class="card col-md-8 offset-2">
        <h3 class="card-header">
            Nouvelle Catégorie
        </h3>
        <div class="card-body ">
            <!--Form-->
            <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row ">
                    <div class="form-group col-md-12">
                        <label for="nom">Nom</label>
                        <input type="text" required="" name="nom" class="form-control" id="nom" aria-describedby="emailHelp" placeholder="Entrer le nom de la catégorie de voiture">
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
                        <textarea type="text" required name="description" class="form-control" id="descrption" aria-describedby="emailHelp" placeholder="Entrer une description"></textarea>
                        @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                </div>

                <button type="submit"  class="offset-3 col-md-6 btn btn-outline-success">Ajouter</button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>
</div>
@endsection
