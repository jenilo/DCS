@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<div class="col-md-8 col-12 my-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    Pacientes
                </h2>
            </div>
      		<div class="col-md-4 col-12 my-auto text-right">
                <a type="button" class="btn btn-primary bg-aquablue rounded-pill" href="{{route('createpatient')}}"><i class="fas fa-plus"></i>&nbsp Añadir paciente</a>
            </div>
      	</div>
      	<div class="row no-gutters">
			<div class="col p-3">
				<table id="table_id" class="display">
				    <thead>
				        <tr>
				            <th class="text-muted">#</th>
							<th class="text-muted">Nombre</th>
							<th class="text-muted">Fecha nacimiento</th>
                            <th class="text-muted">Telefono</th>
                            <th class="text-muted col-auto">Información</th>
                            <th class="col-auto">op</th>
				        </tr>
				    </thead>
				    <tbody>
				        @if(isset($patients) && count($patients)>0)
            				@foreach ($patients as $patient)
								<tr>
									<td class="fw-bold">{{$patient->id}}</td>
									<td class="fw-bold">{{$patient->name}}</td>
									<td class="fw-bold">{{$patient->dateBirth}}</td>
                                    <td class="fw-bold">{{$patient->phone}}</td>
                                    <td>
										<a href="{{route('patient',['patient' => $patient->id])}}" class="text-decoration-none p-1 border rounded-pill text-aquablue"><i class="far fa-folder-open"></i> ver expediente</a href="">
									</td>
									<td class="text-center">
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
										      		<button onclick="deleteRow('{{url('patients')}}',{{$patient->id}},this)"><i class="far fa-trash-alt"></i> Eliminar</button>
										    		</a>
										    	</li>
										    </ul>
										</div>
									</td>
								</tr>
							@endforeach
						@else
                            <tr>
                                <td colspan="6" rowspan="3" class="text-center"><h1>No hay pacientes</h1></td>
                            </tr>
                        @endif
				    </tbody>
				</table>

				
			</div>

		</div>
		
	</div>
</div>

<script src="{{URL::asset('js/deleteRecord.js')}}"></script>
<script>
    var table = $('#table_id').DataTable({
    	language: {
    		url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json",
    		search: 'Buscar pacientes:',
    		searchPlaceholder: "Paciente..."
    	},
    	columns: [
	    	{title: '#' },
	    	{title: 'Nombre' },
	    	{title: 'Fecha de nacimiento' },
	    	{title: 'Telefono'},
	    	{title: 'Info', "searchable": false, orderable: false },
	    	{title: '', "searchable": false, orderable: false }
    	],
    	'dom': '<<"float-start"f><"float-end"l><t>ip>',
    	'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
    });
    
</script>

@endsection