@extends('layouts.app')

@section('content')

<div class="p-4">
	<div class="container bg-white p-4 rounded shadow">
		<div class="row">
			<div class="col">
				<h5>Nombre: <span class="fw-bold">{{$patient->name}}</span></h5>
			</div>
		</div>
		<div class="row">
			<form class="row" id="sendOdontogram" method="POST" action="{{route('createodontogram')}}" enctype="multipart/form-data">
                @csrf
				<div class="col">
					<input id="name" class="form-control" type="text" name="name" placeholder="Nombre odontograma..." required>
				</div>
				<div class="col mx-5">
                	<input type="hidden" name="medical_record_id" value="{{$medical_record->id}}">
                	<a href="{{ url()->previous() }}" class="btn btn-warning text-white">Cancelar</a>
                    <button type="submit" class="btn btn-primary bg-aquablue">Guardar</button>
				</div>
			</form>
		</div>
      	<div class="row g-0 p-3">
			<div class="col-1">
				<button onclick="changeColor('#dc3545',this)" class="select-color w-50 btn btn-danger" disabled="true">&nbsp;</button><br>
				<button onclick="changeColor('#0d6efd',this)" class="select-color w-50 mt-2 btn btn-primary">&nbsp;</button><br>
				<button onclick="changeColor('#198754',this)" class="select-color w-50 mt-2 btn btn-success">&nbsp;</button><br>
				<button onclick="changeColor('#ffc107',this)" class="select-color w-50 mt-2 btn btn-warning text-white">&nbsp;</button><br>
				<button onclick="changeLetter('S',this)" class="change-letter w-50 mt-2 btn btn-secondary">S</button><br>
				<button onclick="changeLetter('FP',this)" class="change-letter w-50 mt-2 btn btn-secondary text-white">FP</button><br>
				<button onclick="changeLetter('N',this)" class="change-letter w-50 mt-2 btn btn-secondary text-white">N</button><br>
			</div>
			<div class="col">
				<canvas id="odontogram" width="100" height="100" style="width: 800px; height: 550px"></canvas>
			</div>
      		
    	</div>
	</div>
</div>

<script type="text/javascript">
	var canvas = $("#odontogram")[0];
	var ctx = canvas.getContext('2d');;
	var img = new Image();
	img.src = "{{asset('images/odontogram.png')}}";
	var color = "#dc3545";
	var letter;
	var onlyclick = false;

	var cw = canvas.width = 800,
	cx = cw / 2;
	var ch = canvas.height = 550,
	cy = ch / 2;

	var dibujar = false;
	ctx.lineJoin = "round";
	var puntos = [];
	ctx.lineJoin = "round";

	img.onload = function(){
        ctx.drawImage(img, 0, 0,img.width*0.6,img.height*0.6);
        img.style.display = 'none';
	}

	canvas.addEventListener('mousedown', function(evt) {
		dibujar = true;
		//ctx.clearRect(0, 0, cw, ch);
		puntos.length = 0;
		ctx.beginPath();
		onlyclick = true;

	}, false);


	canvas.addEventListener('mouseup', function(evt) {
		redibujarTrazado();

		if(letter!=null && onlyclick){
			ctx.beginPath();
			ctx.font = "30px Arial";
			ctx.fillStyle = color;
			var m = oMousePos(canvas, evt);
			ctx.fillText(letter, m.x, m.y);
		}
		
		onclyclick = false;

	}, false);

	canvas.addEventListener("mouseout", function(evt) {
		redibujarTrazado();
	}, false);

	canvas.addEventListener("mousemove", function(evt) {
		if (dibujar) {
			var m = oMousePos(canvas, evt);
			puntos.push(m);
			ctx.lineWidth = 4;
			ctx.strokeStyle = color;
			ctx.lineTo(m.x, m.y);
			ctx.stroke();
		}
		onlyclick = false;

	}, false);

	function calcularPuntoDeControl(a, b) {
		var pc = {}
		pc.x = (a.x + b.x) / 2;
		pc.y = (a.y + b.y) / 2;
		return pc;
	}


	function redibujarTrazado() {
		dibujar = false;
	}

	function oMousePos(canvas, evt) {
		var ClientRect = canvas.getBoundingClientRect();
		return { //objeto
			x: Math.round(evt.clientX - ClientRect.left),
			y: Math.round(evt.clientY - ClientRect.top)
		}
	}


	function changeColor(newColor,target){
		color = newColor;
		$('.select-color').prop('disabled',false);
		$(target).prop('disabled',true);

	}
	function changeLetter(newLetter,target){
		letter = newLetter;
		$('.change-letter').prop('disabled',false);
		$(target).prop('disabled',true);
	}

	$('#sendOdontogram').submit(function (e){
		e.preventDefault();
		var dataURL = canvas.toDataURL('image/png');
		var data = new FormData(e.target);
		data.append("imgBase64", dataURL);
		console.log(data);
		axios.post("{{route('createodontogram')}}", data)
		.then(function (response) {
		    console.log(response);
		})
		.catch(function (error) {
		    console.log(error);
		});
	});
	
</script>

@endsection