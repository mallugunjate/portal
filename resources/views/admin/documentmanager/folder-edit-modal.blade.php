{!! Form::model($folder, ['action' => ['Document\FolderAdminController@update', 'id'=>$folder->id], 'method' => 'PUT']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Rename Folder <i>{{$folder->name}}</i></h4>
    </div>

    <div class="modal-body">
        

                            <input type="hidden" name="banner_id" value={{$banner->id}}>

                            <div class="form-group">
                                <h5 class="clearfix">Folder name <span class="req">*</span></h5>
                                {!! Form::text('name', $folder->name, ['class'=>'form-control']) !!}
                            </div>


    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
    </div>

{!! Form::close() !!}

	


