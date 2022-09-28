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
<style>
    .form-check-input {
        position:relative;
        margin-right:0;
    }
</style>

@if($ticket->app_type==1)
<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="lastRec" id="lastRec" value="4">
        <div class="form-group" style="margin-bottom: 0rem!important;">
            <div class="input-group" style="width:100%!important;">
                <div class="input-group-prepend">
                <label class="form-label " style="color: #ff9149; font-weight:bold">القدرة</label>
                </div>
                <div class="col-sm-12 col-md-3">
                    <input type="radio" {{ $readonly?"readonly":"" }}  name="phase[]"  {{ $ticket->phase==1?'checked':"" }} id="radio-1" class="jui-radio-buttons" value="1" onclick="">
                   
                    <label for="radio-1">1 فاز</label>
                    <input type="radio" {{ $readonly?"readonly":"" }} name="phase[]" {{ $ticket->phase==2?'checked':"" }} id="radio-2" class="jui-radio-buttons" value="2" onclick="">
                 <label for="radio-2">3 فاز</label></div>
                <div class="col-sm-12 col-md-3"    style="padding-bottom: 15px;" >
                    <div class="float-left">
                        <input type="number" class="form-control numFeild" {{ $readonly?"readonly":"" }} style="width:60px;"  name="inAmper" id="inAmper" value="{{ $ticket->inAmper }}" placeholder="30 أمبير">
                    </div> &nbsp;
                    <label for="radio-1"> &nbsp; أمبير</label>
                </div>
            </div>
        </div>
    </div>
    


</div>

