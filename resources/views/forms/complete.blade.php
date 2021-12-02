@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<h4>{{$form->name}}</h4>
      		<h5>Paciente: {{$medical_record->patient->name}}</h5>
      		{{--$medical_record--}}
      	</div>
      	<div class="row no-gutters">
			<div class="col p-3">
				<form action="{{route('createcompleteform')}}" method="POST" id="form_complete">
					@csrf
					<table class="table table-responsive">
						{{--<thead>
							<tr class="border-0">
								<th class="fw-bold">Pregunta</th>
								<th class="fw-bold">Respuesta</th>
								<th></th>
							</tr>	
						</thead>--}}
						<tbody>
							@foreach($form->questions as $question)
								<tr class="border border-white">
									<td class="fw-bold">{{$question->question}}</td>
									@php
										$i = $loop->iteration;
									@endphp
									@if($question->answer_type_id == \App\Enums\ResponseType::YesOrNo)
										<td>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="response[{{$question->id}}]" value="1" id="radioa{{$i}}" required>
												<label class="form-check-label" for="radioa{{$i}}">Si</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="response[{{$question->id}}]" value="2" id="radiob{{$i}}">
												<label class="form-check-label" for="radiob{{$i}}">No</label>
											</div>
										</td>
									@else
										<td>
											<input name="response[{{$question->id}}]" class="form-control" type="text">
										</td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
						<input type="hidden" name="medical_record_id" value="{{$medical_record->id}}">
						<input type="hidden" name="form_id" value="{{$form->id}}">
						<input type="hidden" name="patient_id" value="{{$medical_record->patient->id}}">
	                    <button type="submit" id="save" class="btn btn-primary bg-aquablue">Guardar</button>
	                    <button type="button" class="btn btn-warning text-white">Cancelar</button>
	                </div>
				</form>
			</div>

		</div>
		
	</div>
</div>

@endsection