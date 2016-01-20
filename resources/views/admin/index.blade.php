

<!DOCTYPE html>
<html>

<head>
    @section('title', 'Admin Home')
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
                    <h2>Admin Home</h2>
                    <ol class="breadcrumb">
{{--                         <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Calendar</a>
                        </li>
                        <li class="active">
                            <strong>Manage Events</strong>
                        </li> --}}
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
		                            <h5>Admin Functions</h5>
		                            
		                        </div>
		                        <div class="ibox-content">

		                            <div class="m-b-lg">

		                               		                

<h3>Documents</h3>
<a href="/admin/document/create">Upload a document</a><br />

<h3>Folders</h3>
<a href="/admin/folder">View Folder Structure</a><br />
<a href="/admin/folder/create">Add a folder</a><br />

<h3>Calendar</h3>
<a href="/admin/calendar/">Event CRUD</a>


<h3>Communications</h3>




		                            </div>

		                            <div class="table-responsive">




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



			</body>
			</html>


