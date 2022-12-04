@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection

@section('content')
    <link rel="stylesheet" type="text/css"
          href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css"/>
    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css"
          href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css"/>
    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>
    <div class="app-content content appmainmob">

        <style>
            table th {
                color: white;
            }

            .ss .col1 {
                width: 50%;
            }

            .ss .col2 {
                width: 5%;
            }

            .ss .col3 {
                width: 5%;
            }

            .ss .col4 {
                width: 18%;
            }

            .ss .col5 {
                width: 20%;
            }

            .dt-buttons {
                text-align: left;
                display: inline;
                float: left;
                position: relative;
                bottom: 10px;
                margin-right: 10px;
                margin-bottom: 0 !important;
            }

        </style>

        <section class="horizontal-grid " id="horizontal-grid" style="display: block;">

            <div class="content-body">
                <section id="hidden-label-form-layouts">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <form method="post" id="formDataaa" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <img
                                                    src="http://t.expand.ps/expand_repov1/public/assets/images/ico/report32.png">
                                            تقرير العمل اليومي
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-4 ">
                                                    <div class="form-group">
                                                        <div class="input-group width99 width98rtl widthsub" style="">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">اسم الموظف</span>
                                                            </div>
                                                            <input type="text" readonly id="formDataNameAR"
                                                                   class="form-control alphaFeild ac ui-autocomplete-input"
                                                                   placeholder="ابدا بالكتابة لعرض محاور البحث"
                                                                   name="formDataNameAR" autocomplete="off">
                                                            <input type="hidden" id="nameId" name="nameId">
                                                            <input type="hidden" id="rowId" name="rowId" value="">
                                                        </div>
                                                        <div id="auto-complete-barcode"
                                                             class="divKayUP barcode-suggestion ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-md-12 pr-0 pr-s-12">
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                      id="basic-addon1">التاريخ </span>
                                                            </div>
                                                            <input type="text" id="from" maxlength="10"
                                                                   data-mask="00/00/0000" name="date"
                                                                   class="form-control singledate "
                                                                   placeholder="yyyy/mm/dd"
                                                                   aria-describedby="basic-addon1" aria-invalid="false"
                                                                   value="<?php echo date('d/m/Y')?>" autocomplete="off"
                                                                   onkeyup="getDay()">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-2 col-md-12 pr-0 pr-s-12">
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                      id="basic-addon1">اليوم</span>
                                                            </div>
                                                            <input type="text" id="from1" maxlength="10" name="day"
                                                                   class="form-control singledate "
                                                                   aria-describedby="basic-addon1" aria-invalid="false"
                                                                   value="" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12 pr-0 pr-s-12">
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                      id="basic-addon1">البدء</span>
                                                            </div>
                                                            <input type="text" id="start" maxlength="5" name="start"
                                                                   class="form-control" data-mask="00:00"
                                                                   placeholder="00:00" aria-describedby="basic-addon1"
                                                                   aria-invalid="false" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12 pr-0 pr-s-12">
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">الانتهاء</span>
                                                            </div>
                                                            <input type="text" id="end" maxlength="5" name="end"
                                                                   class="form-control " data-mask="00:00"
                                                                   placeholder="00:00" aria-describedby="basic-addon1"
                                                                   aria-invalid="false" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                        <!---------------------------------------table 1 card 1--------------------------------------------------------->
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                {{--                                                <div class="card">--}}
                                                {{--                                                    <div class="card-body">--}}
                                                {{--                                                        <div class="form-body">--}}
                                                {{--                                                            <div class="row">--}}
                                                {{--                                                                <div class="col-xl-12 col-lg-12">--}}

                                                <table class="detailsTB table ss" id="tb"
                                                       style="width:100%; margin-top:-10px;direction:rtl;text-align:right">
                                                    <thead>
                                                    <tr style="text-align:center !important;">
                                                        <th width="20px">#</th>
                                                        <th class="col1">{{ 'العمل' }}</th>
                                                        <th class="col2">{{ 'من الساعة' }}</th>
                                                        <th class="col3">{{ 'الى الساعة' }}</th>
                                                        <th class="col4">{{ 'المستفيد' }}</th>
                                                        <th class="col5">{{ 'الحالة' }}</th>
                                                        {{--<th class="col6">{{ 'مرقفاتك' }}</th>--}}
                                                    </tr>
                                                    </thead>
                                                    {{-- ---------------------------------------------------------- --}}
                                                    {{-- data-mask="00:00"  maxlength="5"  value="<?php echo date("h:i")?>"  --}}
                                                    {{-- ---------------------------------------------------------- --}}
                                                    <tbody>
                                                    <tr>
                                                        <td width="20px">1</td>
                                                        <td class="col1">
                                                            <input type="text"
                                                                   class="form-control work-text work_1"
                                                                   name="work[]">
                                                            <input type="hidden"
                                                                   class="form-control work_id_1"
                                                                   name="work_id[]">
                                                        </td>
                                                        <td class="col2">
                                                            <input type="text"
                                                                   class="form-control from_1"
                                                                   name="from[]"
                                                                   data-mask="00:00">
                                                        </td>
                                                        <td class="col3">
                                                            <input type="text"
                                                                   class="form-control to_1"
                                                                   name="to[]"
                                                                   data-mask="00:00">
                                                        </td>
                                                        <td class="col4">
                                                            <input type="text"
                                                                   class="form-control ap beneficial_1"
                                                                   index="1"
                                                                   name="beneficial[]"
                                                                   oninput="removeIdAndModel(1);">
                                                            <input type="hidden"
                                                                   class="form-control beneficial_id_1"
                                                                   name="beneficialId[]">
                                                            <input type="hidden"
                                                                   class="form-control beneficial_model_1"
                                                                   name="beneficialModel[]">
                                                        </td>
                                                        <td class="col5">
                                                            {{--                                                                                <input type="text"--}}
                                                            {{--                                                                                       class="form-control"--}}
                                                            {{--                                                                                       name="note[]">--}}
                                                            <div class="input-group" style="width: 100% !important;">
                                                                <select id="state" name="state[]"
                                                                        class="form-control state1">
                                                                    @foreach ($workState as $state)
                                                                        <option
                                                                                value="{{$state->id}}">{{$state->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append"
                                                                     onclick="ShowConstantModal(6427,'state1','الحالة')">
                                                                    <span
                                                                            class="input-group-text input-group-text2">
                                                                        <i class="fa fa-external-link"></i>
                                                                    </span>
                                                                </div>
                                                                <span class="input-group-text input-group-text2"
                                                                      onclick="emptyFirstRow();">
                                                                    <i class="fa fa-trash"></i>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20px">2</td>
                                                        <td class="col1">
                                                            <input type="text"
                                                                   class="form-control work-text"
                                                                   name="work[]">
                                                            <input type="hidden"
                                                                   class="form-control"
                                                                   name="work_id[]">
                                                        </td>
                                                        <td class="col2">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="from[]"
                                                                   data-mask="00:00">
                                                        </td>
                                                        <td class="col3">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="to[]"
                                                                   data-mask="00:00">
                                                        </td>
                                                        <td class="col4">
                                                            <input type="text"
                                                                   class="form-control ap"
                                                                   index="2"
                                                                   name="beneficial[]"
                                                                   oninput="removeIdAndModel(2);">
                                                            <input type="hidden"
                                                                   class="form-control beneficial_id_2"
                                                                   name="beneficialId[]">
                                                            <input type="hidden"
                                                                   class="form-control beneficial_model_2"
                                                                   name="beneficialModel[]">
                                                        </td>
                                                        <td class="col5">
                                                            <div class="input-group" style="width: 100% !important;">
                                                                <select id="state" name="state[]"
                                                                        class="form-control state2">
                                                                    @foreach ($workState as $state)
                                                                        <option
                                                                                value="{{$state->id}}">{{$state->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append"
                                                                     onclick="ShowConstantModal(6427,'state1','الحالة')">
                                                                                        <span
                                                                                                class="input-group-text input-group-text2">
                                                                                            <i class="fa fa-external-link"></i>
                                                                                        </span>
                                                                </div>
                                                                <span class="input-group-text input-group-text2"
                                                                      onclick="$(this).parent().parent().parent().remove()">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="20px">3</td>
                                                        <td class="col1">
                                                            <input type="text"
                                                                   class="form-control work-text"
                                                                   name="work[]">
                                                            <input type="hidden"
                                                                   class="form-control"
                                                                   name="work_id[]">
                                                        </td>
                                                        <td class="col2">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="from[]"
                                                                   data-mask="00:00">
                                                        </td>
                                                        <td class="col3">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="to[]"
                                                                   data-mask="00:00">
                                                        </td>
                                                        <td class="col4">
                                                            <input type="text"
                                                                   class="form-control ap"
                                                                   index="3"
                                                                   name="beneficial[]"
                                                                   oninput="removeIdAndModel(3);" onfocus="newRow()">
                                                            <input type="hidden"
                                                                   class="form-control beneficial_id_3"
                                                                   name="beneficialId[]">
                                                            <input type="hidden"
                                                                   class="form-control beneficial_model_3"
                                                                   name="beneficialModel[]">
                                                        </td>
                                                        <td class="col5">
                                                            {{--                                                                                <input type="text"--}}
                                                            {{--                                                                                       class="form-control"--}}
                                                            {{--                                                                                       name="note[]"--}}
                                                            {{--                                                                                       id="note_3"--}}
                                                            {{--                                                                                       onfocus="newRow()">--}}
                                                            <div class="input-group" style="width: 100% !important;">
                                                                <select id="state" name="state[]"
                                                                        class="form-control state3">
                                                                    @foreach ($workState as $state)
                                                                        <option
                                                                                value="{{$state->id}}">{{$state->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="input-group-append"
                                                                     onclick="ShowConstantModal(6427,'state1','الحالة')">
                                                                                        <span
                                                                                                class="input-group-text input-group-text2">
                                                                                            <i class="fa fa-external-link"></i>
                                                                                        </span>
                                                                </div>
                                                                <span class="input-group-text input-group-text2"
                                                                      onclick="$(this).parent().parent().parent().remove()">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 attachs-section"
                                             style="margin-left: 25px; margin-right: 25px;">
                                            <img src="https://db.expand.ps/images/upload.png" width="40" height="40">
                                            <span class="attach-header">
                                                {{ 'مرفقات' }}
                                            </span>
                                            <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"
                                                 style="cursor:pointer;    float: left;" onclick="scanToJpg();">

                                            <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"
                                                 style="cursor:pointer;    float: left;" onclick="scanTopdf();">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <!--                                        <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"  style="cursor:pointer;    float: left;" onclick="scanToJpg();">

                                                                                <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;    float: left;" onclick="scanTopdf();">-->
                                        <div class="form-group col-8 mb-2">
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
                                                                 onclick="$('#currFile').val(1);validateName(1);">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                            <input type="hidden" id="currFile" name="currFile">
                                            <input type="file" style="display:none" id="attachfile" name="attachfile"
                                                   onchange="startUpload('formDataaa')">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-6" style="position: relative; right: 45%">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary addBtn" id="save">
                                                    {{"حفظ"}}
                                                    <i class="la la-check-square-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
            <!---------------------------------------table 2 style---------------------------------------------------------->
            <style>
                .detailsTB th {
                    color: #ffffff;
                }

                .detailsTB th,
                .detailsTB td {
                    text-align: right !important;

                }

                .recList > tr > td {
                    font-size: 12px;
                }

                table.dataTable tbody th,
                table.dataTable tbody td {
                    padding-bottom: 5px !important;
                }

                .dataTables_filter {
                    margin-top: -15px;
                }

                .even {
                    background-color: #D7EDF9 !important;
                }

                .dt-buttons {
                    margin-bottom: 20px;
                    text-align: left;

                }

            </style>
            <!---------------------------------------table 2 card 2--------------------------------------------------------->

            <div class="content-body resultTblaa">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header" style="direction: rtl;">
                                <h4 class="card-title"><img
                                            src="{{ asset('assets/images/ico/report32.png') }}"/>{{ trans('أعمال الأيام السابقة') }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row" id="resultTblaa">
                                        <div class="col-xl-12 col-lg-12">

                                            <table class="detailsTB table wtbl"
                                                   style="width:100%; margin-top: -10px;direction:rtl;text-align:right">
                                                <thead>
                                                <tr style="text-align:center !important;background: #00A3E8;">
                                                    <th width="50px">#</th>
                                                    <th class="col1">{{ 'التاريخ' }}</th>
                                                    <th class="col2">{{ 'اليوم' }}</th>
                                                    <th class="col3">{{ 'عدد المهام المنجزة' }}</th>
                                                    <th class="col4">{{ 'عدد ساعات العمل' }}</th>
                                                    <th class="col5">{{ 'عدد المستفيدين' }}</th>
                                                    {{--<th class="col6">{{ '' }}</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody id="recListaa">
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

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
              uploadScannedfile(scannedImage);
              // processScannedImage(scannedImage);
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

                shortCutName = response.file.real_name;

                shortCutID = response.file.id;
                urlfile = getFileUrl(response.file)
                shortCutName = shortCutName.substring(0, 40)
                if (response.file.extension == "jpg" || response.file.extension == "png")
                  fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/image.png';
                else if (response.file.extension == "pdf")
                  fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/pdf.png';
                else if (response.file.extension == "doc")
                  fileimage = 'https://template.expand.ps/public/assets/images/ico/word.png';
                else if (response.file.extension == "excel" || response.file.extension == "xsc")
                  fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/excellogo.png';
                else
                  fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/file.png';
                var row = '<li style="font-size: 17px !important;color:#000000">' +
                  '<div class="row">' +
                  '<div class="col-sm-6 attmob">' +
                  `<input type="text" required" id="attachName${attach_index}" key="${attach_index}" name="attachName[]" class="form-control attachName">` +
                  '</div>' +
                  '<div class="attdocmob col-sm-5 attach_row_' + attach_index + '">' +
                  '<div id="attach" class=" col-sm-12 ">' +
                  '<div class="attach">' +
                  '<a class="attach-close1" href="' + urlfile + '" style="color: #74798D; float:left;" target="_blank">' +
                  '<span class="attach-text hidemob">' + shortCutName + '</span>' +
                  '<img style="width: 20px;"src="' + fileimage + '">' +
                  '</a>' +
                  `<input type="hidden" id="attach_ids${attach_index}" name="attach_ids[]" value="${response.file.id}">` +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '<div class="attdelmob">' +
                  `<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${attach_index});validateName(${attach_index})">` +
                  '</div>' +
                  '<div class="attdelmob">' +
                  '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>' +
                  '</div>' +
                  ' </div>' +

                  ' </li>'
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

          let workCount = 4;
          attach_index = 2;

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

          function addNewAttatch() {
            if ($(".attachName").last().val().length > 0) {
              var row = '<li style="font-size: 17px !important;color:#000000">' +
                '<div class="row">' +
                '<div class="col-sm-6 attmob">' +
                `<input type="text" id="attachName${attach_index}" key="${attach_index}" name="attachName[]" class="form-control attachName">` +
                '</div>' +
                '<div class="attdocmob col-sm-5 attach_row_' + attach_index + '">' +
                `<input type="hidden" id="attach_ids${attach_index}" name="attach_ids[]" value="">` +
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
              url: 'uploadTicketAttach',
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
                    file = data.all_files[j]
                    $actionBtn += drawFile(file, id)
                    $actionBtn += '</div>';
                    shortCutName = shortCutName.substring(0, 40)
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

          function drawFile(file, index) {
            shortCutName = (file?.real_name);
            shortCutID = (file.id ?? file.attach_ids);
            urlfile = getFileUrl(file)
            shortCutName = shortCutName.substring(0, 20);
            if (file.extension === "jpg" || file.extension === "png")
              fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/image.png';
            else if (file.extension === "pdf")
              fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/pdf.png';
            else if (file.extension === "doc")
              fileimage = 'https://template.expand.ps/public/assets/images/ico/word.png';
            else if (file.extension === "excel" || file.extension === "xsc")
              fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/excellogo.png';
            else
              fileimage = 'https://t.expand.ps/expand_repov1/public/assets/images/ico/file.png';
            $actionBtn = '<div id="attach" class=" col-sm-12 ">'
              + '<div class="attach">'
              + ' <a class="attach-close1" href="' + urlfile + '" style="color: #74798D; float:left;" target="_blank">'
              + '  <span class="attach-text hidemob">' + shortCutName + '</span>'
              + '    <img style="width: 20px;"src="' + fileimage + '">'
              + '</a>'
              + `<input type="hidden" id="attach_ids${index}" name="attach_ids[]" value="${(shortCutID)}">`
              + '</div>'
              + '</div>';
            // $actionBtn += '</div>';
            return $actionBtn;
          }

          function setAttach(files) {
            // $(".addAttatch").html('')
            if (files) {
              for (i = 0; i < files.length; i++) {
                var row = `
                        <li style="font-size: 17px !important;color:#000000">
                            <div class="row">
                                <div class="col-sm-6 attmob">
                                    <input type="text" id="attachName${attach_index}" key="${attach_index}" name="attachName[]" class="form-control attachName" value="${files[i].attachName}">
                                </div>
                                <div class="attdocmob col-sm-5 attach_row_${attach_index}">
                                    ${drawFile(files[i], attach_index)}
                                </div>
                                <div class="attdelmob attachs">
                                    <img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${attach_index});validateName(${attach_index})">
                                </div>
                                <div class="attdelmob attachs">
                                    <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>
                                </div>
                            </div>
                         </li>`
                attach_index++
                $(".addAttatch").append(row)
              }
            }
          }

          function emptyFirstRow() {
            $('.beneficial_id_1').val('');
            $('.beneficial_model_1').val('');
            $('.beneficial_1').val('');
            $('.to_1').val('');
            $('.from_1').val('');
            $('.work_id_1').val('');
            $('.work_1').val('');
          }

          function setBeneficialData(event, data) {
            const index = event.target.attributes.index.value
            $(`.beneficial_id_${index}`).val((data?.item?.id));
            $(`.beneficial_model_${index}`).val((data?.item?.model));
          }

          function removeIdAndModel(index) {
            $(`.beneficial_id_${index}`).val('');
            $(`.beneficial_model_${index}`).val('');
          }

          function setWorkTable(works) {
            workCount = works?.length ?? 0;
            for (let i = 0; i < works?.length; i++) {
              const work = works[i];
              let row = `<tr>
                                    <td width="20px">${(i + 1)}</td>
                                    <td class="col1">
                                        <input type="text"
                                               class="form-control work-text ${i === 0 ? 'work_1' : ''}"
                                               name="work[]" value="${(work?.work ?? '')}">
                                        <input type="hidden"
                                               class="form-control ${i === 0 ? 'work_id_1' : ''}"
                                               name="work_id[]" value="${(work?.id ?? '')}">
                                    </td>
                                    <td class="col2">
                                        <input type="text"
                                               class="form-control ${i === 0 ? 'from_1' : ''}"
                                               name="from[]"
                                               data-mask="00:00" value="${(work?.start ?? '')}">
                                    </td>
                                    <td class="col3">
                                        <input type="text"
                                               class="form-control ${i === 0 ? 'to_1' : ''}"
                                               name="to[]"
                                               data-mask="00:00" value="${(work?.end ?? '')}">
                                    </td>
                                    <td class="col4">
                                        <input type="text"
                                               class="form-control ap ${i === 0 ? 'beneficial_1' : ''}"
                                               index="${(i + 1)}"
                                               name="beneficial[]" value="${(work?.beneficial_name ?? '')}" onfocus="newRow()" oninput="removeIdAndModel(${(i + 1)});">
                                        <input type="hidden"
                                               class="form-control beneficial_id_${(i + 1)}"
                                               name="beneficialId[]" value="${(work?.beneficial_id ?? '')}">
                                        <input type="hidden"
                                               class="form-control beneficial_model_${(i + 1)}"
                                               name="beneficialModel[]" value="${(work?.beneficial_model ?? '')}">
                                    </td>
                                    <td class="col5">
                                        <div class="input-group" style="width: 100% !important;">
                                            <select id="state" name="state[]"
                                                    class="form-control state${(i + 1)}">
                                                @foreach ($workState as $state)
              <option value="{{$state->id}}"${(work?.state) === {{$state->id}} ? 'selected' : ''}>{{$state->name}}</option>
                                                @endforeach
              </select>
              <div class="input-group-append" onclick="ShowConstantModal(6427,'state${(i + 1)}','الحالة')">
                                                <span class="input-group-text input-group-text2">
                                                    <i class="fa fa-external-link"></i>
                                                </span>
                                            </div>
                                            <span class="input-group-text input-group-text2" onclick="${i > 0 ? '$(this).parent().parent().parent().remove()' : 'emptyFirstRow()'}">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </div>
                                    </td>
                                </tr>`
              $('.ss > tbody').append(row);
              $(".ap").autocomplete({
                source: 'archive_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                  setBeneficialData(event, ui)
                }
              });
            }
            newRow()
          }

          var attatchcount = 0;
          $(document).ready(function () {
            let name = $("#formDataNameAR").val();
            let model_id = $("#nameId").val();
            let date = $("#from").val();
            $.ajax({
              type: 'get',
              url: 'update_by_field',
              data: {
                name: name,
                model_id: model_id,
                date: date
              },
              success: function (response) {

                if (response.work != null) {
                  $('#rowId').val(response.id);
                  $('#from1').val(response.day);
                  $('#start').val(response.start);
                  $('#end').val(response.end);
                  $('#save').html('تعديل');
                  $('.ss > tbody').empty();
                  setWorkTable(response.work);
                  getDay()
                  setAttach((response?.fileObj ?? []))
                }
              },
            })
          })
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $("#formDataNameAR,#from").keyup(function () {
            let name = $("#formDataNameAR").val();
            let model_id = $("#nameId").val();
            let date = $("#from").val();
            $.ajax({
              type: 'get',
              url: 'update_by_field',
              data: {
                name: name,
                model_id: model_id,
                date: date
              },
              success: function (response) {
                $('#rowId').val(response.id);
                $('#from1').val(response.day);
                $('#start').val(response.start);
                $('#end').val(response.end);
                $('#save').html('تعديل');
                $('.ss > tbody').empty();
                setWorkTable(response.work);
                getDay()
              },
            })

          })
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $("#formDataNameAR").val('{{Auth()->user()->nick_name}}');
          $("#nameId").val('{{Auth()->user()->id}}');
          // $(document).ready(function () {
          //     if ($('#form1').val() == "Mon") {
          //         $('#form1').val() = 'الأثنين';
          //     }
          // })
          $(function () {
            $(".ac").autocomplete({
              source: 'emp_auto_complete',
              minLength: 1,
              select: function (event, ui) {
                // let subscribe_name = (ui.item.id)
                // update(subscribe_name);
                $('#nameId').val((ui.item.id));

              }
            });
          });
          $(function () {
            $(".ap").autocomplete({
              source: 'archive_auto_complete',
              minLength: 1,
              select: function (event, ui) {
                setBeneficialData(event, ui)
              }
            });
          });

          function doUploadWork(formDataStr, fileArea) {
            $.ajaxSetup({
              headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            var formData = new FormData($("#" + formDataStr)[0]);
            $.ajax({
              url: 'uploadAttach',
              type: 'POST',
              data: formData,
              dataType: "json",
              async: true,
              success: function (data) {
                row = '';
                $("." + fileArea).html('');
                if (data.all_files) {
                  var j = attatchcount;
                  for (j = attatchcount; j < data.all_files.length; j++) {
                    shortCutName = data.all_files[j].real_name;
                    shortCutID = data.all_files[j].id;
                    urlfile = getFileUrl(data.all_files[j])
                    shortCutName = shortCutName.substring(0, 40)
                    row += '<div id="attach" class=" col-lg-12 ">'
                      + '<div class="attach" onmouseover="$(this).children().first().next().show()">'
                      + '    <span class="attach-text">' + shortCutName + '</span>'
                      + '    <a class="attach-close1" href="' + urlfile + '" style="color: #74798D; float:left;" target="_blank"><i class="fa fa-eye"></i></a>'
                      + '    <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>'
                      + '      <input type="hidden" id="' + formDataStr + 'imgUploads[]" name="' + formDataStr + 'imgUploads[]" value="' + shortCutName + '">'
                      + '             <input type="hidden" id="' + formDataStr + 'orgNameList[]" name="' + formDataStr + 'orgNameList[]" value="' + shortCutName + '">'
                      + '             <input type="hidden" id="' + formDataStr + 'orgIdList[]" name="' + formDataStr + 'orgIdList[]" value="' + shortCutID + '">'
                      + '    </div>'
                      + '</div>'
                      + '</div>'
                  }
                  attatchcount = j;
                  $(".alert-danger").addClass("hide");
                  $(".alert-success").removeClass('hide');
                  $("." + fileArea).append(row)
                  $(".loader").addClass('hide');
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

          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $(document).ready(function () {
            let ds = $('#from').val();
            var spt = ds.split('/');
            let d = spt[0];
            let m = spt[1];
            let y = spt[2];
            days = Array();
            days[0] = 'الأحد';
            days[1] = 'الإثنين';
            days[2] = 'الثلاثاء';
            days[3] = 'الأربعاء';
            days[4] = 'الخميس';
            days[5] = 'الجمعة';
            days[6] = 'السبت';
            d = new Date(m + '/' + d + '/' + y);
            let dss = days[d.getDay()];
            $('#from1').val(dss);
          })

          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          function getDay() {
            let ds = $('#from').val();
            var spt = ds.split('/');
            let d = spt[0];
            let m = spt[1];
            let y = spt[2];
            days = Array();
            days[0] = 'الأحد';
            days[1] = 'الإثنين';
            days[2] = 'الثلاثاء';
            days[3] = 'الأربعاء';
            days[4] = 'الخميس';
            days[5] = 'الجمعة';
            days[6] = 'السبت';
            d = new Date(m + '/' + d + '/' + y);
            let dss = days[d.getDay()];
            $('#from1').val(dss);
          }

          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

          function newRow() {
            if (($(".work-text")?.last()?.val()?.length ?? 1) > 0) {
              let row =
                `<tr>
                            <td width="20px">${(workCount + 1)}</td>
                            <td class="col1">
                                <input type="text"
                                       class="form-control work-text  ${workCount === 0 ? 'work_1' : ''}"
                                       name="work[]" >
                                <input type="hidden"
                                       class="form-control ${workCount === 0 ? 'work_id_1' : ''}"
                                       name="work_id[]" >
                            </td>
                            <td class="col2">
                                <input type="text"
                                       class="form-control ${workCount === 0 ? 'from_1' : ''}"
                                       name="from[]"
                                       data-mask="00:00" >
                            </td>
                            <td class="col3">
                                <input type="text"
                                       class="form-control ${workCount === 0 ? 'to_1' : ''}"
                                       name="to[]"
                                       data-mask="00:00">
                            </td>
                            <td class="col4">
                                <input type="text"
                                       class="form-control ap ${workCount === 0 ? 'beneficial_1' : ''}"
                                       index="${(workCount + 1)}"
                                       name="beneficial[]" onfocus="newRow()" oninput="removeIdAndModel(${(workCount + 1)});">
                                <input type="hidden"
                                       class="form-control beneficial_id_${(workCount + 1)}"
                                       name="beneficialId[]">
                                <input type="hidden"
                                       class="form-control beneficial_model_${(workCount + 1)}"
                                       name="beneficialModel[]">
                            </td>
                            <td class="col5">
                                <div class="input-group" style="width: 100% !important;">
                                    <select id="state" name="state[]"
                                            class="form-control state${(workCount + 1)}">
                                        @foreach ($workState as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
                                                        @endforeach
                </select>
                <div class="input-group-append" onclick="ShowConstantModal(6427,'state${(workCount + 1)}','الحالة')">
                                            <span class="input-group-text input-group-text2">
                                                <i class="fa fa-external-link"></i>
                                            </span>
                                        </div>
                                        <span class="input-group-text input-group-text2" onclick="${workCount > 0 ? '$(this).parent().parent().parent().remove()' : 'emptyFirstRow()'}">
                                                <i class="fa fa-trash"></i>
                                        </span>
                                </div>
                            </td>
                        </tr>`
              $('#tb').append(row);
              $(".ap").autocomplete({
                source: 'archive_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                  setBeneficialData(event, ui)
                }
              });
              workCount++;
            }
          }

          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $('#formDataaa').submit(function (e) {
            e.preventDefault();
            if (validateAllAttachmentNames()) {
              return false
            }
            $(".loader").removeClass('hide');
            let formData = new FormData(this);
            $.ajax({
              type: 'POST',
              url: "saveReport",
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
                $(".loader").addClass('hide');
                $('.wtbl').DataTable().ajax.reload();
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: '{{trans('admin.data_added')}}',
                  showConfirmButton: false,
                  timer: 1500
                })
                // this.reset();
              },
              error: function (response) {
                $(".loader").addClass('hide');

                Swal.fire({
                  position: 'top-center',
                  icon: 'error',
                  title: '{{trans('admin.error_save')}}',
                  showConfirmButton: false,
                  timer: 1500
                })

              }
            });
          });

          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $(function () {
            var table = $('.wtbl').DataTable({
              "language": {
                "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                "sLoadingRecords": "جارٍ التحميل...",
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر MENU مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار START إلى END من أصل TOTAL مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع MAX مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                  "sFirst": "الأول",
                  "sPrevious": "السابق",
                  "sNext": "التالي",
                  "sLast": "الأخير"
                },
                "oAria": {
                  "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                  "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                }
              }
            });
          });

          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          function calcDuration(t1, t2) {
            compareDate1 = new Date(('10/10/2010 ' + t1 + ':00'));
            compareDate2 = new Date(('10/10/2010 ' + t2 + ':00'));
            var diff = Math.abs(compareDate2 - compareDate1) / (1000 * 3600);
            diffSplit = diff.toString().split('.');
            hours = diffSplit[0];
            min = ((diffSplit.length > 1) ? (diffSplit[1] * 60) : '00');
            finalTime = hours + ':' + min.toString().substring(0, 2) + ':00';
            return finalTime;
          }

          function addTimes(times = []) {
            const z = (n) => (n < 10 ? '0' : '') + n;
            let hour = 0
            let minute = 0
            let second = 0
            for (const time of times) {
              const splited = time.split(':');
              hour += parseInt(splited[0]);
              minute += parseInt(splited[1])
              second += parseInt(splited[2])
            }
            const seconds = second % 60
            const minutes = parseInt(minute % 60) + parseInt(second / 60)
            const hours = hour + parseInt(minute / 60)
            return z(hours) + ':' + z(minutes) + ':' + z(seconds)
          }

          /////////////////////////////////////////////// TABLE SEARCH 2////////////////////////////////////////////////////
          $(document).ready(function () {
            $('.loader').removeClass('hide');
            if ($.fn.DataTable.isDataTable('.wtbl')) {
              $(".wtbl").dataTable().fnDestroy();
              $('#recListaa').empty();
            }
            let nameID = $('#nameId').val();
            table = $('.wtbl').DataTable({
              ajax: {
                url: 'showReport',
                type: 'get',
                data: function (d) {
                  d.nameID = nameID;
                }
              },
              columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {
                  data: null,
                  render: function (data, row, type) {
                    $actionBtn = '<a ondblclick="update(' + (data.id ?? '') + ')">' + (data.date ?? '') + '</a>';
                    return $actionBtn;
                  },
                  name: 'name',

                },
                {data: 'day'},
                {
                  data: null,
                  render: function (data, row, type) {
                    count = data.work.length;
                    return count;
                  },
                  name: 'count',
                },
                {
                  data: null,
                  render: function (data, row, type) {
                    let res = [];
                    for (j = 0; j < data?.work?.length; j++) {
                      if (data?.work[j]?.start !== "" && data?.work[j]?.start !== null && data?.work[j]?.end !== null && data?.work[j]?.end[j] !== "") {
                        res[j] = calcDuration(data?.work[j]?.start, data?.work[j]?.end[j]);
                      }
                    }

                    return addTimes(res);
                  }
                },
                {
                  data: null,
                  render: function (data, row, type) {
                    let count = 0;
                    var i;
                    for (i = 0; i < data?.work?.length; i++) {
                      if (data?.work[i]?.beneficial_name !== '' && data?.work[i]?.beneficial_name !== null) {
                        count++;
                      }
                    }
                    return count;
                  },
                  name: 'count'
                },
                // { data: null,
                //     render:function(data,row,type){
                //         if(data.morf.length>0){
                //             var i=1;
                //             $actionBtn ='';
                //             for(j=0;j<data.morf.length;j++){
                //                 var file=data.morf[j];
                //                 if(file!=null){
                //                     shortCutName=file.real_name;
                //                     shortCutName=shortCutName.substring(0, 20);
                //                     urlfile='{{ asset('') }}';
                //                     urlfile+=file.url;
                //                     if(file.extension=="jpg"||file.extension=="png"||file.extension=="jfif")
                //                     fileimage='{{ asset('assets/images/ico/image.png') }}';
                //                     else if(file.extension=="pdf")
                //                     fileimage='{{ asset('assets/images/ico/pdf.png') }}';
                //                     else if(file.extension=="doc"||file.extension=="docx")
                //                     fileimage='https://template.expand.ps/public/assets/images/ico/word.png';
                //                     else if(file.extension=="excel"||file.extension=="xsc")
                //                     fileimage='{{ asset('assets/images/ico/excellogo.png') }}';
                //                     else
                //                     fileimage='{{ asset('assets/images/ico/file.png') }}';
                //                     $actionBtn+="<div class='row' style='margin-left:0px;'>";
                //                     $actionBtn += '<div id="attach" class=" col-sm-12 ">'
                //                         +'<div class="attach">'
                //                         +' <a class="attach-close1" href="'+urlfile+'" style="color: #74798D; float:left;" target="_blank">'
                //                             +'  <span class="attach-text">'+shortCutName+'</span>'
                //                             +'    <img style="width: 20px;"src="'+fileimage+'">'
                //                             +'</a>'
                //                         +'</div>'
                //                         +'</div>';
                //                     $actionBtn += '</div>';
                //                 }
                //             }

                //             return $actionBtn;
                //         }
                //         else{return '';}
                //     },
                //     name:'fileIDS',
                // },
              ],
              /////////////////////////////////////////////////////////////////////////////////
              dom: 'Bflrtip',
              buttons: [
                {
                  extend: 'excel',
                  tag: 'img',
                  title: '',
                  attr: {
                    title: 'excel',
                    src: 'http://t.expand.ps/expand_repov1/public/assets/images/ico/excel.png',
                    style: 'cursor:pointer;display:inline;height: 40px; padding-top: 4px;',
                  },

                },
                {
                  extend: 'print',
                  tag: 'img',
                  title: '',
                  attr: {
                    title: 'print',
                    src: 'http://t.expand.ps/expand_repov1/public/assets/images/ico/Printer.png ',
                    style: 'cursor:pointer;height: 32px;display:inline',
                    class: "fa fa-print"
                  },
                  customize: function (win) {
                    $(win.document.body).find('table').find('tbody')
                      .css('font-size', '20pt');
                  }
                },
              ],
              "language": {
                "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                "sLoadingRecords": "جارٍ التحميل...",
                "sProcessing": "جارٍ التحميل...",
                "sLengthMenu": "أظهر _MENU_ مدخلات",
                "sZeroRecords": "لم يعثر على أية سجلات",
                "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                "sInfoPostFix": "",
                "sSearch": "ابحث:",
                "sUrl": "",
                "oPaginate": {
                  "sFirst": "الأول",
                  "sPrevious": "السابق",
                  "sNext": "التالي",
                  "sLast": "الأخير"
                },
                "oAria": {
                  "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                  "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                }
              }
            });
            $('.loader').addClass('hide');
          })

          function update($id) {
            let work_id = $id;
            $.ajax({
              type: 'get',
              url: 'updateReport',
              data: {
                work_id: work_id,
              },
              success: function (response) {
                let no = 3;
                $('.ss > tbody').empty();
                for (var i = 0; i < response.empWork.work.length; i++) {
                  $('#rowId').val(response.empWork.id);
                  $('#formDataNameAR').val(response.empWork.name);
                  $('#from1').val(response.empWork.day);
                  response.empWork.date;
                  var spt = response.empWork.date.split('-');
                  let y = spt[0];
                  let m = spt[1];
                  let d = spt[2];
                  $('#from').val(d + '/' + m + '/' + y);
                  let z = 0;
                  let nos = 0;
                  let last = '';
                  update = '';
                  if (response.update == 0) {
                    update = 'disabled';
                  }
                  for (var i = 0; i < response.empWork.work.length; i++) {
                    response.empWork.date;
                    if (i == response.empWork.work.length - 1 && response.update == 1) {
                      last += 'onfocus="newRow()"';
                    }
                    var spt = response.empWork.date.split('-');
                    let y = spt[0];
                    let m = spt[1];
                    let d = spt[2];
                    $('#from').val(d + '/' + m + '/' + y);
                    let row = '<tr>' + '<td width="20px">' + (z += 1) + '</td>' +
                      '<td class="col1"><input type="text" ' + update + ' value="' + response.empWork.work[i] + '" class="form-control" name="work[]"></td>' +
                      '<td class="col2"><input type="text" ' + update + ' value="' + response.empWork.fromTime[i] + '" class="form-control" name="from[]" data-mask="00:00"></td>' +
                      '<td class="col3"><input type="text" ' + update + ' value="' + response.empWork.toTime[i] + '" class="form-control" name="to[]" data-mask="00:00"></td>' +
                      '<td class="col4"><input type="text" ' + update + ' value="' + response.empWork.most[i] + '" class="form-control ap" name="most[]"></td>' +
                      '<td class="col5"><input type="text" ' + update + ' value="' + response.empWork.note[i] + '" class="form-control" name="note[]"' + last + '></td>' +
                      // '<td class="col6">'+
                      //     '<div class="row" style="direction:rtl;width:auto;width: 100%;margin-right: 1%;height: 90%;">'+
                      //         '<div class="row attachs-body" style="width: 69%;margin-right:auto; height: 81%;padding-top:10px;">'+
                      //             '<div class="form-group paddmob">'+
                      //              '<input type="hidden" name="fromname" value="formDataaa'+(nos+=1)+'">'+
                      //              '<input type="file" class="form-control-file" id="formDataaaupload-file'+(nos)+'[]" multiple="2" name="formDataaaUploadFile[]" onchange="doUploadWork("formDataaa","formDataaa'+(nos)+'FilesArea")" style="display: none" >'+
                      //                 '<div class="row formDataaa'+(nos+=1)+'FilesArea" style="margin-left: 0px;">'+
                      //                   '<input type="hidden" id="formDataaaorgIdList[]" name="formDataaaorgIdList[]" value="">'+
                      //                 '</div>'+
                      //             '</div>'+
                      //         '</div>'+
                      //         '<div style="height: 87%;">'+
                      //          '<img src="http://t.expand.ps/expand_repov1/public/assets/images/ico/upload.png" width="40" height="40" style="cursor:pointer"onclick="document.getElementById("formDataaaupload-file'+(nos)+'[]").click(); return false">'+
                      //         '</div>'+
                      //     '</div>'+
                      // '</td>'+
                      '</tr>';
                    $('.ss > tbody').append(row);
                    $(".ap").autocomplete({
                      source: 'archive_auto_complete',
                      minLength: 1,
                      select: function (event, ui) {
                        setBeneficialData(event, ui)
                      }
                    });
                  }
                }
              },

            });

          }

        </script>
@endsection
