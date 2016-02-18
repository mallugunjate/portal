
@if(count($nav["children"]) >0 )
	<li class="parent-folder folder " id="folder{{$nav['id']}}" data-id="{{$nav['id']}}" data-isWeek = false>

		{{-- <a class="editFolder fa fa-pencil" href="/admin/folder/{{$nav['id']}}/edit" > --}}
		
		
			<div class="folder-name">
				{{$nav["label"]}}
			</div>
	 	<a class="modal-link" data-toggle="modal" data-remote="true" href="/admin/folder/{{$nav['id']}}/edit" data-target="#mmmm-modal">
	 		<i class=" fa fa-pencil"></i>
	 	</a>
		<ul>

		@foreach ($nav["children"] as $child)
		<?php $nav = $navigation[$child["child_id"]] ?>
		@include('admin.folderstructure.folderstructure-partial')
		@endforeach 

		</ul>
	</li>

@elseif ( isset($nav["weeks"]) && count($nav["weeks"] > 0) )
	<li class="parent-folder folder " id="folder{{$nav['id']}}" data-id="{{$nav['id']}}" data-isWeek="false"> 
		{{-- <a class="editFolder fa fa-pencil" href="/admin/folder/{{$nav['id']}}/edit" > --}}
		
		
		<div class="folder-name">
			{{$nav["label"]}}
		</div>
		<a class="modal-link" data-toggle="modal" data-remote="true" href="/admin/folder/{{$nav['id']}}/edit" data-target="#mmmm-modal">
			<i class="fa fa-pencil"></i>
		</a>
		

		<ul>
			@foreach ($nav["weeks"]  as $week )
			<li class="folder" id ="folder{{$week['week_id']}}" data-id="{{$week['week_id']}}" data-isWeek="true"> 
				<ul class="folder-name">
					{{ "Week " . $week["week"] }}
				</ul>
			</li>
			@endforeach
		</ul>
	</li>	
	

@else
	<li class="parent-folder folder " id="folder{{$nav['id']}}" data-id="{{$nav['id']}}" data-isWeek="false">
		{{-- <a class="editFolder fa fa-pencil" href="/admin/folder/{{$nav['id']}}/edit" > --}}
		
		
		<div class="folder-name"> 
			{{$nav["label"]}}
		</div>
		
		<a class="modal-link" data-toggle="modal" data-remote="true" href="/admin/folder/{{$nav['id']}}/edit" data-target="#mmmm-modal">
			<i class=" fa fa-pencil"></i>
		</a>
		<ul></ul>
	</li>
@endif