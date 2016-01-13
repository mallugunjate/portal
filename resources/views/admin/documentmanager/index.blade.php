<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document Manager')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation" onload="checkDeepLink()">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('admin.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('admin.includes.topbar')
        </div>

       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Document Manager</h2>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/document">Documents</a></li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="file-manager">

                                <h5>Folders</h5>
                                    @include('admin.navigation-view', ['navigation'=>$navigation])
                                    <div id="file-container" class="hidden">
                                    <ol class="breadcrumbs"></ol>
                                    <input type="hidden" name="default_folder" value={{$defaultFolder}}>
                            {{--         @include('admin.documentmanager.document-table') --}}
                                    </div>
                                    <div id="package-viewer" class="hidden">
                                    @include('admin.package.view')
                                    </div>
                                    

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 animated fadeInRight">
                    
                    <div class="row">

                        <div class="col-lg-12">

                        <div id="file-container" class="ibox">
{{--                             <div class="ibox-title">
                                <div class="ibox-tools">
                                    
                                </div>
                            </div> --}}


                            <div class="ibox-content">
                            
                                <input type="hidden" name="default_folder" value={{ $defaultFolder }}>
                               {{--  @include('site.documents.document-table') --}}
                                    @include('admin.documentmanager.document-table')
                                


                                <form id="example-advanced-form" action="#">
                                    <h3>Upload Files</h3>
                                    <fieldset>
                                {{--         <legend>Account Information</legend>
                                 
                                        <label for="userName-2">User name *</label>
                                        <input id="userName-2" name="userName" type="text" class="required">
                                        <label for="password-2">Password *</label>
                                        <input id="password-2" name="password" type="text" class="required">
                                        <label for="confirm-2">Confirm Password *</label>
                                        <input id="confirm-2" name="confirm" type="text" class="required">
                                        <p>(*) Mandatory</p> --}}
                                        <div id="file-uploader" class="hidden">
                                            <div id="watermark">Drag and drop documents here</div>
                                            @include('admin.documentmanager.document-upload')
                                        </div>

                                    </fieldset>
                                 
                                    <h3>Meta Data</h3>
                                    <fieldset>
                                        <legend>Profile Information</legend>
                                 
                                        <label for="name-2">First name *</label>
                                        <input id="name-2" name="name" type="text" class="required">
                                        <label for="surname-2">Last name *</label>
                                        <input id="surname-2" name="surname" type="text" class="required">
                                        <label for="email-2">Email *</label>
                                        <input id="email-2" name="email" type="text" class="required email">
                                        <label for="address-2">Address</label>
                                        <input id="address-2" name="address" type="text">
                                        <label for="age-2">Age (The warning step will show up if age is less than 18) *</label>
                                        <input id="age-2" name="age" type="text" class="required number">
                                        <p>(*) Mandatory</p>
                                    </fieldset>
                                 

                                </form>


                                <!---     -->
                                    
                            </div>
                        </div>

                          

                        <div class="topLevelNavItems">
                        <h1>Documents</h1>
                        @foreach ($navigation as $nav) 

                            @if ( $nav["is_child"] == 0)
                                
                                <div class="file-box">
                                    <div class="file">
                                        <a id="{{ $nav['id'] }}" class="parent-folder folder branch" href="/documentmanager#!/{{ $nav['id'] }}">
                                            <span class="corner"></span>

{{--                                             <div class="icon">
                                                <i class="fa fa-folder"></i>
                                            </div> --}}

                                        <div class="image">
                                            <img alt="image" class="img-responsive" src="/images/p2.jpg">
                                        </div>                                            

                                            <div class="file-name">
                                                {{ $nav["label"] }}
                                                <br>
                                                {{-- <small>Added: Jan 11, 2014</small> --}}
                                            </div>
                                        </a>
                                    </div>
                                </div>                                

                            @endif

                        @endforeach
                        </div>



                            </div>
                        </div>





 

                        </div>

          
                    </div>


                    </div>

                    

                </div>
                </div>



    </div>

</div>
{{-- 
            @include('site.includes.modal') --}}

                @include('site.includes.footer')

                @include('admin.includes.scripts')

            <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
            <script type="text/javascript" src="/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="/js/vendor/jquery-ui.min.js"></script>
            <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
            <script type="text/javascript" src="/js/custom/admin/folders/folderStructure.js" ></script>
            <script type="text/javascript" src="/js/custom/admin/documents/fileTable.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/deleteFile.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/getPackages.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/deletePackage.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/showPackage.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/breadcrumb.js"></script>
            <script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
            <script type="text/javascript" src="/js/vendor/dropzone.js"></script>
            <script type="text/javascript" src="/js/custom/admin/documents/uploadDocument.js"></script>
            <script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
            <script type="text/javascript" src="/js/vendor/lightbox.min.js"></script>
            <script type="text/javascript" src="/js/custom/tree.js"></script>
            <script type="text/javascript" src="/js/plugins/steps/jquery.steps.min.js"></script>
             {{--    <script type="text/javascript" src="/js/custom/folderStructure.js" ></script> --}}
                {{-- <script type="text/javascript" src="/js/custom/site/documents/breadcrumb.js" ></script --}}>
 {{--                <script type="text/javascript" src="/js/custom/site/documents/fileTable.js" ></script> --}}

                <script type="text/javascript">


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(document).ready(function() {



// var form = $("#example-advanced-form").show();
 
// form.steps({
//     headerTag: "h3",
//     bodyTag: "fieldset",
//     transitionEffect: "slideLeft",
//     onStepChanging: function (event, currentIndex, newIndex)
//     {
//         // Allways allow previous action even if the current form is not valid!
//         if (currentIndex > newIndex)
//         {
//             return true;
//         }
//         // Forbid next action on "Warning" step if the user is to young
//         if (newIndex === 3 && Number($("#age-2").val()) < 18)
//         {
//             return false;
//         }
//         // Needed in some cases if the user went back (clean up)
//         if (currentIndex < newIndex)
//         {
//             // To remove error styles
//             form.find(".body:eq(" + newIndex + ") label.error").remove();
//             form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
//         }
//         form.validate().settings.ignore = ":disabled,:hidden";
//         return form.valid();
//     },
//     onStepChanged: function (event, currentIndex, priorIndex)
//     {
//         // Used to skip the "Warning" step if the user is old enough.
//         if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
//         {
//             form.steps("next");
//         }
//         // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
//         if (currentIndex === 2 && priorIndex === 3)
//         {
//             form.steps("previous");
//         }
//     },
//     onFinishing: function (event, currentIndex)
//     {
//         form.validate().settings.ignore = ":disabled";
//         return form.valid();
//     },
//     onFinished: function (event, currentIndex)
//     {
//         alert("Submitted!");
//     }
// }).validate({
//     errorPlacement: function errorPlacement(error, element) { element.before(error); },
//     rules: {
//         confirm: {
//             equalTo: "#password-2"
//         }
//     }
// });




                        
                        $(".tree").treed({openedClass : 'fa-folder-open', closedClass : 'fa-folder'});

                        var defaultFolderId = $("input[name='default_folder']").val();

                        if (defaultFolderId) {
                            var folder = $("#"+defaultFolderId);
                            $("#"+defaultFolderId).parent().click();
                            $.ajax({
                                url : '/admin/document',
                                data : {
                                    folder : defaultFolderId,
                                    isWeekFolder : folder.attr("data-isweek")
                                }
                            })
                            .done(function(data){
                                console.log(data);
                                fillTable(data);
                            });
                        }

                    }); 
                </script>


                @include('site.includes.bugreport')

            </body>