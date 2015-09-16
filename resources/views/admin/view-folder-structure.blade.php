<p>Current Folder Structure</p>

<ul>
@foreach($folders as $folder)
	<li>{{ $folder->name }} ({{$folder->id}})
		<ul>
		@foreach($folderStruct as $fs)

			@if($fs->parent == $folder->id)
				<li>{{ $fs->child }}</li>
			@endif
		@endforeach
		</ul>
	</li>
@endforeach
</ul>