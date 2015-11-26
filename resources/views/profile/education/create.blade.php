@if (count($profile_education)>0)	
	@foreach ($profile_education as $education)
	<div  class="education col-md-12"> 

	<span class="col-md-3"> 
		{!! Form::label('edu_focus[]', "Education Focus : ") !!}
		{!! Form::text('edu_focus[]', $education->focus, ['class'=>'form-control', 'readonly'=>'readonly',  'disabled'=>'disabled']) !!}
		
	</span>
	<span class="col-md-3">
		{!! Form::label('edu_level[]', "Education Level : ") !!}
		{!! Form::select('edu_level[]', $edu_level_list, $edu_level_list[$education->education_level_id], ['class'=>'form-control ', 'disabled'=>'disabled']) !!}
		
	</span>
	<span class="col-md-2">
		{!! Form::label('edu_start[]', "Start Date: ") !!}
		{!! Form::text('edu_start[]', $education->education_start, ['class'=>'form-control ', 'readonly'=>'readonly',  'disabled'=>'disabled']) !!}
	</span>

	<span class="col-md-2">
		{!! Form::label('edu_end[]', "End Date: ") !!}
		{!! Form::text('edu_end[]', $education->education_end, ['class'=>'form-control ', 'readonly'=>'readonly',  'disabled'=>'disabled']) !!}
		
	</span>

	<span class="col-md-2">
		{!! Form::label('school[]', "School Name: ") !!}
		{!! Form::text('school[]', $education->school_name, ['class'=>'form-control ', 'readonly'=>'readonly',  'disabled'=>'disabled']) !!}
		
	</span>

	<span class="col-md-2">
		{!! Form::checkbox('delete', 'Delete', null, ['data-education-id'=>$education->id, 'class'=>'delete_education'])  !!}
		{!! Form::label('delete', 'Delete Education') !!}
	</span>
	</div>
	@endforeach
@endif
	
	<div class="col-md-1">
			<label></label>
			<a  name ="add_education" class="add_education btn btn-primary"> Add More  </a> 
	</div>

		