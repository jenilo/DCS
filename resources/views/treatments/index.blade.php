@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<div class="col-md-8 col-12 my-auto">
      			<h2>{{$clinic->name}}</h2>
      			<h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    Tratamientos
                </h2>
            </div>
      		<div class="col-md-4 col-12 my-auto text-right">
                <button type="button" class="btn btn-primary bg-aquablue rounded-pill" data-bs-toggle="modal" data-bs-target="#addTreatmentModal"><i class="fas fa-plus"></i>&nbsp Añadir tratamiento</button>
            </div>
      	</div>
      	<div class="row no-gutters">
			<div class="col p-3">
				<table id="table_id" class="display">
				    <thead>
				        <tr>
				            <th class="text-muted">#</th>
							<th class="text-muted">Nombre</button></th>
                            <th class="col-auto"></th>
				        </tr>
				    </thead>
				    <tbody>
				        @if(isset($treatments) && count($treatments)>0)
            				@foreach ($treatments as $treatment)
								<tr>
									<th class="fw-bold">{{$treatment->id}}</th>
									<td class="fw-bold">{{$treatment->name}}</td>
									<td class="fw-bold text-center">
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
										      		<button onclick="deleteRow('{{url('treatments')}}',{{$treatment->id}},this)"><i class="far fa-trash-alt"></i> Eliminar</button>
										    		</a>
										    	</li>
										    </ul>
										</div>
									</td>
								</tr>
							@endforeach
                        @endif
				    </tbody>
				</table>
			</div>

		</div>
		
	</div>
</div>

@include('modals.modalAddTreatment')

<script src="{{URL::asset('js/deleteRecord.js')}}"></script>
<script>
	$(function() {
	    console.log( "ready!" );
	    $('').addClass();
	});
	var table = $('#table_id').DataTable({
		language: {
    		url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json",
    		search: 'Buscar tratamiento:',
    		searchPlaceholder: "Tratamiento..."
    	},
    	columns: [
	    	{title: '#' },
	    	{title: 'Nombre' },
	    	{title: '', "searchable": false, orderable: false }
    	],
    	'lengthMenu': [[10, 25, -1], [10, 25, "Todos"]],
    	'dom': '<<"float-start"f><"float-end"l><t>ip>'
	    
    });
</script>

@endsection