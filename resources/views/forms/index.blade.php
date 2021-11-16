@extends('layouts.app')

@section('content')

{{--<div class="p-2">
	<div class="container">
      	<div class="row g-0">
      		<div class="col-md-8 col-12 my-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    Formularios
                </h2>
            </div>
      		<div class="col-md-4 col-12 my-auto text-right">
                <button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#addFormModal"><i class="fas fa-plus-circle"></i> Crear formulario</button>
       
            </div>
      	</div>
      	<div class="row no-gutters">
			<div class="col p-3">
				<table class="table table-responsive-md table-striped table-hover table-sm shadow">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nombre</th>
                            <th scope="col">Actions</th>
						</tr>
					</thead>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                            @if(@isset($forms) && count($forms)>0)
                                {{$forms->links()}}
                            @endif
                            </td>
                        </tr>
                    </tfoot>
					<tbody>
						@if(isset($forms) && count($forms)>0)
            				@foreach ($forms as $form)
								<tr id="Treatment{{$form->id}}">
									<th>{{$form->id}}</th>
									<td>{{$form->name}}</td>
									<td>
										<a type="button" class="btn btn-primary py-1" href="{{route('createquestions',['form' => $form->id])}}"><i class="fas fa-plus-circle"></i> añadir preguntas</a>
										<a type="button" class="btn btn-primary py-1" href="{{route('editquestions',['form' => $form->id])}}"><i class="fas fa-plus-circle"></i> editar preguntas</a>
									</td>
								</tr>
							@endforeach
						@else
                            <tr>
                                <td colspan="5" rowspan="3" class="text-center"><h1>No hay Formularios</h1></td>
                            </tr>
                        @endif
					</tbody>
				</table>
			</div>

		</div>
		
	</div>
</div>--}}

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<div class="col-md-8 col-12 my-auto">
                <div id="table_id_filter" class="input-group">
					<div class="input-group-prepend border-0">
					<span class="input-group-text h-100 border-0 bg-white" id="basic-addon1"><i class="fas fa-search"></i></span>
					</div>
					<input type="search" aria-controls="table_id" class="form-control border-0" placeholder="Buscar Formulario..." aria-label="Username" aria-describedby="basic-addon1">
				</div>
                
            </div>
      		<div class="col-md-4 col-12 my-auto text-right">
                <button type="button" class="btn btn-primary bg-aquablue rounded-pill" data-bs-toggle="modal" data-bs-target="#addFormModal"><i class="fas fa-plus"></i>&nbsp Crear formulario</button>
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
				    	{{--@if(isset($forms) && count($forms)>0)
            				@foreach ($forms as $form)
								<tr id="Treatment{{$form->id}}">
									<th>{{$form->id}}</th>
									<td>{{$form->name}}</td>
									<td>
										<a type="button" class="btn btn-primary py-1" href="{{route('createquestions',['form' => $form->id])}}"><i class="fas fa-plus-circle"></i> añadir preguntas</a>
										<a type="button" class="btn btn-primary py-1" href="{{route('editquestions',['form' => $form->id])}}"><i class="fas fa-plus-circle"></i> editar preguntas</a>
									</td>
								</tr>
							@endforeach
						@else
                            <tr>
                                <td colspan="5" rowspan="3" class="text-center"><h1>No hay Formularios</h1></td>
                            </tr>
                        @endif--}}
				        @if(isset($forms) && count($forms)>0)
            				@foreach ($forms as $form)
								<tr>
									<th>{{$form->id}}</th>
									<td>{{$form->name}}</td>
									<td class="text-center">
										<div class="dropdown" role="group">
										    <button id="btnOptions" type="button" class="text-muted" data-bs-toggle="dropdown" aria-expanded="false">
										    	<i class="fas fa-ellipsis-h"></i>
										    </button>
										    <ul class="dropdown-menu" aria-labelledby="btnOptions">
										      	<li>
										      		<a href="{{route('editquestions',['form' => $form->id])}}" class="dropdown-item"><i class="fas fa-edit"></i> Editar</a>
										      	</li>
										    	<li>
										      		<a class="dropdown-item text-danger">
										      			<button onclick="deleteRow({{$form->id}},this)"><i class="far fa-trash-alt"></i> Eliminar</button>
										    		</a>
										    	</li>
										    </ul>
										</div>
									</td>
								</tr>
							@endforeach
						@else
                            <tr>
                                <td colspan="3" rowspan="3" class="text-center"><h1>No hay Formularios</h1></td>
                            </tr>
                        @endif
				    </tbody>
				</table>
			</div>

		</div>
		
	</div>
</div>

<script>
	var table = $('#table_id').DataTable({
		language: {
    		url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json"
    	},
    	columns: [
	    	{title: '#' },
	    	{title: 'Nombre' },
	    	{title: '', "searchable": false, orderable: false }
    	],
    	'lengthMenu': [[10, 25, -1], [10, 25, "Todos"]],
    	'dom': '<<"float-start"f><"float-end"l><t>ip>'
	    
    });
    
    function deleteRow(id,target){
    	console.log(id);
    	table.row( $(target).parents('tr') ).remove().draw();
    }
</script>

@include('modals.modalAddForm')

@endsection