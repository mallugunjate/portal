

    <style type="text/css">
/*        form {
            border: thin solid #e9e9e9;
            margin-top: 25px;
            padding: 20px;
        }
        .form-title{
            padding-top:20px;
            font-size:22px;
            font-weight: bold;
        }
        .deleteFolder{

        }*/
        #addWeekContainer, #addFolderContainer, #addChildFolderContainer{
            display: block;
            display: none;
        }
    </style>

    {!! Form::open(['action' => ['Document\FolderAdminController@store'], 'method' => 'POST']) !!}

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        {{-- <h4 class="modal-title">Edit Folder <i>{{$folder->name}}</i></h4> --}}
        <h4 class="modal-title">Add subfolder</h4>
    </div>

    <div class="modal-body">
        

        <input type="hidden" name="banner_id" value={{$banner->id}}>


        <div class="form-group">                                
            <label>Subfolder Name <span class="req">*</span></label>
            
            <input type="text" name="child[]"  class="form-control">
        </div>


    </div>

    <div class="modal-footer">

        {{-- @if(empty($params))
                            <button class="deleteFolder btn btn-danger pull-left" id="deleteFolder{{$folder->id}}" data-id=
                            "{{$folder->id}}"><i class="fa fa-trash"></i> Delete Folder </button>
                        @else
                            <div class="disabled-button-container pull-left" data-toggle="tooltip" data-placement="right"  title="Only empty folders can be deleted">
                                <a class="btn btn-danger" disabled="disabled"><i class="fa fa-trash"></i> Delete Folder </a>
                            </div>
                        @endif --}}

        <button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
        <button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
    </div>

    {!! Form::close() !!}

	

        <script type="text/javascript" src="/js/custom/admin/folders/editFolder.js"></script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
{{--     <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/custom/editFolder.js"></script>
    <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script> --}}
    <script type="text/javascript">
        $(function () {
            $('.disabled-button-container').tooltip()
            $('.chosen').chosen({
                width:'100%'
            })
        })
    </script>


