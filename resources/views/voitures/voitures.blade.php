@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Liste de <strong class="text-purple">Voitures</strong>
            @if (Auth::user()->type!="client")
        <a href="{{ route('voitures.create') }}" class=" col-md-3 btn btn-sm btn-info float-right "><h4 class="">Ajouter une Nouvelle Voiture</h4></a><br><br>

            @endif
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
                        <th >
                            {{ $loop->index+1 }}
                        </th>
                        <td>
                            {!! wordwrap($voiture['nom'],30,"<br/>") !!}
                         </td>
                         <td>
                             {{ $voiture['matricule'] }}
                        </td>
                        <td>
                            {!! wordwrap($voiture->categorie->nom,30,"<br/>") ?? "Moderne" !!}
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
                            <a href="{{ route('voitures.show',$voiture) }}" class="btn btn-sm btn-success float-left"> <i class="fa fa-eye"></i> Voir </a>
                            @if (Auth::user()->type!="client")
                            <a href="{{ route('voitures.edit',$voiture) }}" class="btn btn-sm btn-primary float-left"> <i class="fa fa-edit"></i> Modifier</a>
                            <form    action="{{ route('voitures.destroy',$voiture) }}" method="post">
                                @csrf
                                @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" > <i class="fa fa-trash"></i> Spprimer </button>
                                </form>
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
