@extends('layouts.master')

@section('content')

<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Témoignages des Personnels et les clients</h2>
        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Contenue</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th><th>
                    </th></tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                        <tr>
                            <th scope="row">
                                {{ $loop->index+1 }}
                            </th>
                            <td >
                                {{ $feedback->client->nom.' '.$feedback->client->prenom }}
                            </td>
                            <td>
                                {!! wordwrap($feedback['contenue'],70,"<br/>") !!}
                            </td>

                            @if ($feedback['statut']=="enattente")
                            <td>
                                <span class="badge badge-danger">En Attente</span>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{  route('feedbacks.show',$feedback)  }}">
                                    <i class="fa fa-cogs"></i>
                                        Gérer
                                </a>
                            </td>
                            @else
                            <td>
                                <span class="badge badge-success">déjà Publié</span>
                            </td>
                            <td>
                                <form    action="{{ route('retirer',$feedback) }}" method="post">
                                    @csrf
                                    @method('put')
                                        <button type="submit" class="btn btn-sm btn-info"  ><i class="fa fa-trash"></i> Retirer </button>
                                </form>
                            </td>
                            @endif
                            <td>
                                <form    action="{{ route('feedbacks.destroy',$feedback) }}" method="post">
                                    @csrf
                                    @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash"></i> Supprimer </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
