<!DOCTYPE html>
<html>

<head>
    @section('title', 'Document')
    @include('admin.includes.head')

  <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
      <nav class="navbar-default navbar-static-side" role="navigation">
          <div class="sidebar-collapse">
            @include('admin.includes.sidenav')
          </div>
      </nav>

  <div id="page-wrapper" class="gray-bg" >
    <div class="row border-bottom">
      @include('admin.includes.topbar')
        </div>

    <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Documents</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Document</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
    </div>

    <div class="wrapper wrapper-content  animated fadeInRight">
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-title">
                      <h5>Edit Document</h5>

                      <div class="ibox-tools">

                          
                      </div>
                  </div>
                  <div class="ibox-content">
                     <form method="get" class="form-horizontal" >
                              <input type="hidden" name="documentID" id="documentID" value="{{ $document->id }}">
                              <input type="hidden" name="banner_id" value="{{$banner->id}}">

                              <div class="form-group"><label class="col-sm-2 control-label"> Title</label>
                                  <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $document->title }}"></div>
                              </div>

                              

                              <div class="form-group">
                                  {!! Form::label('description', 'Description' , ['class'=>'col-sm-2 control-label']) !!}
                                  <div class="col-sm-10">
                                      {!! Form::text('description',$document->description, ['class'=>'form-control']) !!}      
                                  </div>
                              </div>

                              {{-- <div class="form-group">
                                {!! Form::label('tags[]', 'Tags') !!}
                                {!! Form::select('tags[]', $tags, $selected_tags, ['class'=>'chosen', 'multiple'=>'true']) !!}
                              </div> --}}
                              
                              <div class="form-group">

                                      <label class="col-sm-2 control-label">Start &amp; End</label>

                                      <div class="col-sm-10">
                                          <div class="input-daterange input-group" id="datepicker">
                                              <input type="text" class="input-sm form-control" name="start" id="start" value="{{$document->start}}" />
                                              <span class="input-group-addon">to</span>
                                              <input type="text" class="input-sm form-control" name="end" id="end" value="{{$document->end}}" />
                                          </div>
                                      </div>
                              </div>

                      </form>
                  </div>

              </div>

              <div class="ibox">
                  <div class="ibox-title">
                      <h5>Mark Document as Alert</h5>

                      <div class="ibox-tools">

                          
                      </div>
                  </div>
                  <div class="ibox-content">
                     <form method="get" class="form-horizontal" >
                              <input type="hidden" name="documentID" id="documentID" value="{{ $document->id }}">
                              <input type="hidden" name="banner_id" value="{{$banner->id}}">
                              
                              
                              <div class="form-group">
                                            
                                  <label class="col-sm-2 control-label">Target Stores</label>
                                  <div class="col-sm-10">
                                    @if($all_stores)
                                        {!! Form::select('stores', $storeList, null, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                        {!! Form::label('allStores', 'Or select all stores:') !!}
                                        {!! Form::checkbox('allStores', null, true ,['id'=> 'allStores'] ) !!}
                                      @else
                                        {!! Form::select('stores', $storeList, $target_stores, [ 'class'=>'chosen', 'id'=> 'storeSelect', 'multiple'=>'true']) !!}
                                        {!! Form::label('allStores', 'Or select all stores:') !!}
                                        {!! Form::checkbox('allStores', null, false ,['id'=> 'allStores'] ) !!}
                                      @endif
                                  </div>

                              </div>
                              <div class="form-group">

                                      <label class="col-sm-2 control-label">Start &amp; End</label>

                                      <div class="col-sm-10">
                                          <div class="input-daterange input-group" id="datepicker">
                                              <input type="text" class="input-sm form-control" name="start" id="start" value="{{$document->start}}" />
                                              <span class="input-group-addon">to</span>
                                              <input type="text" class="input-sm form-control" name="end" id="end" value="{{$document->end}}" />
                                          </div>
                                      </div>
                              </div>

                             

                      </form>
                  </div>

              </div>
          </div>
      </div>


  </div>

        @include('site.includes.footer')

          @include('admin.includes.scripts')

        <script type="text/javascript">
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });

        </script>

        <script type="text/javascript" src="/js/custom/admin/global/bannerSelector.js"></script>
        <script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>  
        <script type="text/javascript">
        $(".chosen").chosen({
          width:'75%'
      })
    </script>

        @include('site.includes.bugreport')



      </body>
      </html>
