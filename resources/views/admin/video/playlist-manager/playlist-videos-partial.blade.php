@if(isset($videos) && count($videos)>0)
<table class="table table-hover playlist-videos-table  ">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

        @foreach($videos as $video)

        <tr class="playlist-videos">
            <td data-video-id="{{$video->id}}" > {{$video->title}} </td>
            <td></td>
            <td> <a data-video-id="{{$video->id}}" id="file{{$video->id}}" class="remove-video btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>

        @endforeach
	</tbody>

</table>
@else
<table class="table table-hover playlist-videos-table hidden">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif