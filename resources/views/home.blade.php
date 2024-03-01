@extends('layouts.app')

@section('content')
    @canany('view-dashbord')
        <div class="container">
            <h1>Tableau de bord</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Nombre total de clients</h5>
                            <p class="card-text">{{ $totalClients }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Nombre total de produits</h5>
                            <p class="card-text">{{ $totalProduits }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Répartition des clients par sexe</h5>
                            <canvas id="chartSexe"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('chartSexe').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Masculin', 'Féminin'],
                    datasets: [{
                        label: 'Nombre de clients',
                        data: [{{ $nbClientsMasculin }}, {{ $nbClientsFeminin }}],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endcanany

@endsection
