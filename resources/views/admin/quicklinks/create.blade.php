<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Quicklink')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
	body .modal-ql-file{
    width: 100%; /* respsonsive width */
    margin: 0 auto;
/*    margin-left:-40%; */

	}

	body .modal-ql-file .modal-content{
		width: 900px !important;
		margin-left:-150px; 
		/*margin: 0 auto;*/

	}

	body.adminview .ibox-title{
		padding: 0px !important;
		min-height: 0px !important;
	}

	.ql-filetable td, .ql-filetable thead{
		font-size: 12px !important;
	}

	.modal-ql-file .ibox-title{ border: none; padding: 0px; }
	.modal-ql-file .ibox-title h6{ font-size: 16px !important; font-weight: normal; }
	</style>
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
                    <h2>Create a Quicklink</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/dashboard">Quicklinks</a>
                        </li>
                        <li class="active">
                            <strong>Create a Quicklink</strong>
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
		                            <h5>New Quicklink</h5>
		                            <div class="ibox-tools">
		                               {{--  <a href="/admin/quicklink/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Package</a> --}}
                                        
		                            </div>
		                        </div>
		                        <div class="ibox-content">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    <form method="get" class="form-horizontal" id="createNewQuicklinkForm">
                                        
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">
                                        <div class="form-group"><label class="col-sm-2 control-label">Name <span class="req">*</span></label>
                                            <div class="col-sm-10"><input type="text" id="name" name="name" class="form-control" value=""></div>
                                        </div>

                          

                                        <div class="form-group"><label class="col-sm-2 control-label">Quicklink type <span class="req">*</span></label>
                                            <div class="col-md-10">
                                               @foreach($quicklink_types as $qtype)
                                               <?php $id = "quicklink-" . $qtype->name ?>
                                               	<div>{!! Form::input('radio', 'type', $qtype->id , ['id'=> $id ]) !!} {{$qtype->name}}</div>
                                               @endforeach
                                            </div>
                                        </div>

                          

                                        <div class="form-group"><label class="col-sm-2 control-label">Quicklink URL</label>
                                            <div class="col-md-10" id="quicklink-url">
                                            	
                                            </div>

                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/dashboard"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="quicklink-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Quicklink</button>

                                            </div>
                                        </div>
                                        
                                    </form>


                                </div>
		                    </div>

		                    <div id="document-listing" class="modal modal-ql-file fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title">Select a Document <span id="ql-doc-selected"><span></h4>
							            </div>
							            <div class="modal-body">


								           <div class="row">

									           <div class="col-md-3">





						                            <div class="file-manager">

						                                <span class="top-level-folder"> <h5><i class="fa fa-folder"></i> {{$banner->name}}</h5> </span>
						                                    @include('admin.navigation-view', ['navigation'=>$navigation])
						                                    <div id="file-container" class="hidden">
						                                    <ol class="breadcrumbs"></ol>
						                                    <input type="hidden" name="default_folder" value="">
						                                    <input type="hidden" name="banner_id" value={{$banner->id}}>
						                            {{--         @include('admin.documentmanager.document-table') --}}
						                                    </div>
						                                    <div id="package-viewer" class="hidden">
						                                    @include('admin.package.view')
						                                    </div>
						                                    

						                                <div class="clearfix"></div>
						                            </div>
										            {{--
										            	<ul class="tree">
										            	@foreach ($navigation as $nav) 
														
															@if (isset($nav["is_child"]) && ($nav["is_child"] == 0) )
																
																@include('admin.package.file-folder-structure-partial', ['navigation' =>$navigation, 'currentnode' => $nav])
																
															@endif

														@endforeach
														</ul>

														--}}
												</div>

												<div class="col-md-9">
													<div class="ibox-title">
                                        				<h6 id="folder-title"></h6>
                                       			 		<div class="ibox-tools"></div>
                                    				</div> 
												    <div class="ibox-content">    
				                                        <table class="table tablesorter ql-filetable" id="file-table"></table>
				                                    </div>
												</div>
											</div> <!-- end row -->										
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
							                <button type="button" class="btn btn-primary" id="attach-selected-files"><i class="fa fa-check"></i> Select Document</button>
							            </div>
							        </div>
							    </div>
							</div>

							<div id="folder-listing" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title">Select Folder</h4>
							            </div>
							            <div class="modal-body">
							            	<ul class="tree">
							            	@foreach ($folderStructure as $folder)
											
												@if (isset($folder["is_child"]) && ($folder["is_child"] == 0) )
													
													@include('admin.package.folder-structure-partial', ['folderStructure' =>$folderStructure, 'currentnode' => $folder])
													
												@endif


											@endforeach
											</ul>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
							                <button type="button" class="btn btn-primary" id="attach-selected-folders"><i class="fa fa-check"></i> Select Folder</button>
							            </div>
							        </div>
							    </div>
							</div>

							<div id="external" class="modal fade">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							                <h4 class="modal-title">Add External URL</h4>
							            </div>
							            <div class="modal-body">
							            	URL <input type="text" id="external-url" >
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
							                <button type="button" class="btn btn-primary" id="add-external-url"><i class="fa fa-check"></i> Done</button>
							            </div>
							        </div>
							    </div>
							</div>
		                </div>

                    </div>
            </div>
	</div>


</div>

@include('site.includes.footer')

@include('admin.includes.scripts')

@include('site.includes.bugreport')

<script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/custom/admin/folders/folderStructureQL.js" ></script>
<script type="text/javascript" src="/js/custom/admin/documents/fileTableQL.js"></script>
<script type="text/javascript" src="/js/custom/admin/quicklinks/addQuicklink.js"></script>			
<script type="text/javascript" src="/js/custom/tree.js"></script>

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

    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});            

</script>


</body>
</html>

			
	



