<!DOCTYPE html>
<html>

<head>
    @section('title', 'Dashboard')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    
</head> 

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg" style="background: #f3f3f4 url('/images/dashboard-banners/hockey.jpg') top left no-repeat;">
            <div class="row border-bottom">
                @include('site.includes.topbar')
            </div>



            <div class="wrapper wrapper-content" style="position: relative; top: 270px;">

            <div class="row">
                <div class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Featured Content</h5>
                    </div>
                    <div class="ibox-content">

                            <p>See how aspects of the Bootstrap grid system work across multiple devices with a handy table.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            Extra small devices
                                            <small>Phones (&lt;768px)</small>
                                        </th>
                                        <th>
                                            Small devices
                                            <small>Tablets (≥768px)</small>
                                        </th>
                                        <th>
                                            Medium devices
                                            <small>Desktops (≥992px)</small>
                                        </th>
                                        <th>
                                            Large devices
                                            <small>Desktops (≥1200px)</small>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Grid behavior</th>
                                        <td>Horizontal at all times</td>
                                        <td colspan="3">Collapsed to start, horizontal above breakpoints</td>
                                    </tr>
                                    <tr>
                                        <th>Max container width</th>
                                        <td>None (auto)</td>
                                        <td>750px</td>
                                        <td>970px</td>
                                        <td>1170px</td>
                                    </tr>
                                    <tr>
                                        <th>Class prefix</th>
                                        <td>
                                            <code>.col-xs-</code>
                                        </td>
                                        <td>
                                            <code>.col-sm-</code>
                                        </td>
                                        <td>
                                            <code>.col-md-</code>
                                        </td>
                                        <td>
                                            <code>.col-lg-</code>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th># of columns</th>
                                        <td colspan="4">12</td>
                                    </tr>
                                    <tr>
                                        <th>Max column width</th>
                                        <td class="text-muted">Auto</td>
                                        <td>60px</td>
                                        <td>78px</td>
                                        <td>95px</td>
                                    </tr>
                                    <tr>
                                        <th>Gutter width</th>
                                        <td colspan="4">30px (15px on each side of a column)</td>
                                    </tr>
                                    <tr>
                                        <th>Nestable</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Offsets</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Column ordering</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>Grid classes apply to devices with screen widths greater than or equal to the breakpoint sizes, and override grid classes targeted at smaller devices. Therefore, applying any
                                <code>.col-md-</code> class to an element will not only affect its styling on medium devices but also on large devices if a
                                <code>.col-lg-</code> class is not present.</p>

                    </div>
                </div>
            </div>


                <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Latest Updates</h5>
                    </div>
                    <div class="ibox-content">

                            <p>See how aspects of the Bootstrap grid system work across multiple devices with a handy table.</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            Extra small devices
                                            <small>Phones (&lt;768px)</small>
                                        </th>
                                        <th>
                                            Small devices
                                            <small>Tablets (≥768px)</small>
                                        </th>
                                        <th>
                                            Medium devices
                                            <small>Desktops (≥992px)</small>
                                        </th>
                                        <th>
                                            Large devices
                                            <small>Desktops (≥1200px)</small>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Grid behavior</th>
                                        <td>Horizontal at all times</td>
                                        <td colspan="3">Collapsed to start, horizontal above breakpoints</td>
                                    </tr>
                                    <tr>
                                        <th>Max container width</th>
                                        <td>None (auto)</td>
                                        <td>750px</td>
                                        <td>970px</td>
                                        <td>1170px</td>
                                    </tr>
                                    <tr>
                                        <th>Class prefix</th>
                                        <td>
                                            <code>.col-xs-</code>
                                        </td>
                                        <td>
                                            <code>.col-sm-</code>
                                        </td>
                                        <td>
                                            <code>.col-md-</code>
                                        </td>
                                        <td>
                                            <code>.col-lg-</code>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th># of columns</th>
                                        <td colspan="4">12</td>
                                    </tr>
                                    <tr>
                                        <th>Max column width</th>
                                        <td class="text-muted">Auto</td>
                                        <td>60px</td>
                                        <td>78px</td>
                                        <td>95px</td>
                                    </tr>
                                    <tr>
                                        <th>Gutter width</th>
                                        <td colspan="4">30px (15px on each side of a column)</td>
                                    </tr>
                                    <tr>
                                        <th>Nestable</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Offsets</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    <tr>
                                        <th>Column ordering</th>
                                        <td colspan="4">Yes</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>Grid classes apply to devices with screen widths greater than or equal to the breakpoint sizes, and override grid classes targeted at smaller devices. Therefore, applying any
                                <code>.col-md-</code> class to an element will not only affect its styling on medium devices but also on large devices if a
                                <code>.col-lg-</code> class is not present.</p>

                    </div>
                </div>
            </div>


            </div>

            </div>

        </div>
    </div>

    @include('site.includes.footer')       
    @include('site.includes.scripts')
    @include('site.includes.bugreport')

</body>
</html> 