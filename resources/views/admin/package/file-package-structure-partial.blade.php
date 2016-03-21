@foreach($packages as $package)
	<div>
	<input type="checkbox" name="packages[]" value={{$package["id"]}} class="package" data-package-name ="{{$package['package_name']}} "> {{$package["package_name"]}} 
	</div>
	{{-- @foreach ($package["documents"] as $doc)
	<ul>
		{{$doc->original_filename}}
	</ul>
	@endforeach --}}
	

@endforeach

