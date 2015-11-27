@extends('app')

@section('content')

	<p> Create Your profile </p>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/profile/store') }}" id="profile_form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-md-4 control-label">First Name</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="firstname" value="{{ $profile->firstname }}">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label">Last Name</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="lastname" value="{{ $profile->lastname }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="store">Store</label>
			<div class="col-md-6">
				<input type="text" class="form-control" id="store" name="store" value="{{ $profile->store_id }}">	
				{!! Form::select('career_path', $careers_list , $profile->career_path_id) !!}
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label" for="employee_id">Employee Number</label>
			<div class="col-md-6">
				<input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $profile->employee_id }}">	
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="position">Position</label>
			<div class="col-md-6">
				{!! Form::select('position', $positions_list , $profile->position_id) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="groups[]">Subscribe to groups</label>
			<div class="col-md-6">
				{!! Form::select('groups[]', $groups_list , $profile_groups, ['multiple'=>'multiple']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="manager">Manager</label>
			<div class="col-md-6">
				{!! Form::select('manager', $storeStaff , $profile->manager_id) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="move_distance">Move</label>
			<div class="col-md-6">
				{!! Form::select('move_distance', $moves_list , $profile->move_distance_id) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="career_path">Career Path</label>
			<div class="col-md-6">
				{!! Form::select('career_path', $careers_list , $profile->career_path_id) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="profile_picture">Upload your Photo</label>
			<div class="col-md-6">
				<input type="file" name="profile_picture">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="ulead">uLead Graduate</label>
			<div class="col-md-6">
				<input type="boolean" class="form-control" id="ulead" name="ulead" value="{{ $profile->ulead }}">	
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="five_factors">Five Success Factors Score</label>
			<div class="col-md-6">
				<input type="number" class="form-control" id="five_factors" name="five_factors" value="{{ $profile->five_factors }}">	
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="tribal_customs">Tribal Customs Score</label>
			<div class="col-md-6">
				<input type="number" class="form-control" id="tribal_customs" name="tribal_customs" value="{{ $profile->tribal_customs }}">	
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label" for="leadership_brand">Leadership Brand Score</label>
			<div class="col-md-6">
				<input type="number" class="form-control" id="leadership_brand" name="leadership_brand" value="{{ $profile->leadership_brand }}">	
			</div>
		</div>
			
		<div class="form-group">
			<label class="col-md-4 control-label">History</label>
			<div class="col-md-6 col-md-offset-4">
				@include('profile.history.create')
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Activities</label>
			<div class="col-md-6 col-md-offset-4">
				@include('profile.activity.create')
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Education</label>
			<div class="col-md-6 col-md-offset-4">
				@include('profile.education.create')
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					Update
				</button>
			</div>
		</div>



	</form>

	


<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">

	var stores = <?php echo ($storeobj_list); ?>;


	$(".add_experience").click(function(){
		$(
			
			'<div  class="experience col-md-12">'+	
			'<span class=" col-md-3">'+
			'{!! Form::label('past_store[]', "Store Number :  ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('past_store[]', null, array('class' => 'form-control', 'id'=>'storenumber') ) !!} '+
			' </span>'+

			'<span class=" col-md-3"> '+
			' {!! Form::label('past_position[]', "  Position :   ", array('class' => 'control-group')) !!}    '+
			' {!! Form::select('past_position[]', $positions_list, null , array('class' => 'form-control') ) !!} '+
			'</span>'+
			
			'<span class=" col-md-2">'+
			' {!! Form::label('past_start[]', "  Start Date: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('past_start[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+
			
			'<span class=" col-md-2">'+
			'{!! Form::label('past_end[]', "  End Date: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('past_end[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+
			'<span class="remove">'+
			'<a  class="remove_experience btn btn-primary"> Remove </a>'+ 
			'</span>'+
			'</div>'
		
			

		).insertBefore($(".add_experience").parent()).hide().slideDown(300);
		$("#storenumber").autocomplete({
			source : stores
		})
		
	});

	 $("#profile_form").on("click", ".remove_experience", function(){
	 	$(this).parent().parent().slideUp(300)

	});

	 $(".add_activity").click(function(){
		
		$(
			
			'<div  class="experience col-md-12">'+	
			'<span class=" col-md-3">'+
			'{!! Form::label('activity[]', "Activity :  ", array('class' => 'control-group')) !!} '+
			'{!! Form::select('activity[]', $activity_list , null, array('class' => 'form-control') ) !!} '+
			' </span>'+

			'<span class=" col-md-3"> '+
			' {!! Form::label('activity_level[]', "  Level :   ", array('class' => 'control-group')) !!}    '+
			' {!! Form::select('activity_level[]', $activity_level_list, null , array('class' => 'form-control') ) !!} '+
			'</span>'+
			
			'<span class=" col-md-2">'+
			' {!! Form::label('activity_start[]', "  Start Date: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('activity_start[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+
			
			'<span class=" col-md-2">'+
			'{!! Form::label('activity_end[]', "  End Date: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('activity_end[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+
			'<span class="remove">'+
			'<a  class="remove_activity btn btn-primary"> Remove </a>'+ 
			'</span>'+
			'</div>'
		
			

		).insertBefore($(".add_activity").parent()).hide().slideDown(300);
		

		
	});

 	$("#profile_form").on("click", ".remove_activity", function(){
	 	$(this).parent().parent().slideUp(300)

	});

	$(".add_education").click(function(){
		
		$(
			
			'<div  class="education col-md-12">'+	
			'<span class=" col-md-3">'+
			'{!! Form::label('edu_focus[]', "Education Focus :  ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('edu_focus[]', null , array('class' => 'form-control') ) !!} '+
			' </span>'+

			'<span class=" col-md-3"> '+
			' {!! Form::label('edu_level[]', "Education Level :   ", array('class' => 'control-group')) !!}    '+
			' {!! Form::select('edu_level[]', $edu_level_list, null , array('class' => 'form-control') ) !!} '+
			'</span>'+
			
			'<span class=" col-md-2">'+
			' {!! Form::label('edu_start[]', "Start Date: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('edu_start[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+
			
			'<span class=" col-md-2">'+
			'{!! Form::label('edu_end[]', "End Date: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('edu_end[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+

			'<span class=" col-md-2">'+
			'{!! Form::label('school[]', "School Name: ", array('class' => 'control-group')) !!} '+
			'{!! Form::text('school[]' , null,  ['class'=>'form-control ']) !!} '+						
			
			'</span>'+
			'<span class="remove">'+
			'<a  class="remove_education btn btn-primary"> Remove </a>'+ 
			'</span>'+
			'</div>'
		
			

		).insertBefore($(".add_education").parent()).hide().slideDown(300);
		
	});

	 $("#profile_form").on("click", ".remove_education", function(){
	 	$(this).parent().parent().slideUp(300)

	});

	 $(".delete_experience").change(function() {
	    if ($(this).prop('checked') == true) {
	    	$(this).append('<input type="text" name="delete_experience[]" value ='+ $(this).attr('data-experience-id') +'>')
	    }
	    if ($(this).prop('checked') == false) {
	    	console.log($('input[name="delete_experience[]"] option[value= '+ $(this).attr('data-experience-id') + '] '))
	    	$('input[name="delete_experience[]"][value= ' + $(this).attr('data-experience-id') + ']').remove();
	    }
	});

	 $('.delete_activity').change(function(){
	 	if ($(this).prop('checked') == true) {
	 		$(this).append('<input type="text" name="delete_activity[]" value ='+ $(this).attr('data-activity-id') +'>')
	 	}
	 	if ($(this).prop('checked') == false) {
	    	$('input[name="delete_activity[]"][value= ' + $(this).attr('data-activity-id') + ']').remove();
	    }

	 })

	 $('.delete_education').change(function(){
	 	if ($(this).prop('checked') == true) {
	 		$(this).append('<input type="text" name="delete_education[]" value='+ $(this).attr('data-education-id') +'>')
	 	}
	 	if ($(this).prop('checked') == false) {
	    	$('input[name="delete_education[]"][value= ' + $(this).attr('data-education-id') + ']').remove();
	    }
	 })

	 
	</script>
@endsection
