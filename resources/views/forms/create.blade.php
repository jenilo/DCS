@extends('layouts.app')

@section('content')

<div class="container p-2">
    <div class="row g-0">
        <div class="col-md-8 col-12 my-auto">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{$form->name}}
            </h2>
        </div>
    </div>
    {{--<div class="row g-0">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
            {{$errors}}
        @endif
        @if(isset($answertypes))
            <p>no vacio</p>
            {{$answertypes}}
        @endif
    </div>--}}
    <div class="row g-0">
        <div class="col-lg-12">
            <form method="POST" action="{{url('patients')}}" enctype="multipart/form-data">
                @csrf
                {{--<div class="mb-3 row">
                    <div class="row"></div>
                    <label for="name" class="col-sm-8 col-form-label">Pregunta: </label>
                    <label for="answer_type_id" class="col-sm-4 col-form-label">Tipo:</label>
                    <div class="row form-group">
                        <div class="col-sm-8">
                            <input type="text" class="col-sm-8 form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" required>
                             @error('name')
                                <span class="invalid-feedback">{{$errors->first('question')}}</span>
                             @enderror
                        </div>
                        <div class="col-sm-4">
                            <select class="col-sm-4 form-control" name="answer_type_id" id="answer_type_id">
                                <option selected disabled>Elegir</option>
                                @foreach($answertypes as $answerType)
                                    <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                                @endforeach
                             </select>
                        </div>
                         
                    </div>
                </div>--}}


                <div class="mb-3 row" id="row1">
                    <div class="col-md-6">
                        <label for="name" class="col-md-8 col-form-label">Pregunta: </label>
                        <textarea class="form-control" rows="2" name="question"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label for="answer_type_id" class="col-md-4 col-form-label">Tipo:</label>
                        <select class="col-md-4 form-control" name="answer_type_id" id="answer_type_id">
                            <option selected disabled>Elegir</option>
                            @foreach($answertypes as $answerType)
                                <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                            @endforeach
                         </select>
                    </div>
                    <div class="col-sm-4 my-auto">
                        <button id="add" type="button" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</button>
                    </div>
                </div>

                <div id="dynamic_field">
                    
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-warning">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){  
        var i=1;  
        $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append(`<div class="mb-3 row" id="row`+i+`">
                    <div class="col-md-6">
                        <label for="name" class="col-md-8 col-form-label">Pregunta: </label>
                        <textarea class="form-control" rows="2" name="question"></textarea>
                    </div>
                    <div class="col-md-2">
                        <label for="answer_type_id" class="col-md-4 col-form-label">Tipo:</label>
                        <select class="col-md-4 form-control" name="answer_type_id" id="answer_type_id">
                            <option selected disabled>Elegir</option>
                            @foreach($answertypes as $answerType)
                                <option value="{{$answerType->id}}">{{$answerType->answerType}}</option>
                            @endforeach
                         </select>
                    </div>
                    <div class="col-sm-4 my-auto">
                        <button type="button" name="remove" id="`+i+`" class="btn btn-danger btn_remove"><i class="fas fa-minus"></i></button>
                    </div>
                </div>`);  
        });  
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
        });  
    });  
</script>

@endsection