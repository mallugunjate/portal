<div>
	<ul class="package_list">
	@foreach($packages as $package)
		<li class="package" id="{{$package->id}}">{{$package->package_screen_name}}</li>
	@endforeach
	</ul>
</div>
