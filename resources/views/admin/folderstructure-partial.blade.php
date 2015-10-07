
@if(count($nav["children"]) >0 )
	<li id={{$nav["id"]}}> {{$nav["label"]}} 
	<a class="btn btn-default editFolder" href="/admin/folder/{{$nav['id']}}/edit" >Edit</a> 
	<!-- <a class="btn btn-default deleteFolder" data-folderId="{{$nav['id']}}">Delete</a> -->
	<ul>

	@foreach ($nav["children"] as $child)
	<?php $nav = $navigation[$child["child_id"]] ?>
	@include('admin.folderstructure-partial')
	@endforeach 

	</ul>
	</li>

@elseif ( isset($nav["weeks"]) && count($nav["weeks"] > 0) )
	<li id={{$nav["id"]}}> {{$nav["label"]}} 
		<!-- <a class="deleteFolder" href="" data-folder-id={{$nav["id"]}} >Delete</a> -->
		<a class="btn btn-default editFolder" href="/admin/folder/{{$nav['id']}}/edit" >Edit</a>

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
		<a class="btn btn-default editFolder" href="/admin/folder/{{$nav['id']}}/edit" >Edit</a>
		<a class="btn btn-default deleteFolder" data-folderId="{{$nav['id']}}">Delete</a>
		<ul>		
		</ul>
	</li>
@endif
	

			
