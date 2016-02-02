<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link href="/js/plugins/fileinput/fileinput.css" rel="stylesheet">

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
                    <h2>Dashboard</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Dashboard</strong>
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
		                            <h5>Branding</h5>

		                            <div class="ibox-tools">

		                                {{-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> --}}
		                            </div>
		                        </div>
		                        <div class="ibox-content">
		                        	<div class="row">
		                        		<div class="col-lg-6">
		                        		<img src="/images/dashboard-banners/{{ $banner->background }}" width="400" />
		                        		</div>
		                        		<div class="col-lg-6">
		                        	
											<label class="control-label">Change Branding</label>
											<input id="dashboardbackground" name="dashboardbackground[]" type="file" multiple class="file-loading">
											<input type="hidden" value="{{ $banner->id }}" name="banner_id" id="banner_id">
		                        		</div>
		                        	</div>

		                            
		                        </div>

		                    </div>


		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>QuickLinks</h5>

		                            <div class="ibox-tools">



		                                <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Quiclink</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

									<div class="dd" id="quicklinkslist">
		                                <ol class="dd-list">
		                                	{{-- <div class="dd-placeholder" style="height: 42px;"></div> --}}
		                                    @foreach($quicklinks as $ql)
		                                 	<?php switch($ql->type) {
		                                    		case 1:
		                                    			$icon = '<i class="fa fa-folder"></i>';
		                                    			$type = "Folder";
		                                    			$link = '<a href="/admin/document/manager#!/'.$ql->url.'">'.$ql->link_name.'</a>';		
		                                    			break;
		                                    		case 2: 
		                                    			$icon = '<i class="fa fa-file-o"></i>';		
		                                    			$type = "File";
		                                    			$link = '<a class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/" data-target="#fileviewmodal" > '. $ql->link_name.'</a>';
		                                    			break;
		                                    		case 3:
		                                    			$icon = '<i class="fa fa-external-link"></i>';		
		                                    			$type = "Link";
		                                    			$link = '<a target="_blank" href="'. $ql->url .'">'. $ql->link_name .'</a>';
		                                    			break;
		                                    		default:
		                                    			$icon = '<i class="fa fa-cog"></i>';		
		                                    			break;

		                                    	}?>
		                                    <li class="dd-item" data-id="{{ $ql->id }}">
												<span class="pull-left">
													<div class="dd-handle"><i class="fa fa-bars"></i></div>
													<span style="position: relative; top: 5px;">{!! $link !!} <span class="label label-default">{!! $icon !!} {{ $type }}</span> </span>
												</span>
												<span class="pull-right">
													<a data-quicklink="{{ $ql->id }}" id="quicklink-{{ $ql->id }}" class="quicklink-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;
												</span>
		                                     </li>
		                                    @endforeach
		                                </ol>
		                            </div>     	

		                        </div>

		                    </div>

		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Order Featured Content</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/feature" class="btn btn-primary btn"><i class="fa fa-pencil"></i> Edit Featured Content Pages</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

									<div class="dd" id="featuredcontentlist">
		                                <ol class="dd-list">
		                                	{{-- <div class="dd-placeholder" style="height: 42px;"></div> --}}
		                                    @foreach($features as $f)
		                                 
		                                    <li class="dd-item" data-id="{{ $f->id }}">
		                                        	<span class="pull-left"><div class="dd-handle"><i class="fa fa-bars"></i></div></span>
		                                            {{-- <span class="pull-right"><a data-event="" id="" class="event-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></span> --}}
		                                            <img src="/images/featured-covers/{{ $f->thumbnail }}" height="30" width="30" /><span class="client-link" style="margin:0px 10px;">{{ $f->title }}</span>
		                                     </li>
		                                    @endforeach
		                                </ol>
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
				<script src="/js/plugins/nestable/jquery.nestable.js"></script>
				<script src="/js/plugins/fileinput/fileinput.js"></script>
				<script src="/js/custom/admin/quicklinks/changeQuicklinksOrder.js"></script>
				<script src="/js/custom/admin/quicklinks/deleteQuicklink.js"></script>
				<script src="/js/custom/admin/features/changeFeaturesOrder.js"></script>
				<script src="/js/custom/admin/dashboard/uploadBackground.js"></script>

				<script>

			         $(document).ready(function(){

					    $("#dashboardbackground").fileinput({
					        initialPreview: [],
					        overwriteInitial: true,
					        initialCaption: ""
					    });

						var serializeQuicklinksData = function (e) {
			                 var list = e.length ? e : $(e.target);			                        
			                 var data = list.nestable('serialize');
			                 updateQuicklinksOrder(data);
			             };

						var serializeFeaturedContentData = function (e) {
			                 var list = e.length ? e : $(e.target);			                        
			                 var data = list.nestable('serialize');
			                 updateFeaturesOrder(data);
			             };			             

			             $('#quicklinkslist').nestable({
			                 group: 1
			             }).on('change', serializeQuicklinksData);


			             $('#featuredcontentlist').nestable({
			                 group: 2
			             }).on('change', serializeFeaturedContentData);

			         });
    			</script>				


				@include('site.includes.bugreport')



			</body>
			</html>
