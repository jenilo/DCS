@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<h5>{{$completed_form->form->name}}</h5>
      		<h6>Paciente: {{$completed_form->medical_record->patient->name}}</h6>
      		{{$completed_form}}
      	</div>
      	<div class="row no-gutters">
			<div class="col p-3">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Pregunta</th>
							<th>Respuesta</th>
							<th></th>
						</tr>	
					</thead>
					<form action="{{route('updatecompleteform')}}" method="POST" id="form_complete">
					@csrf
					<tbody>
						
						@foreach($completed_form->answers as $answer)
							<tr>
								<td>{{$answer->question->question}}</td>
								@if($answer->question->answer_type_id == \App\Enums\ResponseType::YesOrNo)
									<td>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="response[{{$answer->id}}]" id="inlineRadio1" value="1" {{$answer->answer == 1? "checked" : ""}}>
											<label class="form-check-label" for="inlineRadio1">Si</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="response[{{$answer->id}}]" id="inlineRadio2" value="2" {{$answer->answer == 2? "checked" : ""}}>
											<label class="form-check-label" for="inlineRadio2">No</label>
										</div>
									</td>
								@else
									<td>
										<input name="response[{{$answer->id}}]" value="{{$answer->answer}}" class="form-control" type="text">
									</td>
								@endif
							</tr>
						@endforeach
						<input type="hidden" name="medical_record_id" value="{{$completed_form->medical_record->id}}">
					</tbody>
					<tfoot colspan="3">
						<div class="text-right">
		                    <button type="submit" id="save" class="btn btn-primary">Editar</button>
		                    <a href="{{ url()->previous() }}" class="btn btn-warning">Cancel</a>
		                </div>
					</tfoot>
					</form>
				</table>
			</div>

		</div>
		
	</div>
</div>

@endsection