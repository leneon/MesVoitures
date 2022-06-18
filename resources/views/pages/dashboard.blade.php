@extends('layouts.master')

@section('content')

    @if (Auth::user()->type=="client")
        @include('layouts.partials.client_content')
    @else
        @include('layouts.partials.admin_content')
    @endif

@endsection

@section('container')

    @if (Auth::user()->type=="client")
        @include('layouts.partials.client_container')
    @else
        @include('layouts.partials.admin_container')
    @endif

@endsection
