<!DOCTYPE html>
<html>

<head>
    @section('title', 'Edit Communication')
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
                        	<strong>Edit Communication</strong>
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
                            <h5>Edit Communication</h5>

                            <div class="ibox-tools">

                                <!-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> -->
                            </div>
                        </div>
                        <div class="ibox-content">



							<form class="form-horizontal" id="updateCommunicationForm">

								<input type="hidden" name="banner_id" value={{$banner->id}} >
								<input type="hidden" id="communicationId" name="communicationId" value={{$communication->id}}> 

								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
						            <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value="{{ $communication->subject }}"></div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Type</label>
										<div class="col-sm-10">
											<div class="btn-group" role="group" data-toggle="buttons">
											@foreach($communicationTypes as $ct)

												@if($communication->communication_type_id == $ct->id)
												<label class="btn btn-outline btn-default active">
												@else 
												<label class="btn btn-outline btn-default">
												@endif

												@if( $ct->id == 1)
												<input type="radio" id="" name="communication_type" value="{{ $ct->id }}"><i class="fa fa-times"></i> {{ $ct->communication_type }}
												@else 
												<input type="radio" id="" name="communication_type" value="{{ $ct->id }}"><i class="fa fa-circle text-{{ $ct->colour }}"></i> {{ $ct->communication_type }}
												@endif
											</label>	

											@endforeach
											</div>
										</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 control-label">Body</label>
										<div class="col-sm-10">
											<textarea class="communication_body" name="body" cols="50" rows="10" id="body">
												{{ $communication->body }}

											</textarea>
												
										</div>
								</div>

								<div class="form-group">
						                                            
						                <label class="col-sm-2 control-label">Target Stores</label>
						                <div class="col-sm-10">
						                	@if($all_stores)
		                                        {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
		                                        {!! Form::label('allStores', 'Or select all stores:') !!}
		                                        {!! Form::checkbox('allStores', null, true ,['id'=> 'allStores'] ) !!}
		                                    @else
		                                        {!! Form::select('stores', $storeList, $target_stores, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
		                                        {!! Form::label('allStores', 'Or select all stores:') !!}
		                                        {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
		                                    @endif
						                </div>

						        </div>

						        <div class="form-group">

						                <label class="col-sm-2 control-label">Start &amp; End</label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control" name="send_at" id="send_at" value="{{$communication->send_at}}" />
						                        <span class="input-group-addon">to</span>
						                        <input type="text" class="input-sm form-control" name="archive_at" id="archive_at" value="{{$communication->archive_at}}" />
						                    </div>
						                </div>
						        </div>


								<div class="hr-line-dashed"></div>

								<!-- <div class="existing-files row"> -->
									<div class="form-group">

										<label class="col-sm-2 control-label">Files Attached</label>
										<div class="existing-files-container col-md-10">
											@foreach($communication_documents as $doc)
											<div class="row">
												<div class="feature-files col-md-8">
													<div class="feature-filename" data-fileid = "{{$doc->id}}"> <i class="fa fa-file-o"></i> {{$doc->original_filename}} </div>
													<div class="feature-filepath"> File Location : {{$doc->folder_path}}</div>
													<div class="feature-timestamp"> Uploaded At : {{$doc->created_at}}</div>
												</div>

												<!-- <div class="col-md-1 remove-file btn btn-default" data-document-id="{{$doc->id}}">Remove</div> -->
												<a data-document-id="{{ $doc->id }}" id="document{{$doc->id}}" class="remove-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</div>
											@endforeach
											
												
										</div>


									</div>
								<!-- </div> -->
								<div id="files-staged-to-remove"></div>
								<div id="files-selected" class="row"></div>		

								<!-- <div class="existing-folders row"> -->
									<div class="form-group">
										<label class="col-sm-2 control-label">Packages Attached</label>
										<div class="existing-folders-container col-md-10" >
											
											@foreach($communication_packages as $package)
											<div class="row">
												<div class="communication_packages col-md-8">
													<div class="feature-packagename" data-folderid = {{$package->id}}> <i class="fa fa-folder-o"></i> {{$package->package_screen_name}} </div>
													
													<div class="package-timestamp"> Updated At : {{$package->updated_at}}</div>
												</div>

												
												<a data-package-id="{{ $package->id }}" id="package{{$package->id}}" class="remove-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</div>
											@endforeach
											
											
										</div>
										
									</div>
								<!-- </div>	 -->
								<div id="packages-selected" class="row"></div>
								<div id="packages-staged-to-remove"></div>





								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<div id="add-documents" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add Documents</div>
										<div id="add-packages" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add Packages</div>		
									</div>
								</div>



								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<a class="btn btn-white" href="/admin/communication"><i class="fa fa-close"></i> Cancel</a>
										<button class="btn btn-primary communication-update"><i class="fa fa-check"></i> Send New Communication</button>
						            </div>
						        </div>

							</form>




                        </div> <!--  ibox content closes-->

                    </div><!-- ibox closes -->
                </div> <!-- col-lg-12 closes -->
            </div><!-- row closes -->


        </div><!-- wrapper closes -->




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
		                @include('admin.package.package-structure-partial', ['packages'=>$packages])
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

		<script type="text/javascript" src="/js/custom/admin/features/editFeature.js"></script>
		<script type="text/javascript" src="/js/custom/admin/communications/editCommunication.js"></script>

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

		<script type="text/javascript">
			$(".date").datetimepicker({
		          format: 'YYYY-MM-DD HH:mm:ss'
		    });

		    $(".chosen").chosen({
				  width:'75%'
			});

		    $('.input-daterange').datepicker({
		         format: 'yyyy-mm-dd',
		        keyboardNavigation: false,
		        forceParse: false,
		        autoclose: true
		    });      				

		    CKEDITOR.replace('body');



		</script>

			</body>
			</html>




