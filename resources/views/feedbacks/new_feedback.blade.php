@extends('layouts.master')

@section('container')

<div class="row">
    <div class="card col-md-12">
        <h2 class="card-header">M. {{ Auth::user()->nom }} un mot pour nos services merci !</h2>
        <div class="card-body">
            <!--Form-->
            <form method="post" action="{{ route('feedbacks.store') }}">
                @csrf
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Votre mot de remarque</label>
                    <textarea class="form-control" id="car_features" class="" name="contenue" cols="50" rows="5"></textarea>

                @error('contenue')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>


                <button type="submit" name="feed_back" class="btn btn-outline-success">Envoyer</button>
            </form>
            <!-- ./ Form -->
        </div>
    </div>

            </div>
@endsection
