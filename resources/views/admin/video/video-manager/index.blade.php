<!DOCTYPE html>
<html>

<head>
    @section('title', 'Videos')
    @include('admin.includes.head')

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
                    <h2>Videos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Videos</strong>
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
		                            <h5>Videos</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/video/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Videos</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">
		                            	<table class="table table-hover issue-tracker">
			                            	<tr>
												<td></td>
												<td>Title</td>
												<td>Thumbnail</td>
												<td>Description</td>
												<td>Uploader</td>
												<td>Actions</td>
											</tr>
			                            	@foreach($videos as $video)
			                            	<tr>
			                            		@if ($video->featured)
			                            			<td><i class="fa fa-film"></i> </td>
			                            		@else
			                            			<td></td>
			                            		@endif
			                            		<td>{!! $video->link !!}</a></td>
			                            		<td> <img src="/video/thumbs/{{$video->thumbnail}}" height="75" width="125"> </td>
			                            		<td> {{$video->description}} </td>
			                            		<td> {{$video->uploaderFirstName}} {{$video->uploaderLastName}} </td>
			                            		<td>
			                            			<a href="/admin/video/{{$video->id}}/uploadthumbnail" class="btn btn-primary btn-sm " title="Upload Video Thumbnail" data-videoId = "{{$video->id}}"><i class="fa fa-film"></i></a>
			                            			<a href="/admin/video/{{$video->id}}/edit" class=" btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
			                            			<a data-video="{{$video->id}}" id="video{{$video->id}}" class="video-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

			                            		</td>
			                            	</tr>
			                            	@endforeach
		                            	</table>
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


				<script type="text/javascript" src="/js/custom/admin/videos/deleteVideo.js"></script>
				<script type="text/javascript" src="/js/custom/admin/videos/createThumbnail.js"></script>
				<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>

				@include('site.includes.bugreport')
				@include('site.includes.modal')


			</body>
			</html>
