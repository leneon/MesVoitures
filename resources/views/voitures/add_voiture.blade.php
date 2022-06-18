@extends('layouts.master')
@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Ajouter nouvelle 🏎 Voiture</h2>
        <div class="card-body">
            <!--Form-->
            <form method="post" action="{{ route('voitures.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Voiture</label>
                        <input value="{{ old('nom') }}"  placeholder="Entrer le nom de la voiture" type="text" required="" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Matricule</label>
                        <input value="{{ old('matricule') }}" placeholder="Le matricule de la voiture" type="text" required="" name="matricule" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('matricule')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Prix de location par jour</label>
                        <input value="{{ old('prix') }}" placeholder="Prix de location/jour en Fcfa" type="text" required="" name="prix" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('prix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-6 focused">
                        <label for="exampleInputEmail1">Type de voiture</label>
                        <select class="form-control" name="categorie_id" onchange="getCarCategoryId(this.value);" id="car_type">
                            <option value="{{ old('categorie_id') }}">{{ old('categorie_id') ?? "Selectionnez une catégorie de voiture" }}</option>
                            @foreach ($categories as $categorie )
                                <option value="{{ $categorie['id'] }}">{{ $categorie['nom'] }}</option>
                            @endforeach
                            @error('categorie_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Phot extérieure</label>
                        <input type="file" required="" name="photo_ext" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Photo intérieur </label>
                        <input type="file" required="" name="photo_int" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Photo avant</label>
                        <input type="file" required="" name="photo_avt" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Photo arrière</label>
                        <input type="file" required="" name="photo_arr" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Descriptions plus détaillée de la voiture</label>
                        <textarea type="text" required name="description" rows="1"  class="form-control" id="car_features" aria-describedby="emailHelp"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit"  class="btn btn-outline-success">  Ajouter  </button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>
</div>
@endsection
