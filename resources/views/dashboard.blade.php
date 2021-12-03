@extends('layouts.app')

@section('content')

<div class="p-4">
    <div class="container bg-white p-4 rounded shadow">
        <div class="row g-0">
            <div class="col-md-8 col-12 my-auto">
                <div>
                    <h3>{{$clinic->name}}</h3>
                </div>
                
            </div>
            {{--<div class="col-md-4 col-12 my-auto text-right">
                <button type="button" class="btn btn-primary bg-aquablue rounded-pill" data-bs-toggle="modal" data-bs-target="#addTreatmentModal"><i class="fas fa-plus"></i>&nbsp Añadir tratamiento</button>
            </div>--}}
        </div>
        <div class="row no-gutters">
            <div class="col">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">
    const labels = [
      'Enero',
      'Febrero',
      'Marzo',
      'Abril',
      'Mayo',
      'Junio',
    ];
    const data = {
      labels: labels,
      datasets: [{
        label: 'Citas',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {}
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    const labels2 = [
      'Diagnóstico y Prevención',
      'Ortodoncia',
      'Implantes',
      'Odontopediatría',
      'Estética Dental',
      'Periodoncia',
      'Prótesis',
      'Caries',
      'Bruxismo'
    ];
    const data2 = {
      labels: labels2,
      datasets: [{
        label: 'Citas por tratamiento',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };
    const config2 = {
        type: 'line',
        data: data2,
        options: {}
    };
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );
</script>

@endsection
