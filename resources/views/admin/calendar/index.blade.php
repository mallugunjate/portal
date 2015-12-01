
<h1>Events</h1>

<a href="">add new event</a>


<table>

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
	<td><a href="/admin/calendar/delete/{{ $event->id }}">delete</a></td>
</tr>
@endforeach

</table>

{!! $events->render() !!}