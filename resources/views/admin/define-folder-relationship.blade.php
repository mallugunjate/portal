<p>define a parent/child folder relation</p>


{!! Form::open(array('action' => 'FolderStructureAdminController@store', 'files' => false, 'class' => 'form-horizontal', 'role' => 'form')) !!}
                    
        <div class="form-group">
            <label for="parent">Parent Folder</label>
           	<select class="form-contorl" id="parent" name="parent">
           		@foreach ($folders as $folder)
           			<option value="{{ $folder->id }}">{{ $folder->name }}</option>
           		@endforeach
           	</select>
           		
        </div>


		<div class="form-group">
            <label for="child">Child Folder</label>
            <select class="form-control" id="child" name="child">
           		@foreach ($folders as $folder)
           			<option value="{{ $folder->id }}">{{ $folder->name }}</option>
           		@endforeach            	
            </select>
        </div>        

        <div class="form-group">  

            <div class="col-sm-5 pull-right">
               
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-ok"></span> Save</button>

            </div>

        </div>
        
                    	
{!! Form::close() !!}