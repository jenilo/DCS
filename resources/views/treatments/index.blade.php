@extends('layouts.app')

@section('content')

<div class="p-2">
	<div class="container">
      	<div class="row g-0">
      		<div class="col-md-8 col-12 my-auto">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                    Tratamientos
                </h2>
            </div>
      		<div class="col-md-4 col-12 my-auto text-right">
                <button type="button" class="btn btn-primary py-1" data-bs-toggle="modal" data-bs-target="#addTreatmentModal"><i class="fas fa-plus-circle"></i> Añadir tratamiento</button>
                <!--<a type="button" class="btn btn-primary py-1" href="{{route('createtreatment')}}"><i class="fas fa-plus-circle"></i> Añadir Tratamiento</a>-->
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
                            @if(@isset($treatments) && count($treatments)>0)
                                {{$treatments->links()}}
                            @endif
                            </td>
                        </tr>
                    </tfoot>
					<tbody>
						@if(isset($treatments) && count($treatments)>0)
            				@foreach ($treatments as $treatment)
								<tr id="Treatment{{$treatment->id}}">
									<th>{{$treatment->id}}</th>
									<td>{{$treatment->name}}</td>
									<td>
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
									</td>
								</tr>
							@endforeach
						@else
                            <tr>
                                <td colspan="5" rowspan="3" class="text-center"><h1>No hay tratamientos</h1></td>
                            </tr>
                        @endif
					</tbody>
				</table>
			</div>

		</div>
		
	</div>
</div>

@include('modals.modalAddTreatment')

@endsection