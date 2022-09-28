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
                         استعمال البناء
                    </span>
                </div>
                <select id="buildingUse" name="buildingUse" type="text" {{ $readonly?"disabled":"" }}
                    class="form-control valid buildingUse" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    <option value="1" {{$ticket->buildingUse==1?'selected':''}}> {{ 'شقق' }} </option>
                    <option value="2" {{$ticket->buildingUse==2?'selected':''}}> {{ 'ارض' }} </option>
                </select>
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
    <div class="col-lg-4 col-md-12 pr-s-12" >
        <div class="form-group paddmob">
            <div class="input-group" style="width: 94.6% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        الاستعمال التنظيمي  
                    </span>
                </div>
                <select id="systemUse" {{ $readonly?"disabled":"" }} name="systemUse" type="text"
                    class="form-control valid systemUse" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    @foreach($helpers['useList'] as $use)
                    <option value="{{ $use->id }}" {{$use->id== $ticket->systemUse?'selected':''}}>{{ $use->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}" onclick="ShowConstantModal(6278,'systemUse','الشركة المنفذة')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
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
    @if(count($ticket->pieceArr)==0)
    <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 16px;padding-right: 0px;">
        <div class="form-group">
            <div class="input-group" style="width: 100% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم القطعة' }}
                    </span>
                </div>
                <input type="text" id="pieceNo" name="pieceNo[]"
                    class="form-control" placeholder="0000"
                    value=""
                    {{ $readonly?"readonly":"" }}
                    aria-describedby="basic-addon1">
                <a class="add-btn" onclick="addPieceNo();" style="margin-left: 0px;padding-top: 9px;padding-right: 9px;">
                    <i class="fa fa-plus" style="color:#1E9FF2;"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
    @if(count($ticket->pieceArr)>0)
    <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 16px;padding-right: 0px;">
        <div class="form-group">
            <div class="input-group" style="width: 100% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم القطعة' }}
                    </span>
                </div>
                <input type="text" id="pieceNo" name="pieceNo[]"
                    class="form-control" placeholder="0000"
                    value="{{$ticket->pieceArr[0]}}"
                    {{ $readonly?"readonly":"" }}
                    aria-describedby="basic-addon1">
                <a class="add-btn" onclick="addPieceNo();" style="margin-left: 0px;padding-top: 9px;padding-right: 9px;">
                    <i class="fa fa-plus" style="color:#1E9FF2;"></i>
                </a>
            </div>
        </div>
    </div>
    @endif
    @if(count($ticket->pieceArr)>1)
    <div class="col-lg-4 col-md-12 pr-s-12 PieceRow1 " >
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم القطعة' }}
                    </span>
                </div>
                <input type="text" id="pieceNo[]" name="pieceNo[]"
                    class="form-control" placeholder="0000"
                    value="{{$ticket->pieceArr[1]}}"
                    {{ $readonly?"readonly":"" }}
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    @endif
    
</div>
<div class="row PieceRow2">
    @for($i=2 ; $i<count($ticket->pieceArr) ; $i++)
    <div class="col-lg-3 col-md-12 pr-s-12">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'رقم القطعة' }}
                    </span>
                </div>
                <input type="text" id="pieceNo[]" name="pieceNo[]"
                    value="{{$ticket->pieceArr[$i]}}"
                    {{ $readonly?"readonly":"" }}
                    class="form-control" placeholder="0000"
                    aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    @endfor
</div>
@include('dashboard.includes.regionsTemplate_rec')

