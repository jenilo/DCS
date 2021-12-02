@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<h4>{{$completed_form->form->name}}</h4>
      		<h5>Paciente: {{$completed_form->medical_record->patient->name}}</h5>
      		{{--$completed_form->medical_record--}}
      	</div>
      	<div class="row no-gutters">
			<div class="col p-3">
				<form action="{{route('updatecompleteform')}}" method="POST" id="form_complete">
					@csrf
					<table class="table table-responsive">
						{{--<thead>
							<tr>
								<th>Pregunta</th>
								<th>Respuesta</th>
								<th></th>
							</tr>	
						</thead>--}}
						<tbody>
							@foreach($completed_form->answers as $answer)
								<tr class="border border-white">
									<td class="fw-bold">{{$answer->question->question}}</td>
									@php
										$i = $loop->iteration;
									@endphp
									@if($answer->question->answer_type_id == \App\Enums\ResponseType::YesOrNo)
										<td>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="response[{{$answer->id}}]" id="radioa{{$i}}" value="1" {{$answer->answer == 1? "checked" : ""}} required>
												<label class="form-check-label" for="radioa{{$i}}">Si</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name="response[{{$answer->id}}]" id="radiob{{$i}}" value="2" {{$answer->answer == 2? "checked" : ""}}>
												<label class="form-check-label" for="radiob{{$i}}">No</label>
											</div>
										</td>
									@else
										<td>
											<input name="response[{{$answer->id}}]" value="{{($answer->answer!=-1)? $answer->answer : "";}}" class="form-control" type="text">
										</td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-right">
						<input type="hidden" name="medical_record_id" value="{{$completed_form->medical_record->id}}">
						<input type="hidden" id="patient_id" value="{{$completed_form->medical_record->patient->id}}">
			            <button type="submit" id="save" class="btn btn-primary bg-aquablue fw-bold">Editar</button>
			            <a href="{{ url()->previous() }}" class="btn btn-warning text-white">Cancelar</a>
			        </div>
				</form>	
			</div>

		</div>
		
	</div>
</div>

@endsection