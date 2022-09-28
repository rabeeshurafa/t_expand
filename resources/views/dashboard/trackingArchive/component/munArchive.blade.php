<?php
if (isset($helpers)) {
    $archive = $helpers['archive'];
}
?>
<style>
    .w-97 {
            width: 97% !important;
        }
</style>
<div class="row white-row  mb-2">
    <div class="col-lg-12 col-md-12 ">
        <div class="row">
            <div class="col-lg-8 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                {{trans('archive.title')}}
                            </span>
                        </div>
                        <input type="text" id="msgTitle" class="form-control removeborders" name="msgTitle"
                               style="width: 30%;" readonly value="{{$archive['info']->title}}">
                        <select name="archive_type" readonly id="archive_type" class="form-control archive_type">
                            <option value="0">-- {{ trans('archive.document_type') }} --</option>
                            @foreach($archive['docTypes'] as $docType)
                                <option value="{{$docType->id}}" {{$docType->id==$archive['info']->type_id?"selected":''}}> {{$docType->name}}   </option>
                            @endforeach
                        </select>
                        <input type="hidden" id="ArchiveID" name="ArchiveID" value="{{$archive['info']->id}}">
                        <input type="hidden" id="archive_type" name="archive_type" value="{{$archive['info']->url}}">
                        <input type="hidden" id="customer_model" name="customer_model" value="{{$archive['info']->model_name}}">
                        <input type="hidden" id="customer_id" name="customer_id" value="{{$archive['info']->model_id}}">
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                    {{trans('archive.date')}}
                            </span>
                        </div>
                        <input type="text" id="msgDate" readonly name="msgDate"
                               class="form-control  valid"
                               value="{{$archive['info']->date}}" placeholder=""
                               autocomplete="off">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                @if ($archive['info']->type=='projArchive')
                                    {{trans('archive.proj_name')}}
                                @elseif($archive['info']->type=='empArchive')
                                    {{trans('archive.name_emp')}}
                                @elseif ($archive['info']->type=='citArchive')
                                    {{trans('archive.name_cit')}}
                                @elseif ($archive['info']->type=='assetsArchive')
                                    {{trans('archive.name_assets')}}
                                @else
                                    {{trans('archive.commitment_to')}}
                                @endif
                            </span>
                        </div>
                            <input type="text" id="customerName" readonly class="form-control cust" name="customerName"
                                   style="width: 30%;" value="{{$archive['info']->name}}">
                    </div>
                </div>
            </div>

            <div class="{{$archive['info']->type=='lawArchieve'?'col-lg-12':'col-lg-4'}} col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group {{$archive['info']->type=='lawArchieve'?'w-97':''}}">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                @if ($archive['info']->type=='lawArchieve')
                                    {{ trans('admin.notes') }}
                                @else
                                    {{trans('archive.num')}}
                                @endif
                            </span>
                        </div>
                        <input type="text" id="msgid" name="msgid" readonly class="form-control  valid"
                               style="{{$archive['info']->type=='lawArchieve'?'':'text-align: left;direction: ltr;'}}" value="{{$archive['info']->serisal}}">
                    </div>
                </div>
            </div>
        </div>
        @if($archive['info']->type!='lawArchieve')
        <div class="row cop">
            <div class="col-md-12 checkCop">
{{--                <input type="checkbox" name="copyTo" onclick="$('.copyto').toggle()">--}}
                {{trans('archive.copy_to')}}
            </div>
            <div class="col-md-8  copyto">
                @foreach($archive['CopyTo'] as $copyTo)
                    <div class="form-group paddmob">
                        <div class="input-group w-91">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    {{trans('archive.copy_to')}}
                                </span>
                            </div>
                            <input type="text" id="copyToText[]" class="form-control cust_auto name" name="copyToText[]" readonly value="{{$copyTo->name}}" >
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <div class="row col-md-12">
        @foreach($archive['files'] as $file)
            <?php
                $urlFile = asset('');
                if ($file->type == 1) {
                    $urlFile .= $file->url;
                } else {
                    $urlFile = $file->url;
                }
            ?>
            <div id="attach" class=" col-md-4">
                <div class="attach" onmouseover="$(this).children().first().next().show()">
                    <a class="attach-close1" href="{{$urlFile}}" style="color: #74798D;float: left;" target="_blank">
                        <span class="attach-text">{{substr($file->real_name,0,15)}}</span>
                        @if($file->extension=="jpg"||$file->extension=="png")
                            <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/image.png">
                        @elseif($file->extension=="pdf")
                            <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/pdf.png">
                        @elseif($file->extension=="xsc" || $file->extension=="excel")
                            <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/excellogo.png">
                        @elseif($file->extension=="doc")
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