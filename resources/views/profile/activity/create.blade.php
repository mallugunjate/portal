@if (count($profile_experiences)>0)	
	@foreach ($profile_activities as $activity)
	<div  class="activity col-md-12"> 
		
	<span class="col-md-3"> 
		{!! Form::label('activity[]', "Activity : ") !!}
		{!! Form::select('activity[]', $activity_list, $activity->activity_id, ['class'=>'form-control ', 'disabled'=>'disabled']) !!}
		
	</span>
	<span class="col-md-3">
		{!! Form::label('activity_level[]', "Level : ") !!}
		{!! Form::select('activity_level[]', $activity_level_list, $activity->level_id, ['class'=>'form-control ', 'disabled'=>'disabled']) !!}
		
	</span>
	<span class="col-md-2">
		{!! Form::label('past_start[]', "Start Date: ") !!}
		{!! Form::text('activity_start[]', $activity->start, ['class'=>'form-control ', 'readonly'=>'readonly', 'disabled'=>'disabled']) !!}
	</span>

	<span class="col-md-2">
		{!! Form::label('past_end[]', "End Date: ") !!}
		{!! Form::text('activity_end[]', $activity->finished, ['class'=>'form-control ', 'readonly'=>'readonly', 'disabled'=>'disabled']) !!}
		
	</span>
	<span class="col-md-2">
		{!! Form::checkbox('delete', 'Delete', null ,['data-activity-id'=>$activity->id, 'class'=>'delete_activity'])  !!}
		{!! Form::label('delete', 'Delete activity') !!}
	</span>
	</div>
	@endforeach
@endif	
	<div class="col-md-1">
			<label></label>
			<a  name ="add_activity" class="add_activity btn btn-primary"> Add More  </a> 
	</div>	
		
