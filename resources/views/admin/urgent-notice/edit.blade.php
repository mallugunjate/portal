<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Urgent Notice')
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
                    <h2>Edit an Urgent Notice</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/urgentnotice">Urgent Notice</a>
                        </li>
                        <li class="active">
                            <strong>Edit an Urgent Notice</strong>
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
		                            <h5>Edit Urgent Notice: {{ $urgent_notice->title }}</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/urgentnotice/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New urgent Notice</a>
                                        
		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal" >
                                        <input type="hidden" name="urgent_noticeID" id="urgent_noticeID" value="{{ $urgent_notice->id }}">
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                        <div class="form-group"><label class="col-sm-2 control-label"> Title</label>
                                            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $urgent_notice->title }}"></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10"><textarea id="description" name="description" class="form-control" value="{{$urgent_notice->description}}"></textarea></div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                         <div class="form-group"><label class="col-sm-2 control-label">Attachment Type</label>
                                            <div class="col-md-10">
                                            	<input hidden id="attachment_type_selected" value={{$urgent_notice->attachment_type_id}}>
                                               @foreach($attachment_types as $atype)
                                               <?php $id = "attachment-" . $atype->name ?>
                                               	<div>{!! Form::radio('attachment_type', $atype->id , false, ['id'=> $id ]) !!} {{$atype->name}}</div>
                                               @endforeach


                                            </div>
                                        </div>

                                        <div class="form-group hidden"><label class="col-sm-2 control-label">Attachment Selected</label>
                                            <div class="col-md-10" id="attachment-selected">
                                               
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End</label>

                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control" name="start" id="start" value="{{$urgent_notice->start}}" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control" name="end" id="end" value="{{$urgent_notice->end}}" />
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

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
                                        </form>


                                </div>
                            </div>

                                        



                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/package"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="package-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                            </div>
                                        </div>
                                    


                                </div>
		                    </div>

		           

                    </div>

				@include('site.includes.footer')

			    @include('admin.includes.scripts')
            </div>
	


		     


                <script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

                    
                    

				</script>

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
				                <button type="button" class="btn btn-primary" id="attach-selected-folders">Select Folders</button>
				            </div>
				        </div>
				    </div>
				</div>


				<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>	
				<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>	
				<script type="text/javascript" src="/js/custom/admin/urgent-notices/editUrgentNotice.js"></script>
				<script type="text/javascript">
					$(".chosen").chosen({
				        width:'75%'
				    })
				    $('.input-daterange').datepicker({
				         format: 'yyyy-mm-dd',
				        keyboardNavigation: false,
				        forceParse: false,
				        autoclose: true
				    });            
				    console.log($("textarea").attr('value'));
				    CKEDITOR.replace('description');
				    
				    CKEDITOR.instances['description'].setData($("textarea").attr('value'));

				</script>
			</body>
			</html>

