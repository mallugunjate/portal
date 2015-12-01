
<h1>Events</h1>

<a href="">add new event</a>


<table>
<meta name="csrf-token" content="{!! csrf_token() !!}"/>
<tr>
	<td>id</td>
	<td>title</td>
	<td>desc</td>
	<td>start</td>
	<td>end</td>
</tr>
@foreach($events as $event)
<tr>
	<td>{{ $event->id }}</td>
	<td>{{ $event->title }}</td>
	<td>{{ $event->description }}</td>
	<td>{{ $event->start }}</td>
	<td>{{ $event->end }}</td>

	<td><a href="/admin/calendar/show/{{ $event->id }}">view</a></td>
	<td><a href="/admin/calendar/edit/{{ $event->id }}">edit</a></td>
	<td><span data-event="{{ $event->id }}" id="event{{$event->id}}" class="pull-right event-delete btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</span></td>
</tr>
@endforeach

</table>


{!! $events->render() !!}

<script src="/js/jquery-2.1.1.min.js"></script>

<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
</script>

<script src="/js/custom/deleteEvent.js"></script>