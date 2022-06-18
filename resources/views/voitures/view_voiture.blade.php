@extends('layouts.master')

@section('content')

    <div class="container-fluid d-flex align-items-center">
        <div class="row">
        <div class="col-lg-12 col-md-10">
            <h3 class="display-2 text-white">{{$voiture['nom']}}</h3>
        </div>
        </div>

    </div>
@endsection

@section('container')
<div class="row">
    <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="card-profile-image">
                    <a href="#">
                        <img src="{{ Storage::url($voiture['photo_int']) }}" class="circle">
                    </a>
                    </div>
                </div>

                <div class="col-lg-6 order-lg-2">
                    <div class="card-profile-image">
                    <a href="#">
                        <img src="{{ Storage::url($voiture['photo_avt']) }}" class="circle">
                    </a>
                    </div>
                </div>

                <div class="col-lg-6 order-lg-2">
                    <div class="card-profile-image">
                    <a href="#">
                        <img src="{{ Storage::url($voiture['photo_arr']) }}" class="circle">
                    </a>
                    </div>
                </div>
            </div>

                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                </div>

                <div class="card-body pt-0 pt-md-4">

                    <div class="text-center">

                        <hr>
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                    <h3 class="mb-0 text-orange">{{ $voiture['nom'] }}</h3>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Voiture</th>
                                        <th scope="col">Matricule.</th>
                                        <th scope="col">Type de voiture</th>
                                        <th scope="col">Prix par jour</th>
                                        <th scope="col">Statut</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                {{ $voiture['nom'] }}
                                            </td>
                                            <td>
                                                {{ $voiture['matricule'] }}
                                            </td>
                                            <td>
                                                {{ $voiture->categorie->nom }}
                                            </td>
                                            <td>
                                            {{ $voiture['prix'] }} FCFA
                                            </td>
                                            @if ($voiture['disponibilite']=="Disponible")
                                            <td>
                                                <span class="badge badge-success">Disponible</span>
                                            </td>
                                            @else
                                            <td>
                                                <span class="badge badge-danger">Louer</span>
                                            </td>
                                            @endif

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        <br>
                    <div class="card">
                        <div class="card-header">
                            {{ $voiture['nom'] }} Voir aussi
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                {!! $voiture['description'] !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
