@extends('layouts.master')
@section('content')
<div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
          <h1 class="text-white">Se connecter a son compte  </h1>
          <p class="text-lead text-light">veuillez fournir votre adresse e-mail et votre mot de passe pour accéder au panneau d’administration</p>
<br>
        </div>
      </div>
    </div>
  </div>

<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
          <div class="card-body px-lg-5 py-lg-5">
              <!--Login Form-->
            <form method="post" role="form" action="{{ route('login') }}">
                {{ @csrf_field() }}
              <div class="form-group mb-3 focused">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                  </div>

                  <input class="form-control" required="" name="email" placeholder="Email" type="email">
                </div>
              </div>
              <div class="form-group mb-3 focused">
              </div>
              <div class="form-group focused">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                  </div>
                  <input class="form-control" required=""  name="password" placeholder="Password" type="password">
                </div>
              </div>
              <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                <label class="custom-control-label" for=" customCheckLogin">
                  <span class="text-muted">Se souvenir de moi</span>
                </label>
              </div>
              <div class="text-center">
                <button type="submit" name="login" class="btn btn-primary my-4">Se connecter</button>
              </div>
            </form>

            <!-- ./ Login Form-->

          </div>
        </div>
        <div class="row mt-3">
          <div class="col-6">
            <a href="#"  class="btn btn-outline-danger"><small>Mot de passe perdu?</small></a>
          </div>

          <div class="col-6 text-right">
            <a href="{{ route('home') }}" class="btn btn-outline-success"><small>Accueil</small></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
