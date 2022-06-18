<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Location
  </title>

  @include('layouts.partials.link')

  @include('layouts.partials.head_js')
</head>

<body class="">

    @guest
    @else
    @include('layouts.partials.sidebar')
    @endguest

  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
          <!-- Brand -->
          <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('dashboard') }}">{{ Auth::user()->nom??"" }} compte personnel</a>
          <!-- Form -->

        @guest
        @else
        @include('layouts.partials.navbar')
        @endguest

        </div>
     </nav>

    <!-- End Navbar -->

    <!-- Header -->
    @if (isset($user))
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 500px; background-image: url({{ Storage::url($user->photo) }}); background-size: cover; background-position: center top;">
    @elseif (isset($voitures))
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 500px; background-image: url(/img/header-bg.jpg); background-size: cover; background-position: center top;">
    @elseif (isset($voiture))
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 500px; background-image: url({{ Storage::url($voiture['photo_ext']) }}); background-size: cover; background-position: center top;">
    @else
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 500px; background-image: url(/img/header-bg.jpg); background-size: cover; background-position: center top;">
    @endif
      <span class="mask bg-gradient-default opacity-5"></span>
      <div class="container-fluid">
        <div class="header-body">

          <!-- Card stats -->
        @yield('content')

        </div>
      </div>
    </div>
    <!--End Header -->

    <div class="container-fluid mt--7">
    <!--Pie chart to show number of car categories-->
      @yield('container')

      <!-- Footer -->
      @include('layouts.partials.footer')

    </div>

  </div>

  @include('layouts.partials.script')

</body>

</html>
