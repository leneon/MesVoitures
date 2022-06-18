@extends('layouts.master')

@section('content')
<div class="row">
            <!-- Billing Details -->
            <div class="billing-details offset-1">
                <div class="input-checkbox">
                        <form action="{{ route('add_user') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                            <input type="checkbox" id="create-account">&nbsp;&nbsp;&nbsp;&nbsp;
                            <label class="btn btn-primary" for="create-account">
                                <span></span>
                                Ajouter un user
                            </label>
                                @if(Auth::user()->droit=="x")
                                <div class="caption text-white">
                                    <p>Le nouveau Utilisateur doit se connecter avec son <b>E-mail</b> et un mot de passe <b>123456789</b> par defaut</p>
                                    <input required class="input form-control col-md-7" type="email" name="email" placeholder="Entrer un adresse mail valid">
                                    <br><button type="submit" class="btn btn-success">Ajouter</button>

                                </div>
                                @else
                                <div class="caption">
                                    <p>Vous n'avez pas le droit de créer un nouveau user!</p>

                                </div>
                                @endif
                            </div>
                        </form>
                </div>

            </div>
            <!-- /Billing Details -->
    <div class="card col-md-12">
        <h2 class="card-header">Comptes user</h2>



        <div class="card-body">
            <div class="table-responsive">
            <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th><th>
                    </th></tr>
                    </thead>
                    <tbody>

                      @foreach ($users as $user)
                      <tr>
                        <th scope="row">
                            {{ $loop->index+1 }}
                        </th>
                        <td>
                            {{ $user['nom'] }}
                        </td>

                        <td>
                            {{ $user['email'] }}
                        </td>


                            <td><form    action="{{ route('retirer',$user) }}" method="post">
                                @csrf
                                @method('put')
                                    <button type="submit" class="btn btn-sm btn-primary" > <i class="fa fa-trash"></i> Retirer </button>
                                </form>
                            </td>
                            <td><form    action="{{ route('user.destroy',$user) }}" method="post">
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


