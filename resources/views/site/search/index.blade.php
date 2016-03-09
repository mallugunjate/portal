<!DOCTYPE html>
<html>

<head>
    @section('title', 'Search')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')

    <style>

    #footer{
        position: fixed;
        bottom: 0px;
    }

    </style>    
    
</head> 

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg clearfix">
            <div class="row border-bottom">
                @include('site.includes.topbar')
            </div>


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Search <span class="search-query">this is wheere we'd put the string</span></h2>
<!--                 <ol class="breadcrumb">
                    <li>jdaf ja fl aslk salk adslkd aslkdsa lksad</li>
                </ol> -->
            </div>
            
        </div>            



            <div class="wrapper wrapper-content">

    


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Documents <small>45 results</small></h2>
                        </div>

                        <div class="mail-box">


<table class="table tablesorter table-hover table-mail tablesorter-default" id="file-table" role="grid"><thead><tr> <th> Title </th> <th> Description </th> <th> Uploaded At </th> <th> Start </th> <th> End </th> </tr></thead><tbody><tr> <td class="mail-subject"><a href="#"><i class="fa fa-file-o"></i> no title</a></td> <td>no description</td> <td>2013-06-27 23:24:07</td> <td>0000-00-00 00:00:00</td> <td>0000-00-00 00:00:00</td> <td></td> </tr><tr> <td class="mail-subject"><a href=""><i class="fa fa-file-image-o"></i> no title</a></td> <td>no description</td> <td>2016-01-25 23:24:08</td> <td>0000-00-00 00:00:00</td> <td>0000-00-00 00:00:00</td> <td></td> </tr></tbody></table>
<!-- 
                            <table class="table table-hover table-mail">
                                <tbody>

                                    <tr class="read">
                                    
                                        <td class="check-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </td>

                                                                <td class="mail-subject">
                                                                            <a href="communication/show/18">this is a message</a>
                                            </td>
                                                            
                                        <td class="mail-preview"><a href="communication/show/18">dsdasdsa</a></td>
                                        
                                        <td class="text-right mail-date">Thu, Feb 11, 2016 12:00 am <small style="font-weight: normal;padding-left: 10px;">(3 weeks ago)</small></td>
                                    </tr>                

                                                 
                                </tbody>
                            </table> -->


                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Folders <small>4 results</small></h2>
                        </div>

                        <div class="mail-box">


                            <table class="table table-hover table-mail">
                                <tbody>

                                    <tr class="read">
                                    
                                        <td class="check-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </td>

                                                                <td class="mail-subject">
                                                                            <a href="communication/show/18">this is a message</a>
                                            </td>
                                                            
                                        <td class="mail-preview"><a href="communication/show/18">dsdasdsa</a></td>
                                        <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                                        <td class="text-right mail-date">Thu, Feb 11, 2016 12:00 am <small style="font-weight: normal;padding-left: 10px;">(3 weeks ago)</small></td>
                                    </tr>                

                                                 
                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>                
           

                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Communications <small>3 results</small></h2>
                        </div>

                        <div class="mail-box">


                            <table class="table table-hover table-mail">
                                <tbody>

                                    <tr class="read">
                                    
                                        <td class="check-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </td>

                                                                <td class="mail-subject">
                                                                            <a href="communication/show/18">this is a message</a>
                                            </td>
                                                            
                                        <td class="mail-preview"><a href="communication/show/18">dsdasdsa</a></td>
                                        <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                                        <td class="text-right mail-date">Thu, Feb 11, 2016 12:00 am <small style="font-weight: normal;padding-left: 10px;">(3 weeks ago)</small></td>
                                    </tr>                

                                                 
                                </tbody>
                            </table>


                        </div>
                    </div>

                </div> 


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Alerts <small>3 results</small></h2>
                        </div>

                        <div class="mail-box">


                            <table class="table table-hover table-mail">
                                <tbody>

                                    <tr class="read">
                                    
                                        <td class="check-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </td>

                                                                <td class="mail-subject">
                                                                            <a href="communication/show/18">this is a message</a>
                                            </td>
                                                            
                                        <td class="mail-preview"><a href="communication/show/18">dsdasdsa</a></td>
                                        <td class=""><!-- <i class="fa fa-paperclip"></i> --></td>
                                        <td class="text-right mail-date">Thu, Feb 11, 2016 12:00 am <small style="font-weight: normal;padding-left: 10px;">(3 weeks ago)</small></td>
                                    </tr>                

                                                 
                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>    


                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="search-box-header">
                            <h2>Communications <small>0 results</small></h2>
                        </div>

<!--                         <div class="mail-box">


                            <table class="table table-hover table-mail">
                                <tbody>

                                    <tr class="read">
                                    
                                        <td class="check-mail">
                                            <i class="fa fa-envelope-o"></i>
                                        </td>

                                                                <td class="mail-subject">
                                                                            <a href="communication/show/18">this is a message</a>
                                            </td>
                                                            
                                        <td class="mail-preview"><a href="communication/show/18">dsdasdsa</a></td>
                                        
                                        <td class="text-right mail-date">Thu, Feb 11, 2016 12:00 am <small style="font-weight: normal;padding-left: 10px;">(3 weeks ago)</small></td>
                                    </tr>                 

                                                 
                                </tbody>
                            </table>


                        </div> -->
                    </div>

                </div>                              

                <br class="clearfix" />
            </div>

        </div>
    </div>

    @include('site.includes.footer')       
    @include('site.includes.scripts')
    @include('site.includes.bugreport')
    @include('site.includes.modal')


</body>
</html> 

