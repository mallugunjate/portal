<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Calendar')
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
                    <h2>Create an Event</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/calendar">Calendar</a>
                        </li>
                        <li class="active">
                            <strong>Create an Event</strong>
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
		                            <h5>New Event</h5>
		                            <div class="ibox-tools">
		                               {{--  <a href="/admin/calendar/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Event</a> --}}
                                        
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
                                    
                                    <form method="get" class="form-horizontal" id="createNewEventForm">
                                        <input type="hidden" name="banner" id="banner" value="1">
                                        <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value=""></div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Event Type</label>
                                            <div class="col-sm-10">
                                                {{-- <input type="text" class="form-control" value="{{ $event_type->event_type }}"> --}}

                                                <select class="form-control" id="event_type" name="event_type">
                                                    @foreach($event_types_list as $e)
                                                       
                                                            <option value="{{ $e->id }}">{{ $e->event_type}}</option>
                                                       
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                                        

                                        {{-- <div class="summernote"></div> --}}

                                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                                
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Start &amp; End</label>

                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" class="input-sm form-control" name="start" id="start" value="" />
                                                        <span class="input-group-addon">to</span>
                                                        <input type="text" class="input-sm form-control" name="end" id="end" value="" />
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Tags</label>
                                            <div class="col-md  -10">
                                                {!! Form::select('tags[]', $tags, null, ['class'=>'chosen', 'multiple'=>'true', 'id'=>'tags']) !!}
                                                
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/calendar"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="event-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Event</button>

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

				@include('site.includes.bugreport')

				<script src="/js/custom/addEvent.js"></script>
                <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

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

                    $(".chosen").chosen();

                </script>


			</body>
			</html>
