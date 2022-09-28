<?php 
if(isset($helpers)){
    $archive=$helpers['archive'];
}
$title=null;
foreach($archive['docTypes'] as $docType){
    if(intval($docType->id)==intval($archive['info']->trade_type)){
        $title=$docType->name;
        break;
    }
}

?>

<div class="row white-row mb-2">
    <div class="col-lg-12 col-md-12 ">
        <div class="row">
            <div class="col-lg-3 col-md-3 pr-0 pr-s-3">
                <div class="form-group">
                    <div class="input-group w-s-87" style="width: 100% !important;">
                        <div class="input-group-prepend" style="height: 38px;">
                            <span class="input-group-text" id="basic-addon1">
                                رقم المعاملة
                            </span>
                        </div>
                        <input type="text" id="tradeNo" class="form-control" name="tradeNo" readonly value="{{$archive['info']->trade_no}}">
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 pr-2">
                <div class="form-group">
                    <div class="input-group w-s-87">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                               {{trans('archive.deal_type')}}
                            </span>
                        </div>
                        <select class="form-control tradeType" readonly name="tradeType" id="tradeType">
                            <option value="">{{trans('admin.select')}}</option>
                            @foreach($archive['docTypes'] as $docType)
                                <option value="{{$docType->id}}" {{$docType->id==$archive['info']->trade_type?"selected":''}}> {{$docType->name}}   </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-12 pr-0 pr-s-12">
                <div class="form-group">
                    <div class="input-group w-s-87">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                مقدم الطلب
                            </span>
                        </div>
                        <input type="text" id="supplierName" class="form-control" name="supplierName" readonly value="{{$archive['info']->name}}">
                        <input type="hidden" id="ArchiveID" name="ArchiveID" value="{{$archive['info']->id}}">
                        <input type="hidden" id="archive_type" name="archive_type" value="{{$archive['info']->url}}">
                        <input type="hidden" id="customer_model" name="customer_model" value="{{$archive['info']->model_name}}">
                        <input type="hidden" id="customer_id" name="customer_id" value="{{$archive['info']->model_id}}">
                        <input type="hidden" id="customerName" name="customerName" value="{{$archive['info']->name}}">
                        <input type="hidden" id="msgTitle" name="msgTitle" value="{{$title}}">
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                <div class="form-group">
                    <div class="input-group w-s-87" id="licGroup">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                {{trans('archive.date')}}
                            </span>
                        </div>
                        <!--<input type="text" id="date" name="date" class="form-control eng-sm  valid" value="" placeholder="" autocomplete="off">-->
                        <input type="text" id="date" name="date" maxlength="10" class="form-control eng-sm  valid"
                              readonly value="{{$archive['info']->date}}" autocomplete="off">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 pr-0 pr-s-12">
                <div class="form-group">
                    <div class="input-group w-s-87">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                رقم الهوية
                            </span>
                        </div>
                        <input type="text" id="vehicleName" class="form-control vehicle" name="vehicleName" readonly value="{{$archive['info']->vehicle_name}}" >
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 pr-2">
                <div class="form-group">
                    <div class="input-group w-s-87" id="licGroup">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                رقم الحوض
                            </span>
                        </div>
                        <input type="text" id="plateNo" class="form-control plateNo" name="plateNo" readonly value="{{$archive['info']->plateNo}}" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 pr-0 pr-s-12">
                <div class="form-group">
                    <div class="input-group w-s-87" id="licGroup">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                رقم القطعة
                            </span>
                        </div>
                        <input type="text" id="vehicleNo" class="form-control vehicleNo" name="vehicleNo" readonly value="{{$archive['info']->vehicle_no}}" >
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                <div class="form-group">
                    <div class="input-group w-s-87" id="licGroup">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                اسم القطعة
                            </span>
                        </div>
                        <input type="text" id="driverName" class="form-control" name="driverName" readonly value="{{$archive['info']->driverName}}" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 pr-2">
                <div class="form-group">
                    <div class="input-group w-s-87" id="licGroup">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                رقم الوصل 
                            </span>
                        </div>
                        <input type="text" id="driverPhone" class="form-control" name="driverPhone" readonly value="{{$archive['info']->driverPhone}}" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                <div class="form-group">
                    <div class="input-group w-s-87">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                المبلغ  
                            </span>
                        </div>
                        <input type="text" id="documentPlace" class="form-control"name="documentPlace"  readonly value="{{$archive['info']->document_place}}" >
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col-lg-12 col-md-12 pr-0 pr-s-12" style="min-width: 21%" >
                    <div class="form-group">
                        <div class="input-group w-s-87" style="width:97% !important">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    {{trans('admin.notes')}}
                                </span>
                            </div>
                            <input type="text" id="notes" class="form-control " name="notes"  readonly value="{{$archive['info']->notes}}" >
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            @foreach($archive['files'] as $file)
                <?php
                    $urlFile = asset('');
                    if(!str_contains($file['url'], "http")){
                        $urlFile.=$file['url'];
                    }else{
                        $urlFile=$file['url'];
                    }
                ?>
                <div id="attach" class=" col-md-4">
                    <div class="attach" onmouseover="$(this).children().first().next().show()">
                        <a class="attach-close1" href="{{$urlFile}}" style="color: #74798D;float: left;" target="_blank">
                            <span class="attach-text">{{substr($file['real_name'],0,15)}}</span>
                            @if(str_contains($file['url'], ".jpg")||str_contains($file['url'], ".png"))
                                <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/image.png">
                            @elseif(str_contains($file['url'], ".pdf"))
                                <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/pdf.png">
                            @elseif(str_contains($file['url'], ".xsc") || str_contains($file['url'], ".excel"))
                                <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/excellogo.png">
                            @elseif(str_contains($file['url'], ".doc"))
                                <img style="width: 20px;" src="https://template.expand.ps/public/assets/images/ico/word.png">
                            @else
                                <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/file.png">
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>