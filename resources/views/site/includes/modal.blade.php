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


 <div class="modal inmodal" id="fullCalModal" tabindex="-1" role="event" aria-hidden="true" style="display: none;" >

    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header clearfix">
                    
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body event-modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
        </div>
    </div>
</div>


<div class="modal inmodal" id="bugreportmodal" tabindex="-1" role="event" aria-hidden="true" style="display: none;">

    <div class="modal-dialog">
        <div class="modal-content animated flipInY">

            <div class="modal-header clearfix">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <i class="fa fa-bug modal-icon"></i>
                <h4 class="modal-title">Report a Bug</h4>
                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
            </div>

            <div class="modal-body" style="padding: 0px 10px;">
                <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
                    remaining essentially unchanged.</p>
                        <div class="form-group"><label>Sample Input</label> <input type="email" placeholder="Enter your email" class="form-control"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary sendBugReport" data-dismiss="modal">Send</button>
            </div>
        </div>
    </div>
</div> 

    <script>
        $(document).ready(function() {

            $('.sendBugReport').click(function(){
                swal({
                    title: "Thanks!",
                    text: "You're helping us build something awesome!",
                    type: "success"
                });
            });

        });
    </script>

<script>
    document.getElementById("videoplayer").allowTransparency = "true";
</script>