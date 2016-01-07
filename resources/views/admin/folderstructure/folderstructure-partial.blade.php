
@if(count($nav["children"]) >0 )
	<div class="folder" id={{$nav["id"]}} data-isWeek = false>
	
		<a class="editFolder fa fa-pencil" href="/admin/folder/{{$nav['id']}}/edit" >
	
			<div class="folder-name">
				{{$nav["label"]}} 
			</div>
	 	</a>
		<ul>

		@foreach ($nav["children"] as $child)
		<?php $nav = $navigation[$child["child_id"]] ?>
		@include('admin.folderstructure-partial')
		@endforeach 

		</ul>
	</div>

@elseif ( isset($nav["weeks"]) && count($nav["weeks"] > 0) )
	<div class="folder" id={{$nav["id"]}} data-isWeek = false> 
		<a class="editFolder fa fa-pencil" href="/admin/folder/{{$nav['id']}}/edit" >
			<div class="folder-name">
				{{$nav["label"]}} 
			</div>
		</a>
		<!-- <a class="deleteFolder" href="" data-folder-id={{$nav["id"]}} >Delete</a> -->

		<div>
			@foreach ($nav["weeks"]  as $week )
			<ul class="folder" id = {{$week["week_id"]}}  data-isWeek = true> 
				<div class="fa folder-name">
					{{ "Week " . $week["week"] }}
				</div>
			</ul>
			@endforeach
		</div>
	</div>	
	

@else
	<div class="folder" id={{$nav["id"]}} data-isWeek = false>
		<a class="editFolder fa fa-pencil" href="/admin/folder/{{$nav['id']}}/edit" >
		<div class="folder-name"> 
			{{$nav["label"]}}
		</div>
		</a>
		<!-- <a class="btn btn-default deleteFolder" data-folderId="{{$nav['id']}}">Delete</a> -->
	</div>
@endif
	

			
