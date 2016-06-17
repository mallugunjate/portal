@foreach($eventsList as $day=>$events)
<div class="timeline-item">

    <div class="row">
        <div class="col-md-4 date">
            <i class="fa fa-calendar"></i>
            
            {{$events[0]->prettyDateStart}}
            <br>
            <small class="text-navy">
            @if( strtotime($events[0]->start) < strtotime(date("y-m-d H:i:s")) )
                {!! $events[0]->since !!} ago
            @else 
                in {!! $events[0]->since !!} 
            @endif
            
            </small>
        </div>
        <div class="col-md-8 content">
            @foreach($events as $e)
            <span class="label label-primary">{!! $e->event_type_name !!}</span>
            <span class="m-b-xs"><strong>{!! $e->title !!}</strong></span>
            <p>{!! $e->description !!}</p>
            @endforeach
        </div>
    </div>
</div>
@endforeach