<div class="row" style="border:thin solid #ccc">
	<form role="form" class="form-inline" style="width: 100%; padding-left: 10px; " method="get" action="/{{ Request::segment(1) }}/search">
	    <div class="visible-xs">
	    	<i class="fa fa-search" style="display: inline !important; font-size: 20px; color: #ccc; line-height: 10px; position:relative; top:10px; float:left ; width:5%"></i>
	    	<span style="width:75%; float:left"> <input type="text" class="form-control" name="q" id="top-search" placeholder="Search . . . " id="search" style="border: none;font-size: 20px; position:relative; ; width:75%"></span>
		
	    	<span style="width:15%"><button type="submit" class="btn btn-primary btn-sm" style="display: inline ; border-radius:0px; font-size:15px;float:right; width:15%">Search</button></span>
	    </div>
	    <div class="hidden-xs">
	    	<i class="fa fa-search" style="display: inline !important; font-size: 20px; color: #ccc; line-height: 10px; position:relative; top:3px;  "></i>
	    
	    	<input type="text" class="form-control" name="q" id="top-search" placeholder="Search . . . " id="search" style="border: none;font-size: 20px; position:relative; ">
		
	    	<button type="submit" class="btn btn-primary btn-sm" style="display: inline ; border-radius:0px; font-size:15px;float:right;">Search</button>
	    </div>
	
	</form>
</div>