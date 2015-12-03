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
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/calendar">Calendar</a>
                        </li>
                        <li class="active">
                            <strong>Edit an Event</strong>
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
		                            <h5>Edit Event: {{ $event->title }}</h5>
		                            <div class="ibox-tools">
		                                <a href="" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Event</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" value="{{ $event->title }}"></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">
                                                <div class="summernote">{{ $event->description }}</div>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                        <!-- <div class="form-group" id="data_5">
                                            <label class="col-sm-2 control-label">Event Start &amp; End</label>

                                            <div class="input-daterange input-group" id="datepicker">

                                                <span class="input-group-addon">to</span>

                                            </div>
                                        </div> -->



                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Event Start &amp; End</label>

                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control" name="start" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control" name="end" />
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/calendar"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>
                                            </div>
                                        </div>
                                    </form>


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

                    $('.input-daterange').datepicker({
                        keyboardNavigation: false,
                        forceParse: false,
                        autoclose: true
                    });


                            $(document).ready(function(){

                                $('.summernote').summernote();

                           });




				</script>

				<script src="/js/custom/deleteEvent.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
