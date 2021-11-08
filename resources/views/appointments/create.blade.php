
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
            <form method="POST" action="{{route('saveappointment')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label text-right">Paciente</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" disabled>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSearchPatientModal" onclick="getPatients('')">Buscar paciente</button>
                        <input type="hidden" name="patient_id" value="{{old('patient_id')}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="dateBirth" class="col-sm-4 col-form-label text-right">Tratamiento</label>
                    <div class="col-sm-8">
                        <select class="col-md-4 form-control" id="treatment_id" name="treatment_id" required>
                            <option selected disabled>Elegir</option>
                            @foreach($treatments as $treatment)
                                <option value="{{$treatment->id}}">{{$treatment->name}}</option>
                            @endforeach
                         </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="date" class="col-sm-4 col-form-label text-right">Fecha</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ (isset($date))? $date : old('date') }}" required>
                         @error('date')
                            <span class="invalid-feedback">{{$errors->first('date')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="timeStart" class="col-sm-4 col-form-label text-right">Hora</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control @error('timeStart') is-invalid @enderror" name="timeStart" value="{{ old('timeStart') }}" required>
                        @error('timeStart')
                            <span class="invalid-feedback">{{$errors->first('timeStart')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="timeEnd" class="col-sm-4 col-form-label text-right">Hora</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control @error('timeEnd') is-invalid @enderror" name="timeEnd" value="{{ old('timeEnd') }}" required>
                        @error('timeEnd')
                            <span class="invalid-feedback">{{$errors->first('timeEnd')}}</span>
                         @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="notes" class="col-sm-4 col-form-label text-right">Notas</label>
                    <div class="col-sm-8">
                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="invalid-feedback">{{$errors->first('notes')}}</span>
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

@include('modals.modalSearchPatient')

@endsection