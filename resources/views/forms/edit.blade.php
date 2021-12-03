@extends('layouts.app')

@section('content')


<div class="p-4">
    <div class="container bg-white p-4 rounded shadow">
        <div class="row g-0">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0 fw-bold">
                {{$form->name}}
            </h2>
        </div>
        
        <div class="row g-0">
            <div class="col-lg-12">
                <form method="POST" action="{{url('questions/edit')}}" id="form_questions" enctype="multipart/form-data">
                    @csrf
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th scope="col">Pregunta</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">
                                        <!--<button id="add" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</button>-->
                                        <button id="add" type="button" class="btn btn-primary bg-aquablue bg-white text-aquablue fw-bold rounded-pill"><i class="fas fa-plus"></i>&nbsp Añadir</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="dynamic_field">
                                @foreach($questions[0]->questions as $question)
                                    <tr id="{{$loop->iteration}}">
                                        <td><textarea class="form-control" rows="2" id="question0" name="inputs[{{$loop->iteration-1}}][question]" required>{{$question->question}}</textarea>
                                        </td>
                                        <td>
                                            <select class="col-md-4 form-control" id="answer_type_id0" name="inputs[{{$loop->iteration-1}}][answer_type_id]" id="answer_type_id" required>
                                            @foreach($answertypes as $answerType)
                                                <option value="{{$answerType->id}}"{{ ($question->answer_type_id == $answerType->id) ? 'selected' : '' ;}}>{{$answerType->answerType}}</option>
                                            @endforeach
                                            </select>
                                            <input type="hidden" name="inputs[{{$loop->iteration-1}}][id]" value="{{$question->id}}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger bg-white text-danger fw-bold" onclick="deleteRecord('{{$question->id}}','{{url('questions')}}','{{$loop->iteration}}')"><i class="fas fa-minus"></i> Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" name="form_id" value="{{$form->id}}">
                        
                    
                    <div class="text-right">
                        <button type="submit" id="save" class="btn btn-primary bg-aquablue text-white fw-bold">Guardar</button>
                        <!--<button type="button" class="btn btn-warning text-white">Cancel</button>-->
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script src="{{URL::asset('js/deleteRecord.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){  
        var i = {{count($questions[0]->questions)}};  
        $('#add').click(function(){

                $('#dynamic_field').append(`<tr id="row`+i+`">
                    <td><textarea class="form-control" rows="2" id="question0" name="inputs[`+i+`][question]" required></textarea></td>
                    <td><select class="col-md-4 form-control" id="answer_type_id0" name="inputs[`+i+`][answer_type_id]" id="answer_type_id" required>
                        <option selected disabled>Elegir</option>
                        @foreach($answertypes as $answerType)
                            <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                        @endforeach
                    </select></td>
                    <input type="hidden" name="inputs[`+i+`][id]" value="-1">
                    <td><button id="`+i+`" type="button" name="remove" class="btn btn-danger btn_remove"><i class="fas fa-minus"></i></button</td>
                </tr>`);

           i++;
        });  

        $(document).on('click', '.btn_remove', function(){  
            console.log("entre?");
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
        });

        $('#form_questions').on('submit', function(event){
            event.preventDefault();

            $.ajax({
                url:'{{ url("questions/edit") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#save').attr('disabled','disabled');
                },
            }).done(function(data){
                //console.log(data);
                //errors(data);
                //$('#save').attr('disabled', false);
                Swal.fire({
                    title: data.short,
                    text: data.message,
                    type: "success"
                }).then(function() {
                    window.location.href = "{{route('forms')}}";
                });
            });

        }); 

        function errors(data){
            $.each( data, function( key, value ) {
                var id = key.split('inputs.').pop()[0];
                var type = key.split('.').pop().split('.')[0];

                $('#'+type+id).addClass("is-invalid");
                $('#span.'+type+id).text("");
                //console.log($('#span'+type+id));
            });
        }


    });
</script>

@endsection