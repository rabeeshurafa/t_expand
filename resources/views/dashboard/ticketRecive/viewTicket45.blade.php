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
            </div>
        </div>
    </div>
</div>
@endif
<input type="hidden" id="app_type"  name="app_type" value="5">
<input type="hidden" id="dept_id"  name="dept_id" value="{{$ticket->dept_id}}">
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                   <span class="input-group-text" id="basic-addon1">اليوم</span>
                </div>
                <input type="text" id="day" maxlength="10"  name="day" {{ $readonly?"readonly":"" }} class="form-control singledate "  aria-describedby="basic-addon1" aria-invalid="false" value="{{ $ticket->day_name }}" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <div class="input-group w-m-84">
                <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">التاريخ </span>
                </div>
                <input type="text" id="date" maxlength="10" data-mask="00/00/0000" name="date"  {{ $readonly?"readonly":"" }}
                class="form-control singledate " placeholder="dd/mm/yyyy" aria-describedby="basic-addon1" aria-invalid="false"
                 value="{{$ticket->date}}" autocomplete="off" onkeyup="getDay()">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 col-sm-12">
        <div class="form-group">
            <div class="input-group" style="width: 95% !important;">
                <div class="input-group-prepend">
                   <span class="input-group-text" id="basic-addon1">
                       اسم السائق
                   </span>
                </div>
                <input type="text" id="emp_name"  name="emp_name" class="form-control" {{ $readonly?"readonly":"" }}  aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->emp_name}}">
                <input type="hidden" id="emp_id"  name="emp_id" value="{{$ticket->emp_id}}">
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">اسم الممرض </span>
                </div>
                <select class="form-control nurse" {{ $readonly?"readonly":"" }} name="nurse" id="nurse">
                    <option value="">{{ 'اسم الممرض' }} </option>
                    @foreach($helpers['nurses'] as $nurse)
                        <option value="{{$nurse->id}}" {{ $ticket->nurse_id==$nurse->id?'selected':"" }}>{{$nurse->name}} </option>
                    @endforeach
                </select>
                <div class="input-group-append hideMob"
                    onclick="ShowConstantModal(6395,'nurse','الممرض')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('dashboard.includes.subscriber_rec')
@include('dashboard.includes.regionsTemplate_rec')
<div class="row">
    <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
        <span class="attach-header">
            {{ 'تفاصيل الحالة' }}
        </span>
    </div>
