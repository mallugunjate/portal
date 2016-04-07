
	<ul class="tree" id="navigation-structure">
		{!! csrf_field() !!}
		@foreach ($navigation as $nav) 
			
			@if ( isset($nav["is_child"]) && $nav["is_child"] == 0)
				
				@include('admin.navigation-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
				
			@endif

		@endforeach
	</ul>



