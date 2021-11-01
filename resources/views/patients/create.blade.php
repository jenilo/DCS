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
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
            {{$errors}}
        @endif
    </div>
    <div class="row g-0">
        <div class="col-lg-8 col-sm-12">
            <form method="POST" action="{{url('patients')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label text-right">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                         @error('name')
                            <span class="invalid-feedback">{{$errors->first('name')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="dateBirth" class="col-sm-4 col-form-label text-right">Fecha de nacimiento</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('dateBirth') is-invalid @enderror" name="dateBirth" value="{{ old('dateBirth') }}" required>
                         @error('dateBirth')
                            <span class="invalid-feedback">{{$errors->first('dateBirth')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="phone" class="col-sm-4 col-form-label text-right">Telefono</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" pattern="[0-9]{10}" title="Solo números" value="{{ old('phone') }}" required>
                         @error('phone')
                            <span class="invalid-feedback">{{$errors->first('phone')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-4 col-form-label text-right">Dirección</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <span class="invalid-feedback">{{$errors->first('address')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="employment" class="col-sm-4 col-form-label text-right">Ocupación</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('employment') is-invalid @enderror" value="{{ old('employment') }}" name="employment"> 
                        @error('employment')
                            <span class="invalid-feedback">{{$errors->first('employment')}}</span>
                         @enderror
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