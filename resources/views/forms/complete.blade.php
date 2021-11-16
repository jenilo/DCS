@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
      	<div class="row g-0">
      		<h5>{{$form->name}}</h5>
      		<h6>Paciente: {{$medical_record->patient->name}}</h6>
      		{{$medical_record}}
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
					<form action="{{route('createcompleteform')}}" method="POST" id="form_complete">
					@csrf
					<tbody>
						
						@foreach($form->questions as $question)
							<tr>
								<td>{{$question->question}}</td>
								@if($question->answer_type_id == \App\Enums\ResponseType::YesOrNo)
									<td>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="response[{{$question->id}}]" id="inlineRadio1" value="1">
											<label class="form-check-label" for="inlineRadio1">Si</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="response[{{$question->id}}]" id="inlineRadio2" value="2">
											<label class="form-check-label" for="inlineRadio2">No</label>
										</div>
									</td>
								@else
									<td>
										<input name="response[{{$question->id}}]" class="form-control" type="text">
									</td>
								@endif
							</tr>
						@endforeach
						<input type="hidden" name="form_id" value="{{$medical_record->id}}">
						<input type="hidden" name="medical_record_id" value="{{$form->id}}">
					</tbody>
					<tfoot colspan="3">
						<div class="text-right">
		                    <button type="submit" id="save" class="btn btn-primary">Save</button>
		                    <button type="button" class="btn btn-warning">Cancel</button>
		                </div>
					</tfoot>
					</form>
				</table>
			</div>

		</div>
		
	</div>
</div>

{{--<script>
	$('#form_complete').on('submit', function(event){
		//event.preventDefault();
		//console.log(JSON.parse($(this).serialize()));
	});
</script>--}}

@endsection