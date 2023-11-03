@extends('layouts.app')
@section('title')
    Rapport des approbations
@endsection
@section('content')
    <section class="content">
        <div class="row">
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
            {{-- <div class="card">
                <div class="card-body">
                    <div class="tab-content p-0">
                        <h2><i class="fas fa-chart-pie mr-1"></i>Statistiques des Demandes pour l'Année {{ $year }}
                        </h2>
                        <canvas id="approvalsProgressChart"></canvas>
                    </div>
                    <form method="GET" action="{{ route('graphique.index') }}">
                        @csrf
                        <label for="year">Sélectionnez l'année :</label>
                        <select name="year" id="year">
                            @foreach ($years as $year)
                                <option value="{{ $year->year }}" @if ($year->year == $selectedYear) selected @endif>
                                    {{ $year->year }}</option>
                            @endforeach
                        </select>
                        <button type="submit">Afficher</button>
                    </form>
                </div>
            </div> --}}

            <div class="card" style="position: relative; left: 0px; top: 0px;">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Sales
                    </h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 450px;">
                            <div class="tab-content p-0">
                                <h2><i class="fas fa-chart-pie mr-1"></i>Statistiques des Demandes pour l'Année {{ $year }}
                                </h2>
                                <canvas id="approvalsProgressChart"></canvas>
                            </div>
                            <form method="GET" action="{{ route('graphique.index') }}">
                                @csrf
                                <label for="year">Sélectionnez l'année :</label>
                                <select name="year" id="year">
                                    @foreach ($years as $year)
                                        <option value="{{ $year->year }}" @if ($year->year == $selectedYear) selected @endif>
                                            {{ $year->year }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Afficher</button>
                            </form>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 450px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="sales-chart-canvas" height="300"
                                style="height: 300px; display: block; width: 873px;" class="chartjs-render-monitor"
                                width="873"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        var selectYear = document.getElementById('selectYear');
        var ctx = document.getElementById('approvalsProgressChart').getContext('2d');
        var data = {
            labels: @json(array_keys($refusalsByMonth)), // Les mois
            datasets: [{
                    label: 'Demandes de Badge',
                    data: @json(array_values($badgeRequestsByMonth)), // Le nombre de demandes pour chaque mois
                    backgroundColor: 'rgb(4, 157, 199)',
                }, {
                    label: 'Refus',
                    data: @json(array_values($refusalsByMonth)), // Les refus par mois
                    backgroundColor: 'rgb(176, 29, 0)',
                },
                {
                    label: 'Approbations',
                    data: @json(array_values($approvalsByMonth)), // Les approbations par mois
                    backgroundColor: 'rgb(0, 168, 65)',
                },
                {
                    label: 'En Attente',
                    data: @json(array_values($attentesByMonth)), // Les attentes par mois
                    backgroundColor: 'rgb(224, 171, 39)',
                }
            ]
        };
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistiques des Demandes de Badge par Mois'
                    },
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de demandes'
                        }
                    }
                }
            }
        });
    </script>
@endsection
