<div class="card-header">
    <h4 class="card-title">
        <img src="{{  asset('assets/images/'.$ticketInfo->ticket_ico)}}" width="32" height="32">
        @if($type == 'buildingComplaint')
            <span>{{'شكاوى البناء'}}</span>
        @else
            <span>{{ $ticketInfo->ticket_name }}</span>
        @endif
    </h4>

    <div class="heading-elements1 onOffArea form-group mt-1" style="display: none;    top: -5px;">
        <input type="checkbox" id="myonoffswitchHeader" class="switchery" data-size="xs" checked="">
    </div>
</div>