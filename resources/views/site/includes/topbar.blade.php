<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0" >
{{-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> --}}
{{-- <div class="navbar-header" style="">

</div> --}}

    <style type="text/css">
    
        @media (max-width: 767px){
            .custom-col-xs-1 {
                width:10%;
            }
            .custom-col-xs-10 {
                width:80%;
            }
        }

        @media (max-width: 1045px) and (min-width: 992px)  {
          .truncate {
                display:inline-block;
                width: 120px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
        .store-details{
            font-size: 22px;
            position: relative;
            top:12px;
            right:5px;
            float: right;
            
        }
        .form-inline {

            @media (min-width: 768px ) {
            
                .form-group {
                  display: inline-block;
                  margin-bottom: 0;
                  vertical-align: middle;
                }


                .form-control {
                  display: inline-block;
                  width: auto; 
                  vertical-align: middle;
                }

                .input-group > .form-control {
                  width: 100%;
                }
            }
        }

        input:focus::-webkit-input-placeholder { color:transparent; }

    </style>

    <div class="row">
        <div class="navbar-minimalize minimalize-styl-2 btn btn-primary ">
                <i class="fa fa-bars"></i>
        </div>
    
        <div class="col-lg-6 col-md-6 col-sm-9 col-xs-8">
            <div class="" style="padding-right: 20px;margin:10px 0px;">
                @include('site.includes.search')
            </div>
        </div>
        

        <div class="hidden-xs hidden-sm">
            
            <div class="" style="padding: 15px 30px 0px 0px; float:right">
                <span class="truncate" id="store-name">
                </span>
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
        <div class="visible-xs visible-sm col-xs-1 col-sm-1">
            <div class="store-details ">
                <i class="fa fa-university" style=""></i>
            </div>
            
        </div>

    </div>

     <script type="text/javascript">
        var s = localStorage.getItem('userStoreName');
        s = s.replace(/^A/, "");
        var storeName = document.getElementById('store-name');
        storeName.innerHTML = s;
                
    </script>
</nav>