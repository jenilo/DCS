@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0 p-3">
			<div class="col-12 col-md-4">
                <div class="row border rounded p-2">
                    <h1 class="col-12 col-lg-4 text-center"><i class="far fa-user-circle" style="font-size: 80px;"></i></h1>
                    <div class="col-12 col-lg-8">
                        <h4 class="fw-bold mb-0 text-capitalize"><span id="name_patient">{{$patient->name}}</span></h4>
                        <h6 class="text-muted mb-1"><span id="dateBirth">{{$patient->dateBirth}}</span> &middot; <span id="age">00 años</span></h6>
                        <h6><span class="border px-2 rounded-pill mr-2"> <i class="fas fa-phone-alt"></i> <span class="text-muted" id="phone">{{$patient->phone}}</span> </span> </h6>
                        <h6><span class="border px-2 rounded-pill"> <i class="fas fa-briefcase"></i> <span class="text-muted" id="employment">{{$patient->employment}}</span> </span>
                        </h6>
                        
                    </div>
                    <div class="col-12">
                    	<p class="mb-1"><i class="fas fa-map-marked-alt"></i> {{$patient->address}}</p>
                    	<h6><i class="fas fa-folder"></i> Fecha de admisión: {{$patient->medical_records->dateAdmission}}</h6>
                    	<h6><i class="far fa-clipboard"></i> Observaciones: {{$patient->medical_records->observations}}</h6>
                    </div>
                </div>
			</div>
			<div class="col-12 col-md-8 px-4">
				<table id="table_id" class="display">
				    <thead>
				        <tr>
				            <th class="text-muted">#</th>
							<th class="text-muted">Fecha</th>
                            <th class="text-muted">Hora</th>
                            <th class="text-muted col-auto">Notas</th>
                            <th></th>
				        </tr>
				    </thead>
				    <tbody>
				    	@foreach($patient->appointments as $appointment)
				    		<tr>
								<td class="fw-bold">{{$appointment->id}}</td>
								<td class="fw-bold">{{$appointment->date}}</td>
								<td class="fw-bold">{{$appointment->timeStart}}</td>
								<td class="fw-bold">{{$appointment->notes}}</td>
								<td class="text-center fw-bold">
									<div class="dropdown" role="group">
									    <button id="btnOptions" type="button" class="text-muted" data-bs-toggle="dropdown" aria-expanded="false">
									    	<i class="fas fa-ellipsis-h"></i>
									    </button>
									    <ul class="dropdown-menu" aria-labelledby="btnOptions">
									      	<li>
									      		<a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Editar</a>
									      	</li>
									    	<li>
									      		<a class="dropdown-item text-danger">
									      		<button onclick="deleteRow({{$appointment->id}},this)"><i class="far fa-trash-alt"></i> Eliminar</button>
									    		</a>
									    	</li>
									    </ul>
									</div>
								</td>
							</tr>
				    	@endforeach
				    </tbody>
				</table>
			</div>



		</div>
		<div class="row g-0 p-3 border rounded bg-gray-100">
			<h2 class="col">Expediente médico</h2>
			<div class="col text-end">
				<button type="button" class="btn btn-primary bg-aquablue rounded-pill mr-2" data-bs-toggle="modal" data-bs-target="#completeFormModal"><i class="fas fa-plus"></i>&nbsp Formulario</button>
				<button type="button" class="col btn btn-primary bg-aquablue rounded-pill" data-bs-toggle="modal" data-bs-target="#saveFileModal"><i class="fas fa-plus"></i>&nbsp Registro médico</button>
				<a href="{{route('odontogram',['patient' => $patient->id])}}" class="col btn btn-primary bg-aquablue rounded-pill"><i class="fas fa-plus"></i>&nbsp Odontograma</a>
			</div>
			<div class="row g-0 border rounded p-3 mb-2 bg-white">
				<h6 class="text-muted">Formularios</h6>
				@if(count($patient->medical_records->forms_completed) > 0)
					<div class="row row-cols-2 row-cols-lg-6 row-cols-md-8 row-cols-sm-4 no-gutters p-2">
						@foreach($patient->medical_records->forms_completed as $form_completed)
						<div class="mb-2">
							<a href="{{route('showcompletedform',$form_completed->id)}}" class="text-decoration-none mb-2" data-toggle="tooltip" data-placement="top" title="Fecha: {{$form_completed->saveDate}}">
								<img class="mx-auto" src="{{asset('icons/form.png')}}" style="width: 120px;" alt="">
								<h6 class="fw-bold text-muted text-center mb-0 mt-2">{{$form_completed->form->name}}</h6>
							</a>
						</div>
							
						@endforeach
					</div>
				@else
					<h1 class="text-gray-300 text-center">No hay registros</h1>
				@endif
			</div>
			<div class="row g-0 border rounded p-3 bg-white">
				<h6 class="text-muted">Documentos</h6>
				@if(count($patient->medical_records->files) > 0)
					<div class="row row-cols-2 row-cols-lg-6 row-cols-md-8 row-cols-sm-4 no-gutters p-2">
						@foreach($patient->medical_records->files as $file)
							<a class="text-decoration-none">
								@if(substr($file->filePath, -3) == "pdf")
									<img class="mx-auto" src="{{asset('icons/pdf.png')}}" style="width: 120px;" alt="">
								@else
									<img onclick="openImage('{{Storage::url($file->filePath)}}')" class="mx-auto" src="{{Storage::url($file->filePath)}}" style="width: 120px;" alt="">
								@endif
								<h6 class="fw-bold text-muted text-center mb-0 mt-2">{{$file->name}}</h6>
							</a>
						@endforeach
					</div>
				@else
					<h1 class="text-gray-300 text-center">No hay registros</h1>
				@endif

			</div>
		</div>
		
	</div>
</div>

@include('modals.modalAddCompletedForm')
@include('modals.modalSaveFile')
@include('modals.modalViewImage')

<script src="{{URL::asset('js/deleteRecord.js')}}"></script>
<script>

	$('#age').text(moment().diff("{{$patient->dateBirth}}",'years')+" años");
    var table = $('#table_id').DataTable({
    	columns: [
	    	{title: '#' },
	    	{title: 'Fecha' },
	    	{title: 'Hora' },
	    	{title: 'Notas', orderable: false },
	    	{title: '', "searchable": false, orderable: false }
    	],
    	'dom': '<<"float-start"f><"float-end"l><t>ip>',
    	'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
	    
    });

    function openImage(url){
    	$('#viewImageModal').modal('show');
    	$('#viewImageModal #img').attr("src",url);
    }
</script>

@endsection