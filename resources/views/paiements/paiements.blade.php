@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">
            Les  <span class="text-purple">Paiements</span> s'éffectuer sur une <span class="text-green">reservation</span> déja approuvé
        </h2>
        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Voiture</th>
                        <th scope="col">Jours</th>
                        <th scope="col">Client </th>
                        <th scope="col">Date</th>
                        <th scope="col">Statut </th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr>
                                <th scope="row">
                                    {{ $loop->index+1 }}
                                </th>
                                <td>
                                    <a href="{{ route('voitures.show',$reservation->voiture->id) }}">{{ $reservation->voiture->nom }}</a>
                                </td>
                                <th class="text-center">
                                    {{ $reservation['nbre_jrs'] }}
                                </th>

                                <td>
                                    @if (Auth::user()->type!="client")
                                    <a href="{{ route('mon_profil',$reservation->client->id) }}">{{ $reservation->client->nom }}</a>
                                    @else
                                    {{ $reservation->client->nom.' '.$reservation->client->prenom }}</a>
                                    @endif
                                </td>

                                <td>
                                    {{ date('d-m-Y', strtotime($reservation['date'])) }}
                                </td>

                                <td>

                                    @if ($reservation['numero']!=null)
                                    <span class="badge badge-success">Location Payé</span>
                                    @else
                                    <span class="badge badge-danger">En Attente</span>
                                    @endif
                                </td>

                                <td >
                                    @if ($reservation['numero']!=null)
                                    <a href="#"  class="badge badge-info"><i class="fas fa-money-check-alt"></i> Déja Payé</a>
                                    @else
                                    <a href="{{ route('paiements.paiement',$reservation) }}"  class="badge badge-success">+<i class="fas fa-money-check-alt"></i> Ajouter un payement</a>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">{{ $reservations->links() }}</div><br><br>
    </div>
</div>
@endsection
