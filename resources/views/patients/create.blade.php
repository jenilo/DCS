@extends('layouts.app')

@section('content')

<div class="container p-2">
    <div class="row g-0">
        <div class="col-md-8 col-12 my-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                Crear paciente
            </h2>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-8 col-sm-12">
            <form method="POST" action="{{url('patients')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label text-right">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="dateBirth" class="col-sm-4 col-form-label text-right">Fecha de nacimiento</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="dateBirth"> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-4 col-form-label text-right">Telefono</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="phone" pattern="[0-9]{10}" title="Solo números"> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-4 col-form-label text-right">Dirección</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="address"> 
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="employment" class="col-sm-4 col-form-label text-right">Ocupación</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="employment"> 
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-warning">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection