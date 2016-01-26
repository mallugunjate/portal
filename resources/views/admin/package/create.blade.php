<html>
<head>
	<title></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
</head>
<body class="container-fluid">
	<!-- navbar begins -->
	<nav class="navbar navbar-default">
	    @include('admin.banner', ['banners' => $banners])
	    
	  </nav>
	<!-- navbar ends-->
	<div class="col-md-10 col-md-offset-1">
		
		{!! Form::open( ['action' => ['Document\PackageAdminController@store'], 'method'=>'POST']) !!}
		<input type="hidden" name="banner_id" value="{{$banner->id}}">
		<h3>Create Package</h3> 
		<div>
			Package Name: <input type="text" name="package_name" >
		</div>
		<!-- <div>
			Start :
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('start', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
        </div>
        <div>
			End :
			<div class="input-group date" id="datetimepicker2">
	          {!! Form::text('end', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
        </div>


        <div>
        	Package hidden from store : <input type="checkbox" value=1 name="is_hidden">
        </div>

        <div>
        	{!! Form::label('tags[]', 'Tags') !!}
        	{!! Form::select('tags[]', $tags, null , ['class'=>'chosen', 'multiple'=>'true']) !!}
        </div> -->

        <div>
			
			<div id="document-listing" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title">Select Documents</h4>
			            </div>
			            <div class="modal-body">
			            	@foreach ($navigation as $nav) 
							
								@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
									
									@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
									
								@endif

							@endforeach
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                <button type="button" class="btn btn-primary" id="attach-selected-files">Select Documents</button>
			            </div>
			        </div>
			    </div>
			</div>

			<div id="folder-listing" class="modal fade">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title">Select Folders</h4>
			            </div>
			            <div class="modal-body">
			            	@foreach ($folderStructure as $folder)
							
								@if (isset($folder["is_child"]) && ($folder["is_child"] == 0) )
									
									@include('admin.package.folder-structure-partial', ['folderStructure' =>$folderStructure, 'currentnode' => $folder])
									
								@endif


							@endforeach
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                <button type="button" class="btn btn-primary" id="attach-selected-files">Select Folders</button>
			            </div>
			        </div>
			    </div>
			</div>
			

			<input class="btn btn-default" type="button" id="add-documents" value="Add Documents" />
			<input class="btn btn-default" type="button" id="add-folders" value="Add Folders" />
			<div id="files-selected">
					

			</div>
		
		</div>
		
		<button type="submit"> Create Package</button>
		{!! Form::close() !!}
	</div>


<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/custom/createpackage.js"></script>
<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
<script type="text/javascript" src="/js/vendor/moment.js"></script>
<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
	$(".date").datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss'
    });

</script>
</body>
</html>