</div>
<div class="card-content collapse show">
    <div class="card-body" style="padding-bottom: 0px;padding-top: 0px;">
        <div class="form-body">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                نقل الحالة من
                                </span>
                            </div>
                            <select class="form-control transfer_from" {{ $readonly?"readonly":"" }} name="transfer_from" id="transfer_from">
                                <option value="">{{ 'نقل الحالة من' }} </option>
                                @foreach($helpers['transfer_froms'] as $transfer_from)
                                    <option value="{{$transfer_from->id}}" {{ $ticket->transfer_from==$transfer_from->id?'selected':"" }}>{{$transfer_from->name}} </option>
                                @endforeach
                            </select>
                            <div class="input-group-append hideMob"
                                onclick="ShowConstantModal(6396,'transfer_from','نقل من')">
                                <span class="input-group-text input-group-text2">
                                    <i class="fa fa-external-link"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <div class="input-group w-m-96">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                   الساعة
                               </span>
                            </div>
                            <input type="text" id="time"  name="time" class="form-control" {{ $readonly?"readonly":"" }} data-mask="00:00" maxlength="5"  aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->time}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                نقل الحالة إلى
                                </span>
                            </div>
                            <select class="form-control transfer_to" {{ $readonly?"readonly":"" }} name="transfer_to" id="transfer_to">
                                <option value="">{{ 'نقل الحالة إلى' }} </option>
                                @foreach($helpers['transfer_to'] as $transfer_to)
                                    <option value="{{$transfer_to->id}}" {{ $ticket->transfer_to==$transfer_to->id?'selected':"" }}>{{$transfer_to->name}} </option>
                                @endforeach
                            </select>
                            <div class="input-group-append hideMob"
                                onclick="ShowConstantModal(6397,'transfer_to','نقل إلى')">
                                <span class="input-group-text input-group-text2">
                                    <i class="fa fa-external-link"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                    الوصول
                               </span>
                            </div>
                            <input type="text" id="arrival_time"  name="arrival_time" class="form-control" {{ $readonly?"readonly":"" }}
                            data-mask="00:00" maxlength="5"  aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->arrival_time}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                    المغادرة
                               </span>
                            </div>
                            <input type="text" id="Departure_time"  name="Departure_time" class="form-control" data-mask="00:00" maxlength="5" {{ $readonly?"readonly":"" }}
                            aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->Departure_time}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <div class="input-group w-m-97">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                   نوع الحالة
                               </span>
                            </div>
                            <textarea type="text" id="status_type" class="form-control" {{ $readonly?"readonly":"" }}  placeholder="نوع الحالة  "
                            name="status_type" style="height: 35px;">{{$ticket->status_type}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
        <span class="attach-header">
            {{ 'المطالبة المالية' }}
        </span>
    </div>
</div>
<div class="card-content collapse show">
    <div class="card-body" style="padding-bottom: 0px;padding-top: 0px;">
        <div class="form-body">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                   رقم المطالبة المالية
                               </span>
                            </div>
                            <input type="text" id="financial_no"  name="financial_no" class="form-control" {{ $readonly?"readonly":"" }}
                            aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->financial_no}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                المبلغ المطلوب
                                </span>
                            </div>
                            <select class="form-control" name="required_amount" {{ $readonly?"readonly":"" }} id="required_amount">
                                <option value="0">{{ 'اختر' }} </option>
                                <option value="100" {{ $ticket->required_amount==100?'selected':"" }}> 100 </option>
                                <option value="200" {{ $ticket->required_amount==200?'selected':"" }}> 200 </option>
                                <option value="300" {{ $ticket->required_amount==300?'selected':"" }}> 300 </option>
                                <option value="400" {{ $ticket->required_amount==400?'selected':"" }}> 400 </option>
                                <option value="500" {{ $ticket->required_amount==500?'selected':"" }}> 500 </option>
                                <option value="600" {{ $ticket->required_amount==600?'selected':"" }}> 600 </option>
                                <option value="700" {{ $ticket->required_amount==700?'selected':"" }}> 700 </option>
                                <option value="800" {{ $ticket->required_amount==800?'selected':"" }}> 800 </option>
                                <option value="900" {{ $ticket->required_amount==900?'selected':"" }}> 900 </option>
                                <option value="1000"{{ $ticket->required_amount==1000?'selected':"" }}> 1000 </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                   المبلغ المدفوع
                               </span>
                            </div>
                            <select class="form-control" name="paid_amount" {{ $readonly?"readonly":"" }} id="paid_amount" onchange="showVoucher();">
                                <option value="0">{{ 'اختر' }} </option>
                                <option value="100" {{ $ticket->paid_amount==100?'selected':"" }}> 100 </option>
                                <option value="200" {{ $ticket->paid_amount==200?'selected':"" }}> 200 </option>
                                <option value="300" {{ $ticket->paid_amount==300?'selected':"" }}> 300 </option>
                                <option value="400" {{ $ticket->paid_amount==400?'selected':"" }}> 400 </option>
                                <option value="500" {{ $ticket->paid_amount==500?'selected':"" }}> 500 </option>
                                <option value="600" {{ $ticket->paid_amount==600?'selected':"" }}> 600 </option>
                                <option value="700" {{ $ticket->paid_amount==700?'selected':"" }}> 700 </option>
                                <option value="800" {{ $ticket->paid_amount==800?'selected':"" }}> 800 </option>
                                <option value="900" {{ $ticket->paid_amount==900?'selected':"" }}> 900 </option>
                                <option value="1000"{{ $ticket->paid_amount==1000?'selected':"" }}> 1000 </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row voucher hide">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                   رقم الوصل
                               </span>
                            </div>
                            <input type="text" id="voucher_no" {{ $readonly?"readonly":"" }} name="voucher_no" class="form-control"
                              aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->voucher_no}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                               <span class="input-group-text" id="basic-addon1">
                                   تاريخ الوصل
                               </span>
                            </div>
                            <input type="text" id="voucher_date" {{ $readonly?"readonly":"" }} name="voucher_date" class="form-control"
                            maxlength="10" data-mask="00/00/0000" placeholder="yyyy/mm/dd"
                            aria-describedby="basic-addon1" aria-invalid="false" autocomplete="off" value="{{$ticket->voucher_date}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .w-m-84{
        width: 84% !important;
    }
    .w-m-96{
        width: 96% !important;
    }
    .w-m-97{
        width: 97.7% !important;
    }
    @media (max-width: 767.98px){
        .w-m-84,.w-m-96,.w-m-97{
            width: 98% !important;
        }
    }
</style>
<script>
$(document).ready(function (){
showVoucher();
});
function showVoucher(){
    if($("#paid_amount").val() > 0){
       $(".voucher").removeClass('hide');
    }else{
        $(".voucher").addClass('hide');
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
    let ds=$('#date').val();
    var spt = ds.split('/');
    let d =spt[0];
    let m =spt[1];
    let y=spt[2];
    days=Array();
        days[0]='الأحد';
        days[1]='الإثنين';
        days[2]='الثلاثاء';
        days[3]='الأربعاء';
        days[4]='الخميس';
        days[5]='الجمعة';
        days[6]='السبت';
        d=new Date(m+'/'+d+'/'+y);
    let dss = days[d.getDay()];
    $('#day').val(dss);
})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getDay(){
    let ds=$('#date').val();
    var spt = ds.split('/');
    let d =spt[0];
    let m =spt[1];
    let y=spt[2];
    days=Array();
        days[0]='الأحد';
        days[1]='الإثنين';
        days[2]='الثلاثاء';
        days[3]='الأربعاء';
        days[4]='الخميس';
        days[5]='الجمعة';
        days[6]='السبت';
        d=new Date(m+'/'+d+'/'+y);
    let dss = days[d.getDay()];
    $('#day').val(dss);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
