
@extends('layouts.master')

@section('content')

    <div class="container-fluid d-flex align-items-center">
        <div class="row">
        <div class="col-lg-12 col-md-10">
            <h3 class="display-2 text-white">Bienvenue {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</h3>
        </div>
        </div>

    </div>
@endsection

@section('container')

<div class="row">
    <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
    <div class="card card-profile shadow">
        <div class="card-body pt-0 pt-md-4">
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="row justify-content-center">
                    <div class="col-lg-2 order-lg-1">
                        <div class="card-profile-image">
                        <a href="#">
                            <img alt="avatar" src="{{ Storage::url(Auth::user()->photo) }}" class="rounded-circle">
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col">
            <!--Profile Details-->
            <div class="card-profile-stats d-flex justify-content-center mt-md-5">

            </div>
            </div>
        </div>
        <div class="text-center">
            <h3>
            {{ Auth::user()->nom.' '.Auth::user()->prenom }}<span class="font-weight-light"></span>
            </h3>
            <div class="h5 font-weight-300">
            <i class="ni location_pin mr-2"></i>{{ Auth::user()->email }}
            </div>
            <div class="h5 mt-4">
            <i class="ni business_briefcase-24 mr-2"></i>Système d'Administration de ATIKO Travels
            </div>
            <div>
            </div>
            <hr class="my-4" />
            <p>{!! Auth::user()->bio !!}</p>
        </div>
        </div>
    </div>
    </div>
    <div class="col-xl-8 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
        <div class="row align-items-center">
            <div class="col-8">
            <h3 class="mb-0">Modifier les details de mon compte</h3>
            </div>
            <div class="col-4 text-right">
            </div>
        </div>
        </div>
        <div class="card-body">
        <form action="{{ route('user.update',Auth::user()->id) }}" method ="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h6 class="heading-small text-muted mb-4">Infos</h6>
            <div class="pl-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="nom">Nom</label>
                        <input type="text" id="nom" required name="nom" value="{{ Auth::user()->nom }}" class="form-control form-control-alternative" placeholder="Nom" >
                        @error('nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="{{ Auth::user()->prenom ?? old('nom') }}" class="form-control form-control-alternative" placeholder="Votre prénom" >
                        @error('prenom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="input-first-name">Téléphone</label>
                    <input type="text" name="telephone" id="telephone" required class="form-control form-control-alternative" placeholder="Votre contact téléphoninique" value="{{ Auth::user()->telephone ?? old('telephone') }}">
                    @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="num_carte">Numéro de carte</label>
                    <input type="text" name="num_carte" id="num_carte" required class="form-control form-control-alternative" placeholder="Numéro de carte d'identité" value="{{ Auth::user()->num_carte ?? old('num_carte') }}">
                    @error('num_carte')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="adresse">Adresse de residance</label>
                    <input type="text" name="adresse" id="adresse" required class="form-control form-control-alternative" placeholder="Adresse de résidance" value="{{ Auth::user()->adresse ?? old('adresse') }}">
                    @error('adresse')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                </div>
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label" for="ville">Ville</label>
                    <input name="ville" type="text" id="ville" required class="form-control form-control-alternative" placeholder="Ville de résidance" value="{{ Auth::user()->ville ?? old('ville') }}">
                    @error('ville')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="photo">Photo de profil</label>
                        <input type="file" name="photo" id="photo" accept="image/png, image/jpeg, image/jpg"  name="photo"  class="form-control form-control-alternative" >
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label" for="email">Email adresse</label>
                        <input value="{{ Auth::user()->email ?? old('email') }}" type="email" id="email" name="email"  class="form-control form-control-alternative" placeholder="jesse@example.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                    </div>
                </div>
            </div>

            </div>

            <h6 class="heading-small text-muted mb-4">Appropos</h6>
            <div class="pl-lg-4">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Descriptions plus détaillé de la voiture</label>
                        <textarea type="text" required name="bio"  class="form-control" id="car_features" aria-describedby="emailHelp">{!! $user['bio'] !!}</textarea>
                    @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success"  value="Modifier mon profil">
                    </div>
            </div>

        </form>
        </div>
    </div>
    </div>
</div>
@endsection
