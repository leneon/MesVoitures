<!--Sidebar-->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">

    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('dashboard') }}">
        <img src="/img/logo.png" class="navbar-brand-img" alt="..." height="60">
      </a>
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ route('dashboard') }}">
                <img src="/assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        {{-- <form class="mt-4 mb-3 d-md-display">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form> --}}
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item   ">
            <a class="nav-link  " href="{{ route('dashboard') }}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>

          @if (Auth::user()->type!='client')
          <li class="nav-item">
            <a class="nav-link " href="{{ route('categories.index') }}">
              <i class="fas fa-clipboard-list text-blue"></i> Catégories de voiture
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link " href="{{ route('voitures.index') }}">
              <i class="fa fa-car text-blue"></i> Voitures
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('reservations.index') }}">
              <i class="fas fa-business-time text-blue"></i> Reservation de voitures
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link " href="{{ route('paiements.index') }}">
              <i class="fas fa-money-check-alt text-blue"></i> Payements
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="{{ route('locations') }}">
              <i class="fas fa-cogs text-blue"></i> Gérer les Locations
            </a>
          </li>

{{--
          <li class="nav-item">
            <a class="nav-link " href="admin_advance_reporting.php">
              <i class="fas fa-bullhorn text-blue"></i> Rapports avancés
            </a>
          </li> --}}

          <li class="nav-item">
            @if (Auth::user()->type=="client")
            <a class="nav-link " href="{{ route('feedbacks.create') }}">
                <i class="fas fa-envelope text-blue"></i> FeedBacks
            </a>
            @else
            <a class="nav-link " href="{{ route('feedbacks.index') }}">
                <i class="fas fa-envelope text-blue"></i> FeedBacks
            </a>
            @endif
          </li>
          @if (Auth::user()->type!="client")

          <li class="nav-item">
            <a class="nav-link " href="{{ route('clients') }}">
              <i class="fa fa-users text-blue"></i>Clients
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link " href="{{ route('new_user') }}">
              <i class="fa fa-user-cog text-blue"></i>Utilisateurs
            </a>
          </li>
          @endif
          <br>
          <li class="nav-item"><br>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }} "
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <i class="ni ni-user-run text-red"></i>
            {{ __('Se Déconnecter') }}</a>
            <form action="{{ route('logout') }}" id="logout-form" method="post">
                @csrf
            </form>
          </div>
          </li>


        </ul>

      </div>
    </div>
  </nav>
