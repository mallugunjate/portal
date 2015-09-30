<html>

<head>
    <title>Update Meta Data</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/js/submitmetadata.js"></script>    
    <style>
    .glyphicon-ok{
    	color: #0c0; 
    	font-size: 14px; 
    	display: none;
    }
    </style>
</head>

<body>

	edit the meta data for the files just uploaded<Br />

	@foreach($documents as $doc)
			
			
			<form id="metadataform{{ $doc->id }}">
				<label>{{ $doc->original_filename }}</label><br />
				<input type="hidden" name="file_id" value="{{ $doc->id }}">
				<label>Title</label><input type="text" name="title{{ $doc->id }}" id="title{{ $doc->id }}">
				<label>Description</label><input type="text" name="description{{ $doc->id }}" id="description{{ $doc->id }}">
				<button type="submit" class="meta-data-add" data-id="{{ $doc->id }}">Save</button>
				<span class="glyphicon glyphicon-ok" id="checkmark{{ $doc->id }}" aria-hidden="true"></span>
			</form>


	@endforeach

</body>

</html>