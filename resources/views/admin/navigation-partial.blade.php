@if(count($nav["children"]) >0 )
	<li id={{$nav["id"]}}> {{$nav["label"]}} 
	<ul>
	@foreach ($nav["children"] as $child)
	<?php $nav = $navigation[$child["child_id"]] ?>
	@include('admin.navigation-partial')
	@endforeach 

	</ul>
	</li>

@elseif ( isset($nav["weeks"]) && count($nav["weeks"] > 0) )
	<li id={{$nav["id"]}}> {{$nav["label"]}} 
		<ul>
			@foreach ($nav["weeks"]  as $week )
			<li class="folder" id = {{$week["week_id"]}}  data-isWeek = true> {{ "week " . $week["week"] }}
				<ul>
				</ul>
			</li>
			@endforeach
		</ul>
	</li>	
	

@else
	<li class="folder" id={{$nav["id"]}} data-isWeek = false>{{ $nav["label"] }}	 	
		<ul>
		</ul>
	</li>
@endif
	

			
