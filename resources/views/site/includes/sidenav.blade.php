
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
{{--                     <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/wireframes/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="" href="#">
                            <span class="clear"> 
                                <span class="block m-t-xs"> <strong class="font-bold">Brent Garner</strong>
                             </span> 
                             <span class="text-muted text-xs block">Sr. Web Developer</span><br />
                             <a href="profile"><span class="text-muted text-xs"> <i class="fa fa-user"></i> My Profile</span></a>   |   
                             <a href="/wireframe/login"><span class="text-muted text-xs"> <i class="fa fa-sign-out"></i> Log out</span></a>
                    </div> --}}

                    <div class="logo-element">
                        P
                    </div>
                </li>


                @if($urgentNoticeCount > 0)
                <li class="urgetnNoticeNav">
                    <a style="color: white" href="/{{ Request::segment(1) }}"><i class="fa fa-bolt"></i> <span class="nav-label">URGENT NOTICE</span>
                        @if(isset($urgentNoticeCount))
                        <span class="label label-primary pull-right">{{$urgentNoticeCount}}</span>
                        @endif
                    </a>
                </li>
                @endif

                @if (Request::is( Request::segment(1) ))
                <li class="active">
                @else
                <li>
                @endif 
                    <a href="/{{ Request::segment(1) }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
                </li>


                <!-- CALENDAR NAV -->
                @if (Request::segment(2) == 'calendar')
                <li class="active">
                @else
                <li>
                @endif                
                    <a href="/{{ Request::segment(1) }}/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span></a>
                </li>                



                @if (Request::segment(2) == 'communication')
                <li class="active">
                @else
                <li>
                @endif 
                    <a href="/{{ Request::segment(1) }}/communication"><i class="fa fa-bullhorn"></i> <span class="nav-label">Communications</span> 
                    @if( isset($communicationCount) ) 
                    <span class="label label-inverse pull-right">{{ $communicationCount }}</span>
                    @endif
                    </a>
                </li>            


                <li>
                    <a href="/{{ Request::segment(1) }}/alerts"><i class="fa fa-bell"></i> <span class="nav-label">Alerts</span></a>
                </li>   
                    

                @if (Request::segment(2) == 'document')
                <li class="active">
                @else
                <li>
                @endif 
                    <a href="/{{ Request::segment(1) }}/document"><i class="fa fa-file"></i> <span class="nav-label">Documents</span></a>
                </li>                







{{--                 <li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Messages </span><span class="label label-warning pull-right">5</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="mailbox.html">Inbox</a></li>
                        <li><a href="mail_detail.html">Email view</a></li>
                        <li><a href="mail_compose.html">Compose email</a></li>
                        <li><a href="email_template.html">Email templates</a></li>
                    </ul>
                </li>     --}}            






{{--                 <li class="">
                    <a href="index.html"><i class="fa fa-check-square-o"></i> <span class="nav-label">Tasks</span></a>
                </li>        --}}         

{{--                 <li>
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">My Store</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">Store Profile</a></li>
                        <li><a href="graph_morris.html">Store Staff</a></li>
                    </ul>
                </li> --}}

{{--                 <li>
                    <a href="#"><i class="fa fa-futbol-o"></i> <span class="nav-label">My Activities</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">Activity Profile</a></li>
                        <li><a href="graph_morris.html">Log an Activity</a></li>
                        <li><a href="graph_morris.html">Coaches for Communities</a></li>
                    </ul>
                </li>     --}}  

{{--                 <li>
                    <a href="#"><i class="fa fa-rocket"></i> <span class="nav-label">My Career</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">My Store Profile</a></li>
                        <li><a href="graph_morris.html">My Store Staff</a></li>
                    </ul>
                </li>    --}}
{{-- 
                <li>
                    <a href="#"><i class="fa fa-certificate"></i> <span class="nav-label">My Training</span></a>
                </li> --}}

{{--                 <li>
                    <a href=""><i class="fa fa-lightbulb-o"></i> <span class="nav-label">Idea Factory</span></a>
                </li> --}}

{{--                 <li>
                    <a href="#"><i class="fa fa-comments-o"></i> <span class="nav-label">Neighbourhoods</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">Jumpstart <span class="label label-primary pull-right">12</span></a></li>
                        <li><a href="graph_morris.html">Living Healthy <span class="label label-primary pull-right">27</span></a></li>
                    </ul>
                </li>    --}}                                         
