@extends('layouts.master')
@section('container')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header"><span class="text-purple">Payer</span> pour {{ $reservation->voiture->nom }}  à louer</h2>
        <div class="card-body">
            <!--Form-->
            <form method="post" action="{{ route('paiements.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4 focused">
                        <input type="hidden"  readonly="" name="reservation_id" value="{{ $reservation['id'] }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        <label for="exampleInputEmail1">Voiture</label>
                        <input type="hidden"  readonly="" name="voiture_id" value="{{ $reservation->voiture->id }}" disabled="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <input type="text" required="" readonly="" value="{{ $reservation->voiture->nom }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Type de voiture</label>
                        <input type="text" required="" readonly="" name="car_type" value="{{ $reservation->voiture->categorie->nom }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Matricule</label>
                        <input type="text" required="" readonly="" name="car_regno" value="{{ $reservation->voiture->matricule }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-6 focused">
                        <label for="exampleInputEmail1">Client </label>
                        <input type="text" readonly="" value="{{ $reservation->client->nom }}" required="" name="c_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group col-md-6 focused">
                        <label for="exampleInputEmail1">Numéro de carte</label>
                        <input type="text" readonly="" value="{{ $reservation->client->num_carte }}" required="" name="c_natidno" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>


                </div>

                <div class="row">
                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Nombre de jours de location</label>
                        <input type="text" readonly="" name="b_duration" value="{{ $reservation['nbre_jrs'] }}" required="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Prix par jours</label>
                        <input type="text" readonly="" value="{{ $reservation->voiture->prix }} Fcfa" required="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group col-md-4 focused">
                        <label for="exampleInputEmail1">Prix total (FCFA)</label>
                        <input type="text" readonly="" name="total" value="{{ $reservation->voiture->prix*$reservation['nbre_jrs'] }}" required="" class="form-control text-orange" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="form-group col-md-6 focused">
                        <label for="exampleInputEmail1">Caution (Facultative)</label>
                        <input type="float"   name="caution" class="form-control" id="exampleInputEmail1" placeholder="100 000 fcfa" aria-describedby="emailHelp">
                        @error('caution')
                            <span class="invalid-feedback " role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 focused">
                        <label for="exampleInputEmail1">Methode de Paiment</label>
                        <select class="form-control" name="methode">

                            <option>Espece</option>
                            <option>Mobil Money</option>
                            <option>Dépot banquaire</option>

                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Reference de payement</label>
                        <small>Entrez le code de paiement à 10 chiffres si vous avez utilisé Airltel Money et le numero impaire  si vous avez utilisé un virement bancaire</small>
                        <input type="text" required="" name="reference" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        @error('reference')
                            <span class="invalid-feedback " role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>



                </div>
                <button type="submit" name="pay_hire" class="btn col-md-2 btn-outline-success">Payer</button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>

            </div>
@endsection
