{{-- <div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand">          
			<span></span>
		</a>
	</div>
    
    <ul class="nav navbar-nav"> --}}
      	<li class="navbar-brand text-normal">
            
		</li>
		
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banner <span class="caret"></span></a>
			<ul class="dropdown-menu">
				@foreach($banners as $banner)
					<li> <a class="banner-switch" data-banner-id ={{$banner->id}}> {{$banner->name}} </a> </li>
				@endforeach
			</ul>
		</li>
{{-- 	</ul> --}}
	
{{--     <ul class="nav navbar-nav navbar-right">
          <li><a href="/admin/logout">Logout</a></li>
    </ul>
      
</div> --}}