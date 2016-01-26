<!DOCTYPE html>
<html>

<head>
    @section('title', 'Folder Structure')
    @include('admin.includes.head')
       <style type="text/css">
       	.folder-name{
			display:inline-block;
			color:#222222;
			font-size: 14px;
			font-family: Helvetica, ariel, sans-serif ;
			text-transform: capitalize;	
			line-height: 25px;
		}
		.add-folder{
			color: #222222;
			cursor: pointer;
		}
		.glyphicon-plus-sign{
			color:#228B22;
		}

       </style>
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
                    <h2>Folders</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Calendar</a>
                        </li>
                        <li class="active">
                            <strong>Manage Events</strong>
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
		                            <h5>Folder List</h5>
		                            <div class="ibox-tools">
		                                <a href="#" class="btn btn-primary btn add-folder"><i class="fa fa-plus"></i> Add New Folder</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">


<div >
			
<!-- 			<div class="add-folder row">
				<i class="glyphicon glyphicon-plus-sign"></i>
				<span> Add New Folder </span>
			</div> -->
			<div class="row">
				 {!! Form::open(array('action' => 'Document\FolderAdminController@store', 'files' => false, 'class' => 'form-horizontal', 'role' => 'form')) !!}
					{!! csrf_field() !!}
					<div id="form-container" class="col-md-3 input-group"></div>
				{!! Form::close() !!}
			</div>
			<div class="row">
				{!! csrf_field() !!}

				@foreach ($navigation as $nav) 
					
					@if ( $nav["is_child"] == 0)
						
						@include('admin.folderstructure.folderstructure-partial', ['navigation' =>$navigation, 'currentnode' => $nav, 'banner' => $banner])
						
					@endif


				@endforeach
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

				<script src="/js/custom/admin/events/deleteEvent.js"></script>

				@include('site.includes.bugreport')
				@include('admin.folder.foldermodal')

<script type="text/javascript">
 
	$(".add-folder").on("click", function() {
		$("#form-container").empty();
		$("#form-container").append('<input class="form-control" type="text" name="foldername" placeholder="Folder Name">'+
									'<span class="input-group-btn create-folder"><button class="btn btn-default" type="submit">Add</button></span>');
	});
	

	$('.modal-link').click(function(e) {
	    var modal = $('#mmmm-modal');
	    var modalBody = $('#mmmm-modal .modal-content');
	    console.log( $(this).parent().attr('id') );

	    localStorage.setItem('lastClickedtoTriggerModal', $(this).parent().attr('id') );

	    modalBody.empty();

	    modal
	        .on('show.bs.modal', function () {
	            modalBody.load(e.currentTarget.href)
	        })
	        // .modal();
	    	e.preventDefault();
	});

	$('.cancel-modal').click(function(e) {

		var modalBody = $('#mmmm-modal .modal-content');
		modalBody.empty();
		console.log("empty the modal");
	});

</script>


   
			<!-- Modal -->
			





			</body>
			</html>