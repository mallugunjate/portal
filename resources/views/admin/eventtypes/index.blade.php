<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
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
                    <h2>Calendar Event Types</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Calendar</a>
                        </li>
                        <li class="active">
                            <strong>Manage Event Types</strong>
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
		                            <h5>Event Types</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/eventtypes/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Event Type</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

		                            <div class="m-b-lg">
		                            <div class="alert alert-warning" role="alert"><p><strong>IMPORTANT</strong> - Don't delete an event type if there are existing events of that type.</p></div>
		                            
{{-- 		                                <div class="input-group">
		                                    <input type="text" placeholder="Search event by title..." class=" form-control">
		                                    <span class="input-group-btn">
		                                        <button type="button" class="btn btn-white"> Search</button>
		                                    </span>
		                                </div> --}}

	


		                            </div>

		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker">

										<tr>
											<td>id</td>
											<td>Event Type</td>
											<td></td>
										</tr>
										@foreach($eventtypes as $et)
										<tr>


											<td>{{ $et->id }}</td>
											<td><a href="/admin/eventtypes/{{ $et->id }}/edit">{{ $et->event_type }}</a></td>


											<td>

												<a data-eventtype="{{ $et->id }}" id="eventtype{{$et->id}}" class="eventtype-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

											</td>
										</tr>
										@endforeach

										</table>

{{-- 										{!! $events->render() !!} --}}

		                            </div>
		                        </div>

		                    </div>
		                </div>
		            </div>


		        </div>

				@include('site.includes.footer')

			    @include('site.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

				</script>

				<script src="/js/custom/deleteEventType.js"></script>
				<script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
