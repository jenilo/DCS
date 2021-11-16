@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<div class="col-md-8 col-12 my-auto">
                {{--<h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    Pacientes
                </h2>--}}
                <div class="input-group">
					<div class="input-group-prepend border-0">
					<span class="input-group-text h-100 border-0 bg-white" id="basic-addon1"><i class="fas fa-search"></i></span>
					</div>
					<input type="text" class="form-control border-0" placeholder="Buscar pacientes..." aria-label="Username" aria-describedby="basic-addon1">
				</div>
                
            </div>
      		<div class="col-md-4 col-12 my-auto text-right">
                <!--<button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#addPatientModal"><i class="fas fa-plus-circle"></i> Añadir paciente</button>-->
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
									<td>{{$patient->id}}</td>
									<td>{{$patient->name}}</td>
									<td>{{$patient->dateBirth}}</td>
                                    <td>{{$patient->phone}}</td>
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
										      		<button onclick="deleteRow({{$patient->id}},this)"><i class="far fa-trash-alt"></i> Eliminar</button>
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

				{{--<table class="rows" id="table_id">
					<thead>
						<tr class="bg-gray-200">
							<th class="text-muted" scope="col">#</th>
							<th class="text-muted" scope="col">Nombre <button id="btn-name" class="text-aquablue"><i class="fas fa-arrows-alt-v"></i></button></th>
							<th class="text-muted" scope="col">Fecha nacimiento</th>
                            <th class="text-muted" scope="col">Telefono</th>
                            {{--<th class="text-muted" scope="col">Actions</th>--}}
                            {{--<th class="text-muted col-auto">Información</th>
                            <th class="col-auto"></th>
						</tr>
					</thead>
					<tbody>
						@if(isset($patients) && count($patients)>0)
            				@foreach ($patients as $patient)
								<tr id="Category{{$patient->id}}">
									<td class="fw-bold">{{$patient->id}}</td>
									<td class="fw-bold">{{$patient->name}}</td>
									<td class="fw-bold">{{$patient->dateBirth}}</td>
                                    <td class="fw-bold">{{$patient->phone}}</td>
									{{--<td class="fw-bold">
										<button class="text-aquablue"><i class="fas fa-edit"></i></button>
										<button class="text-aquablue"><i class="fas fa-trash-alt"></i></button>
										{{--<button onclick="editCategory({{$category}})" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCategoryModal">
											<i class="fas fa-edit" ></i> Edit
										</button>
                                        @if(!isset($books[$category->id]))
                                            <button onclick="deleteRecord('Category','{{url('categories')}}',{{$category->id}})" type="button" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        @endif--}}
									{{--<td>
										<a href="" class="text-decoration-none p-1 border rounded-pill text-aquablue"><i class="far fa-folder-open"></i> ver expediente</a href="">
									</td>
									<td class="text-center">
										<div class="dropdown" role="group">
										    <button id="btnOptions" type="button" class="text-muted" data-bs-toggle="dropdown" aria-expanded="false">
										    	<i class="fas fa-ellipsis-h"></i>
										    </button>
										    <ul class="dropdown-menu" aria-labelledby="btnOptions">
										      <li><a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Editar</a></li>
										      <li><a class="dropdown-item text-danger" href="#"><i class="far fa-trash-alt"></i> Eliminar</a></li>
										    </ul>
										</div>
										{{--<button class=" text-muted"><i class="fas fa-ellipsis-h"></i></button>--}}
									{{--</td>
								</tr>
							@endforeach
						@else
                            <tr>
                                <td colspan="5" rowspan="3" class="text-center"><h1>No hay pacientes</h1></td>
                            </tr>
                        @endif
					</tbody>
				</table>--}}
			</div>

		</div>
		
	</div>
</div>

<script>
    var table = $('#table_id').DataTable({
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
    	/*buttons: {
    		buttons: [
    			{extends: 'pageLength', className: "nuevaClase"}
    	]},
    	buttons: [
	        'pageLength'
	    ]*/
	    
    });
    
    function deleteRow(id,target){
    	console.log(id);
    	table.row( $(target).parents('tr') ).remove().draw();
    }
		    
	/*$('th').click(function(){
	    var table = $(this).parents('table').eq(0);
	    var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
	    console.log(rows);
	    this.asc = !this.asc;
	    if (!this.asc){rows = rows.reverse();}
	    for (var i = 0; i < rows.length; i++){table.append(rows[i]);}
	});
	function comparer(index) {
	    return function(a, b) {
	        var valA = getCellValue(a, index), valB = getCellValue(b, index);
	        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
	    }
	}
	function getCellValue(row, index){ return $(row).children('td').eq(index).text(); }*/
</script>

@endsection