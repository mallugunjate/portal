<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/fullcalendar/fullcalendar.print.css">

	<script type="text/javascript">
		function convertDate(t)
		{
			var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
			d.setUTCSeconds(t);
			document.write(d);
		}
	</script>
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
                    <h2>Calendar Events</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>Calendar</a>
                        </li>
                        <li class="active">
                            <strong>List Events</strong>
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
		                            <h5>Event List</h5>
		                            <div class="ibox-tools">
		                                <a href="" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Event</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

		                            <div class="m-b-lg">

		                                <div class="input-group">
		                                    <input type="text" placeholder="Search event by title..." class=" form-control">
		                                    <span class="input-group-btn">
		                                        <button type="button" class="btn btn-white"> Search</button>
		                                    </span>
		                                </div>

										<div class="m-t-md">

                                    <div class="pull-right">
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-comments"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-user"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-list"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-pencil"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-print"></i> </button>
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-cogs"></i> </button>
                                    </div>

                                    <strong>&nbsp;</strong>



                                </div>


		                            </div>

		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker">

										<tr>
											<td>id</td>
											<td>title</td>
											<td>desc</td>
											<td>start</td>
											<td>end</td>
											<td></td>

										</tr>
										@foreach($events as $event)
										<tr>
											<td>{{ $event->id }}</td>
											<td>{{ $event->title }}</td>
											<td>{{ $event->description }}</td>
											<td><script>convertDate( {{ $event->start }} );</script></td>
											<td><script>convertDate( {{ $event->end }} );</script></td>

											<td>

												<a href="/admin/calendar/show/{{ $event->id }}" class="btn btn-white btn-sm"><i class="fa fa-eye"></i></a>
												<a href="/admin/calendar/edit/{{ $event->id }}" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i></a>
												<a data-event="{{ $event->id }}" id="event{{$event->id}}" class="event-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

											</td>
										</tr>
										@endforeach

										</table>

										{!! $events->render() !!}

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

				<script src="/js/custom/deleteEvent.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
