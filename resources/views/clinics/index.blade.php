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
            <div class="col-md-4 col-12 my-auto text-right">
                <button type="button" class="btn btn-primary bg-aquablue rounded-pill" data-bs-toggle="modal" data-bs-target="#addTreatmentModal"><i class="fas fa-plus"></i>&nbsp Añadir usuario</button>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="col">
                <canvas id=""></canvas>
            </div>
        </div>
        
    </div>
</div>

<script type="text/javascript">
    
</script>

@endsection