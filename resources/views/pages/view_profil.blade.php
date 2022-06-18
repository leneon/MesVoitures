@extends('layouts.master')
@section('content')

    <div class="container-fluid d-flex align-items-center">
        <div class="row">
        <div class="col-lg-12 col-md-10">
            <h3 class="display-2 text-white">Hello {{ $user['nom'] }} {{ $user['prenom'] }}</h3>
        </div>
        </div>

    </div>
@endsection

@section('container')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                    <a href="#">
                        <img src="{{ Storage::url($user['photo'] ) }}" class="circle">
                    </a>
                    </div>
                </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

                </div>
                <div class="card-body pt-0 pt-md-4">

                <div class="text-center">
                    <div class="h5 mt-4">
                        <i class="fa fa-user mr-2" ></i>  {{ $user['nom'].' '.$user['prenom'] }}
                    </div>

                    <div class="h5 mt-4 ">
                        <i class="fa fa-envelope mr-2" ></i> {{ $user['email'] }}                            </div>

                    <div class="h5 mt-4">
                        <i class="fa fa-phone mr-2"></i> {{ $user['telephone'] }}                            </div>

                    <div class="h5 mt-4">
                        <i class="fa fa-map-marker mr-2"></i> {{ $user['adresse'] }}                            </div>

                    <div class="h5 mt-4">
                        <i class="fa fa-address-card mr-2"></i> {{ $user['num_carte'] }}                            </div>
                    </div>
                    <hr class="my-4">
                    <p></p>
                    <hr class="my-4">
                    <!--Client Hired Cars-->
                    <div class="card shadow">
                        <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                            <h3 class="mb-0">{{ $user['nom'] }} Rapport de location</h3>
                            </div>

                        </div>
                        </div>
                        <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Voiture</th>
                                <th scope="col">Matricule.</th>
                                <th scope="col">Nbre de jours</th>
                                <th scope="col">Date</th>
                                <th scope="col">Statut</th>
                                <th scope="col">état</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->reservations as $reservation)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->index+1 }}
                                    </th>
                                    <td>
                                        <a href="{{ route('voitures.show',$reservation->voiture->id) }}">{{ $reservation->voiture->nom }}</a>
                                    </td>
                                    <td>
                                        {{ $reservation->voiture->matricule }}
                                    </td>

                                    <td>
                                        {{ $reservation['nbre_jrs'] }}</a>
                                    </td>

                                    <td>
                                        {{ date('d-m-Y', strtotime($reservation['date'])) }}
                                    </td>

                                    <td>
                                        @if ($reservation['statut']=="Accepter")
                                        <span class="badge badge-success">Approuvée</span>
                                        @else
                                        <span class="badge badge-danger">En Attente</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($reservation['etat']=="active")
                                        <span class="badge badge-success">Active</span>
                                        @else
                                        <span class="badge badge-danger">Inctive</span>
                                        @endif

                                    </td>

                                    <td>
                                        @if (Auth::user()->type!="client")
                                        <a href="admin_disaprove_bookings.php?car_id=6&amp;b_id=22" class="badge badge-warning">
                                            <i class="fas fa-times"></i> <i class="fa fa-car"></i>
                                                Annuller
                                        </a>

                                        <a href="admin_approve_bookings.php?delete_booking=22" class="badge badge-danger">
                                            <i class="fas fa-trash"></i> <i class="fa fa-car"></i>
                                                Supprimer
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                <!-- Footer -->
@endsection
