@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">
            Liste de <span class="text-purple">Locations</span> de voitures
        </h2>
        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Voiture</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Jours</th>
                        <th scope="col">Date</th>
                        <th scope="col">Statut Retour</th>
                        <th scope="col">Action</th>
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
                                <td>
                                    {{ $reservation->voiture->matricule }}</a>
                                </td>
                                <th class="text-center">
                                    {{ $reservation['nbre_jrs'] }}
                                </th>

                                <td>
                                    {{ date('d-m-Y', strtotime($reservation['date'])) }}
                                </td>

                                <td>

                                    @if ($reservation['etat']=="active")
                                    <span class="badge badge-success">En cours</span>
                                    @else
                                    <span class="badge badge-danger">Terminé</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($reservation['etat']=="active")
                                    <form    action="{{ route('retouner',$reservation) }}" method="post">
                                        @csrf
                                        @method('put')
                                            <button type="submit" class="btn btn-sm btn-primary" > <i class="fas fa-clipboard-check">  </i> Retourner </button>
                                        </form>
                                    @else
                                    <form    action="{{ route('reservations.destroy',$reservation) }}" method="post">
                                        @csrf
                                        @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" > <i class="fa fa-times"></i> Suppr... </button>
                                    </form>

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
