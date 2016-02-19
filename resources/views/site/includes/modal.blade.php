    <div class="modal inmodal" id="fileviewmodal" tabindex="-1" role="document" aria-hidden="true" style="display: none;">

        <i class="fa fa-times-circle-o pull-right" data-dismiss="modal" style="font-size: 40px !important; color: #fff; cursor: pointer; padding: 20px;"></i>

        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

                <div class="modal-body">

                    <iframe src="" frameborder="0" height="100%" width="100%" allowtransparency="true"></iframe> 
            
                </div>

            </div>
        </div>
    </div>


    <div class="modal inmodal" id="videomodal" tabindex="-1" role="video" aria-hidden="true" style="display: none;">

        <i class="fa fa-times-circle-o pull-right" data-dismiss="modal" style="font-size: 40px !important; color: #fff; cursor: pointer; padding: 20px;"></i>

        <div class="modal-dialog modal-lg" role="video" style="overflow: hidden;">
            <div class="modal-content videomodaltransparent" style="overflow: hidden;">

                <div class="modal-body" style="overflow: hidden;">
                    <iframe frameborder="0" src="" frameborder="0" height="100%" width="100%" id="videoplayer" allowTransparency="true" style="overflow: hidden;"></iframe>     
                </div>

            </div>
        </div>
    </div>    


     <div class="modal inmodal" id="fullCalModal" tabindex="-1" role="video" aria-hidden="true" style="display: none;" >

        <i class="fa fa-times-circle-o pull-right" data-dismiss="modal" style="font-size: 40px !important; color: #fff; cursor: pointer; padding: 20px;"></i>

<!--         <div class="modal-dialog" role="event">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body">

        
                </div>

            </div>
        </div> -->
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        
                        <h4 id="modalTitle" class="modal-title"></h4>
                    </div>
                    <div id="modalBody" class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
    
<script>
    document.getElementById("videoplayer").allowTransparency = "true";
</script>