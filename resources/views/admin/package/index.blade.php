<!DOCTYPE html>
<html>

<head>
    @section('title', 'Package')
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
                    <h2>Packages</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Package</a>
                        </li>
                        <li class="active">
                            <strong>Manage Packages</strong>
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
		                            <h5>Package List</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/package/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Package</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">


		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker">

										<tr>
											
											<td>Title</td>
											<td>Label</td>
											
											<td>Actions</td>

										</tr>
										@foreach($packages as $package)
										<tr>


											
											<td><a href="/admin/package/{{ $package->id }}/edit">{{ $package->package_name }}</a></td>
											<td>{{$package->package_screen_name}}</td>
											<td>

												<a data-package="{{ $package->id }}" id="package{{$package->id}}" class="package-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

				<script src="/js/custom/admin/packages/deletePackage.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
