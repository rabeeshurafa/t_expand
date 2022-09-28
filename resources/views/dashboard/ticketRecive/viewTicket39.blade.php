<?php $readonly=true; ?>
@if(in_array(Auth()->user()->id,json_decode($config[0]->emp_to_update_json)))
    <?php $readonly=false; ?>
@endif

@include('dashboard.includes.wasel_rec')
<div class="row">
    <div class="col-md-4" style=" ">
        <div class="form-group paddmob">
            <div class="input-group" style=" ">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        طبيعة العمل
                    </span>
                </div>
                <select id="workType" name="workType" type="text" {{ $readonly?"disabled":"" }}
                    class="form-control valid workType" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    @foreach($helpers['workTypeList'] as $workType)
                    <option value="{{ $workType->id }}" {{ $ticket->workType== $workType->id ?'selected':''}}>{{ $workType->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}" onclick="ShowConstantModal(6268,'workType','طبيعة العمل')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="dept_id"  name="dept_id" value="{{$ticket->dept_id}}">
<input type="hidden" id="app_type"  name="app_type" value="3">
<input type="hidden" id="subscriber_id" name="subscriber_id" value="0">
<input type="hidden" name="subscriptionID" id="subscriptionID">
<input type="hidden" id="is_lic_defined"  name="is_lic_defined" @if(isset($ticket->license)) value="1" @else  value="0" @endif>
@include('dashboard.includes.subscriber_rec')

<div class="row" style="position: relative; "> 
    @if($ticketInfo->show_nationalID == 1)
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group paddmob">
            <div class="input-group subscribermob">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'رقم الهوية' }}
                    </span>
                </div>
                <input type="text" id="national_id" maxlength="9" minlength="9"
                    class="form-control numFeild" placeholder="{{ 'رقم الهوية' }}"
                    value="{{ $ticket->national_id }}"
                    {{ $readonly?"readonly":"" }}
                    name="national_id">
                
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 23px;padding-right: 0px;">
        <div class="form-group">
            <div class="input-group licNoGroup" id="licGroup">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'رقم الرخصة' }}
                    </span>
                </div>
                <input type="text" id="templicNo" onchange="$('#is_lic_defined').val(0);$('#licNo').val(($(this).val()));" name="templicNo"
                    {{ $readonly?"readonly":"" }}
                    @if(isset($ticket->license))
                        value="{{ $ticket->license->licNo}}"
                    @else
                        value="{{$ticket->licNo}}"
                    @endif
                    class="form-control" placeholder="0000"
                    aria-describedby="basic-addon1">
                    
                <input type="hidden" id="licNo" onchange="$('#is_lic_defined').val(0);" name="licNo"
                    {{ $readonly?"readonly":"" }}
                    @if(isset($ticket->license))
                        value="{{ $ticket->license->id}}"
                    @else
                        value="{{$ticket->licNo}}"
                    @endif>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم قرار الترخيص' }}
                    </span>
                </div>
                <input type="text" id="licDecisionNo" name="licDecisionNo"
                    value="{{ $ticket->licDecisionNo}}"
                    {{ $readonly?"readonly":"" }}
                    class="form-control" placeholder="0000"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group paddmob">
            <div class="input-group subscribermob" >
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم الحوض' }}
                    </span>
                </div>
                <input type="text" id="hodNo" name="hodNo"
                    class="form-control" placeholder="0000"
                    value="{{ $ticket->hodNo}}"
                    {{ $readonly?"readonly":"" }}
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 23px;padding-right: 0px;">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم القطعة' }}
                    </span>
                </div>
                <input type="text" id="pieceNo" name="pieceNo"
                    value="{{ $ticket->pieceNo}}"
                    {{ $readonly?"readonly":"" }}
                    class="form-control" placeholder="0000"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'نوع المبني' }}
                    </span>
                </div>
                <select id="buildingType" {{ $readonly?"disabled":"" }} name="buildingType" type="text"
                    class="form-control valid buildingType" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    @foreach($helpers['buildingTypes'] as $buildingType)
                    <option value="{{ $buildingType->id }}" {{$buildingType->id== $ticket->buildingType?'selected':''}}>{{ $buildingType->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}" onclick="ShowConstantModal(6016,'buildingType','نوع المبني')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.includes.regionsTemplate_rec')

<div class="row" >
    <div class="col-md attachs-section" style="margin-left:25px; margin-right: 25px ">
        {{--<img src="https://db.expand.ps/images/neighbor.png" width="40" height="40">--}}
        <span class="attach-header">
            {{"تفاصيل العمل"}}
        </span>
    </div>
</div>
<div class="row" style="padding-right: 25px; padding-left: 25px">
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group paddmob">
            <div class="input-group subscribermob" >
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'اليوم' }}
                    </span>
                </div>
                <input type="text" id="day" name="day"
                    class="form-control" placeholder="السبت"
                    value="{{ $ticket->day}}"
                    {{ $readonly?"readonly":"" }}
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 23px;padding-right: 0px;">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'التاريخ' }}
                    </span>
                </div>
                <input type="text" id="date" name="date"
                    value="{{ $ticket->date}}"
                    {{ $readonly?"readonly":"" }}
                    class="form-control" data-mask="00/00/0000" placeholder="00/00/0000"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'الوقت' }}
                    </span>
                </div>
                <input type="text" id="time" name="time"
                    value="{{ $ticket->time}}"
                    {{ $readonly?"readonly":"" }}
                    class="form-control" placeholder=""
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-right: 25px; padding-left: 25px">
    <div class="col-md-7" >
        <div class="form-group paddmob">
            <div class="input-group" style="width: 94.6% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        الشركة المنفذة 
                    </span>
                </div>
                <select id="implementedCompany" {{ $readonly?"disabled":"" }} name="implementedCompany" type="text"
                    class="form-control valid implementedCompany" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    @foreach($helpers['componyList'] as $compony)
                    <option value="{{ $compony->id }}" {{$compony->id== $ticket->implementedCompany?'selected':''}}>{{ $compony->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}" onclick="ShowConstantModal(6269,'implementedCompany','الشركة المنفذة')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 pr-s-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'الزمن المتوقع' }}
                    </span>
                </div>
                <input type="text" id="duration" name="duration"
                    value="{{ $ticket->duration}}"
                    {{ $readonly?"readonly":"" }}
                    class="form-control" placeholder=""
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-right: 25px; padding-left: 25px">
    <div class="col-md-7" >
        <div class="form-group paddmob">
            <div class="input-group" style="width: 94.6% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        المكتب الهندسي/ الشركة
                    </span>
                </div>
                <select id="engOffice" name="engOffice" {{ $readonly?"disabled":"" }} type="text"
                    class="form-control valid engOffice" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    @foreach($helpers['officeAreaList'] as $officeArea)
                    <option value="{{ $officeArea->id }}" {{$officeArea->id== $ticket->engOffice?'selected':''}}>{{ $officeArea->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}" onclick="ShowConstantModal(6272,'engOffice','المكتب الهندسي')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>