<!--
                <li>
                    <a href="metrics.html"><i class="fa fa-pie-chart"></i> <span class="nav-label">Metrics</span> <span class="label label-primary pull-right">NEW</span> </a>
                </li>
                <li>
                    <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Widgets</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Forms</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="form_basic.html">Basic form</a></li>
                        <li><a href="form_advanced.html">Advanced Plugins</a></li>
                        <li><a href="form_wizard.html">Wizard</a></li>
                        <li><a href="form_file_upload.html">File Upload</a></li>
                        <li><a href="form_editors.html">Text Editor</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">App Views</span>  <span class="pull-right label label-primary">SPECIAL</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="projects.html">Projects</a></li>
                        <li><a href="project_detail.html">Project detail</a></li>
                        <li><a href="teams_board.html">Teams board</a></li>
                        <li><a href="social_feed.html">Social feed</a></li>
                        <li><a href="clients.html">Clients</a></li>
                        <li><a href="full_height.html">Outlook view</a></li>
                        <li><a href="file_manager.html">File manager</a></li>
                        <li><a href="calendar.html">Calendar</a></li>
                        <li><a href="issue_tracker.html">Issue tracker</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="article.html">Article</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="pin_board.html">Pin board</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Other Pages</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="search_results.html">Search results</a></li>
                        <li><a href="lockscreen.html">Lockscreen</a></li>
                        <li><a href="invoice.html">Invoice</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="login_two_columns.html">Login v.2</a></li>
                        <li><a href="forgot_password.html">Forget password</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="404.html">404 Page</a></li>
                        <li><a href="500.html">500 Page</a></li>
                        <li><a href="empty_page.html">Empty page</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Miscellaneous</span><span class="label label-info pull-right">NEW</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="toastr_notifications.html">Notification</a></li>
                        <li><a href="nestable_list.html">Nestable list</a></li>
                        <li><a href="agile_board.html">Agile board</a></li>
                        <li><a href="timeline_2.html">Timeline v.2</a></li>
                        <li><a href="diff.html">Diff</a></li>
                        <li><a href="sweetalert.html">Sweet alert</a></li>
                        <li><a href="idle_timer.html">Idle timer</a></li>
                        <li><a href="spinners.html">Spinners</a></li>
                        <li><a href="tinycon.html">Live favicon</a></li>
                        <li><a href="google_maps.html">Google maps</a></li>
                        <li><a href="code_editor.html">Code editor</a></li>
                        <li><a href="modal_window.html">Modal window</a></li>
                        <li><a href="forum_main.html">Forum view</a></li>
                        <li><a href="validation.html">Validation</a></li>
                        <li><a href="tree_view.html">Tree view</a></li>
                        <li><a href="chat_view.html">Chat view</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">UI Elements</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="typography.html">Typography</a></li>
                        <li><a href="icons.html">Icons</a></li>
                        <li><a href="draggable_panels.html">Draggable Panels</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                        <li><a href="video.html">Video</a></li>
                        <li><a href="tabs_panels.html">Panels</a></li>
                        <li><a href="tabs.html">Tabs</a></li>
                        <li><a href="notifications.html">Notifications & Tooltips</a></li>
                        <li><a href="badges_labels.html">Badges, Labels, Progress</a></li>
                    </ul>
                </li>

                <li>
                    <a href="grid_options.html"><i class="fa fa-laptop"></i> <span class="nav-label">Grid options</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-table"></i> <span class="nav-label">Tables</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="table_basic.html">Static Tables</a></li>
                        <li><a href="table_data_tables.html">Data Tables</a></li>
                        <li><a href="table_foo_table.html">Foo Tables</a></li>
                        <li><a href="jq_grid.html">jqGrid</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">E-commerce</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="ecommerce_products_grid.html">Products grid</a></li>
                        <li><a href="ecommerce_product_list.html">Products list</a></li>
                        <li><a href="ecommerce_product.html">Product edit</a></li>
                        <li><a href="ecommerce-orders.html">Orders</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Gallery</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="basic_gallery.html">Lightbox Gallery</a></li>
                        <li><a href="carousel.html">Bootstrap Carusela</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Menu Levels </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>

                            </ul>
                        </li>
                        <li><a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                    </ul>
                </li>
                <li>
                    <a href="css_animation.html"><i class="fa fa-magic"></i> <span class="nav-label">CSS Animations </span><span class="label label-info pull-right">62</span></a>
                </li>
                <li class="landing_link">
                    <a target="_blank" href="landing.html"><i class="fa fa-star"></i> <span class="nav-label">Landing Page</span> <span class="label label-warning pull-right">NEW</span></a>
                </li>
                <li class="special_link">
                    <a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
                </li>
            -->
            </ul>