<div class="row exonmobile hidemob">
    <div class="col-md-7">
        <div class="form-group">
            <div class="input-group" style="">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">نوع
                        الإشتراك</span>
                </div>
                <select id="subscriptionType" {{ $readonly?"readonly":"" }} name="subscriptionType"
                    class="form-control">
                    @foreach($helpers['subsList'] as $sub)
                    <option value="{{ $sub->id }}" {{ $ticket->subscription_type==$sub->id?'selected':"" }}>{{ $sub->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append" onclick="ShowConstantModal(39,'subscriptionType','نوع اشتراك مياه')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<input type="hidden" name="subscriptionID" id="subscriptionID">
@include('dashboard.includes.subscriber_rec')

    <input type="hidden" id="dept_id"  name="dept_id" value="{{$ticket->dept_id}}">
    <input type="hidden" id="app_type"  name="app_type" value="{{$ticket->app_type}}">
    <div class="row business_container">
        @if($ticket->app_type==1)
        <div class="input-group mb-2 col-lg-6 col-md-12">
             <div class="input-group-prepend">
               <span class="input-group-text"> موقع الطلب </span>
             </div>
            <div class="form-check-inline form-control">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" {{$ticket->regionBuild ==1 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} value="1" name="regionbuild" id="regionbuild1">خارج الحدود
              </label>
            </div>
            <div class="form-check-inline form-control">
              <label class="form-check-label">
                <input type="checkbox" {{$ticket->regionBuild == 2 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} class="form-check-input" value="2" name="regionbuild" id="regionbuild2">داخل الحدود 
              </label>
            </div>
        </div>
        @else
        <input type="hidden" value="0" id="subscriptionType" name="subscriptionType">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text " id="basic-addon1">
                         موقع الطلب                                                           
                      </span>
                    </div>                              
                    <input type="text" id="address" name="address"  value='{{$ticket->address}}' class="form-control" placeholder="  " aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        @endif
        <div class="col-lg-3 col-md-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text " id="basic-addon1">
                         رقم الحوض                                                           
                      </span>
                    </div>                              
                    <input type="text" id="hodNo" name="hodNo"  value='{{$ticket->hodNo}}' {{ $readonly?"readonly":"" }} class="form-control" placeholder="  " aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text " id="basic-addon1">
                        رقم القطعة
                  </span>
                </div>
                <input type="text" id="pieceNo" name="pieceNo" value="{{$ticket->pieceNo}}" {{ $readonly?"readonly":"" }} class="form-control " placeholder="  " aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
        
    @if($ticket->app_type==1)
    <div class="row">
        <div class="input-group mb-2 col-sm-12">
             <div class="input-group-prepend">
               <span class="input-group-text"> وضعية البناء </span>
             </div>
            <div class="form-check-inline form-control">
              <label class="form-check-label">
                <input type="checkbox" id="typebuild1" {{$ticket->typebuild ==1 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild"  value="1" class="form-check-input" >بناء مقترح
              </label>
            </div>
            <div class="form-check-inline form-control">
              <label class="form-check-label">
                <input type="checkbox" id="typebuild2" {{$ticket->typebuild ==2 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild" value="2" class="form-check-input" >بناء قائم  
              </label>
            </div>
            <div class="form-check-inline form-control">
              <label class="form-check-label">
                <input type="checkbox" id="typebuild3" {{$ticket->typebuild ==3 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild" value="3" class="form-check-input">فوق بناء قائم 
              </label>
            </div>
        </div>
    </div>
        
    <div class="row">
        <table class="table table-bordered mb-3 st" style="text-align:center">
            <thead>
                <th> أ </th>
                <th> ب </th>
                <th> ج </th>
                <th> تجارية </th>
                <th> زراعية </th>
                <th> صناعية </th>
                <th> قديمة </th>
                <th> اخرى </th>
                <th> ملاحظات </th>
            </thead
            <tbody>
                <tr>
                        <td><input  name="typestate" {{$ticket->typestate ==1 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id= "typestate1"  type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="typestate" {{$ticket->typestate ==2 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id= "typestate2" type="checkbox" class="form-check-input" value="2"></td>
                        <td><input name="typestate" {{$ticket->typestate ==3 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id= "typestate3" type="checkbox" class="form-check-input" value="3"></td>
                    <div class="form">
                        <td><input  name="typebuilding" {{$ticket->typebuilding ==1 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id="typebuilding1" type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="typebuilding" {{$ticket->typebuilding ==2 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id="typebuilding2" type="checkbox"   class="form-check-input" value="2"></td>
                        <td><input name="typebuilding" {{$ticket->typebuilding ==3 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id="typebuilding3" type="checkbox"   class="form-check-input" value="3"></td>
                        <td><input name="typebuilding" {{$ticket->typebuilding ==4 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} id="typebuilding4" type="checkbox"   class="form-check-input" value="4"></td>
                        <!--<input type="hidden" id="typebuilding" value="تجارية" name="typebuilding">-->
                        <td style="max-width:50px;background-color:#fff;"><input type="text" {{ $readonly?"readonly":"" }} name="typebuildingother" value="{{$ticket->typebuildingother}}" id="typebuildingother" class="form-control" placeholder=" اخرى  "></td>
                        <td style="max-width:300px"><input type="text" class="form-control" {{ $readonly?"readonly":"" }} value="{{$ticket->typebuildingnote}}" name="typebuildingnote" id="typebuildingnote" placeholder=" ملاحظات "></td>
                    </div>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="form">
            <div class="input-group">
                <label class="form-label" style="color: #ff9149; font-weight:bold">مشتملات العقار </label>
                <div class="col-sm-12 col-md-10">
                    <input onchange="if($(this).prop('checked'))$('.rent2').hide()" {{ $readonly?"disabled":"" }} type="radio" name="typeship" value="1" {{$ticket->typeship ==1 ? 'checked' : ''}} id="typeship1" class="jui-radio-buttons"  >
                    <label for="radio-3">العقار منفصل </label>
                    <input onchange="if($(this).prop('checked'))$('.rent2').show()" {{ $readonly?"disabled":"" }} type="radio" name="typeship" value="2" {{$ticket->typeship ==2 ? 'checked' : ''}} id="typeship2" class="jui-radio-buttons" >
                    <label for="radio-4">العقار ضمن عمارة </label>

                </div>
            </div>
        </div>
    </div>
    <div class="row rent2 {{$ticket->typeship !=2 ? 'hide' : ''}}">
        <table class="table table-bordered mb-3 st" style="text-align:center">
            <thead>
                <th> الرقم </th>
                <th> الوصف </th>
                <th> شقة </th>
                <th> مخزن </th>
                <th> مكتب </th>
                <th> طابق </th>
                <th> مطلع درج </th>
                <th> مصعد </th>
                <th> ملاحظات </th>
            </thead
            <tbody>
                <tr>
                    
                        <td> 1. </td>
                        <td> قائم </td>
                        <td><input name="appart[]" {{$ticket->detailData->appart ? in_array(1, $ticket->detailData->appart) ? 'checked' : '' : ''}} id="appart1" type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="typeStore[]" {{$ticket->detailData->typeStore ? in_array(1, $ticket->detailData->typeStore) ? 'checked' : '' : ''}} id="typeStore1" type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="office[]" {{$ticket->detailData->office ? in_array(1, $ticket->detailData->appart) ? 'checked' : '' : ''}} id="office1" type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="floor[]" {{$ticket->detailData->floor ? in_array(1, $ticket->detailData->floor) ? 'checked' : '' : ''}} id="floor1" type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="stairs[]" {{$ticket->detailData->stairs ? in_array(1, $ticket->detailData->stairs) ? 'checked' : '' : ''}} id="stairs1" type="checkbox" class="form-check-input" value="1"></td>
                        <td><input name="elev[]" {{$ticket->detailData->elev ? in_array(1, $ticket->detailData->elev) ? 'checked' : '' : ''}} id="elev1" type="checkbox" class="form-check-input" value="1"></td>
                        <td style="max-width:60px"><input type="text" value="{{$ticket->detailData->notes1}}" name="notes1" class="form-control" placeholder=" ملاحظات "></td>
                    
                </tr>
                <tr>
                    
                        <td> 2. </td>
                        <td> مرخص غير قائم </td>
                        <td><input name="appart[]" id="appart2" {{$ticket->detailData->appart ? in_array(2, $ticket->detailData->appart) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="2"></td>
                        <td><input name="typeStore[]" id="typeStore2" {{$ticket->detailData->typeStore ? in_array(2, $ticket->detailData->typeStore) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="2"></td>
                        <td><input name="office[]" id="office2" {{$ticket->detailData->office ? in_array(2, $ticket->detailData->office) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="2"></td>
                        <td><input name="floor[]" id="floor2" {{$ticket->detailData->floor ? in_array(2, $ticket->detailData->floor) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="2"></td>
                        <td><input name="stairs[]" id="stairs2" {{$ticket->detailData->stairs ? in_array(2, $ticket->detailData->stairs) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="2"></td>
                        <td><input name="elev[]" id="elev2" {{$ticket->detailData->elev ? in_array(2, $ticket->detailData->elev) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="2"></td>
                        <td style="max-width:300px"><input type="text" value="{{$ticket->detailData->notes2}}" name="notes2" class="form-control" placeholder=" ملاحظات "></td>
                    
                </tr>
                <tr>
                    
                        <td> 3. </td>
                        <td> مستقبلي (غير مرخص) </td>
                        <td><input name="appart[]" id="appart3" {{$ticket->detailData->appart ? in_array(3, $ticket->detailData->appart) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="3"></td>
                        <td><input name="typeStore[]" id="typeStore3" {{$ticket->detailData->typeStore ? in_array(3, $ticket->detailData->typeStore) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="3"></td>
                        <td><input name="office[]" id="office3" {{$ticket->detailData->office ? in_array(3, $ticket->detailData->office) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="3"></td>
                        <td><input name="floor[]" id="floor3" {{$ticket->detailData->floor ? in_array(3, $ticket->detailData->floor) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="3"></td>
                        <td><input name="stairs[]" id="stairs3" {{$ticket->detailData->stairs ? in_array(3, $ticket->detailData->stairs) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="3"></td>
                        <td><input name="elev[]" id="elev3" {{$ticket->detailData->elev ? in_array(3, $ticket->detailData->elev) ? 'checked' : '' : ''}} type="checkbox" class="form-check-input" value="3"></td>
                        <td style="max-width:300px"><input type="text" value="{{$ticket->detailData->notes3}}" name="notes3" class="form-control" placeholder=" ملاحظات "></td>
                    
                </tr>
                <!--<tr style="display:none">-->
                    
                <!--        <td> 4. </td>-->
                <!--        <td> المجموع </td>-->
                <!--        <td><input name="appart[]" id="appart4" type="checkbox" class="form-check-input" value="4"></td>-->
                <!--        <td><input name="typeStore[]" id="typeStore4" type="checkbox" class="form-check-input" value="4"></td>-->
                <!--        <td><input name="office[]" id="office4" type="checkbox" class="form-check-input" value="4"></td>-->
                <!--        <td><input name="floor[]" id="floor4" type="checkbox" class="form-check-input" value="4"></td>-->
                <!--        <td><input name="stairs[]" id="stairs4" type="checkbox" class="form-check-input" value="4"></td>-->
                <!--        <td><input name="elev[]" id="elev4" type="checkbox" class="form-check-input" value="4"></td>-->
                <!--        <td style="max-width:300px"><input type="text" name="notes4" class="form-control" placeholder=" ملاحظات "></td>-->
                    
                <!--</tr>-->
            </tbody>
        </table>
    </div>
    @endif
<div class="row">
    <div class="col-md-7">
        <div class="form-group paddmob">
            <div class="input-group licNoGroup" {{ $readonly?"readonly":"" }}
                >
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'رقم الرخصة' }}
                    </span>
                </div>
                <input type="text" id="LicenceNo" {{ $readonly?"readonly":"" }} class="form-control" 
                 value="{{ $ticket->LicenceNo }}" name="LicenceNo" style="height: 35px;">
                <input type="hidden" id="licNo" name="licNo">
            </div>
        </div>
    </div>
</div>
<div class="row hidemob">
    <div class="col-md-12">

        <div class="form-group">
            <div class="input-group">
                <label class="form-label" style="color: #ff9149; font-weight:bold">
                    {{ 'نوع الملكية' }}
                </label>
                <div class="col-sm-12 col-md-8">
                    <input {{ $readonly?"disabled":"" }}
                        onchange="if($(this).prop('checked'))$('.attach-required').hide()"
                        type="radio" name="Ownership[]" {{ $ticket->ownership_type==1?"checked":"" }} id="radio-3"
                        class="jui-radio-buttons" value="1"
                        onclick="$('.ownertypes').hide();$('.owner').show();">
                    <label for="radio-3">{{ 'ملك' }} </label>
                    <input {{ $readonly?"disabled":"" }}
                        onchange="if($(this).prop('checked'))$('.attach-required').show()"
                        type="radio" name="Ownership[]" id="radio-4"
                        class="jui-radio-buttons" value="2" {{ $ticket->ownership_type==2?"checked":"" }}
                        onclick="$('.ownertypes').hide();$('.rent').show();">
                    <label for="radio-4">{{ 'إيجار' }} </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-7 ownertypes rent hidemob"  style="{{ $ticket->ownership_type==1?'display: none':'' }}">
        <div class="form-group">
            <div class="input-group inputD2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'اسم المالك' }}
                    </span>
                </div>
                <input type="text" id="OwnerName" {{ $readonly?"readonly":"" }}
                    class="form-control ac10 ui-autocomplete-input" value="{{ $ticket->owner_name }}" name="OwnerName" style="height: 35px;"
                    autocomplete="off">
                <input type="hidden" id="SubscriberID1" name="SubscriberID1" value="{{ $ticket->owner_id }}">
            </div>
        </div>
    </div>
    
</div>
<script>
        $('input[name="regionbuild"]').on('change', function() {
          $('input[name="regionbuild"]').not(this).prop('checked', false);
        });
        
        $('input[name="typebuild"]').on('change', function() {
               $('input[name="typebuild"]').not(this).prop('checked', false);
            });
        $('input[name="typestate"]').on('change', function() {
               $('input[name="typestate"]').not(this).prop('checked', false);
            });
        $('input[name="typebuilding"]').on('change', function() {
               $('input[name="typebuilding"]').not(this).prop('checked', false);
                // $('#typebuilding').val($(this).val());
        });

</script>