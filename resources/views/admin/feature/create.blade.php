<!DOCTYPE html>
<html>

<head>
    @section('title', 'Features')
    @include('admin.includes.head')

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
                    <h2>Features</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/feature">Features</a>
                        </li>
                        <li class="active">
                            <strong>Create a New Feature</strong>
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
		                            <h5>Create a New Feature</h5>

		                            <div class="ibox-tools">

		                                
		                            </div>
		                        </div>
		                        <div class="ibox-content">
		                        	<form method="get" class="form-horizontal" id="createNewFeatureForm">
                                        
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">
                                        <div class="form-group"><label class="col-sm-2 control-label">Feature Title</label>
                                            <div class="col-sm-10"><input type="text" id="feature_title" name="feature_title" class="form-control" value=""></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Tile Label</label>
                                            <div class="col-sm-10"><input type="text" id="tile_label" name="tile_label" class="form-control" value=""></div>
                                        </div>
                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End</label>

                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control" name="start" id="start" value="" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control" name="end" id="end" value="" />
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Thumbnail</label>
                                        	<div class="col-md-10"><input type="file" name="thumbnail" id="thumbnail" class="form-control "></div>
                                            
                                        </div>

                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Background Image</label>
                                        	<div class="col-md-10"><input type="file" name="background" id="background" class="form-control "></div>
                                            <div class="col-sm-10"></div>
                                        </div>
                                        
                                        <div class="hr-line-dashed"></div>
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label">Files</label>
                                            <div class="col-md-10">
                                               <input class="btn btn-default" type="button" id="add-documents" value="Add Documents" />
                                            </div>
                                        </div>
                                        <div id="files-selected" class="col-sm-offset-2"></div>

                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Packages</label>
                                            <div class="col-md-10">
                                            	<input class="btn btn-default" type="button" id="add-packages" value="Add Packages" />
                                            </div>
                                        </div>
                                        <div id="packages-selected" class="col-sm-offset-2"></div>
		
			
		

                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/feature"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="feature-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Feature</button>

                                            </div>
                                        </div>
                                        
                                    </form>


		                            
		                        </div>

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

					$('.input-daterange').datepicker({
                         format: 'yyyy-mm-dd',
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true
                    });

				</script>
				<script type="text/javascript" src="/js/custom/admin/features/addFeature.js"></script>

				

				@include('site.includes.bugreport')

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
				            	
								@include('admin.package.package-structure-partial', ['packages' =>$packages])
								
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                <button type="button" class="btn btn-primary attach-selected-packages" id="attach-selected-packages">Select Packages</button>
				            </div>
				        </div>
				    </div>
				</div>


			</body>
			</html>
