@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Liste de <strong class="text-purple">Voitures</strong>
        </h2>
        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Disponibilité</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach ($voitures as $voiture)
                      <tr>
                        <th scope="row">
                            {{ $loop->index+1 }}
                        </th>
                        <td>
                            {{ $voiture['nom'] }}
                         </td>
                         <td>
                             {{ $voiture['matricule'] }}
                        </td>
                        <td>
                            {{ $voiture->categorie->nom ?? "Moderne" }}
                        </td>
                        @if ($voiture['disponibilite']=="Disponible")
                        <td >
                            <b class="badge badge-success">{{ $voiture['disponibilite'] }}</b>
                        </td>
                        @else
                        <td >
                            <b class="badge badge-danger">{{ $voiture['disponibilite'] }}</b>
                        </td>
                        @endif


                            <td>
                                <a href="{{ route('voitures.show',$voiture) }}" class="badge badge-warning">&nbsp;Voir&nbsp;</a>
                            </td>
                            <td>
                                @if ($voiture['disponibilite']=="Louer")
                            <a href="#" class="btn btn-sm btn-warning float-left">Déja Reserver</a>
                            @else
                            <a href="{{ route('form_reservation',$voiture) }}" class="badge badge-primary">Reserver cette voiture</a>
                            @endif
                            </td>


                        </tr>
                      @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <div class="text-center">{{ $voitures->links() }}</div>
        <br>
    </div>
</div>
@endsection
