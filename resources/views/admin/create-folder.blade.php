<p>create a folder</p>


{!! Form::open(array('action' => 'FolderAdminController@store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form')) !!}
                    



                        <div class="form-group">
                            <label for="foldername">Folder Name</label>
                            <input type="text" class="form-control" id="foldername" name="foldername" value="">
                        </div>
     
                        
                        <div class="form-group">  

                            
                            
                            <div class="col-sm-5 pull-right">
                               
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon glyphicon-ok"></span> Save</button>

                            </div>

                        </div>
                        <div class="form-group"> 
                            
                        </div>
                    	
                    {!! Form::close() !!}