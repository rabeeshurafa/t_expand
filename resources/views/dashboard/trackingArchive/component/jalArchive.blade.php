<?php
if (isset($helpers)) {
    $archive = $helpers['archive'];
}
?>
<div class="row white-row mb-2">
    <div class="col-lg-12 col-md-12 ">
        <div class="row">
            <div class="col-lg-8 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                    اسم الاجتماع
                            </span>
                        </div>
                        <input type="text" id="msgTitle" class="form-control cust" readonly
                               value="{{$archive['jalType']->name}}" name="msgTitle" style="width: 30%;">
                        <input type="hidden" id="ArchiveID" name="ArchiveID" value="{{$archive['info']->id}}">
                        <input type="hidden" id="archive_type" name="archive_type" value="{{$archive['info']->url}}">
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                تاريخ الاجتماع
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
                @foreach($archive['CopyTo'] as $copyTo)
                    <div class="form-group paddmob">
                        <div class="input-group w-91">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    مرتبط ب
                                </span>
                            </div>
                            <input type="text" id="copyToText[]" class="form-control cust_auto name" name="copyToText[]"
                                   readonly value="{{$copyTo->name}}">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-4 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                {{trans('archive.num_send')}}
                            </span>
                        </div>
                        <input type="text" id="msgid" readonly name="msgid" class="form-control  valid"
                               style="text-align: left;direction: ltr;" value="{{$archive['info']->serisal}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group" style="width: 97% !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                الموضوع
                            </span>
                        </div>
                        <input type="text" id="subject" readonly class="form-control" name="subject"
                               value="{{$archive['info']->subject}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                <div class="form-group paddmob">
                    <div class="input-group" style="width: 97% !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                القرار
                            </span>
                        </div>
                        <input type="text" id="decision" readonly class="form-control" name="decision"
                               value="{{$archive['info']->decision}}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        @foreach($archive['files'] as $file)
                <?php
                $urlFile='';
                if(is_object($file['file_links'])){
                    if (isset($file['file_links']->ftp)) {
                        $urlFile = $file['file_links']->ftp;
                    } else if (isset($file['file_links']->s3)) {
                        $urlFile = $file['file_links']->s3;
                    } else if (isset($file['file_links']->dropbox)) {
                        $urlFile = $file['file_links']->dropbox;
                    } else {
                        $urlFile = asset('') . $file['url'];
                    }
                }else{
                    if (isset($file['file_links']['ftp'])) {
                        $urlFile = $file['file_links']['ftp'];
                    } else if (isset($file['file_links']['s3'])) {
                        $urlFile = $file['file_links']['s3'];
                    } else if (isset($file['file_links']['dropbox'])) {
                        $urlFile = $file['file_links']['dropbox'];
                    } else {
                        $urlFile = asset('') . $file['url'];
                    }
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
                            <img style="width: 20px;"
                                 src="https://t.palexpand.ps/public/assets/images/ico/excellogo.png">
                        @elseif($file->extension=="doc")
                            <img style="width: 20px;"
                                 src="https://template.expand.ps/public/assets/images/ico/word.png">
                        @else
                            <img style="width: 20px;" src="https://t.palexpand.ps/public/assets/images/ico/file.png">
                        @endif
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
