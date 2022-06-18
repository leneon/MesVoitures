@extends('layouts.master')
@section('container')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Modifier les détailles de  🏎 <b class="text-purple">{{ $voiture['nom'] }}</b></h2>
        <div class="card-body">
            <!--Form-->
            <form method="post" action="{{ route('voitures.update',$voiture) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Voiture</label>
                        <input value="{{ $voiture['nom'] ?? old('nom') }}"  placeholder="Entrer le nom de la voiture" type="text" required="" name="nom" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Matricule</label>
                        <input value="{{ $voiture['matricule'] ?? old('matricule') }}" placeholder="Le matricule de la voiture" type="text" required="" name="matricule" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('matricule')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Prix de location par jour</label>
                        <input value="{{ $voiture['prix']?? old('prix') }}" placeholder="Prix de location/jour en Fcfa" type="text" required="" name="prix" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('prix')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="form-group col-md-6 focused">
                        <label for="exampleInputEmail1">Type de voiture</label>
                        <select class="form-control" name="categorie_id" onchange="getCarCategoryId(this.value);" id="car_type">
                            <option value="{{ $voiture->categorie->id ?? old('categorie_id') }}">{{ ($voiture->categorie->nom ?? old('categorie_id')) ?? "Selectionnez une catégorie de voiture" }}</option>
                            @foreach ($categories as $categorie )
                                <option value="{{$categorie['id'] }}">{{ $voiture->categorie->nom ?? $categorie['nom'] }}</option>
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
                        <label for="exampleInputEmail1">Photo extérieure</label>
                        <input type="file"  name="photo_ext" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Photo intérieur </label>
                        <input type="file"  name="photo_int" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Photo avant</label>
                        <input type="file"  name="photo_avt" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Photo arrière</label>
                        <input type="file"  name="photo_arr" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Descriptions plus détaillé de la voiture</label>
                        <textarea type="text" required name="description"  class="form-control" id="car_features" aria-describedby="emailHelp">{{ $voiture['description'] ?? old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <button type="submit"  class="btn btn-outline-success">Appliquer les modifications  </button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>
</div>
@endsection
