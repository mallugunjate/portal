<!DOCTYPE html>
<html>

<head>
    @section('title', 'Alerts')
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
                    <h2>Alerts</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Alerts</a>
                        </li>
                        <li class="active">
                            <strong>Manage Alerts</strong>
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
		                            <h5>Alerts List</h5>

		                            <div class="ibox-tools">

		                                
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker">

										<tr>
											<td>Document</td>
											<td>Start</td>
											<td>End</td>
											<td>Stores</td>
											<td>Type</td>
											<td></td>
										</tr>

										@foreach($alerts as $alert)
										<tr>

											<td><a href="/admin/document/{{ $alert->document_id }}/edit">{{ $alert->document_name }}</a></td>
											<td>{{ $alert->alert_start }}</td>
											<td>{{ $alert->alert_end }}</td>
											<td>
												@if($alert->count_target_stores > 0)
													<button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$alert->target_stores}}" data-original-title="" title="" aria-describedby="popover199167">
						                                {{$alert->count_target_stores}} Stores
						                            </button>
													
												@else
													&mdash;
												@endif
											</td>
											<td> {{$alert->alert_type}}</td>
											<td>
												
												<a data-alert="{{ $alert->id }}" id="alert{{ $alert->id }}" class="delete-alert btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

				</script>

				<script type="text/javascript" src="/js/custom/admin/alerts/deleteAlert.js"></script>
				@include('site.includes.bugreport')


			</body>
			</html>
