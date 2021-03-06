<div class="modal inmodal" id="fileviewmodal" tabindex="-1" role="document" aria-hidden="true" style="display: none;">

    <i class="fa fa-times-circle-o pull-right" id="dismissmodal" data-dismiss="modal" style="font-size: 40px !important; color: #fff; cursor: pointer; padding: 20px;"></i>

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


 <div class="modal inmodal" id="changelogmodal" tabindex="-1" role="event" aria-hidden="true" style="display: none;" >

    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
<!--                 <div class="modal-header clearfix">
                    <h4 id="modalTitle" class="modal-title">What's New?</h4>
                </div> -->
                <div id="modalBody" class="modal-body event-modal-body" style="padding: 20px;">
                    
                    <?php
                    include('../public/whats-new.html');
                    ?>

                </div>
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
                <i class="fa fa-comment-o modal-icon"></i>
                <h4 class="modal-title">Feedback</h4>
  <!--               <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
            </div>

            <div class="modal-body" style="padding: 10px 10px;">
                <div class="form-group">
                    
                    <input type="hidden" name="bugreport_store_number" id="bugreport_store_number" value="{{ Request::segment(1) }}" />
                    <input type="hidden" name="bugreport_user" id="bugreport_user" value="" />
                    <input type="hidden" name="bugreport_url" id="bugreport_url" value="{{ Request::path() }}" />

                    <textarea rows="5" class="form-control" name="bugreport_desc" id="bugreport_desc" placeholder="Please describe the issue"></textarea>
                    <br />
                    <div class="row">
                        <div class="col-md-8">
                            <input type="email" placeholder="Enter your email (optional)" class="form-control" name="bugreport_email"  id="bugreport_email" value="" />
                        </div>
                        <div class="col-md-4">
                            <label>
                                <input class="" type="checkbox" value="1" name="bugreport_followup" id="bugreport_followup"</input> Need a Follow Up? 
                            </label>
                        </div>
                    </div>
                    

                </div>
        
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary sendBugReport" data-dismiss="modal">Send</button>
            </div>
        </div>
    </div>
</div> 


<script>
    document.getElementById("videoplayer").allowTransparency = "true";
</script>