<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"  style="">
{{-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a> --}}
<div class="navbar-header">
{{--     <form class="form-inline" style="position: relative; top: 10px; left: 30px;">
      <div class="form-group">
        <label for="top-search" style="font-size: 24px;"><i class="fa fa-search"></i></label>
        <input type="text" class="form-control" class="form-control" name="top-search" id="top-search" placeholder="" style="">
      </div>
      <button type="submit" class="btn btn-default">Search</button>
    </form> --}}
</div>
    <ul class="nav navbar-top-links navbar-right" style="position: relative; top: 12px">
        {{-- <li>
            <span class="m-r-sm text-muted welcome-message"></span>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope"></i>  <span class="label label-warning">5</span>
            </a>
            <ul class="dropdown-menu dropdown-messages">
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
            </ul>
        </li>

        <li>
            <a class="right-sidebar-toggle">
                <i class="fa fa-tasks"></i>
            </a>
        </li> --}}

                <li>
                    <script>
                        document.write( localStorage.getItem('userStoreName') );
                    </script>
                    <a id="storeswitch" style="display: inline;"><i class="fa fa-sign-out "></i> Log out</a>
                </li>
    </ul>

</nav>