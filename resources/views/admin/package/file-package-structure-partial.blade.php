@foreach($packages as $package)
	<input type="checkbox" name="packages[]" value={{$package["id"]}} class="package" data-package-name ="{{$package["package_screen_name"]}} "> {{$package["package_screen_name"]}} 
	@foreach ($package["documents"] as $doc)
	<ul>
		{{$doc->original_filename}}
	</ul>
	@endforeach
	

@endforeach

