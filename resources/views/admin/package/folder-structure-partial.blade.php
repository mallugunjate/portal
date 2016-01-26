@if(count($folder["children"]) >0 )
	<li id={{$folder["id"]}} class="parent-folder"> <input type="checkbox"> {{$folder["label"]}} 
	<ul>
	@foreach ($folder["children"] as $child)
	<?php $folder = $folderStructure[$child["child_id"]] ?>
	@include('admin.package.folder-structure-partial')
	@endforeach 

	</ul>
	</li>

@elseif ( isset($folder["weeks"]) && count($folder["weeks"] > 0) )
	<li id={{$folder["id"]}} class="parent-folder"> {{$folder["label"]}} 
		<ul>
			@foreach ($folder["weeks"]  as $week )
			<li class="folder" id = {{$week["global_id"]}}  data-isWeek = true><input type="checkbox"> {{ "week " . $week["week"] }}
				<!-- @if(isset($folderStructure[$week["global_id"]]["documents"]))
					@foreach($folderStructure[$week["global_id"]]["documents"] as $doc)
						<br>
						<input type="checkbox" name="package_files[]" value={{$doc->id}} data-filename={{$doc->filename}}> {{$doc->original_filename}}
					@endforeach
				@endif -->
			</li>
			@endforeach
		</ul>
	</li>	
	

@else
	<li class="folder" id={{$folder["id"]}} data-isWeek = false> <input type="checkbox"> {{ $folder["label"] }}	 	
		<!-- @if(isset($nav["documents"]))
			@foreach($nav["documents"] as $doc)
				<br>
				<input type="checkbox" name="package_files[]" value= {{$doc->id}} data-filename={{$doc->filename}}>  {{$doc->original_filename}}
			@endforeach
		@endif -->
		<ul>
		</ul>
	</li>
@endif		