@extends('layouts.master')
@section('container')
<div class="row">
    <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">

            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

            </div>
            <div class="card-body pt-0 pt-md-4">

            <div class="text-center">

                <hr>
                <div class="card shadow">
                    <div class="card-header border-0">
                    <h3 class="mb-0">LeNeon Réaction</h3>
                    </div>
                    <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Nom d'utilisateur</th>
                            <th scope="col">Numéro de ecarte</th>

                        </tr>
                        </thead>
                        <tbody>

                            <tr>

                                <td>
                                    {{ $feedback->client->nom.' '.$feedback->client->prenom }}
                                </td>
                                <td>
                                    {{ $feedback->client->num_carte }}
                                </td>

                            </tr>

                        </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                         Méssages
                    </div>
                    <div class="card-body">
                        <div class="card-text"><h2><span style="font-size:14px"><strong>{!! $feedback['contenue'] !!}</strong></span></h2>

<div style="page-break-after:always"><span style="display:none">&nbsp;</span></div>

<p>&nbsp;</p>
</div>
                        <hr>
                        <form method="POST" action="{{ route('publier',$feedback) }}">
                            @csrf
                            @method('put')
                        <div class="row">
                            <div class="form-group col-md-2 ">
                                <button type="submit" required="" name="publish" class="form-control btn btn-outline-success" id="exampleInputEmail1" aria-describedby="emailHelp">Publish</button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>

                                        </div>
        </div>
    </div>

</div>
@endsection
