<!DOCTYPE html>
<html>

<head>
    @section('title', 'Create New Communication')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Communications</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <a href="/admin/communication">Communications</a>
                        </li>
                        <li class="active">
                        	<strong>Create New Communication</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Create a New Communication</h5>

		                            <div class="ibox-tools">

		                                <!-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> -->
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		{!! Form::open( ['action' => ['Communication\CommunicationAdminController@store'], 'method'=>'POST', 'class'=>'form-horizontal']) !!}
		

		<input type="hidden" name="banner_id" value={{$banner->id}} >

		<div class="form-group">
			<label class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value=""></div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
					<div class="btn-group" role="group" data-toggle="buttons">
					@foreach($communicationTypes as $ct)

					
					<label class="btn btn-outline btn-default">
						<input type="radio" id="" name="communication_type" value="{{ $ct->id }}"><i class="fa fa-circle {{ $ct->colour }}"></i> {{ $ct->communication_type }}
					</label>	

					@endforeach
					</div>
				</div>
		</div>

		


		<div>
			{!! Form::label('body', 'Body') !!}
			{!! Form::textarea('body', null, ['class'=> 'communication_body']) !!}
		</div>
<!-- 		<div>
			{!! Form::label('sender', 'Sender') !!}
			{!! Form::input('text', 'sender', null, ['class'=>'form-control']) !!}
		</div> -->
<!-- 		<div>
			{!! Form::label('importance', 'Importance') !!}
			{!! Form::select('importance', $importance, null,  ['class'=>'form-control']) !!}
		</div> -->

		<div>
			{!! Form::label('stores[]', 'Select Stores:') !!}
			<select name="stores[]" id="storeSelect"  multiple ="true" ></select>
			{!! Form::label('allStores', 'Or select all stores:') !!}
			{!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
		</div>
		
		<div>
			{!! Form::label('send_at', 'Send On') !!}
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('send_at', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
		</div>
		<div>
			{!! Form::label('archive_at', 'Archive On') !!}
			<div class="input-group date" id="datetimepicker1">
	          {!! Form::text('archive_at', null, ['class'=>'form-control',  'required']) !!}
	          <span class="input-group-addon">
	              <span class="glyphicon glyphicon-calendar"></span>
	          </span>      
	        </div>
		</div>

		<div>
			<div id="add-documents" class="btn btn-default">Add Documents</div>
		</div>

		<div>
			<div id="add-packages" class="btn btn-default">Add packages</div>		
		</div>

<!-- 		<div>
			{!! Form::label('tags[]', 'Tags:') !!}
			{!! Form::select('tags[]', $tags , null,  ['class'=>'chosen', 'multiple'=>'true']) !!}
			
		</div> -->



		<div id="files-selected"></div>
		<div id="packages-selected"></div>

		<div class="hr-line-dashed"></div>
		<div>
			<a class="btn btn-white" href="/admin/communication"><i class="fa fa-close"></i> Cancel</a>
			<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Send New Communication</button>
		</div>
		{!! Form::close() !!}




		                        </div>

		                    </div>
		                </div>
		            </div>


		        </div>




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

		

		<div id="package-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Packages</h4>
		            </div>
		            <div class="modal-body">
		                @include('admin.package.file-package-structure-partial', ['packages'=>$packages])
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" id = "attach-selected-packages">Select Packages</button>
		            </div>
		        </div>
		    </div>
		</div>


				@include('site.includes.footer')

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

				</script>

				<script type="text/javascript" src="/js/custom/communication.js"></script>

				@include('site.includes.bugreport')

			
				<script type="text/javascript" src="/js/custom/createpackage.js"></script>

				<script type="text/javascript" src="/js/vendor/moment.js"></script>
				<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
				<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
				<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

				<script type="text/javascript">
					$(".date").datetimepicker({
				          format: 'YYYY-MM-DD HH:mm:ss'
				    });

				    CKEDITOR.replace('body');
				    $("#add-documents").click(function(){
				    	$("#document-listing").modal('show');
				    });
				    $("#add-packages").click(function(){
				    	$("#package-listing").modal('show');	
				    });



				</script>

			</body>
			</html>
