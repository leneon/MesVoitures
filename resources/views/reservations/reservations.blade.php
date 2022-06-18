@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">
            Liste de <span class="text-purple">Réservations</span> de voitures
            <a href="{{ route('new_reservation') }}" class="float-right col-md-3 btn btn-sm btn-info"><h4 class="">Effectuer une réservation</h4></a><br><br>
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
                        <th scope="col">Statut &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Etat</th>
                        <th scope="col">Actions</th> <th></th>
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
                                    <a href="{{ route('mon_profil',$reservation->client->id) }}">{{ $reservation->client->nom }}</a>
                                </td>

                                <td>
                                    {{ date('d-m-Y', strtotime($reservation['date'])) }}
                                </td>

                                <td>
                                    @if ($reservation['statut']=="Accepter")
                                    <span class="badge badge-success">Approuvée</span>
                                    @elseif($reservation['statut']=="Rejeter")
                                    <span class="badge badge-danger">&nbsp;&nbsp;&nbsp;Rejéter &nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    @else
                                    <span class="badge badge-warning">En attente</span>
                                    @endif

                                    @if ($reservation['etat']=="active")
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>

                                <td >

                                    @if (($reservation['statut']=="enattente")&&(Auth::user()->type!="client"))
                                    <form    action="{{ route('reservations.approuver',$reservation) }}" method="post">
                                        @csrf
                                        @method('put')
                                            <button type="submit" class="btn btn-sm btn-success" > <i class="fa fa-check">  </i> Appr... </button>
                                    </form>
                                    @else
                                    <a href="{{ route('reservations.edit',$reservation) }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Editer</a>

                                    @endif

                                    @if (Auth::user()->type!="client")

                                    <td>
                                        @if ($reservation['statut']=="Rejeter" || $reservation['etat']=="inactive")
                                        <form    action="{{ route('reservations.destroy',$reservation) }}" method="post">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger" > <i class="fa fa-times"></i> Suppr... </button>
                                        </form>
                                        @else
                                        <form    action="{{ route('reservations.annuler',$reservation) }}" method="post">
                                            @csrf
                                            @method('put')
                                                <button type="submit" class="btn btn-sm btn-warning" > <i class="fa fa-times">  </i> Annuler </button>
                                        </form>


                                        @endif

                                    </td>
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
