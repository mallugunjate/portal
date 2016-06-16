@foreach($eventsList as $e)
<div class="timeline-item">

    <div class="row">
        <div class="col-xs-4 date">
            <i class="fa fa-calendar"></i>
            {!! $e->prettyDateStart !!} 
            <br>
            <small class="text-navy">
            @if( strtotime($e->start) < strtotime(date("y-m-d H:i:s")) )
                {!! $e->since !!} ago
            @else 
                in {!! $e->since !!} 
            @endif
            
            </small>
        </div>
        <div class="col-xs-8 content">
            <span class="label label-primary">{!! $e->event_type_name !!}</span>
            <p class="m-b-xs"><strong>{!! $e->title !!}</strong></p>
            <p>{!! $e->description !!}</p>
        </div>
    </div>
</div>
@endforeach