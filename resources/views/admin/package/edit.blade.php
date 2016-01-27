<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Package')
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
                    <h2>Edit an Package</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/package">Package</a>
                        </li>
                        <li class="active">
                            <strong>Edit a Package</strong>
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
		                            <h5>Edit Package: {{ $package->package_screen_name }}</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/package/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Package</a>
                                        
		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal" >
                                        <input type="hidden" name="packageID" id="packageID" value="{{ $package->id }}">
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10"><input type="text" id="name" name="name" class="form-control" value="{{ $package->package_screen_name }}"></div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                        <div class="existing-files row">
											<div class="form-group"><label class="col-sm-2 control-label">Files Attached</label>
												<div class="existing-files-container col-md-10">
													@foreach($documentDetails as $doc)
													<div class="row">
														<div class="package-files col-md-8">
															<div class="package-filename"> {{$doc->original_filename}} </div>
															<div class="package-filepath"> File Location : {{$doc->folder_path}}</div>
															<div class="package-timestamp"> Uploaded At : {{$doc->created_at}}</div>
														</div>

														<div class="col-md-1 remove-file btn btn-default" data-document-id="{{$doc->id}}">Remove</div>
													</div>
													@endforeach
													<div id="files-selected" class="row"></div>
													<div class="row">
														<div id="add-more-files" class="btn btn-default col-md-offset-8">Add More Files</div>
													</div>
												</div>
											</div>
										</div>
										<div id="files-staged-to-remove"></div>
										<div id="files-selected"></div>

                                        
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/calendar"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="event-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                            </div>
                                        </div>
                                    </form>


                                </div>
		                    </div>

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

                    
                    

				</script>

				@include('site.includes.bugreport')

				<script type="text/javascript" src="/js/custom/admin/packages/editPackage.js"></script>
				
			</body>
			</html>



		<!-- {!! Form::model($package, ['action' => ['Document\PackageAdminController@update', 'id'=>$package->id], 'method' => 'PATCH']) !!} -->
		


		

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

		<!-- <div id="files-selected">

		</div>
				
		
		<div class="row">
			<button type="submit" class="btn btn-default">Update Package</button>
		</div>
		{!! Form::close() !!} -->
	<!-- </div> -->



