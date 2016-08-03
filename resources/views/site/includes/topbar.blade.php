<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0" >
{{-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> --}}
{{-- <div class="navbar-header" style="">

</div> --}}
    <script>
        var s = localStorage.getItem('userStoreName');
        s = s.replace(/^A/, "");

    </script>
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
            <div class="navbar-minimalize minimalize-styl-2 btn btn-primary ">
                <i class="fa fa-bars"></i>
            </div>
            <div class="" style="padding: 15px 10px 0px 20px;">
                <script>document.write( s );</script> 
                @if($isComboStore == 1) 
                &nbsp;&nbsp;
                <span class="comboStoreSwitch">
                    <div class="switch">
                        <div class="combostore-onoffswitch onoffswitch">
                            
                            @if($banner->id == 1)
                            <input type="checkbox" checked class="onoffswitch-checkbox" id="comboStore" name="comboStore">
                            @else
                            <input type="checkbox" class="onoffswitch-checkbox" id="comboStore" name="comboStore">
                            @endif
                            
                            <label class="onoffswitch-label" for="comboStore">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </span>
                @endif

                &nbsp;&nbsp;<a id="storeswitch" style="display: inline;"><i class="fa fa-sitemap "></i> Change Store</a>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="pull-right-custom" style="padding-right: 20px;">
                <form role="form" class="form-inline" style="width: 100%; padding-left: 10px; padding-top: 5px;" method="get" action="/{{ Request::segment(1) }}/search">
                    <div class="row visible-xs visible-sm">
                        <div class="col-sm-1 col-xs-1">
                            <i class="fa fa-search" style="font-size: 24px; color: #ccc; line-height: 10px; position:relative; top: 12px;"></i>
                        </div>
                        <div class="col-sm-8 col-xs-8">
                            <input type="text" class="form-control" name="q" id="top-search" placeholder="" id="search" style="border: none; border-bottom: 1px solid #ccc; font-size: 20px; margin:0px 10px; ">
                        </div>
                        <div class="col-sm-1 col-xs-1">
                            <button type="submit" class="btn btn-primary btn-sm" style="display: inline ; ">Search</button>
                        </div>
                    </div>

                    <div class="row hidden-xs hidden-sm">
                        <i class="fa fa-search" style="display: inline !important; font-size: 24px; color: #ccc; line-height: 10px; position:relative; top: 12px;"></i>

                        <input type="text" class="form-control" name="q" id="top-search" placeholder="" id="search" style="border: none; border-bottom: 1px solid #ccc; font-size: 20px; margin:0px 10px;">

                        <button type="submit" class="btn btn-primary btn-sm" style="display: inline ;">Search</button>

                    </div>
                </form>

            </div>

        </div>


    </div>
</nav>