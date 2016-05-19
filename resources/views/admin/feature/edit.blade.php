<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Feature')
    @include('admin.includes.head')
    
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/feature.css">
	
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
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
                    <h2>Edit a Feature</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/feature">Feature</a>
                        </li>
                        <li class="active">
                            <strong>Edit a Feature</strong>
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
		                            <h5>Edit Feature: {{ $feature->title }}</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/feature/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Feature</a>
                                        
		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form  method="" class="form-horizontal"  enctype="multipart/form-data" >
                                        <input type="hidden" name="featureID" id="featureID" value="{{ $feature->id }}">
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                        <div class="form-group"><label class="col-sm-2 control-label"> Title</label>
                                            <div class="col-sm-10"><input type="text" id="feature_title" name="feature_title" class="form-control" value="{{ $feature->title }}"></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label"> Tile Label</label>
                                            <div class="col-sm-10"><input type="text" id="tile_label" name="tile_label" class="form-control" value="{{ $feature->tile_label }}"></div>
                                        </div>

                                       <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End</label>

                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control" name="start" id="start" value="{{ $feature->start }}" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control" name="end" id="end" value="{{ $feature->end }}" />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                        	
                                        	<label class="col-sm-2 control-label">Thumbnail</label>
                                        	<div class="thumbnail-preview col-sm-5">
                                        		<img src="/images/featured-covers/{{$feature->thumbnail}}">
                                        	</div>
                                        	<div class= "col-sm-10 col-sm-offset-2"><input type="file" id="thumbnail" name="thumbnail" class="form-control" value="{{ $feature->thumbnail }}"></div>

                                        </div>

                                        <div class="form-group">
                                        	
                                        	<label class="col-sm-2 control-label">Background</label>
                                        	<div class="background-preview col-sm-5">
                                        		<img src="/images/featured-backgrounds/{{$feature->background_image}}">
                                        	</div>
                                        	<div class= "col-sm-10 col-sm-offset-2"><input type="file" id="background" name="background" class="form-control" value="{{ $feature->background }}"></div>

                                        </div>
                                        </form>
                                        

                                       


                                </div>
                            </div>

                            <div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Documents </h5>
                            		<div class="ibox-tools">
                            			
                            			<div id="add-more-files" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add More Documents</div>
                            		</div>

                            	</div>
                            	<div class="ibox-content">
                                <div class="existing-files row" >
                                	
									<!-- <div class="form-group"><label class="col-sm-2 control-label">Files Attached</label> -->
										<div class="existing-files-container">
											<table class="table table-hover feature-documents-table">
												<thead>
													<tr>
														<td>Title</td>
														<td>Updated</td>
														<td></td>
													</tr>
												</thead>
												<tbody>

													@foreach($feature_documents as $doc)
													<tr class="feature-files">
														<td class="feature-filename" data-fileid = "{{$doc->id}}"> <i class="fa fa-file-o"></i> {{$doc->original_filename}}</td>
														{{-- <td class="feature-filepath"> File Location : {{$doc->folder_path}}</td> --}}
														<td class="feature-timestamp"> {{$doc->created_at}}</td>
														<td>
															<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
														</td>
														

														<!-- <div class="col-md-1 remove-file btn btn-default" data-document-id="{{$doc->id}}">Remove</div> -->
														
													</tr>
													@endforeach
												</tbody>
											</table>
											
											
										</div>
									<!-- </div> -->
									<div id="files-staged-to-remove"></div>
									
								</div>
								<div id="files-selected" class="row"></div>
								</div>		

                            </div>

                            <div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Packages </h5>
                            		<div class="ibox-tools">
                            			
                            			<div id="add-more-packages" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add More Packages</div>
                            		</div>
                            	</div>
                            	<div class="ibox-content">

                                     <div class="existing-folders row" >
										
										<div class="existing-folders-container " >
											
											<table class="table table-hover feature-packages-table">
												<thead>
													<tr>
														<td>Package Name</td>
														<td>Updated</td>
														<td></td>
													</tr>
												</thead>
												<tbody>
													@foreach($feature_packages as $package)
													
													<tr class="feature-packages">
														<td class="feature-packagename" data-folderid = {{$package->id}}><i class="fa fa-folder-o"></i> {{$package->package_name}} </td>
														<td class="package-updated"> {{$package->updated_at}} </td>
														<td><a data-package-id="{{ $package->id }}" id="package{{$package->id}}" class="remove-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
													</tr>
													
													@endforeach

												</tbody>
											</table>
										</div> <!-- existing-folders-container closes -->
													
										
									</div><!-- existing-folders closes -->
									<div id="packages-selected" class="row">

									</div>
									<div id="packages-staged-to-remove">

									</div>
									
								</div> <!-- ibox content closes -->
							</div>

							<div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Notifications </h5>
                            		
                            	</div>
								<div class="ibox-content">

	                                     <div class="latest-updates row" >
											<div class="form-group"><label class="col-sm-2 control-label">Latest Updates</label>
												<div class="latest-updates-container col-md-10" >
													
													
													<div class="row">

														@if( $feature['update_type_id'] == 1 )
														<div class="latest-update-option col-md-8">
															{!! Form::radio('latest_updates_option', '1', ['checked'=>'checked']) !!} By Days
															{!! Form::input('text', 'update_frequency', $feature['update_frequency'] ,['class='=>'update_frequency']) !!}

														</div>
														<div class="latest-update-option col-md-8">
															{!! Form::radio('latest_updates_option', '2') !!} By Documents
															{!! Form::input('text', 'update_frequency', null, ['class='=>'update_frequency', 'disabled'=> 'disabled', 'placeholder'=>'Number of Documents']) !!}
														</div>
														@elseif ($feature['update_type_id'] == 2)
														<div class="latest-update-option col-md-8">
															{!! Form::radio('latest_updates_option', '1') !!} By Days
															{!! Form::input('text', 'update_frequency', null, ['class='=>'update_frequency', 'disabled'=> 'disabled', 'placeholder'=>'Number of Days']) !!}

														</div>
														<div class="latest-update-option col-md-8">
															{!! Form::radio('latest_updates_option', '2', ['checked'=>'checked']) !!} By Documents
															{!! Form::input('text', 'update_frequency', $feature['update_frequency'] , ['class='=>'update_frequency']) !!}
														</div>
														@endif
													</div>
													
													
													
												</div>
											</div>
										</div>
										
										
									</div>
							</div>



                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/admin/feature"><i class="fa fa-close"></i> Cancel</a>
                                    <button class="feature-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                </div>
                            </div>
                                    


                    </div>
                </div>
            </div>

				@include('site.includes.footer')

			    @include('admin.includes.scripts')
            </div>
	


		     


    
	@include('site.includes.bugreport')

	
	<div id="document-listing" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Select Documents</h4>
	            </div>
	            <div class="modal-body">
	            	<ul class="tree">
	            	@foreach ($navigation as $nav) 
					
						@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
							
							@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
							
						@endif

					@endforeach
					</ul>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="button" data-dismiss="modal" class="btn btn-primary" id="attach-selected-files">Select Documents</button>
	            </div>
	        </div>
	    </div>
	</div>

	<div id="package-listing" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Select Folders</h4>
	            </div>
	            <div class="modal-body">
	            	<ul class="tree">
	            	@include('admin.package.package-structure-partial', ['packages' =>$packages])
	            	</ul>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="button" data-dismiss="modal" class="btn btn-primary" id="attach-selected-packages">Select Packages</button>
	            </div>
	        </div>
	    </div>
	</div>



	<script type="text/javascript" src="/js/custom/admin/features/editFeature.js"></script>
	<script type="text/javascript" src="/js/custom/tree.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

    	$(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

    	$('.input-daterange').datepicker({
	        format: 'yyyy-mm-dd',
	        keyboardNavigation: false,
	        forceParse: false,
	        autoclose: true
	    });     

	</script>

	
</body>
</html>
