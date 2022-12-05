@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection
@section('content')
    <style>

        #recList tr:nth-child(even) {
            background: #D7EDF9 !important;
            vertical-align: top !important;
        }

        #recList tr:nth-child(odd) {
            background: #FFF;
            vertical-align: top !important;
        }

        #recList input, #recList textarea {
            background-color: transparent;
            font-size: 13pt !important;
            border: 0px;
        }

        #recList td {
            vertical-align: top !important;;
        }

        .dropdown-menu.show {
            transform: translate3d(119px, 30px, 0px) !important;
        }
    </style>
    <div role="tabpanel" class="tab-pane active show" id="activeIcon1" aria-labelledby="activeIcon1-tab1"
         aria-expanded="true">
        <form action="C_agenda/saveMeeting" id="formData" method="post" novalidate>
            @csrf
            <!-- horizontal grid start -->
            <meta name="csrf-token" content="{{ csrf_token() }}"/>
            <input type="hidden" name="topicToEdit" id="topicToEdit" value="0">
            <section class="horizontal-grid" id="horizontal-grid">
                <div class="row white-row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body" style="padding-bottom: 0px;">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group validate">
                                                    <div class="input-group w-s-87">
                                                        <img src="{{ asset('assets/images/ico/meeting.png') }}"
                                                             style="float: right;height: 34px;">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style="">
                                                                {{trans('archive.meeting_name')}}
                                                            </span>
                                                        </div>
                                                        <input type="hidden" id="meetingID" name="meetingID" value="0">
                                                        <input type="hidden" id="meetingIDEnd" name="meetingIDEnd"
                                                               value="0">
                                                        <input type="hidden" id="lastorder" name="lastorder" value="1">
                                                        <input type="hidden" id="scannedRow" name="scannedRow"
                                                               value="0">
                                                        <input type="hidden" id="mimeType" name="mimeType" value="">
                                                        <input type="hidden" id="scannedFileSrc" name="scannedFileSrc"
                                                               value="">
                                                        <select type="text" id="meetingTitleName"
                                                                name="meetingTitleName"
                                                                class="form-control alphaFeild"
                                                                style="width: 115px;"
                                                                aria-invalid="false"
                                                                onchange="showBuildingColumn()"
                                                                onchange="DisplayMeeting();$('.allmember').addClass('hide');$('.meeting'+$(this).val()).removeClass('hide')">
                                                            <option disabled selected> -- {{trans('admin.select')}}--
                                                            </option>
                                                            @if(count($agendaExtention)>0)
                                                                @foreach($agendaExtention as $agenda)
                                                                    @if(Auth()->user()->id==74 ||(is_array(json_decode($agenda->employee))?in_array(Auth()->user()->id,json_decode($agenda->employee)):array()))
                                                                        <option
                                                                            value="{{$agenda->id}}">{{$agenda->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                        </select>

                                                        <div class="input-group-append"
                                                             onclick="AddNew('meetingTitle','اضافة اجتماع')"
                                                             style="cursor:pointet;padding-left: 5px;;margin-left:0px !important;">
                                                            <span class="input-group-text input-group-text2">
                                                                <i class="fa fa-external-link"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group validate">
                                                    <div class="input-group w-s-87">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style="">
                                                                {{trans('archive.meeting_number')}}
                                                            </span>
                                                            <input id="agendaNum" name="agendaNum" maxlength="20"
                                                                   class="form-control"
                                                                   style="height: calc(2.3rem + 2px) !important;"
                                                                   onblur="DisplayMeeting()" placeholder=" رقم الاجتماع"
                                                                   on
                                                                   aria-invalid="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group validate">
                                                    <div class="input-group w-s-87">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style="">
                                                                {{trans('archive.meeting_date')}}
                                                            </span>
                                                            <input type="text" id="agendaDate" name="agendaDate"
                                                                   class="form-control eng-sm singledatewithDay"
                                                                   data-mask="00/00/0000" autocomplete="off"
                                                                   placeholder="" aria-describedby="basic-addon1"
                                                                   aria-invalid="false" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input hidden id="agenda_id" />
                                            <div class="col-md-1 startMeeting1"
                                                 style="text-align:center; display:none;">
                                                <button type="button" name="mainbutton" id="mainbutton"
                                                        class="btn btn-primary mainbutton"
                                                        style="padding-top:5px;padding-bottom:5px"
                                                        onclick="startMeeting()">
                                                    بدء الجلسة
                                                </button>
                                            </div>
                                            <div class="col-md-3 startMeeting" style="text-align:center;">
                                                <a onClick="printMeeting();">
                                                    <img src="https://doc.expand.ps/images/printer.jpeg" style="height: 32px;">
                                                    طباعة
                                                </a>
                                                <button type="button" onclick="forewordMeeting()" class="btn btn-primary ml-2">
                                                    تحويل الجلسة
                                                </button>
                                                <!-- <div class="form-group ">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1" style="display:none;">
                                                                بحث في المواضيع
                                                                </span>
                                                                <input type="text" id="TopicSrch" name="TopicSrch" class="form-control eng-sm " placeholder="أدخل نص البحث" style="width: 100%;">
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                <input id="TopicSrch" name="TopicSrch"
                                                       class="form-control hide SubPagea round ac1 ui-autocomplete-input hide"
                                                       placeholder="{{trans('archive.topic_search')}} "
                                                       style="text-align: center;width: 350px; "
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="content-body">
                <!-- card actions section start -->
                <section id="card-actions">
                </section>
            </div>
            <div class="content-body">
                <!-- card actions section start -->
                <section id="card-actions">
                    <div class="row">
                        <div class="col-12" id="topicAppend1">
                            <input type="hidden" name="fromname" id="fromname" value="subject1">
                            <table style="width:100%;direction: rtl;text-align: right;background-color: #ffffff;"
                                   class="detailsTB table wtbl1">
                                <thead>
                                <tr
                                    style="text-align:center !important;background-color: #0073AA; color:#ffffff; height:45px !important;">
                                    <th scope="col" style=" width: 30px;color:#ffffff;50px " class="th1">
                                        #
                                    </th>
                                    <th scope="col" class=" th1" style="text-align:center;color:#ffffff;width: 450px ">
                                        {{trans('archive.topic')}}
                                    </th>
                                    <th scope="col" class=" th1" style="text-align:center;color:#ffffff;width: 250px ">
                                        محول من
                                    </th>
                                    <th scope="col" class=" th1" style="text-align:center;color:#ffffff;width: 250px ">
                                        مرتبط ب
                                    </th>
                                    <th scope="col" class="th1 building_column"
                                        style="text-align:center;color:#ffffff;width: 450px ">
                                        التوصيات
                                    </th>
                                    <th scope="col" class="th1" style="text-align:center;color:#ffffff;width: 450px "
                                        width="450px">
                                        {{trans('archive.decision')}}
                                    </th>
                                    <th scope="col" class=" th1" style="width:110px" ></th>
                                </tr>
                                </thead>
                                <tbody id="recList">
                                <tr class="card123 normal-topic">
                                    <td scope="col">
                                        1
                                    </td>
                                    <td scope="col">
                                        <textarea class="form-control resize-ta"
                                                  placeholder="{{trans('archive.enter_subject_here')}}"
                                                  id="topicTitle1" name="topicTitle1" style=" text-align: right;"
                                                  onchange="DrawBorder(1)"></textarea>
                                        <input type="hidden" id="topicid" name="topicid[]" value="0">
                                        <input type="hidden" id="topicid1" name="topicid1" value="0">
                                    </td>
                                    <td scope="col" class="building_column">
                                        <input id="converterFrom1" onchange="DrawBorder(1)" name="converterFrom1"
                                               class="form-control" placeholder="محول من"
                                               style="text-align: right; border:0px solid #000000;">
                                    </td>
                                    <td scope="col">
                                        <input id="applicantName1" onchange="DrawBorder(1)" name="applicantName1"
                                               class="form-control ccac" placeholder="{{trans('archive.recipient')}}"
                                               style="text-align: right; border:0px solid #000000;">
                                        <input type="hidden" id="applicantID1" name="applicantID1" class="form-control"
                                               style="text-align: center;" value="0">
                                        <input type="hidden" id="applicantType1" name="applicantType1"
                                               class="form-control"
                                               style="text-align: center;">

                                    </td>
                                    <td scope="col" class="building_column">
                                        <textarea type="text" class="form-control resize-ta"
                                                  placeholder="التوصيات"
                                                  onchange="DrawBorder(1)" rows="2"
                                                  id="recommendation1" name="recommendation1"></textarea>
                                    </td>
                                    <td scope="col">
                                            <textarea type="text" class="form-control resize-ta"
                                                      placeholder="{{trans('archive.enter_subject')}}"
                                                      onchange="DrawBorder(1)" rows="2"
                                                      id="descisiontxt1" name="descisiontxt1"></textarea>
                                        <div class="row subject1ImagesArea">
                                        </div>
                                        <div class="row subject1FilesArea">
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <input type="hidden" name="fromname" id="fromname" value="subject1">
                                        <input type="file" class="form-control-file" id="subject1UploadFile[]"
                                               multiple="" name="subject1UploadFile[]" onchange="doUploadAttachNew(1)"
                                               style="display: none">

                                        <input type="file" class="form-control-file" id="subject1UploadImage[]"
                                               multiple="" name="subject1UploadImage[]" onchange="doUploadAttachNew(1)"
                                               accept="image/*" style="display: none">

                                        <span class="attach-header">
                                                <span id="attach-required">*</span>
                                                <span class="attach-icons" style="margin-left: 0px;">
                                                    <button type="button" class="mainbutton" name="mainbutton"
                                                            id="mainbutton"
                                                            style="border:0px; background:#ffffff"
                                                            onclick="saveMeeting(1);">
                                                        <img src="{{ asset('assets/images/ico/floppy-icon.png') }}"
                                                             style="height: 32px;">
                                                    </button>
                                                    <span class="dropdown">
                                                      <button class="btn"
                                                              style="background-color: transparent !important; border-color: transparent !important;"
                                                              type="button" id="dropdownMenuButton"
                                                              data-toggle="dropdown" aria-haspopup="true"
                                                              aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v  mr-0" style="color: black;"
                                                           aria-hidden="true"></i>
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                           style="transform: translate3d(119px, 30px, 0px) !important;">
                                                        <a class="dropdown-item"
                                                           onclick="$('#fromname').val('subject1');document.getElementById('subject1UploadFile[]').click(); return false">
                                                            <img src="{{ asset('assets/images/ico/upload.png') }}"
                                                                 style="height: 32px;">
                                                            مرفقات
                                                        </a>
                                                        <a class="dropdown-item hide"
                                                           onclick="document.getElementById('subject1UploadImage[]').click(); return false">
                                                            <img src="{{ asset('assets/images/ico/upload.png') }}"
                                                                 style="height: 32px;">
                                                        </a>
                                                        <a class="dropdown-item hide"
                                                           onclick="scanToJpg();$('#scannedRow').val(1)">
                                                            <img
                                                                src="https://t.palexpand.ps/assets/images/ico/scanner.png"
                                                                class="hide" style="cursor:pointer;">
                                                        </a>
                                                        <a class="dropdown-item"
                                                           onclick="scanTopdf();$('#scannedRow').val(1)">
                                                            <img
                                                                src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"
                                                                style="cursor:pointer;">
                                                            سكانر
                                                        </a>
                                                      </div>
                                                    </span>
                                                </span>
                                            </span>
                                    </td>
                                </tr>
                                @if(isset($agendaDetail))
                                        <?php $c=2; ?>
                                    @foreach($agendaDetail->AgendaTopic as $topic)
                                        <tr class="card{{$c}} card123 forwarded-subject{{$c}}">
                                            <td scope="col">  {{($c)}}  </td>
                                            <td scope="col">
                                                <textarea class="form-control resize-ta" placeholder=""
                                                          id="topicTitle{{$c}}" name="topicTitle{{$c}}"
                                                          style=" text-align: right;" onchange="DrawBorder('{{$c}}')"> {{$topic->title??''}} </textarea>
                                                <input type="hidden" id="topicid" name="topicid[]" value="0">
                                                <input type="hidden" id="topicid{{$c}}" name="topicid{{$c}}" value="0">
                                            </td>
                                            <td scope="col" class="building_column">
                                              <textarea id="converterFrom{{$c}}" onchange="DrawBorder({{$c}})"
                                                        name="converterFrom{{$c}}"
                                                        style=" text-align: right;"
                                                        class="form-control resize-ta" placeholder="محول من"
                                              >{{$agendaDetail->AgendaExtention->name??''}} جلسة رقم {{$agendaDetail->agenda_number??''}} بتاريخ {{$agendaDetail->agenda_date}}</textarea>
                                                <input type="hidden" id="agendaDetailId{{$c}}" name="agendaDetailId{{$c}}" value="{{$agendaDetail->id}}">
                                                <input type="hidden" id="agendaTopicId{{$c}}" name="agendaTopicId{{$c}}" value="{{$topic->id}}">
                                            </td>
                                            <td scope="col">
                                                <input id="applicantName{{$c}}" onchange="DrawBorder({{$c}})"
                                                       name="applicantName{{$c}}"
                                                       class="form-control ccac ui-autocomplete-input" placeholder=""
                                                       style="text-align: right; border:0px solid #000000;"
                                                       autocomplete="off" value="{{$topic->connected_to_txt??''}}">
                                                <input type="hidden" id="applicantID{{$c}}" name="applicantID{{$c}}"
                                                       class="form-control" style="text-align: center;"
                                                       value="{{$topic->connected_to??0}}">
                                                <input type="hidden" id="applicantType{{$c}}"
                                                       name="applicantType{{$c}}" class="form-control"
                                                       style="text-align: center;"
                                                       value="{{$topic->model??''}}">
                                            </td>
                                            <td scope="col" class="building_column">
                                                <textarea type="text" class="form-control resize-ta"
                                                          placeholder="التوصيات"
                                                          onchange="DrawBorder({{$c}})" rows="2"
                                                          id="recommendation{{$c}}" name="recommendation{{$c}}">{{$topic->descision}}</textarea>
                                            </td>
                                            <td scope="col">
                                                <textarea type="text" class="form-control resize-ta"
                                                          onchange="DrawBorder({{$c}})" rows="2"
                                                          id="descisiontxt{{$c}}" name="descisiontxt{{$c}}"> </textarea>
                                                <div class="row subject{{$c}}ImagesArea">
                                                    @foreach($topic->files as $file)
                                                            <?php
                                                            $urlFile = '';
                                                            if(isset($file['file_links']->ftp)){
                                                                $urlFile=$file['file_links']->ftp;
                                                            }else if(isset($file['file_links']->s3)){
                                                                $urlFile=$file['file_links']->s3;
                                                            }  else if (isset($file['file_links']->dropbox)) {
                                                                $urlFile = $file['file_links']->dropbox;
                                                            } else {
                                                                $urlFile = asset('') . $file['file_links']->url;
                                                            }
                                                            ?>
                                                        <div id="attach" class=" col-md-6">
                                                            <div class="attach" onmouseover="$(this).children().first().next().show()">
                                                                <a class="attach-close1" href="{{$urlFile}}" style="color: #74798D;float: left;" target="_blank">
                                                                    <span class="attach-text">{{substr($file['real_name'],0,15)}}</span>
                                                                    <input type="hidden" id="subject{{$c}}imgUploads[]" name="subject{{$c}}imgUploads[]" value="{{$file['real_name']}}">
                                                                    <input type="hidden" id="subject{{$c}}id[]" name="subject{{$c}}id[]" value="{{$file['id']}}">
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
                                                <div class="row subject{{$c}}FilesArea">
                                                </div>
                                            </td>
                                            <td scope="col">
                                                <input type="file" class="form-control-file"
                                                       id="subject{{$c}}UploadFile[]" multiple=""
                                                       name="subject{{$c}}UploadFile[]"
                                                       onchange="doUploadAttachNew({{$c}})" style="display: none">
                                                <input type="file" class="form-control-file"
                                                       id="subject{{$c}}UploadImage[]" multiple=""
                                                       name="subject{{$c}}UploadImage[]"
                                                       onchange="doUploadAttachNew({{$c}})" accept="image/*"
                                                       style="display: none">
                                                <span class="attach-header">
                                                    <span id="attach-required">*</span>
                                                    <span class="attach-icons" style="margin-left: 0px;">
                                                       <button type="button" class="mainbutton" name="mainbutton" id="mainbutton"
                                                               style="border:0px; background:#ffffff"
                                                               onclick="saveMeeting((+'{{$c}}'));">
                                                            <img src="https://t.expand.ps/expand_repov1/public/assets/images/ico/floppy-icon.png"
                                                                 style="height: 32px;">
                                                       </button>
                                                      <span class="dropdown">
                                                          <button class="btn" style="background-color: transparent !important; border-color: transparent !important;"
                                                                  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v  mr-0" style="color: black;" aria-hidden="true"></i>
                                                          </button>
                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                               style="transform: translate3d(119px, 30px, 0px) !important;">
                                                            <a class="dropdown-item"
                                                               onclick="$('#fromname').val('subject{{$c}}');document.getElementById('subject{{$c}}UploadFile[]').click(); return false">
                                                                <img src="{{ asset('assets/images/ico/upload.png') }}" style="height: 32px;">
                                                                مرفقات
                                                            </a>
<!--                                                            <a class="dropdown-item" href="{{ url('') }}/ar/admin/printDes/{{$c}}" target="_blank">
                                                                <img src="https://doc.expand.ps/images/printer.jpeg" style="height: 32px;">
                                                                طباعة
                                                            </a>-->
                                                            <a class="dropdown-item" onclick="scanTopdf();$('#scannedRow').val({{$c}})">
                                                                <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png" style="cursor:pointer;">
                                                                سكانر
                                                            </a>
                                                            <!--<a class="dropdown-item" href="{{ url('') }}/ar/admin/trackingArchive/agenda_archieve/{{$c}}" target="_blank">
                                                                متابعة
                                                            </a>-->
                                                          </div>
                                                        </span>
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php $c++; ?>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            <section class="horizontal-grid" id="horizontal-grid">
                <div class="row white-row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body row">
                                    <div class="form-body col-4 mb-2">
                                        <div class="row">
                                            <div class="col-md-1 startMeeting" style="text-align:center; display:none;">
                                                <button type="button" name="endbutton" id="endbutton"
                                                        class="btn btn-primary"
                                                        style="padding-top:5px;padding-bottom:5px"
                                                        onclick="endMeeting()">
                                                    {{trans('archive.end_meeting')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-8 mb-2">
                                        <div style="padding-right: 36px;padding-bottom: 10px;">
                                            <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"
                                                 style="cursor:pointer;" onclick="scanToJpgMeetingFile();">
                                            <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"
                                                 style="cursor:pointer;" onclick="scanTopdfMeetingFile();">
                                        </div>
                                        <ol class="vasType 1vas addAttatch olmob">
                                            <li style="font-size: 17px !important;color:#000000">
                                                <div class="row">
                                                    <div class="col-sm-6 attmob">
                                                        <input type="text" id="attachName1" key="1" name="attachName[]"
                                                               class="form-control attachName"
                                                               placeholder="أدخل اسم المرفق"
                                                               value="">
                                                    </div>
                                                    <div class="attdocmob col-sm-5 attach_row_1 ">
                                                        <input type="hidden" id="attach_ids1" name="attach_ids[]" value="">
                                                    </div>
                                                    <div>
                                                        <img src="{{ asset('assets/images/ico/upload.png') }}"
                                                             width="40" class="attachs"
                                                             height="40" style="cursor:pointer"
                                                             onclick="$('#currFile').val(1);validateName(1)">

                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                        <div class="row">
                                            <div class="col-md-12 saveAttachment" style="text-align:center;">
                                                <button type="button" name="attachbutton" id="attachbutton"
                                                        class="btn btn-primary"
                                                        style="padding-top:5px;padding-bottom:5px"
                                                        onclick="saveAttachMeeting();">
                                                    حفظ المرفقات
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" id="currFile" name="currFile">
                                        <input type="file" style="display:none" id="attachfile" name="attachfile"
                                               onchange="startUpload('formData')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="modal fade text-left" id="BeginMeeting" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel1"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog2" role="document">
                    <div class="modal-content" style="width: 450px;">
                        <div class="modal-header modal-header2">
                            <h4 class="modal-title" id="myModalLabel2" style="color: #ffffff;"><span
                                    style="padding-right: 160px;">بدء الجلسة</span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="color: #ffffff;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="input-group" style="max-height: 200px; overflow: auto;">
                                        <div class="input-group-prepend" style="margin-right:15%">
                                            <span class="input-group-text" id="basic-addon1" style="width: 81px;">
                                                {{trans('archive.meeting_date')}}
                                            </span>
                                            <input type="text" id="beginAgendaDate" name="beginAgendaDate"
                                                   class="form-control eng-sm singledatewithDay"
                                                   data-mask="00/00/0000 - EEEE"
                                                   autocomplete="off" placeholder="" aria-describedby="basic-addon1"
                                                   aria-invalid="false" style="width: 100%;">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none">
                                    <div class="input-group w-s-87">
                                        <div class="input-group-prepend">
                                            <span style="margin-left: 10px; font-weight: bold; color: black">
                                                من الساعة
                                            </span>
                                            <input type="time" id="starttime" name="starttime" value="00:00">
                                            <span
                                                style="margin-left: 10px; margin-right: 10px; font-weight: bold; color: black;">
                                                الى الساعة
                                            </span>
                                            <input type="time" id="endtime" name="endtime" value="00:00">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group" id="attendessTable"
                                         style="max-height: 200px; overflow: auto;">
                                        <table style="width:100%" class="detailsTB table">
                                            <tr>
                                                <th scope="col">الرجاء اختيار الحضور</th>
                                            </tr>
                                            <tbody id="subTask3">
                                            {{-- <?php $i=1;
                    if(isset($meetingMembers) && !empty($meetingMembers) && count($meetingMembers) > 0){ ?>
                        <?php foreach ($meetingMembers as $key => $value){ ?>
                        <tr class="allmember meeting<?php echo $value->meeting_id; ?>">
                            <td width="20px">
                                <?php echo $i;
                                $i++; ?>
                            </td>
                            <td>
                                <?php echo $value->memername; ?>
                            </td>
                            <td width="40px">
                                <input type="checkbox" name="attendance[]" class="attendance" value="<?php echo $value->memberID; ?>">
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } ?> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group" style="text-align:center">
                                    <button type="button" name="beginmeetsubmit" class="btn btn-info modalBtn"
                                            onclick="beginMeeting()">حفظ
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('dashboard.component.fetch_table')
@endsection
@section('script')
    @include('dashboard.archive.defineMeeting')
    @include('dashboard.archive.takeADecision')
    <script>

        function showBuildingColumn() {
            // if ($('#meetingTitleName').val() == 1) {
            //     $('.building_column').removeClass('hide')
            // } else {
            //     $('.building_column').addClass('hide')
            // }
        }
        function printMeeting(){
            const agenda_id = $('#agenda_id').val();
            if(!agenda_id) return null
            window.open(`{{ url('') }}/ar/admin/printMeeting/${agenda_id}`,'_blank');
        }
        function forewordMeeting(){
            const agenda_id = $('#agenda_id').val();
            if(!agenda_id) return null
            window.open(`{{route('agendaforwording')}}?id=${agenda_id}`,'_blank');
        }
        attach_index = 2;

        function scanToJpgMeetingFile() {
            scanner.scan(displayImagesOnPageMeetingFile,
                {
                    "output_settings":
                        [
                            {
                                "type": "return-base64",
                                "format": "png"
                            }
                        ]
                }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPageMeetingFile(successful, mesg, response) {
            if (!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
                console.info('User canceled');
                return;
            }
            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for (var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                uploadScannedfile(scannedImage);
                // processScannedImage(scannedImage);
            }
        }

        function scanTopdfMeetingFile() {
            scanner.scan(displayPdfOnPageMeetingFile,
                {
                    "output_settings":
                        [
                            {
                                "type": "return-base64",
                                "format": "pdf",
                            }
                        ]
                }
            );
        }

        function displayPdfOnPageMeetingFile(successful, mesg, response) {

            if (!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
                console.info('User canceled');
                return;
            }
            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for (var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                uploadScannedfile(scannedImage);
            }
        }

        function uploadScannedfile(scannedImage) {
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                    'ContentType': 'application/json'
                }
            });

            $.ajax({
                type: 'post',
                url: '{{route('saveScanedFile')}}',
                data: {
                    scannedData: scannedImage.src,
                    type: scannedImage.mimeType,

                },
                dataType: "json",
                async: true,
                success: (response) => {
                    $(".form-actions").removeClass('hide');
                    $(".loader").addClass('hide');
                    $(".archive_type").removeClass("error");
                    const row =meetingNewScannedAttache(response.file,attach_index)
                    attach_index++
                    $(".addAttatch").append(row)
                },

                error: function (response) {
                    $(".form-actions").removeClass('hide');
                    $(".loader").addClass('hide');

                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: '{{trans('admin.error_save')}}',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    // $(".formDataaaFilesArea").html('');

                    if (response.responseJSON.errors.customerName) {

                        $("#customerName").addClass("error");

                    }

                }

            });
            return true;
        }

        function addNewAttatch() {

            if ($(".attachName").last().val().length > 0) {
                var row = '<li style="font-size: 17px !important;color:#000000">' +
                    '<div class="row">' +
                    '<div class="col-sm-6 attmob">' +
                    `<input type="text" id="attachName${attach_index}" key="${attach_index}" name="attachName[]" class="form-control attachName">` +
                    '</div>' +
                    '<div class="attdocmob col-sm-5 attach_row_' + attach_index + '">' +
                   `<input type="hidden" id="attach_ids${attach_index}" name="attach_ids[]" value="">`+
                    '</div>' +
                    '<div class="attdelmob attachs">' +
                    `<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${attach_index});validateName(${attach_index})">` +
                    '</div>' +
                    '<div class="attdelmob attachs">' +
                    '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>' +
                    '</div>' +
                    ' </div>' +

                    ' </li>'
                attach_index++
                $(".addAttatch").append(row)
            }
        }

        function startUpload(formDataStr) {
            id = $("#currFile").val()
            // $('#feesText'+id).val($('#attachfile').val().split('\\').pop())
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            var formData = new FormData($("#" + formDataStr)[0]);
            $.ajax({
                url: '{{route('uploadTicketAttach')}}',
                type: 'POST',
                data: formData,
                dataType: "json",
                async: true,
                success: function (data) {
                    row = '';
                    if (data.all_files) {
                        addNewAttatch()
                        var j = 0;
                        $actionBtn = '';
                        for (j = 0; j < data.all_files.length; j++) {
                            $(".attach_row_" + id).html('')
                            $actionBtn +=attacheViewWithIcon(data.all_files[j], 12, null,id)
                        }
                        $(".alert-danger").addClass("hide");
                        $(".alert-success").removeClass('hide');
                        $(".attach_row_" + id).append($actionBtn)
                        $(".loader").addClass('hide');
                        $("#attachfile").val('');
                        $(".form-control-file").val('');
                        $(".group1").colorbox({rel: 'group1'});
                        setTimeout(function () {
                            $(".alert-danger").addClass("hide");
                            $(".alert-success").addClass("hide");
                        }, 2000)
                    } else {
                        $(".alert-success").addClass("hide");
                        $(".alert-danger").removeClass('hide');
                    }
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                error: function () {
                    $(".alert-success").addClass("hide");
                    $(".alert-danger").removeClass('hide');
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        function validateName(key) {
          const name = $(`#attachName${key}`).val()
          if (name.trim().length > 0) {
            $(`#attachName${key}`).removeClass('error')
            $('#attachfile').trigger('click');
          } else {
            $(`#attachName${key}`).addClass('error')
            $('#attachfile').trigger('click');
          }
        }

        function validateAllAttachmentNames() {
          let error = false
          for (let i = 1; i < attach_index; i++) {
            const name = $(`#attachName${i}`).val()
            const id = $(`#attach_ids${i}`).val()
            if (name?.trim()?.length <= 0 && id?.trim()?.length > 0) {
              $(`#attachName${i}`).addClass('error')
              error = true;
            } else {
              $(`#attachName${i}`).removeClass('error')
            }
          }
          return error;
        }
    </script>
    <script>
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                {
                    "output_settings":
                        [
                            {
                                "type": "return-base64",
                                "format": "png"
                            }
                        ]
                }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if (!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
                console.info('User canceled');
                return;
            }
            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for (var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                rowId = $('#scannedRow').val();
                $('#scannedFileSrc').val(scannedImage.src);
                $('#mimeType').val(scannedImage.mimeType);
                doUploadAttachNew(rowId);
            }
        }

        function scanTopdf() {
            scanner.scan(displayPdfOnPage,
                {
                    "output_settings":
                        [
                            {
                                "type": "return-base64",
                                "format": "pdf",
                            }
                        ]
                }
            );
        }

        function displayPdfOnPage(successful, mesg, response) {

            if (!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if (successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
                console.info('User canceled');
                return;
            }
            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for (var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                rowId = $('#scannedRow').val();
                $('#scannedFileSrc').val(scannedImage.src);
                $('#mimeType').val(scannedImage.mimeType);
                doUploadAttachNew(rowId);
            }
        }

        itopic = 1;

        function saveMeeting(topicRowId=itopic) {
            //meetingID
            //lastorder
            // if(forwardId==0) {
              if ($("#meetingTitleName").val() == null) {
                $("#meetingTitleName").addClass('error');
                return false;
              }
              if ($("#topicTitle" + topicRowId).val() == null || $("#topicTitle" + topicRowId).val() == '') {
                $("#topicTitle" + topicRowId).addClass('error');
                return false;
              }

              if ($("#agendaNum").val() == '') {
                $("#agendaNum").addClass('error');
                return false;
              }
              if ($("#agendaDate").val() == '') {
                $("#agendaDate").addClass('error');
                return false;
              } else {
                $("#agendaDate").removeClass('error');
              }
            // }

            //$("#lastorder").val(itopic)
            var formData = new FormData($("#formData")[0]);
            formData.append('rowToBeSaved', topicRowId);
            console.log(formData)
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            $(".attach-icons").addClass('hide');
            $.ajax({
                url: "{{ route('ajaxSaveMeeting') }}",
                type: 'POST',
                data:formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.topicid) {
                        ii = $("#lastorder").val();
                        ii++;
                        $("#lastorder").val(ii);
                        DisplayMeeting(topicRowId)
                        $("#meetingID").val(data.id)
                        $("#meetingIDEnd").val(data.id)
                        $("#topicid" + (topicRowId)).val(data.topicid)
                        // setTimeout(function(){
                        //   $(".alert-danger").addClass("hide");
                        //   $(".alert-success").addClass("hide");
                        // },2000)


                    } else {
                        $(".loader").addClass('hide');
                        $(".form-actions").removeClass('hide');
                        $(".attach-icons").removeClass('hide');
                        // $(".alert-success").addClass("hide");
                        // $(".alert-danger").removeClass('hide');
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: '{{trans('admin.error_save')}}',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#errMsg").text(data.status.msg)
                    }
                    // $(".loader").addClass('hide');
                    // $(".form-actions").removeClass('hide');
                    // $(".mainbutton").removeClass('hide');
                },
                error: function () {
                    $(".loader").addClass('hide');
                    $(".attach-icons").removeClass('hide');
                },
            });

            return true;
        }

        function editSubject(id) {

            if (confirm('هل تريد تعديل الموضوع')) {
                $("#topicToEdit").val(id);
                var formData = new FormData($("#formData")[0]);
                ;
                $.ajax({
                    url: 'C_agenda/ajaxEditMeeting',
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    async: true,
                    success: function (data) {
                        if (data.status.success) {
                            $(".alert-danger").addClass("hide");
                            $(".alert-success").removeClass('hide');
                            $("#succMsg").text(data.status.msg)

                            setTimeout(function () {
                                $(".alert-danger").addClass("hide");
                                $(".alert-success").addClass("hide");
                            }, 2000)
                        } else {
                            $(".alert-success").addClass("hide");
                            $(".alert-danger").removeClass('hide');
                            $("#errMsg").text(data.status.msg)
                        }
                        $(".loader").addClass('hide');
                        $(".form-actions").removeClass('hide');

                        $(".card" + id).removeAttr('style', 'border: 2px solid #0000ff !important;')
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
                return true;
            }
            return false;
        }

        function deleteSubject(id) {
            if (confirm('هل تريد حذف الموضوع')) {

                topicid = $("#topicid" + id).val();
                if (topicid > 0) {
                    var formData = {'topicid': topicid};
                    $.ajax({
                        url: 'C_agenda/ajaxDeleteMeeting',
                        type: 'POST',
                        data: {'topicid': topicid},
                        dataType: "json",
                        async: true,
                        success: function (data) {
                            if (data.status.success) {
                                $(".alert-danger").addClass("hide");
                                $(".alert-success").removeClass('hide');
                                $("#succMsg").text(data.status.msg)

                                elemCt1 = 0;
                                $('.card123').each(function () {
                                    if (typeof $(this).attr('style') !== "undefined")
                                        elemCt1++
                                });
                                if (elemCt1 == 0)
                                    $(window).unbind('beforeunload');
                                setTimeout(function () {
                                    $(".alert-danger").addClass("hide");
                                    $(".alert-success").addClass("hide");
                                }, 2000)
                            } else {
                                $(".alert-success").addClass("hide");
                                $(".alert-danger").removeClass('hide');
                                $("#errMsg").text(data.status.msg)
                            }
                            $(".loader").addClass('hide');
                            $(".form-actions").removeClass('hide');
                            return true;
                        },
                    });
                }
                return true;
            }
            return false;
        }

        function AttachReplay(id) {
            //DoAjax
            $("#topicToEdit").val(id);
            $(".allDec").html('');

            var formData = new FormData($("#formData")[0]);
            $.ajax({
                url: 'C_agenda/ajaxReplay',
                type: 'POST',
                data: formData,
                dataType: "json",
                async: true,
                success: function (data) {
                    $("#descisiontxt").val(data.topicData[0].decision)

                    for (i = 0; i < data.topicData[0].agreeList.length; i++) {
                        $('.agreedMember').each(function () {
                            if ($(this).val() == data.topicData[0].agreeList[i].memberID) {
                                $(this).trigger('click')
                            }
                        });
                    }
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                cache: false,
                contentType: false,
                processData: false
            });
            $('.dec' + id).html($("#takeADecision").html());
            $('.dec' + id).toggle()
        }

        function saveDesicion(id) {

            $("#topicToEdit").val(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                }
            });
          //$("#topicToEdit").val(id);
          ii = $("#lastorder").val();
          $("#lastorder").val(id);
          var formData = new FormData($("#formData")[0]);
          $(".loader").removeClass('hide');
          $(".attach-icons").addClass('hide');
          $.ajax({
            url: '{{route('ajaxSaveDesicion')}}',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {
              if (data.topicid) {
                $(".alert-danger").addClass("hide");
                $(".alert-success").removeClass('hide');
                //$("#succMsg").text(data.status.msg)
                $("#row" + id).removeAttr('style')
                $("#lastorder").val(ii);
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: 'تم التعديل',
                  showConfirmButton: false,
                  timer: 1000
                })
                setTimeout(function () {
                  $(".loader").addClass("hide");
                  $(".form-actions").removeClass('hide');
                  $(".attach-icons").removeClass('hide');
                  $(".alert-danger").addClass("hide");
                  $(".alert-success").addClass("hide");
                }, 2000)
              } else {
                $(".alert-success").addClass("hide");
                $(".alert-danger").removeClass('hide');
                $("#errMsg").text(data.status.msg)
              }
              $(".loader").addClass('hide');
              $(".form-actions").removeClass('hide');
              $(".attach-icons").removeClass('hide');
            },
            cache: false,
            contentType: false,
            processData: false
          });
          return true;
        }

        function drawAttach() {
            // $('#feesText'+id).val($('#attachfile').val().split('\\').pop())
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            let formData = {
                'meetingID': $("#meetingID").val(),
            };
            $.ajax({
                url: '{{route('meetingAttach')}}',
                type: 'get',
                data: formData,
                dataType: "json",
                async: true,
                success: function (data) {
                    var attach_template = '';
                    if (data.length > 0) {
                        $('.addAttatch').html(' ');
                        let i = 0;
                        for (i = 0; i <= data.length; i++) {

                            if (i == data.length) {
                                attach_template += `<li style="font-size: 17px !important;color:#000000">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" id="attachName${i + 1}" key="${i + 1}" name="attachName[]" class="form-control attachName" placeholder="أدخل اسم المرفق" value="">
                                        </div>
                                        <div class="col-sm-5 attach_row_${i + 1}">
                                            <input type="hidden" id="attach_ids${i + 1}" name="attach_ids[]" value="">
                                        </div>
                                        <div class="col-sm-1">
                                            <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                                                height="40" style="cursor:pointer" class="attachs"
                                                onclick="$('#currFile').val(${i + 1});validateName(${i + 1})">
                                        </div>
                                    </div>
                                </li>`
                                attach_index = i + 1;
                            } else {
                              attach_template +=meetingAttache(data[i],i)
                            }
                        }
                        attach_index = i + 1;
                    }

                    $('.addAttatch').append(attach_template);
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                error: function () {
                    $(".alert-success").addClass("hide");
                    $(".alert-danger").removeClass('hide');
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
            });
        }

        function drawTopics(topics){
            for (i = 0; i < topics?.length; i++) {
              id = topics[i].id;
              itopic = itopic + 1;
              attach = '';
              for (j = 0; j < topics[i]?.files?.length; j++) {
                url =getFileUrl(topics[i]?.files[j])
                shortCutName = topics[i]?.files[j]?.real_name;
                shortCutName = shortCutName.substring(0, 15)
                if (topics[i]?.files[j]?.extension === "jpg" || topics[i]?.files[j]?.extension === "png")
                  fileimage = '{{ asset('assets/images/ico/image.png') }}';
                else if (topics[i]?.files[j]?.extension === "pdf")
                  fileimage = '{{ asset('assets/images/ico/pdf.png') }}';
                else if (topics[i]?.files[j]?.extension === "excel" || topics[i]?.files[j]?.extension === "xsc")
                  fileimage = '{{ asset('assets/images/ico/excellogo.png') }}';
                else
                  fileimage = '{{ asset('assets/images/ico/file.png') }}';

                attach += '       <div id="attach" class=" col-sm-6 ">   ' +
                  '           <div class="attach" onmouseover="$(this).children().first().next().show()">		' +
                  '               <span class="attach-text">' + shortCutName + '</span>		' +
                  '                   <a class="attach-close1" href="' + url + '" style="color: #74798D; float:left;" target="_blank">' +
                  '                       <img style="width: 20px;"src="' + fileimage + '"> ' +
                  '                   </a>		' +
                  '                   <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>' +
                  '                 <input type="hidden" id="subject' + itopic + 'imgUploads[]" name="subject' + itopic + 'imgUploads[]" value="' + topics[i]?.files[j]?.real_name + '">      ' +
                  // '                 <input type="hidden" id="subject'+id+'orgNameList[]" name="subject'+id+'orgNameList[]" value="'+data.agenda_topic[i].files[j].url+'">      ' +
                  '                 <input type="hidden" id="subject' + itopic + 'id[]" name="subject' + itopic + 'id[]" value="' + topics[i]?.files[j]?.id + '">		' +
                  '           </div>	' +
                  '             </div>';
              }
              row = `<tr class="card${itopic} card123 normal-topic">
                        <td scope="col"> ${itopic} </td>
                        <td scope="col">
                           <textarea class="form-control resize-ta" placeholder="" id="topicTitle${itopic}" name="topicTitle${itopic}" style=" text-align: right;" onchange="DrawBorder(${itopic})">${topics[i].title}</textarea>
                            <input type="hidden" id="topicid" name="topicid[]" value="${id}">
                          <input type="hidden" id="topicid${itopic}" name="topicid${itopic}" value="${id}">
                        </td>
                        <td scope="col" class="building_column">
                           <textarea id="converterFrom${itopic}" onchange="DrawBorder(${itopic})"
                                    name="converterFrom${itopic}"
                                    style=" text-align: right;"
                                    class="form-control resize-ta" placeholder="محول من"
                            >${(topics[i]?.converterFrom??'')}</textarea>
                            <input type="hidden" id="agendaDetailId${itopic}" name="agendaDetailId${itopic}" value="${(topics[i]?.agendaDetailId??0)}">
                            <input type="hidden" id="agendaTopicId${itopic}" name="agendaTopicId${itopic}" value="${(topics[i]?.agendaTopicId??0)}">
                        </td>
                        <td scope="col">
                           <input id="applicantName${itopic}" onchange="DrawBorder(${itopic})" name="applicantName${itopic}" class="form-control ccac ui-autocomplete-input" placeholder="" style="text-align: right; border:0px solid #000000;" autocomplete="off"
                            value="${(topics[i]?.connected_to_txt??'') }">
                            <input type="hidden" id="applicantID${itopic}" name="applicantID${itopic}" class="form-control" style="text-align: center;" value="${topics[i].connected_to}">
                            <input type="hidden" id="applicantType${itopic}" name="applicantType${itopic}" class="form-control" style="text-align: center;" value="${topics[i].model}">
                        </td>
                        <td scope="col" class="building_column">
                            <textarea type="text" class="form-control resize-ta"
                                      placeholder="التوصيات"
                                      onchange="DrawBorder(${itopic})" rows="2"
                                      id="recommendation${itopic}" name="recommendation${itopic}">${(topics[i]?.recommendation??'')}</textarea>
                        </td>
                        <td scope="col">
                            <textarea type="text" class="form-control resize-ta" onchange="DrawBorder(${itopic})" rows="2" id="descisiontxt${itopic}" name="descisiontxt${itopic}">${topics[i].descision}</textarea>
                            <div class="row subject${itopic}ImagesArea">
                                ${attach}
                            </div>
                            <div class="row subject${itopic}FilesArea">
                            </div>
                        </td>
                        <td scope="col">
                            <input type="file" class="form-control-file" id="subject${itopic}UploadFile[]" multiple="" name="subject${itopic}UploadFile[]" onchange="doUploadAttachNew(${itopic})" style="display: none">
                            <input type="file" class="form-control-file" id="subject${itopic}UploadImage[]" multiple="" name="subject${itopic}UploadImage[]" onchange="doUploadAttachNew(${itopic})" accept="image/*" style="display: none">
                            <span class="attach-header">
                                <span id="attach-required">*</span>
                                <span class="attach-icons" style="margin-left: 0px;">
                                   <button type="button" class="mainbutton" name="mainbutton" id="mainbutton" style="border:0px; background:#ffffff"
                                       onclick="saveDesicion(${itopic})">
                                        <img src="https://t.expand.ps/expand_repov1/public/assets/images/ico/floppy-icon.png" style="height: 32px;">
                                   </button>
                                   <span class="dropdown">
                                        <button class="btn" style="background-color: transparent !important; border-color: transparent !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <i class="fa fa-ellipsis-v  mr-0" style="color: black;" aria-hidden="true"></i>
                                        </button>
                                        <dv class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="transform: translate3d(119px, 30px, 0px) !important;">
                                            <a class="dropdown-item" onclick="$('#fromname').val('subject${itopic}');document.getElementById('subject${itopic}UploadFile[]').click(); return false">
                                                <img src="{{ asset('assets/images/ico/upload.png') }}" style="height: 32px;">
                                                مرفقات
                                            </a>
                                            <a class="dropdown-item" href="{{ url('') }}/ar/admin/printDes/${id}" target="_blank">
                                                <img src="https://doc.expand.ps/images/printer.jpeg" style="height: 32px;">
                                                طباعة
                                            </a>
                                            <a class="dropdown-item hide" onclick="scanToJpg();$('#scannedRow').val(${itopic})">
                                                <img src="https://t.palexpand.ps/assets/images/ico/scanner.png" class="hide" style="cursor:pointer;" >
                                            </a>
                                            <a class="dropdown-item" onclick="scanTopdf();$('#scannedRow').val(${itopic})">
                                                <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;" >
                                                سكانر
                                            </a>
                                            <a class="dropdown-item" href="{{ url('') }}/ar/admin/trackingArchive/agenda_archieve/${id}" target="_blank">
                                                متابعة
                                            </a>
                                        </div>
                                   </span>
                                </span>
                            </span>
                        </td>
                    </tr>`
              $(".resize-ta").on("keyup", function () {
                $(this).height(calcHeight($(this).val()) + "px");
              });
              $("#recList").prepend(row)
              // $('textarea').height();
            }
        }

        function DisplayMeeting(forwardedRowToBeDeleted) {

            if ($("#meetingTitleName").val() == null) {
                return false;
            }

            if ($("#agendaNum").val() == '') {
                return false;
            }

            $(".loader").removeClass('hide');
            var formData = new FormData($("#formData")[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: 'ajaxDisplayMeeting',
                type: 'POST',
                data: formData,
                dataType: "json",
                async: true,
                success: function (data) {
                  $('.attach-close1').show()
                  $('.fa-save').show()
                  $('.mainbutton').show()
                  $('#endbutton').html('{{trans('archive.end_meeting')}}')
                  //$("#recList").html('')
                  $("#meetingID").val(data.id)
                  $("#agenda_id").val(data.id)
                  if (data.file_ids)
                    drawAttach();
                  $(".normal-topic").remove()
                  $(`.forwarded-subject${forwardedRowToBeDeleted}`).remove()
                  if (data?.agenda_topic?.length >0) {
                    itopic =((+'{{sizeof($agendaDetail->AgendaTopic??[])}}')??0)+1;
                    $("#meetingIDEnd").val(data.id)
                    $("#agendaDate").val(data.agenda_date)
                    $(".startMeeting").show()
                    // itopic=$("#lastorder").val()
                    drawTopics(data?.agenda_topic)
                    itopic++;
                    if ((+data.is_closed) === 1) {
                      setTimeout(function () {
                        $('input').attr('readonly', true);
                        $('textarea').attr('readonly', true);
                        $('#agendaNum').attr('readonly', false);
                        $('#agendaDate').attr('readonly', false);
                        $('.fa-times').hide()
                        $('.attach-close1').hide()
                        $('.otherattache').show()
                        $('.fa-save').hide()
                        $('.mainbutton').hide()
                        $('.attachs').hide();
                        $('#attachbutton').hide()
                        $('#endbutton').html('هذه الجلسة منتهية')
                        $('.ft-x').hide()
                        $('.attach-icon').hide()
                      }, 2000)
                    } else {
                      addTopicTemplate()
                    }
                  }else{
                    addTopicTemplate()
                  }
                  resizeText();
                  $(".loader").addClass('hide');
                  $(".attach-icons").removeClass('hide');
                },
                error: function () {
                    $(".loader").addClass('hide');
                    $(".attach-icons").removeClass('hide');
                },
                cache: false,
                contentType: false,
                processData: false
            });
            return true;
        }

        function startMeeting() {
            if ($('#meetingTitle').val() != '') {
                if ($('#agendaNum').val() != 0) {
                    //$("#startMeet").hide();
                    $(".loader").removeClass('hide');
                    $("#beginAgendaDate").val($("#agendaDate").val());
                    $("#BeginMeeting").modal('show');
                    //DrawEmployee($("#meetingTitleID").val());
                    $(".loader").addClass('hide');

                    $('#repeat').css({"display": "none"});
                    /*$('#mainbutton').css({"display":"none"});
                    $('#startMeet').css({"display":"none"});*/

                    $(".showDec").show()
                    for (var i = 0; i <= itopic; i++) {
                        $('#decision' + i).css({"display": "block"});
                    }
                } else {
                    alert('الرجاء ادخال رقم الاجتماع');
                    $('#agendaNum').val('');
                }
            } else {
                alert('الرجاء ادخال اسم الاجتماع');
                $('#meetingTitle').val('');
            }

        }

        function beginMeeting() {
            if (confirm('هل تريد إضافة الحضور')) {
                //$("#topicToEdit").val(id);
                var formData = new FormData($("#formData")[0]);
                ;
                $.ajax({
                    url: 'C_agenda/ajaxSaveAttendance',
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    async: true,
                    success: function (data) {
                        if (data.status.success) {
                            $(".alert-danger").addClass("hide");
                            $(".alert-success").removeClass('hide');
                            $("#succMsg").text(data.status.msg)
                            $("#BeginMeeting").modal('hide')

                            setTimeout(function () {
                                $(".alert-danger").addClass("hide");
                                $(".alert-success").addClass("hide");
                            }, 2000)
                            $(".ft-check").show()
                        } else {
                            $(".alert-success").addClass("hide");
                            $(".alert-danger").removeClass('hide');
                            $("#errMsg").text(data.status.msg)
                        }
                        $(".loader").addClass('hide');
                        $(".form-actions").removeClass('hide');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
                return true;
            }
            return false;
        }

        function endMeeting() {
            if (confirm('عند إنهاء الجلسة لن تتمكن من تعديل أي محتوى\r\n هل تريد بالفعل إنهاء الجلسة')) {
                //$("#topicToEdit").val(id);
                var formData = new FormData($("#formData")[0]);
                ;
                $.ajax({
                    url: 'ajaxEndMeeting',
                    type: 'POST',
                    data: formData,
                    dataType: "json",
                    async: true,
                    success: function (data) {
                        if (data.success) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: data.success,
                                showConfirmButton: false,
                                timer: 1000
                            })

                            $(".alert-danger").addClass("hide");
                            $(".alert-success").removeClass('hide');
                            $("#succMsg").text(data.status)
                            $("#BeginMeeting").modal('hide')

                            $('input').attr('readonly', true);
                            $('textarea').attr('readonly', true);
                            $('#agendaNum').attr('readonly', false);
                            $('#agendaDate').attr('readonly', false);
                            $('.fa-times').hide()
                            $('.attachs').hide();
                            $('.attach-close1').hide()
                            $('.fa-save').hide()
                            //('#mainbutton').hide()

                            $('.mainbutton').hide()
                            $('#endbutton').html('هذه الجلسة منتهية')
                            $('.ft-x').hide()
                            $('.attach-icon').hide()
                            //$('.fa-paperclip').remove()
                            setTimeout(function () {
                                $(".alert-danger").addClass("hide");
                                $(".alert-success").addClass("hide");
                            }, 2000)

                        } else {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: data.error,
                                showConfirmButton: false,
                                timer: 1000
                            })
                            $(".alert-success").addClass("hide");
                            $(".alert-danger").removeClass('hide');
                            //$("#errMsg").text(data.status)
                        }
                        $(".loader").addClass('hide');
                        $(".form-actions").removeClass('hide');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
                return true;
            }
            return false;
        }

        function saveAttachMeeting() {
            //$("#topicToEdit").val(id);
          if(validateAllAttachmentNames()){
            return false
          }
            $(".loader").removeClass('hide');
            var formData = new FormData($("#formData")[0]);
            ;
            $.ajax({
                url: 'attachMeeting',
                type: 'POST',
                data: formData,
                dataType: "json",
                async: true,
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1000
                        })

                        $(".alert-danger").addClass("hide");
                        $(".alert-success").removeClass('hide');
                        $("#succMsg").text(data.status)
                        $("#BeginMeeting").modal('hide')
                        //$('.fa-paperclip').remove()
                        setTimeout(function () {
                            $(".loader").addClass('hide');
                        }, 2000)

                    } else {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 1000
                        })
                        $(".alert-success").addClass("hide");
                        $(".alert-danger").removeClass('hide');
                        //$("#errMsg").text(data.status)
                    }
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        $(document).ready(function () {

            $(".ccac").autocomplete({
                source: "archive_auto_complete",
                minLength: 2,
                select: function (event, ui) {
                    $(this).next().val(ui.item.id)
                    $(this).next().next().val(ui.item.model)
                    $("#applicantName").val(ui.item.label)
                }
            });
            /*
            $( ".ccac" ).autocomplete({
                source: "searchAllCustomerCitizenByName",
                minLength: 2,
                select: function( event, ui ) {
                    $(this).next().val(ui.item.contact_id)
                    $("#applicantName").val(ui.item.label)
                }
            })*/
        });

        function doUploadAttachNew(frmid) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $("#fromname").val('subject' + frmid)
            $("#startUpload").val(frmid)
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            $(".attach-icons").addClass('hide');
            var formData = new FormData($("#formData")[0]);

            $.ajax({
                url: 'agendaAttach',
                type: 'POST',
                data: formData,
                dataType: "json",
                async: true,
                success: function (data) {
                    row = '';
                    row1 = '';

                    for (j = 0; j < data.all_files.length; j++) {
                      row +=topicAttache(data.all_files[j],frmid);
                    }
                    $(".subject" + frmid + "ImagesArea").append(row)
                    $(".loader").addClass('hide');
                    $(".attach-icons").removeClass('hide');
                    $(".form-actions").removeClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                error: function () {
                    $(".alert-success").addClass("hide");
                    $(".alert-danger").removeClass('hide');
                    // $("#errMsg").text(data.status.msg)
                    $(".loader").addClass('hide');
                    $(".attach-icons").removeClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }

        itopic = 1;
        var agendaIds = new Array();

        function addTopicTemplate() {
            $('.hasLabel').addClass('hide');
            template = '<tr class="card123 normal-topic" id="row' + itopic + '">'
                + '                    <td scope="col">'
                + '                         ' + itopic
                + '                    </td>'
                + '                    <td scope="col">'
                + '                        <textarea class="form-control resize-ta" onchange="DrawBorder(' + itopic + ')" placeholder="{{trans('archive.enter_subject_here')}}" id="topicTitle' + itopic + '" name="topicTitle' + itopic + '" style="text-align: right;"></textarea>'
                + '                        <input type="hidden" id="topicid" name="topicid[]" value="' + 0 + '">'
                + '                        <input type="hidden" id="topicid' + itopic + '" name="topicid' + itopic + '" value="' + 0 + '">'
                + '                    </td>'
                +`<td scope="col" class="building_column">
                        <textarea id="converterFrom${itopic}" onchange="DrawBorder(${itopic})"
                                    name="converterFrom${itopic}"
                                    style=" text-align: right;"
                                    class="form-control resize-ta" placeholder="محول من"
                          ></textarea>
                    </td>`
                + '                    <td scope="col">'
                + '                        <input id="applicantName' + itopic + '" onchange="DrawBorder(' + itopic + ')" name="applicantName' + itopic + '" class="form-control ccac"  placeholder="{{trans('archive.recipient')}}" style="text-align: right; border:0px solid #000000;">'
                + '                        <input type="hidden" id="applicantID" name="applicantID' + itopic + '" class="form-control" value="0" style="text-align: center;">'
                + '                        <input type="hidden" id="applicantType' + itopic + '" name="applicantType' + itopic + '" class="form-control" style="text-align: center;" >'
                + '                                        <input type="file" class="form-control-file" id="subject' + itopic + 'UploadFile[]" multiple="" name="subject' + itopic + 'UploadFile[]" onchange="doUploadAttachNew(' + itopic + ')" style="display: none">'
                + '                                        <input type="file" class="form-control-file" id="subject' + itopic + 'UploadImage[]" multiple="" name="subject' + itopic + 'UploadImage[]" onchange="doUploadAttachNew(' + itopic + ')" accept="image/*" style="display: none">'
                + '                    </td>'
                +`<td scope="col" class="building_column">
                        <textarea type="text" class="form-control resize-ta"
                                  placeholder="التوصيات"
                                  onchange="DrawBorder(${itopic})" rows="2"
                                  id="recommendation${itopic}" name="recommendation${itopic}"></textarea>
                    </td>`
                + '                    <td scope="col">'
                + '<textarea  type="text" class="form-control resize-ta" placeholder="{{trans('archive.enter_subject')}}" onchange="DrawBorder(' + itopic + ')" rows="2" id="descisiontxt' + itopic + '" name="descisiontxt' + itopic + '"></textarea>'
                + '                        '
                + '                                        <div class="row subject' + itopic + 'ImagesArea">'
                + '                                        </div>'
                + '                                        <div class="row subject' + itopic + 'FilesArea" style="margin-left: 0px;">'
                + '                                        </div>'
                + '                    </td>'
                + '                    <td scope="col"style="width: 106px;">'
                + '                            <span class="attach-header" >'
                + '                                <span id="attach-required">*</span>'
                + '                                <span class="attach-icons" style="margin-left: 0px;">'
                + ' <button type="button" class="mainbutton" name="mainbutton" id="mainbutton" style="border:0px; background:#ffffff; " onclick="saveMeeting();">'
                + '                                                     <img src="{{asset('')}}assets/images/floppy-icon.png" style="height: 32px;">'
                + '                                                 </button>'
                + `                                  <span class="dropdown">
                                                  <button class="btn" style="background-color: transparent !important; border-color: transparent !important;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v  mr-0" style="color: black;" aria-hidden="true"></i>
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="transform: translate3d(119px, 30px, 0px) !important;">
                                                    <a class="dropdown-item" onclick="$('#fromname').val('subject${itopic}');document.getElementById('subject${itopic}UploadFile[]').click(); return false">
                                                        <img src="{{ asset('assets/images/ico/upload.png') }}" style="height: 32px;">
                                                        مرفقات
                                                    </a>
                                                    <a class="dropdown-item hide" onclick="scanToJpg();$('#scannedRow').val(${itopic})">
                                                        <img src="https://t.palexpand.ps/assets/images/ico/scanner.png" class="hide" style="cursor:pointer;" >
                                                    </a>
                                                    <a class="dropdown-item" onclick="scanTopdf();$('#scannedRow').val(${itopic})">
                                                        <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;" >
                                                        سكانر
                                                    </a>
                                                  </div>
                                                </span>`
                // +'                                    <a href="#" onclick="$(\'#fromname\').val(\'subject'+itopic+'\');document.getElementById(\'subject'+itopic+'UploadFile[]\').click(); return false" class="attach-icon">'
                // +'                                        <img src="{{asset('')}}assets/images/upload.png" style="height: 32px;">'
                // +'                                    </a>'
                // +                                   `<img src="https://t.palexpand.ps/assets/images/ico/scanner.png" class="hide" style="cursor:pointer;" onclick="scanToJpg();$('#scannedRow').val(${itopic})">`
                // +                                   `<img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;" onclick="scanTopdf();$('#scannedRow').val(${itopic})">`
                + '                                </span>'
                + '                            </span>'
                + '                    </td>'
                + '                </tr>';
            $("#recList").prepend(template);
            $(".resize-ta").on("keyup", function () {
                $(this).height(calcHeight($(this).val()) + "px");
            });
            $(".ccac").autocomplete({
                source: "archive_auto_complete",
                minLength: 2,
                select: function (event, ui) {
                    $(this).next().val(ui.item.id)
                    $(this).next().next().val(ui.item.model)
                    $("#applicantName").val(ui.item.label)
                }
            });
        }

        $(document).ready(function () {
            $("#TopicSrch").on("keydown", function () {
                var txt = $("#TopicSrch").val();
                $('.card123').each(function () {
                    if ($(this).html().indexOf(txt) != -1) {
                        $(this).show();
                    } else
                        $(this).hide();
                });
            })
        })

        function DrawBorder(id) {
            $("#row" + id).attr('style', 'border: 2px solid #0000ff !important;')

            window.onbeforeunload = confirmExit;
        }

        var elemCt = 0;

        function confirmExit() {
            //return ;
            $('.card123').each(function () {
                if (typeof $(this).attr('style') !== "undefined")
                    elemCt++
            });
            if (elemCt > 0)
                return "هل تريد مغادرة الصفحة دون الحفظ؟";

            $(window).unbind('beforeunload');
            return
        }

        function calcHeight(value) {
            let numberOfLineBreaks = (value.match(/\n/g) || []).length;
            // min-height + lines x line-height + padding + border
            let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
            return newHeight;
        }

        $(".resize-ta").on("keyup", function () {
            $(this).height(calcHeight($(this).val()) + "px");
        });

        function resizeText() {
            let all = $("textarea");
            for (let i = 0; i < all.length; i++) {
                if (all[i].value.length > 50 && all[i].value.length < 300)
                    all[i].style.height = all[i].value.length + "px";
                if (all[i].value.length > 300)
                    all[i].style.height = "300px"
            }
        }

    </script>

@endsection
