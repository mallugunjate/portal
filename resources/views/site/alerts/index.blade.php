<!DOCTYPE html>
<html>

<head>
    @section('title', 'Alerts')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    <style>
    .modal-lg{ height: 95%; width: 80% !important; padding: 0; }
    .modal-content{ height: 100% !important;}
    .modal-body{ padding: 0; margin: 0; height: 100% !important; }
    </style>    
</head>	

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
           @include('site.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
              @include('site.includes.topbar') 
        </div>


<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">

            @include('site.alerts.alertssidebar')

            </div>
            <div class="col-lg-10 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                	@if($title == "")
                		All Alerts <small>({{ $alertCount }} active alert)</small>	
                	@else
                		{{ $title }}
                	@endif

                    
                </h2>

            </div>
                <div class="mail-box">


                <table class="table table-hover table-mail">
                <tbody>
                    <thead>
                        <tr> 
                            <th>&nbsp;</th>
                            <th> Alert File </th>
                            <th> Alert Type</th>
                            <th> Description </th>
                            <th> Date </th> 
                        </tr>
                    </thead>

                @foreach($alerts as $alert)
                

                <tr class="unread">

                    <td class="check-mail">
                        <i class="fa fa-bell-o"></i>
                    </td>
                    
                    <td class="mail-subject"><a href="#" class="launchPDFViewer" data-toggle="modal" data-target="#fileviewmodal" data-file="/files/{{ $alert->filename }}">{!! $alert->icon !!} {{ $alert->title }}</a></td>
                    <td><span class="label label pull-left">{{ $alert->alertTypeName }}</span></td>
                    <td class="mail-preview">{{ $alert->description }}</td>
                    
                    <td class="mail-date">{{ $alert->prettyDate }} <small style="font-weight: normal;padding-left: 10px;">({{ $alert->since }} ago)</small></td>
                </tr>                

                @endforeach
                 
                </tbody>
                </table>


                </div>
            </div>
        </div>
        </div>



    @include('site.includes.footer')       
  
    @include('site.includes.scripts')

    <script type="text/javascript">
        $("body").on("click", ".launchPDFViewer", function(e){
            var filepath = $(this).attr("data-file");
            $("#fileviewmodal").find('iframe').attr("src", filepath);
        });
    </script>


    @include('site.includes.bugreport')
    @include('site.includes.modal')

</body>
</html> 