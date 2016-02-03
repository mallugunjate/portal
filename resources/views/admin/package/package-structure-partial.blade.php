
@if(count($packages)>0)
	@foreach($packages as $package)
		<div class="package_list_item">
		<input type="checkbox" class="package-checkbox" name = "feature_packages[]" value = {{$package["id"]}} data-packageid = {{$package["id"]}} data-packagename = "{{$package['package_screen_name']}}"  > {{$package["package_screen_name"]}} 
		</div>
	@endforeach
@endif