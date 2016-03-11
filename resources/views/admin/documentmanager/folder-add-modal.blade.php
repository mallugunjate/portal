{!! Form::open(['action' => ['Document\FolderAdminController@store'], 'method' => 'POST']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        {{-- <h4 class="modal-title">Edit Folder <i>{{$folder->name}}</i></h4> --}}
        <h4 class="modal-title">Add subfolder</h4>
    </div>

    <div class="modal-body">
        

        <input type="hidden" name="banner_id" value={{$banner->id}}>
        <input type="hidden" name="parent" value={{$parent}}>

        <div class="form-group">                                
            <label>Subfolder name <span class="req">*</span></label>
            
            <input type="text" name="name"  class="form-control">
        </div>


    </div>

    <div class="modal-footer">

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Create subfolder</button>
    </div>

{!! Form::close() !!}

	

        <script type="text/javascript" src="/js/custom/admin/folders/editFolder.js"></script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>

    <script type="text/javascript">
        $(function () {
            $('.disabled-button-container').tooltip()
            $('.chosen').chosen({
                width:'100%'
            })
        })
    </script>


