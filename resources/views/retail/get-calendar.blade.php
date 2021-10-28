
<script type="text/javascript">
$('#tab-calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listWeek'
					},
					defaultDate: new Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					events: [
						@php
							$events = get_calendar_events(Auth::user()->id);
						@endphp
					
					@if(Auth::check() && !empty( $events ) && count($events) > 0)
						@foreach($events as $key)
						{
							title: '{{$key->title}}',
							start: '{{$key->datetime}}',
						},
						@endforeach
					@endif
			
					]
				});
</script>