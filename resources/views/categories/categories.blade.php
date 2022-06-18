@extends('layouts.master')

@section('content')
<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">Liste de <strong class="text-purple">catégories</strong>
            <a href="{{ route('categories.create') }}" class="float-right col-md-3 btn btn-sm btn-info"><h4 class="">Ajouter une Nouvelle Catégorie</h4></a><br><br>
        </h2>
        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                      @foreach ($categories as $categorie)
                      <tr>
                        <th scope="row">
                            {{ $loop->index+1 }}
                        </th>
                        <td>
                            {{ $categorie['nom'] }}
                         </td>
                         <td>
                            {!! wordwrap($categorie['description'],70,"<br/>") !!}
                         </td>

                        <td>
                            <a href="{{ route('categories.edit',$categorie) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i> Modifier</a>
                            <form    action="{{ route('categories.destroy',$categorie) }}" method="post">
                                @csrf
                                @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger"  ><i class="fa fa-trash"></i> Supprimer </button>
                            </form>
                        </td>

                        </tr>
                      @endforeach

                     </tbody>
                </table>

            </div><br>
            <div class="text-center">{{ $categories->links() }}</div>
        </div>
    </div>
</div>
@endsection
