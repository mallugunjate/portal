@if(count($nav["children"]) >0 )
	<li> {{$nav["label"]}} 
	<ul>
	@foreach ($nav["children"] as $child)
	<?php $nav = $navigation[$child["child_id"]] ?>
	@include('admin.navigation-partial')
	@endforeach 
	</ul>
	</li>
@else
	<li>{{ $nav["label"] }} 
		<ul></ul>
	</li>
@endif
	

			
