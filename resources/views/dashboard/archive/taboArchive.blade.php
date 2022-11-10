@extends('layouts.admin')

@section('search')

    <li class="dropdown dropdown-language nav-item hideMob">

        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">

    </li>

@endsection
@section('content')
    <style>
        .width-97-per {
            width: 97% !important;
        }
        .width-98-per {
            width: 98% !important;
        }
        .ui-autocomplete{
            width: 300px;
        }
        @media (max-width: 767.98px) {
            .width-97-per {
                width: 98% !important;
            }
        }
    </style>
    <div class="content-body">

        <section id="hidden-label-form-layouts">

            <form method="post" id="formDataaa" enctype="multipart/form-data">
                @csrf
                <meta name="csrf-token" content="{{ csrf_token() }}"/>
                <div class="col-xl-12 col-lg-12 colMob">

                    <div class="card">
                        <div class="card-header">

                            <h4 class="card-title">
                                <img src="{{asset('assets/images/archive_ico.png')}}" style="height: 32px"/>
                                ارشيف الطابو
                            </h4>
                            <div class="heading-elements1 onOffArea form-group mt-1"
                                 style="height: 20px; margin: 0px !important" title="الاعدادات">
                                <img src="{{ asset('assets/images/ico/share.png') }}" height="27px"
                                     onclick="ShowConfigModal('formData')" style="cursor:pointer">

                                <div class="form-group">
                                    <a onclick="ShowConfigModal('formData')" style="color:#000000">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row white-row">
                                <div class="col-md-7 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            اختر الحوض
                                                        </span>
                                                    </div>

                                                    <select type="text" name="hodId" id="hodId" class="form-control">
                                                        <option value="">-- اختر الحوض --</option>
                                                        @foreach($hod as $item)
                                                            <option value="{{$item->id}}">{{$item->hod_name}}
                                                                ({{$item->hod_no}}
                                                                )
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="id" name="id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            رقم القطعة
                                                        </span>
                                                    </div>
                                                    <input type="text" id="pieceNo" class="form-control"
                                                           placeholder="رقم القطعة" name="pieceNo">
                                                    <input type="hidden" id="tabo_data_id" name="tabo_data_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            رقم الحوض
                                                        </span>
                                                    </div>
                                                    <input type="text" id="hodNo" class="form-control"
                                                           placeholder="رقم الحوض" name="hodNo">
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
                                                            اسم المواطن
                                                        </span>
                                                    </div>
                                                    <input type="text" id="citizenName" class="form-control"
                                                           placeholder="اسم المواطن" name="citizenName">
                                                    <input type="hidden" id="citizenId" name="citizenId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            رقم الحي
                                                        </span>
                                                    </div>
                                                    <input type="text" id="areaName" class="form-control"
                                                           placeholder="رقم الحي" name="areaName">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            مساحة القطعة
                                                        </span>
                                                    </div>
                                                    <input type="text" id="area" class="form-control"
                                                           placeholder="مساحة القطعة" name="area">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group width-97-per">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{trans('archive.title')}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="msgTitle" class="form-control"
                                                           placeholder="عنوان الوثيقة" name="msgTitle"
                                                           style="width:35%;">
                                                    <select name="archive_type" id="archive_type"
                                                            class="form-control archive_type">
                                                        <option value="0">
                                                            -- {{ trans('archive.document_type') }} --
                                                        </option>
                                                        @foreach($archive_type as $archiveType)
                                                            <option value="{{$archiveType->id}}"> {{$archiveType->name}}   </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hidemob"
                                                         onclick="ShowConstantModal(6444,'archive_type','{{ trans('archive.document_type') }}')"
                                                         style="cursor:pointer">
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
                                                            الرسوم
                                                        </span>
                                                    </div>
                                                    <input type="text" id="cost" class="form-control"
                                                           placeholder="الرسوم" name="cost">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group width-98-per">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            ملاحظات
                                                        </span>
                                                    </div>
                                                    <input type="text" id="notes" class="form-control"
                                                           placeholder="ملاحظات" name="notes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 ">
                                    <div class="row attachs-body">
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="hidden" name="fromname" value="formDataaa">
                                            <meta name="csrf-token" content="{{ csrf_token() }}"/>
                                            <input type="file" class="form-control-file" id="formDataaaupload-file[]"
                                                   multiple="" name="formDataaaUploadFile[]"
                                                   onchange="doUploadAttach('formDataaa')"

                                                   style="display: none">
                                            <div class="row col-lg-12 col-md-12 formDataaaFilesArea"
                                                 style="margin-left: 0px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12 hidemob" style="padding-left: 0px;padding-right: 0px;">
                                    <img src="{{asset('assets/images/ico/upload.png')}}" width="40" height="40"
                                         style="cursor:pointer;    float: left;"
                                         onclick="document.getElementById('formDataaaupload-file[]').click(); return false">
                                    <img src="{{asset('assets/images/ico/scanner.png')}}"
                                         style="cursor:pointer;    float: left;" onclick="scanToJpg();">
                                    <img src="{{asset('assets/images/ico/scannerpdf.png')}}"
                                         style="cursor:pointer;    float: left;" onclick="scanTopdf();">
                                </div>
                            </div>
                            <div style="text-align: center;padding-bottom: 20px;">
                                @can('store_archive')
                                    <button onclick="save()" type="button" class="btn btn-primary modify" id="editBtn"
                                            style="display:none">
                                        تعديل
                                    </button>
                                @endcan

                                <button onclick="save()" type="button" class="btn btn-primary save" id="saveBtn"
                                        style="">
                                    {{ trans('admin.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    @include('dashboard.archive.arc_config')
        @include('dashboard.component.fetch_table')
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

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            // console.log(imagesScanned[0].getBase64NoPrefix())
            // console.log(imagesScanned[0])
            var image = new Image();

            image.src = scannedImage.src;
            var imagediv =
                `<div >
            <a target="_blank" href="${scannedImage.src}" data-original-title="" title="">
                <img src="${image.src}" width="70" height="100" >
            </a>
            <input type="hidden" id="scannerfile[]" name="scannerfile[]" value="${scannedImage.src}">
            <a class="attach-close1" style="color: #74798D; float:left;font-size: 27px !important;" onclick="$(this).parent().remove()">×</a>
        </div>`
            ;
            $('.formDataaaFilesArea').append(imagediv);
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
                // processScannedPdf(scannedImage);
            }
        }

        function processScannedPdf(scannedImage) {
            imagesScanned.push(scannedImage);
            // console.log(imagesScanned[0].getBase64NoPrefix())
            // console.log(imagesScanned)
            var image = new Image();

            image.src = scannedImage.src;
            var imagediv =
                `<div >
            <a target="_blank" href="${scannedImage.src}" data-original-title="" title="">
                <img src="https://t.palexpand.ps/assets/images/ico/pdf.png" width="70" height="100" >
            </a>
            <input type="hidden" id="scannerPdf" name="scannerPdf[]" value="${scannedImage.src}">
            <a class="attach-close1" style="color: #74798D; float:left;font-size: 27px !important;" onclick="$(this).parent().remove()">×</a>
        </div>`
            ;
            $('.formDataaaFilesArea').append(imagediv);
        }

        function uploadScannedfile(scannedImage) {
            $(".loader").removeClass('hide');
            $('#saveBtn').css('display', 'none');
            $('#editBtn').css('display', 'none');
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
                    $('#saveBtn').css('display', 'inline-block');
                    $('#editBtn').css('display', 'none');
                    $(".loader").addClass('hide');
                    $(".archive_type").removeClass("error");
                    row = attacheView(response.file, 'formDataaa');
                    $(".formDataaaFilesArea").append(row)
                },

                error: function (response) {
                    $('#saveBtn').css('display', 'inline-block');
                    $('#editBtn').css('display', 'none');
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

        $(function () {
            $("#pieceNo").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        type: "get",
                        url: "tabo_piece",
                        data: {
                            ...request,
                            hod_id: $('#hodId').val(),
                        },
                        success: response,
                        dataType: 'json'
                    });
                },
                minLength: 1,
                select: function (event, ui) {
                    // console.log(ui.item)
                    setTimeout(function(){$("#pieceNo").val(ui?.item?.final_no)},100)
                    $("#hodNo").val(ui?.item?.hod?.hod_no);
                    $("#tabo_data_id").val(ui?.item?.id);
                    $("#citizenName").val(ui?.item?.owner_name);
                    $("#citizenId").val(ui?.item?.owner_id);
                    $("#areaName").val(ui?.item?.areaName);
                    $("#area").val(ui?.item?.area);
                }
            });
        });
        $(function () {
            $("#pieceNoSearch").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        type: "get",
                        url: "tabo_piece",
                        data: {
                            ...request,
                            hod_id: $('#hodIdSearch').val(),
                        },
                        success: response,
                        dataType: 'json'
                    });
                },
                minLength: 1,
                select: function (event, ui) {
                    // console.log(ui.item)
                    setTimeout(function(){$("#pieceNoSearch").val(ui?.item?.final_no)},100)
                    $("#tabo_data_idSearch").val(ui?.item?.id);
                    $('.wtbl').DataTable().ajax.reload();
                }
            });
        });

        function save() {
            // $(".loader").removeClass('hide');
            if ($('#archive_type').val() === 0) {
                $(".archive_type").addClass("error");
                return false;
            }
            if ($('#hodId').val()==='') {
                $(".hodId").addClass("error");
                return false;
            }
            if ($('#tabo_data_id').val()==='') {
                $(".pieceNo").addClass("error");
                return false;
            }

            if (document.getElementById('formDataaaorgIdList[]') == null && document.getElementById('scannerPdf[]') == null && document.getElementById('scannerfile[]') == null) {
                if (!confirm('لايوجد مرفقات هل تريد الاستمرار؟')) {
                    return false;
                }
            }
            $(".loader").removeClass('hide');
            $('#saveBtn').css('display', 'none');
            $('#editBtn').css('display', 'none');
            form = $('#formDataaa')[0]
            let formData = new FormData(form);

            $("#customerName").removeClass("error");

            $.ajax({
                type: 'POST',
                url: "storeTaboArchive",
                data: formData,
                contentType: false,
                processData: false,

                success: (response) => {
                    $('#saveBtn').css('display', 'inline-block');
                    $('#editBtn').css('display', 'none');
                    $(".loader").addClass('hide');
                    $(".archive_type").removeClass("error");
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: '{{trans('admin.data_added')}}',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#citizenId').val('');
                    $('#id').val('');
                    $('#tabo_data_id').val('');
                    form.reset();
                    $('.wtbl').DataTable().ajax.reload();
                    $(".formDataaaFilesArea").html('');

                },

                error: function (response) {
                    $('#saveBtn').css('display', 'inline-block');
                    $('#editBtn').css('display', 'none');
                    $(".loader").addClass('hide');
                    $(".archive_type").removeClass("error");
                    $("#customerName").on('keyup', function (e) {
                        if ($(this).val().length > 0) {
                            $("#customerName").removeClass("error");
                        }
                    });

                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: '{{trans('admin.error_save')}}',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    if (response?.responseJSON?.errors?.customerName) {
                        $("#customerName").addClass("error");
                    }
                }

            });
            return true;
        };

        function update($id) {
            $('#saveBtn').css('display', 'none');
            $('#editBtn').css('display', 'inline-block');
            $(".formDataaaFilesArea").html('');
            $.ajax({
                type: 'get', // the method (could be GET btw)
                url: "{{ route('getTaboArchive') }}",
                data: {
                    id: $id,
                },

                success: function (response) {

                    $('#hodId').val(response?.hodId);
                    $('#id').val(response?.id);
                    $('#tabo_data_id').val(response?.tabo_data_id);
                    $('#pieceNo').val(response?.pieceNo);
                    $('#hodNo').val(response?.hodNo);
                    $('#citizenName').val(response?.citizenName);
                    $('#citizenId').val(response?.citizenId);
                    $('#areaName').val(response?.areaName);
                    $('#area').val(response?.area);
                    $('#cost').val(response?.cost);
                    $('#msgTitle').val(response?.msgTitle);
                    $('#archive_type').val(response?.archive_type);
                    $('#notes').val(response?.notes);

                    row = '';
                    if (response.files) {
                        for (j = 0; j < response.files.length; j++) {
                            row += attacheView(response.files[j], "formDataaa");
                        }
                        $(".formDataaaFilesArea").html(row)
                    }
                    window.scrollTo(0, 0);
                },

            });

        }
        function delete_archive($id) {
            var _token = '{{ csrf_token() }}';
            if (confirm('هل انت متاكد من حذف الارشيف؟ لن يمكنك استرجاعه فيما بعد')) {
                $.ajax({
                    type: 'post',
                    url: "taboArchive_delete",
                    data: {
                        id: $id,
                        _token: _token,
                    },
                    success: function (response) {
                        $(".loader").addClass('hide');
                        $('.wtbl').DataTable().ajax.reload();

                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'تم حذف البيانات بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        // $("#ajaxform")[0].reset();
                    },

                    error: function (response) {
                        $(".loader").addClass('hide');
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: '{{ trans('admin.error_save') }}',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                });
                return true;
            }
            return false;
        }
    </script>
@endsection