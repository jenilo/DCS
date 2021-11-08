document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = $('#calendar')[0];

	var today = moment().format("YYYY-MM-DD");

	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		/*visibleRange: {
			start: today
			//start: '2021-11-02'
		},*/
		//hiddenDays: [7],
		locale:'es',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,listWeek'
		},
		events: 'http://127.0.0.1:8000/appointments/all',

		/*dayRender: function(date, cell){
			console.log(date);
			if (date < today) {
				$(cell).addClass('disabled');
			}
		},*/
		/*validRange: {
		    	start: today,
		},*/
		fixedWeekCount: false,
		
		navLinks: true,
		/*dayCellContent: function (arg){
			console.log(arg);
		},*/
		dayMaxEventRows: true,
		dayMaxEvents: true, // for all non-TimeGrid views
		views: {
			timeGrid: {
				dayMaxEventRows: 5, // adjust to 6 only for timeGridWeek/timeGridDay
				dayMaxEvents: 5
			}
		},
		dateClick: function (info){
			//console.log(info);

			if (moment().isSame(info.dateStr,'day') || moment(info.dateStr).isAfter(moment()))
				window.location.href = '/appointments/create/'+info.dateStr;
		},
		eventClick: function (params){
			console.log(params);
			axios.get('http://127.0.0.1:8000/appointments/show/'+params.event.id).then(function (response) {
                console.log(response.data);
                showAppointment(response.data);
            })
            .catch(function (error) {
                console.log(error);
                swal("Error!",{icon: "error"});
            });
			$('#showAppointmentModal').modal('show');
		}

	});
	calendar.render();

	function showAppointment(data){
		console.log(data.name);
		$('#name_patient').text(data.name);
		$('#dateBirth').text(data.dateBirth);
		$('#age').text(moment().diff(data.dateBirth,'years')+" años");
		$('#phone').text(data.phone);

		$('#employment').text((data.employment)? data.employment: "No especificado");
		//$('#dateAppointment').text(data.date);
		$('#timeAppointment').text(moment(data.date+" "+data.timeStart).format("hh:mm A"));
		$('#treatment').text(data.treatment_name);
		$('#notes').text(data.notes);
		//moment.locale('es');
		//console.log(moment().diff('2021-11-06','days'));
		/*console.log(moment());
		console.log(moment().isAfter(data.date)+"es despues");
		console.log(moment().isBefore(data.date)+"es antes");
		console.log(moment().isAfter('2021-11-06')+"es igual");
		console.log(moment().isBefore('2021-11-06')+"es igual");
		console.log(moment().diff('2021-11-04','days')+" diferencia");*/

		//console.log(moment('2021-11-05').diff(moment(),'days'));

		$('#dateAppointment').text(moment(data.date).format("dddd, MMMM Do YYYY"));

		var now = moment().format("YYYY-MM-DD H:mm");
		var momentAppointment = moment(data.date+' '+data.timeStart).format("YYYY-MM-DD H:mm");

		var diff = moment(now).diff(moment(momentAppointment), 'seconds');

		if(diff > 0){
			console.log(moment(momentAppointment).fromNow());
			$('#relativeTime').text(moment(momentAppointment).fromNow());
		}
		else if(diff < 0){
			console.log(moment(momentAppointment).toNow());
			$('#relativeTime').text(moment(momentAppointment).toNow());
		}
		else{
			$('#relativeTime').text("Now");
			console.log("Ahora");
		}


		/*if (moment().isSame(data.date,'day')) {
			console.log("Si es igual");
			var now = moment().format("YYYY-MM-DD H:mm");
			var momentAppointment = moment('2040-11-08'+' '+data.timeStart).format("YYYY-MM-DD H:mm");
			console.log(now + " - " + momentAppointment);

			var diff = moment(now).diff(moment(momentAppointment), 'seconds');

			if(diff > 0)
				console.log(moment(momentAppointment).fromNow());
			else if(diff < 0)
				console.log(moment(momentAppointment).toNow());
			
			console.log(diff);
			 //momentAppointment.diff(n);
			/*var v = moment(momentAppointment).diff(n,'seconds');
			console.log(v);*/
			//moment(n).diff(momentAppointment,'seconds');

			
			//console.log(n.diff(momentAppointment,'seconds'));
			//console.log(moment(data.date+' '+data.timeStart).format("hh:mm:ss A")); // 1:00:00 PM
		//}
		/*else if (moment(data.date).isAfter(moment())){
			console.log("Es despues");
			//console.log(moment(data.date).toNow());
			$('#relativeDate').text(moment(data.date).toNow());
		}
		else if(moment(data.date).isBefore(moment())){
			console.log("Es antes");
			$('#relativeDate').text(moment(data.date).fromNow());
			//console.log(moment(data.date).fromNow());
		}*/
	}
});