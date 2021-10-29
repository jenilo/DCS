
document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = $('#calendar')[0];
	var calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		locale:'es',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,listWeek'
		},

	});
	calendar.render();
});