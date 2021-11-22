@extends('layouts.app')

@section('content')


<div class="p-4">
    <div class="container bg-white p-4 rounded shadow">
        <div class="row g-0">
            <div id="calendar">
      		</div>
        </div>
    </div>
</div>


{{--<div class="p-2">

	<div class="container">
      	<div id="calendar">
      		
      	</div>
      	
		
	</div>
</div>--}}

@include('modals.modalShowAppointment')

@endsection