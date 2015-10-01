
<p>Current Folder Structure</p>
<ul class="tree">
@foreach ($navigation as $nav) 
	
	@if ( $nav["is_child"] == 0)
		
		@include('admin.navigation-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
		
	@endif


@endforeach
</ul>


