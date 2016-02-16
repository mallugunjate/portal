
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

                @if (Request::segment(2) == 'alerts')
                <li class="active">
                @else
                <li>
                @endif 
                    <a href="/{{ Request::segment(1) }}/alerts"><i class="fa fa-bell"></i> <span class="nav-label">Alerts</span></a>
                </li>   
                    

                @if (Request::segment(2) == 'document')
                <li class="active">
                @else
                <li>
                @endif 
                    <a href="/{{ Request::segment(1) }}/document"><i class="fa fa-file"></i> <span class="nav-label">Documents</span></a>
                </li>                


            </ul>