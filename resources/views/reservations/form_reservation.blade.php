@extends('layouts.master')
@section('container')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Louer  {{ $voiture['nom'] }}</h2>
        <div class="card-body">
            <!--Form-->
            <form method="post" action="{{ route('reservations.store') }}" enctype="multipart/form-data">
               @csrf
                <div class="row">
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Voiture</label>
                        <input type="text" required="" readonly=""  value="{{ $voiture['nom'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Type de voiture</label>
                        <input type="text" required="" readonly=""  value="{{ $voiture->categorie->nom }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Matricule</label>
                        <input type="text" required="" readonly="" value="{{ $voiture['matricule'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group col-md-6 focused" style="display:none">
                        <label for="exampleInputEmail1">ID</label>
                        <input type="text" required="" name="voiture_id" value="{{ $voiture['id'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Location Max(Maximum 7 Jours)</label>
                        <select class="form-control" name="nbre_jrs">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Prix Journalière</label>
                        <input type="text" required="" readonly="" name="prix" value="{{ $voiture['prix'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    @if (Auth::user()->type=="client")
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Client </label>
                        <input type="hidden" value="{{ Auth::user()->id }}"  name="client_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <input type="text" value="{{ Auth::user()->nom }}" readonly=""   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    @else
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Employer </label>
                        <input type="hidden" value="{{ Auth::user()->id }}"  name="employe_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <input type="text" value="{{ Auth::user()->nom }}" readonly=""  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    @endif

                </div>

                @if (Auth::user()->type!="client")
                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <div class="payment-method">
                                <div class="input-radio">
                                    <input type="radio" name="client" value="ancien"  value="{{ old('niveau_service') }}" id="payment-1">
                                    <label for="payment-1">
                                        <span></span>
                                        Choisir un client
                                    </label>
                                    <div class="caption">
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="client_id" value="{{ old('client_id') }}" id="exampleFormControlSelect1">
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client['id'] }}">{{ $client['nom'].' '.$client['prenom'] }}</option>
                                                @endforeach
                                            </select><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="input-radio">
                                    <input type="radio"  name="client"  value="nouveau"  id="payment-2">
                                    <label for="payment-2">
                                        <span></span>
                                        Renseignez un nouveau client
                                    </label>
                                    <div class="caption">
                                        <div class="form-group col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-6 focused">
                                                    <label for="exampleInputEmail1">Nom </label>
                                                    <input type="text"  name="nom" value="{{ old('nom') }}"  placeholder=" << NADOH >> " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                    @error('nom')
                                                        <span class="invalid-feedback " role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6 focused">
                                                    <label for="exampleInputEmail1">Adresse E-mail</label>
                                                    <input type="email"  name="email"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="adresse@google.fr">
                                                    @error('email')
                                                        <span class="invalid-feedback " role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-4 focused">
                                                    <label for="exampleInputEmail1">Adresse de résidence</label>
                                                    <input type="text" name="adresse"  placeholder="Paris, << 2e Avenue >>" value="{{ old('adresse') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                    @error('adresse')
                                                        <span class="invalid-feedback " role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-4 focused">
                                                    <label for="exampleInputEmail1">Téléphone</label>
                                                    <input type="text" name="telephone" placeholder="+228 91 66 40 40" value="{{ old('telephone') }}"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                    @error('telephone')
                                                        <span class="invalid-feedback " role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-4 focused">
                                                    <label for="exampleInputEmail1">Numéro de la carte d'identité</label>
                                                    <input type="text"  name="num_carte" value="{{ old('num_carte') }}"  placeholder="1234567890" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                    @error('num_carte')
                                                        <span class="invalid-feedback " role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <button type="submit"  class="btn btn-outline-success">Reservez cette voiture</button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>
</div>
@endsection
