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
                <form method="POST" action="{{url('questions')}}" id="form_questions" enctype="multipart/form-data">
                    @csrf
                    <div id="dynamic_field">
                        <div class="mb-3 row" id="row0">
                            <div class="col-md-6">
                                <label for="name" class="col-md-8 col-form-label fw-bold">Pregunta: </label>
                                <textarea class="form-control" rows="1" id="question0" name="inputs[0][question]" required></textarea>
                                <span id="spanquestion0`" class="invalid-feedback"> </span>
                            </div>
                            <div class="col-md-2">
                                <label for="answer_type_id" class="col-md-4 col-form-label fw-bold">Tipo:</label>
                                <select class="col-md-4 form-control" id="answer_type_id0" name="inputs[0][answer_type_id]" id="answer_type_id" required>
                                    <option selected disabled>Elegir</option>
                                    @foreach($answertypes as $answerType)
                                        <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                                    @endforeach
                                 </select>
                                 <span id="spananswer_type_id0`" class="invalid-feedback"> </span>
                                 <input type="hidden" name="inputs[0][form_id]" value="{{$form->id}}">
                            </div>
                            <div class="col-sm-4 my-auto mb-0">
                                <button id="add" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</button>
                            </div>
                        </div>

                    
                        
                    </div>
                    
                    <div class="text-right mr-3">
                        <button type="submit" id="save" class="btn btn-primary bg-aquablue fw-bold">Guardar</button>
                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
    {{--<div class="row g-0">
        <div class="col-md-8 col-12 my-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{$form->name}}
            </h2>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-12">
            <form method="POST" action="{{url('questions')}}" id="form_questions" enctype="multipart/form-data">
                @csrf
                <div id="dynamic_field">
                    <div class="mb-3 row" id="row0">
                        <div class="col-md-6">
                            <label for="name" class="col-md-8 col-form-label">Pregunta: </label>
                            <textarea class="form-control" rows="2" id="question0" name="inputs[0][question]" required></textarea>
                            <span id="spanquestion0`" class="invalid-feedback"> </span>
                        </div>
                        <div class="col-md-2">
                            <label for="answer_type_id" class="col-md-4 col-form-label">Tipo:</label>
                            <select class="col-md-4 form-control" id="answer_type_id0" name="inputs[0][answer_type_id]" id="answer_type_id" required>
                                <option selected disabled>Elegir</option>
                                @foreach($answertypes as $answerType)
                                    <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                                @endforeach
                             </select>
                             <span id="spananswer_type_id0`" class="invalid-feedback"> </span>
                             <input type="hidden" name="inputs[0][form_id]" value="{{$form->id}}">
                        </div>
                        <div class="col-sm-4 my-auto">
                            <button id="add" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</button>
                        </div>
                    </div>

                
                    
                </div>
                
                <div class="text-right">
                    <button type="submit" id="save" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-warning">Cancel</button>
                </div>
            </form>
        </div>
    </div>--}}
</div>

<script type="text/javascript">
    $(document).ready(function(){  
        var i=1;  
        $('#add').click(function(){    
           $('#dynamic_field').append(`<div class="mb-3 row" id="row`+i+`">
                    <div class="col-md-6">
                        <label for="name" class="col-md-8 col-form-label">Pregunta: </label>
                        <textarea class="form-control" rows="1" id="question`+i+`" name="inputs[`+i+`][question]" required></textarea>
                        <span id="spanquestion`+i+`" class="invalid-feedback"> </span>
                    </div>
                    <div class="col-md-2">
                        <label for="answer_type_id" class="col-md-4 col-form-label">Tipo:</label>
                        <select class="col-md-4 form-control" name="inputs.`+i+`.answer_type_id" id="answer_type_id`+i+`" required>
                            <option selected disabled>Elegir</option>
                            @foreach($answertypes as $answerType)
                                <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                            @endforeach
                         </select>
                         <span id="spananswer_type_id`+i+`" class="invalid-feedback"> </span>
                    </div>
                    <div class="col-sm-4 my-auto">
                        <button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove"><i class="fas fa-minus"></i></button>
                    </div>
                </div>`);  
           i++;
        });  
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
        });

        $('#form_questions').on('submit', function(event){
            event.preventDefault();

            $.ajax({
                url:'{{ url("questions") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#save').attr('disabled','disabled');
                },
            }).done(function(data){
                console.log(data);
                errors(data);
                $('#save').attr('disabled', false);
            });

        }); 

        function errors(data){
            $.each( data, function( key, value ) {
                var id = key.split('inputs.').pop()[0];
                var type = key.split('.').pop().split('.')[0];
                //console.log(id);
                //console.log('#'+type+id);

                $('#'+type+id).addClass("is-invalid");
                $('#span.'+type+id).text("Hola");
                console.log($('#span'+type+id));
                //console.log($('#'+type+id));
            });
        }

    });  
</script>

@endsection