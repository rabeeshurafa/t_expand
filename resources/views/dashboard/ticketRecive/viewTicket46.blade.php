<?php $readonly=true; ?>
@if(in_array(Auth()->user()->id,json_decode($config[0]->emp_to_update_json)))
    <?php $readonly=false; ?>
@endif


<input type="hidden" id="dept_id"  name="dept_id" value="{{$ticket->dept_id}}">
<input type="hidden" id="app_type"  name="app_type" value="{{$ticket->app_type}}">
@if($ticket->archive_type == 'out_archieve' || $ticket->archive_type == 'in_archieve')
    @include('dashboard.trackingArchive.component.outArchive')
@elseif($ticket->archive_type == 'trade_archive')
    @include('dashboard.trackingArchive.component.tradeArchive')
@elseif($ticket->archive_type == 'finance_archive')
    @include('dashboard.trackingArchive.component.financeArchive')
@elseif($ticket->archive_type == 'agenda_archieve')
    @include('dashboard.trackingArchive.component.agendaArchive')
@elseif($ticket->archive_type == 'jal_archieve')
    @include('dashboard.trackingArchive.component.jalArchive')
@else
    @include('dashboard.trackingArchive.component.munArchive')
@endif