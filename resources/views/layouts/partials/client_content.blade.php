
<div class="row">
    <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Voitures louer</h5>
                                <span class="h2 font-weight-bold  mb-0">
                                    {{ DB::table('reservations')->where('client_id',Auth::user()->id)->where('numero','<>',null)->where('etat','active')->count() }}
                                </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-danger mr-2"></span>
                        <span class="text-nowrap"></span>
                        </p>
                    </div>
            </div>
    </div>

    <div class="col-xl-4 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Voiture Reservé</h5>
                    <span class="h2 font-weight-bold mb-0">
                        {{ DB::table('reservations')->where('client_id',Auth::user()->id)->where('numero',null)->count() }}
                    </span>
                </div>
                <div class="col-auto">
                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                    <i class="fas fa-business-time"></i>
                </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-danger mr-2"></span>
                <span class="text-nowrap"></span>
            </p>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6">
      <div class="card card-stats mb-4 mb-xl-0">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Voitures disponible</h5>
                <span class="h2 font-weight-bold mb-0">
                    {{ DB::table('voitures')->where('disponibilite','Disponible')->count() }}
                </span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                <i class="fas fa-car"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-warning mr-2"></span>
            <span class="text-nowrap"></span>
          </p>
        </div>
      </div>
    </div>


</div>
  <br>
<div class="row">
    <div class="col-xl-4 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Payement en Attente</h5>
                    <span class="h2 font-weight-bold mb-0">
                        {{ DB::table('reservations')->where('statut','Accepter')->where('numero',null)->count() }}
                    </span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                  <i class="fas fa-money-check-alt"></i>
                </div>
              </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">
              <span class="text-success mr-2"></span>
              <span class="text-nowrap"></span>
            </p>
          </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
            <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">FeedBacks</h5>
                    <span class="h2 font-weight-bold mb-0">
                        {{ DB::table('feedback')->where('client_id',Auth::user()->id)->count() }}
                    </span>
                </div>
                <div class="col-auto">
                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                    <i class="fas fa-envelope"></i>
                </div>
                </div>
            </div>
            <p class="mt-3 mb-0 text-muted text-sm">
                <span class="text-success mr-2"></span>
                <span class="text-nowrap"></span>
            </p>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Types de voitures</h5>
                        <span class="h2 font-weight-bold mb-0">
                        {{ DB::table('categories')->count() }}
                        </span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"></span>
                    <span class="text-nowrap"></span>
                </p>
            </div>
        </div>
    </div>




</div>
