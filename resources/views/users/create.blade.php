@extends('layouts.app')

@section('content')


<div class="p-4">
    <div class="container bg-white p-4 rounded shadow">
        <div class="row g-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0 fw-bold">
                Crear paciente
            </h2>
        </div>
        
        <div class="row g-0">
            <div class="col-lg-8 col-sm-12">
                <form method="POST" action="{{url('users')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-4 col-form-label text-right fw-bold">Nombre</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                             @error('name')
                                <span class="invalid-feedback">{{$errors->first('name')}}</span>
                             @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-4 col-form-label text-right fw-bold">Correo electrónico</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" title="Solo números" value="{{ old('email') }}" required>
                             @error('email')
                                <span class="invalid-feedback">{{$errors->first('email')}}</span>
                             @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-4 col-form-label text-right fw-bold">Contraseña</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback">{{$errors->first('password')}}</span>
                             @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn bg-aquablue text-white fw-bold">Guardar</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection