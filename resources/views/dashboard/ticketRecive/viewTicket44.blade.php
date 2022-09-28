<?php $readonly=true; ?>
@if(in_array(Auth()->user()->id,json_decode($config[0]->emp_to_update_json)))
    <?php $readonly=false; ?>
@endif
@if($ticket->receipt_no!=null && $ticket->receipt_no!=0)
<div class="row">
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group">
            <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text " id="basic-addon1">
                    رقم الوصل
                  </span>
                </div>
                <input type="text" id="ReciptNo" {{ $readonly?"readonly":"" }} value="{{ $ticket->receipt_no }}" name="ReciptNo" class="form-control" placeholder="0000000" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <div class="input-group" style="width: 161px !important;">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="basic-addon1" style="height: 33px !important;">
                     المبلغ
                  </span>
                </div>
                <input type="text"  id="AmountInNIS" {{ $readonly?"readonly":"" }} name="AmountInNIS" class="form-control numFeild"  style="height: 33px !important;"  value="{{ $ticket->amount }}">
                <select id="CurrencyID" {{ $readonly?"readonly":"" }} name="CurrencyID" type="text" class="form-control valid" style="height: 33px !important;" aria-invalid="false">
                    <option value="26"  {{ $ticket->currency==26?'selected':"" }}> شيكل </option>
                    <option value="28"  {{ $ticket->currency==28?'selected':"" }}> دينار </option>
                    <option value="27"  {{ $ticket->currency==27?'selected':"" }}> دولار </option>
                    <option value="31"  {{ $ticket->currency==31?'selected':"" }}> يورو </option>
                </select>
                <div class="input-group-append hidden-xs hidden-sm">
                    <div class="input-group-append" onclick="QuickAdd(30,'ownType','Own type')">
                        <span class="input-group-text input-group-text2">
                            <i class="fa fa-external-link"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


<input type="hidden" id="dept_id"  name="dept_id" value="{{$ticketInfo->dept_id}}">
<input type="hidden" id="app_type"  name="app_type" value="5">
<div class="row">
    <div class="col-md-3">
        <div class="form-group paddmob">
            <div class="input-group w-96">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'العام' }}
                    </span>
                </div>
                <input type="text" id="year" {{ $readonly?"readonly":"" }}
                    class="form-control numFeild" placeholder="{{ 'العام' }}"
                    name="year" value="{{$ticket->year}}">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group paddmob">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'الرقم' }}
                    </span>
                </div>
                <input type="text" id="app_no" {{ $readonly?"readonly":"" }}
                    class="form-control numFeild" placeholder="{{ 'الرقم' }}"
                    name="app_no" value="{{$ticket->app_no}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group paddmob">
            <div class="input-group w-96">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'الموضوع' }}
                    </span>
                </div>
                <input type="text" id="topic" 
                    class="form-control numFeild" placeholder="{{ 'الموضوع' }}"
                    name="topic" value="{{$ticket->topic}}">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group paddmob">
            <div class="input-group w-96">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'من' }}
                    </span>
                </div>
                <input type="text" id="subscriber_name" {{ $readonly?"readonly":"" }}
                    class="form-control numFeild" placeholder="{{ 'اسم الموظف' }}"
                    name="subscriber_name" value="{{$ticket->customer_name}}">
                <input type="hidden" id="subscriber_id"  name="subscriber_id" value="{{$ticket->customer_id}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group paddmob">
            <div class="input-group w-96">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'المسمي الوظيفي' }}
                    </span>
                </div>
                <select class="form-control position" disabled name="position" id="position">
                    <option value="">
                        {{ 'المسمي الوظيفي' }}
                    </option>
                    @foreach($helpers['positions'] as $position)
                        <option value="{{$position->id}}" {{$ticket->position == $position->id?"selected":''}}>{{$position->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group paddmob">
            <div class="input-group w-96">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'الي' }}
                    </span>
                </div>
                <input type="text" id="subscriber_name1" {{ $readonly?"readonly":"" }}
                    class="form-control numFeild" placeholder="{{ 'اسم الموظف' }}"
                    name="subscriber_name1" value="{{$ticket->customer_name1}}">
                <input type="hidden" id="subscriber_id1"  name="subscriber_id1" value="{{$ticket->customer_id1}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group paddmob">
            <div class="input-group w-96">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'المسمي الوظيفي' }}
                    </span>
                </div>
                <select class="form-control position1" disabled name="position1" id="position1">
                    <option value="">
                        {{ 'المسمي الوظيفي' }}
                    </option>
                    @foreach($helpers['positions'] as $position)
                        <option value="{{$position->id}}" {{$ticket->position1 == $position->id?"selected":''}}>{{$position->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <div class="input-group"  style="width: 98%!important;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'الموضوع' }}
                    </span>
                </div>
                <textarea {{ $readonly?"readonly":"" }} type="text" id="malDesc" class="form-control"
                    placeholder="الموضوع" name="malDesc"
                    style="height: 200px;">{{ $ticket->malDesc }}</textarea>

            </div>
        </div>
    </div>
</div>

