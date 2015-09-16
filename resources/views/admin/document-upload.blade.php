<p>this is the document upload view</p>


{!! Form::open(array('action' => 'DocumentAdminController@store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form')) !!}
                    

                        <div class="form-group">
                            <label for="document">Document</label>
                            {!! Form::file('document') !!}
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="">
                        </div>
     
                        <div class="form-group">    
                            <label for="description">Description <small>&mdash; 1 or 2 sentences<small></label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>    
                        <div class="form-group">  

                            
                            
                            <div class="col-sm-5 pull-right">
                               
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-ok"></span> Save</button>

                            </div>

                        </div>
                        <div class="form-group"> 
                            
                        </div>
                    	
                    {!! Form::close() !!}