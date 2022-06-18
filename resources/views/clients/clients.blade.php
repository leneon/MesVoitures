@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Comptes client</h2>
        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Numéro de carte</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Vile</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Action</th><th>
                    </th></tr>
                    </thead>
                    <tbody>

                      @foreach ($clients as $client)
                      <tr>
                        <th scope="row">
                            {{ $loop->index+1 }}
                        </th>
                        <td>
                            {{ $client['nom'] }}
                         </td>
                        <td>
                            {{ $client['num_carte'] }}
                        </td>

                        <td>
                            {{ $client['telephone'] }}
                        </td>

                        <td>
                            {{ $client['email'] }}
                        </td>
                        <td>
                            {{ $client['ville'] }}
                        </td>
                        <td>
                            {{ $client['adresse'] }}
                        </td>
                        <td>
                            <form    action="{{ route('user.destroy',$client) }}" method="post">
                            @csrf
                            @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" > <i class="fa fa-trash"></i> Supprimer </button>
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


