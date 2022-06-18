       <!-- User -->
       <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img  src="{{ Storage::url(Auth::user()->photo) }}" alt="Image">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->email }}</span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Bien venue {{ Auth::user()->nom }}</h6>
            </div>

            @if (Auth::user()->type=="client");
            <a href="{{ route('mon_profil',Auth::user()->id) }}" class="dropdown-item">
                <i class="ni ni-single-02"></i>
              <span>Mon Profil</span>
            @endif

            <a href="{{ route('profil',Auth::user()->id) }}" class="dropdown-item">
              <i class="fa fa-user-cog"></i>
            <span>Modifier Mon Profil</span>

            <a href="{{ route('password.reset',Auth::user()->id) }}" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Changer de mot de passe</span>
            </a>
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
