<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Feedback')
    @include('admin.includes.head')
    
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/feature.css">
	
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
                    <h2>Update a Feedback</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/feedback">Feedback</a>
                        </li>
                        <li class="active">
                            <strong>Update a Feedback</strong>
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
		                            <h5>Update Feedback</h5>
		                            
		                        </div>
		                        <div class="ibox-content">

                                    <form  method="" class="form-horizontal"   >
                                        <input type="hidden" name="feedbackID" id="feedbackID" value="{{ $feedback->id }}">
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                        <div class="form-group">
                                        	<label class="col-sm-2 col-md-2 col-lg-1 control-label"> Description </label>
                                            <div class="col-sm-10 col-md-10 col-lg-11">
                                            	<input type="text" id="feedback_description" name="feedback_description" class="form-control" value="{{ $feedback->description }}" readonly>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                        	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Current URL</label>
                                        	<div class="col-sm-10 col-md-10 col-lg-11">
                                        		<input type="text" id="feedback_url" name="feedback_url" class="form-control" value="{{ $feedback->current_url}}" readonly> 
                                        	</div>
                                        </div>

                                         <div class="form-group">
                                        	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Store Number</label>
                                        	<div class="col-sm-10 col-md-10 col-lg-11">
                                        		<input type="text" id="store_number" name="store_number" class="form-control" value="{{ $feedback->store_number}}" readonly> 
                                        	</div>
                                        </div>

                                        <div class="form-group">
                                        	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Follow up requested</label>
                                        	<div class="col-sm-10 col-md-10 col-lg-11">
                                        		@if($feedback->follow_up)
                                        		<input type="checkbox" id="follow_up" name="follow_up" class="form-control" disabled checked > 
                                        		@else
                                        		<input type="checkbox" id="follow_up" name="follow_up" class="form-control" disabled > 

                                        		@endif
                                        	</div>
                                        	
                                        	
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 col-md-2 col-lg-1 control-label">Sent At</label>
                                        	<div class="col-sm-10 col-md-10 col-lg-11">
                                        		<input type="text" id="created_at" name="created_at" class="form-control" value="{{ $feedback->created_at}}" readonly> 
                                        	</div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Update Status </h5>
                            		<div class="ibox-tools">
                            			
                            		</div>
                            	</div>
                            	<div class="ibox-content">
                            		<form class="form-horizontal">
                            		<div class="form-group">
                            			<label class="col-sm-2 col-md-2 col-lg-1 control-label"> Update Feedback Code </label>
                            			
                            			<div class="col-sm-10 col-md-10 col-lg-11 feedback-codes">
                            				@if(isset($feedback->code))

                            					{!! Form::select('feedback_codes', $feedback_code_list, $feedback->code->id ,['class'=>'form-control']) !!}
                            				@else

                            					{!! Form::select('feedback_codes', $feedback_code_list, null, [
                            					'class' =>'form-control']) !!}
                            				@endif
                            			</div>

                            		</div>
                            		</form>
								</div> <!-- ibox content closes -->
							</div>

                            <div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Notes </h5>
                            		<div class="ibox-tools">
                            			
                            			<div id="add-more-notes" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add New Note</div>
                            		</div>

                            	</div>
                            	<div class="ibox-content">
                                	<form class="form-horizontal">
	                                	<div class="form-group">
	                                		<label class="col-sm-2 col-md-2 col-lg-1 control-label" >
	                                			Notes
	                                		</label>
	                                		<div class="col-sm-10 col-md-10 col-lg-11 feedback-notes">
	                                			@if(isset($feedback->notes))
	                                				@foreach($feedback->notes as $note)
	                                				<input type="text" class="form-control" value="{{ $note->note }}">
	                                				<div class="col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10 col-lg-2 col-lg-offset-10">
	                                					{!! $note->displayText !!}
	                                					{!! $note->prettyDisplayDate !!}
	                                				</div>
	                                				
	                                				@endforeach

	                                			@endif

	                                		</div>
	                                	</div>
                                	</form>
								</div>		

                            </div>

                            

							<div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Notifications </h5>
                            		
                            	</div>
								<div class="ibox-content">

	                                     <div class="latest-updates row" >
											<div class="form-group"><label class="col-sm-2 control-label">Latest Updates</label>
												<div class="latest-updates-container col-md-10" >
													
													
													<div class="row">

														
													</div>
													
													
													
												</div>
											</div>
										</div>
										
										
									</div>
							</div>



                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/admin/feature"><i class="fa fa-close"></i> Cancel</a>
                                    <button class="feature-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                </div>
                            </div>
                                    


                    </div>
                </div>
            </div>

				@include('site.includes.footer')

			    @include('admin.includes.scripts')
            </div>
	


		     


    
	@include('site.includes.bugreport')


	<script type="text/javascript" src="/js/custom/admin/features/editFeature.js"></script>
	<script type="text/javascript" src="/js/custom/tree.js"></script>
	<script src="/js/custom/datetimepicker.js"></script>
	
	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

    	$(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});    

	</script>

	
</body>
</html>
