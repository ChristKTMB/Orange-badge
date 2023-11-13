<div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $totalRequests }}</h3>
            <p>Nombre de demande</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('rapport.index') }}" class="small-box-footer">Voir plus <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $nombreApprouves }}</sup></h3>
            <p>Demande accepter</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{ route('rapport.index') }}" class="small-box-footer">Voir plus <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $nombreEnAttente }}</h3>
            <p>Demande en attente</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="{{ route('rapport.index') }}" class="small-box-footer">Voir plus <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $nombreDeRefuses }}</h3>
            <p>Demande rejeter</p>
        </div>
        <div class="icon">
            <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{ route('rapport.index') }}" class="small-box-footer">Voir plus <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>