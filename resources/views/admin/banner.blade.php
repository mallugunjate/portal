<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand">          
			<span></span>
		</a>
	</div>
    
    <ul class="nav navbar-nav">
      
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banner <span class="caret"></span></a>
			<ul class="dropdown-menu">
				@foreach($banners as $banner)
					<li> <div class="banner-switch" data-banner-id ={{$banner->id}}> {{$banner->name}} </div> </li>
				@endforeach
			<!-- 		<li><a href="/admin/home?banner_id=1">Sportchek</a></li>
				<li><a href="/admin/home?banner_id=2">Atmosphere</a></li> -->
			</ul>
		</li>
	</ul>
    <ul class="nav navbar-nav navbar-right">
          <li><a href="/admin/folder?banner_id={{$banner->id}}">Edit Folders</a></li>
    </ul>
      
</div>