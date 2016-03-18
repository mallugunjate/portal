@if(count($folder["children"]) >0 )
	
	<li id={{$folder["global_folder_id"]}} class="parent-folder folder folder-item">
		{{$folder["label"]}} 
	<ul>
	@foreach ($folder["children"] as $child)
		<?php  $folder = $folderstructure[$child['child_id']]; ?>
		@include('site.feature.folder-structure-partial')
	@endforeach 

	</ul>
	</li>

@elseif ( isset($folder["weeks"]) && count($folder["weeks"] > 0) )
	<li id={{$folder["global_folder_id"]}} class="parent-folder folder folder-item">
		{{$folder["label"]}} 
		<ul>
			@foreach ($folder["weeks"]  as $week )
			<li class="folder parent-folder folder" id = {{$week["global_id"]}}  data-isWeek = true>
				{{ "Week " . $week["week"] }}
			</li>
			@endforeach
		</ul>
	</li>	
	

@else
	<li class="parent-folder folder folder-item" id={{$folder["global_folder_id"]}} data-isWeek = false>
		{{ $folder["label"] }}
		<ul>
		</ul>
	</li>
@endif		