<div class="row">
    <div class="col-md-6" >
        <div class="form-group paddmob">
            <div class="input-group" style="width: 94.6% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        مكتب مساحة 
                    </span>
                </div>
                <select id="areaOffice" {{ $readonly?"disabled":"" }} name="areaOffice" type="text"
                    class="form-control valid areaOffice" aria-invalid="false">
                    <option > {{ '-- اختر --' }} </option>
                    @foreach($helpers['officeAreaList'] as $officeArea)
                    <option value="{{ $officeArea->id }}"  {{$officeArea->id== $ticket->areaOffice?'selected':''}} >{{ $officeArea->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}"onclick="ShowConstantModal(6084,'areaOffice','مكتب مساحة')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" >
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
                    @foreach($helpers['officeEngList'] as $officeEng)
                    <option value="{{ $officeEng->id }}" {{$officeEng->id== $ticket->engOffice?'selected':''}}>{{ $officeEng->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append hidemob {{ $readonly?"hide":"" }}" onclick="ShowConstantModal(6272,'engOffice','مكتب هندسي')">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-external-link"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md attachs-section"
        style="margin-left: 25px !important; margin-right: 25px !important;">
        <img src="https://db.expand.ps/images/upload.png" width="40" height="40">
        <span class="attach-header">{{ 'مرفقات' }}
            <span id="attach-required">{{ '*' }}</span>

            <span style="position:absolute; left: 0; font-size: 0.76em;">
                {{ 'يرجى التأكد من إستلام التالي' }}
            </span>
        </span>
    </div>
</div>

<div class="col-md-12">
    <table width="100%" class="detailsTB table archTbl attachs-body" name="Education"
        id="Education">
        <tbody id="requieredAttatch" style="border: hidden">
            <?php $total=0; 
                    $arr=json_decode($ticket->attatchName);
                    $arr1=json_decode($ticket->attachReceive);
                    $j=0;
                    $arr=is_array($arr)?$arr:array();
                    $arr1=is_array($arr1)?$arr1:array();
                    
                    // print_r($arr1);
                    ?>
                
                     <?php 
                    if(sizeof($arr)>0){?>
                        @for($i = 0 ; $i< sizeof($arr) ; $i++)
                        
                        <tr>
                            <td class="col-md-1">
                                <input type="checkbox"  <?php if( $j < sizeof($arr1) ) if( $arr1[$j] == $i ){ echo 'checked'; $j++; } ?> {{ $readonly?"disabled":"" }} value="{{$i}}" name="attachReceive[]" class="condition">
                            </td>
                            <td class="col-md-10" style="text-align: center!important;" >
                                <input class="form-control" id="plusRequieredAttach" {{ $readonly?"readonly":"" }} type="text" name="attatchName[]"value="{{$arr[$i]}}"/>
                            </td>
                            <td>
                            </td>
                
                        </tr> 
                        @endfor
                    <?php } ?>
        </tbody>
    </table>

</div>

<script>
    firstpiece=('{{count($ticket->pieceArr)}}'-1);
    function addPieceNo(){
        if(firstpiece==0){
            $('.PieceRow1').append(`<div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text " id="basic-addon1">
                                {{ 'رقم القطعة' }}
                            </span>
                        </div>
                        <input type="text" id="pieceNo[]" name="pieceNo[]"
                            class="form-control" placeholder="0000"
                            aria-describedby="basic-addon1">
                    </div>
                </div>`)
            firstpiece=1;
        }else{
            $('.PieceRow2').append(`<div class="col-lg-3 col-md-12 pr-s-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text " id="basic-addon1">
                                {{ 'رقم القطعة' }}
                            </span>
                        </div>
                        <input type="text" id="pieceNo[]" name="pieceNo[]"
                            class="form-control" placeholder="0000"
                            aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>`)
        }
    }
    $(document).ready(function() {
        
        $("#requieredAttatch").on("blur", "#plusRequieredAttach",function() {
            console.log($(".docs1").last().val());
            if($(".docs1").last().val().length>0){
                lastC1=$("#attachReceive1N").val();
                    $("#requieredAttatch").append('' 
                    +'<tr>'
                    +    '<td class="col-md-1">'
                    +        '<input type="checkbox" value="'+lastC1+'" name="attachReceive1[]" class="condition">'
                    +    '</td>'
                    +    '<td class="col-md-10" id="plusRequieredAttach"  style="text-align: center!important;" >'
                    +        '<input class="form-control docs1"  type="text" name="docs1[]"  >'
                    +    '</td>'
                    +    '<td onclick="$(this).parent().remove()" >'
                    +        '<i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor:pointer;  color:#1E9FF2;font-size: 15pt; "></i>'
                    +    '</td>'
                    +'</tr>'
                    );
                    $("#attachReceive1N").val(++lastC1);
            }
            
        });
    });

    
</script>



