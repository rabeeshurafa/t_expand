@extends('layouts.admin')

@section('search')

    <li class="dropdown dropdown-language nav-item hideMob">

        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">

    </li>

@endsection

@section('content')

    <div class="content-body">
        <section id="hidden-label-form-layouts">
            <form method="post" id="formDataaa" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="col-xl-7 col-lg-6">

                        <div class="card rSide">

                            <div class="card-header">

                                <h4 class="card-title"><img src="{{asset('assets/images/archive_ico.png')}}"
                                                            style="height: 32px"/>

                                    {{ trans('archive.building_permit_archive') }}

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

                                <div class="form-body">

                                    <div class="row">

                                        <div class="col-lg-6 col-md-12 pr-0 pr-s-12">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                        اسم صاحب الترخيص

                                                        </span>

                                                    </div>

                                                    <input type="text" id="customerName" class="form-control cust"
                                                           name="customerName">

                                                    <input type="hidden" id="customerid" name="customerid" value="0">

                                                    <input type="hidden" id="archieveid" name="archieveid" value="0">

                                                    <input type="hidden" id="customername" name="customername"
                                                           value="0">

                                                    <input type="hidden" id="url" name="url" value="<?php echo $url ?>">

                                                    <input type="hidden" id="customerType" name="customerType"
                                                           value="0">

                                                    <input type="hidden" id="msgType" name="msgType" value="">

                                                    <input type="hidden" id="pk_i_id" name="pk_i_id" value="0">

                                                    <input type="hidden" id="ArchiveID" name="ArchiveID" value="">

                                                    <input type="hidden" id="type" name="type" value="{{$type}}">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-3 col-md-12 pr-0 pr-s-12" style="padding-right: 0px">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" id="licGroup">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            رقم ملف الترخيص

                                                        </span>

                                                    </div>

                                                    <input type="text" id="fileNo" name="fileNo"
                                                           class="form-control eng-sm  valid" value="" placeholder=""
                                                           autocomplete="off">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-3 col-md-12 pr-0 pr-s-12">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" id="licGroup">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            تاريخ فتح الملف

                                                        </span>

                                                    </div>

                                                    <input type="text" id="license_date" name="license_date"
                                                           class="form-control eng-sm  valid" value="" placeholder=""
                                                           autocomplete="off">

                                                </div>

                                            </div>

                                        </div>
                                        {{-- <div class="col-lg-5 col-md-12 pr-0 pr-s-12"  >

                                            <div class="form-group">

                                                <div class="input-group w-s-87" id="licGroup">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{ trans('archive.lic_num') }}

                                                        </span>

                                                    </div>

                                                        <input type="text" id="licNo" name="licNo" class="form-control eng-sm  valid" value="" placeholder="" autocomplete="off">


                                                </div>

                                            </div>

                                        </div> --}}

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-3 col-md-12 pr-0 pr-s-12" style="min-width: 21%">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{ trans('archive.pelvis_number') }}

                                                        </span>

                                                    </div>

                                                    <input type="text" id="licn" class="form-control " name="licn">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-3 col-md-12 pr-0 pr-s-12" style="min-width: 20%">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" style="width: 90% !important;">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{ trans('archive.piece_number') }}

                                                        </span>

                                                    </div>

                                                    <input type="text" id="licnfile" class="form-control "
                                                           name="licnfile">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-2 col-md-12 pr-0 pr-s-12" style="padding-right: 0px">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" id="licGroup"
                                                     style="width: 100% !important">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{ trans('archive.lic_num') }}

                                                        </span>

                                                    </div>

                                                    <input type="text" id="licNo" name="licNo"
                                                           class="form-control eng-sm  valid" value="" placeholder=""
                                                           autocomplete="off">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-4 col-md-12 pr-0 pr-s-12" style="min-width: 20%">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" style="width: 97% !important">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            الغاية من الإستعمال

                                                        </span>

                                                    </div>

                                                    <input type="text" id="use_desc" class="form-control "
                                                           name="use_desc">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-3 col-md-12 pr-0 pr-s-12" style="display:none;">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{ trans('archive.build_type') }}

                                                        </span>

                                                    </div>

                                                    <select class="form-control" name="BuildingData" id="BuildingData">

                                                        <option value="2079">قائم</option>

                                                        <option value="2080">مقترح</option>

                                                        <option value="2081">قائم/مقترح</option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-10 col-md-12 pr-0 pr-s-12">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{ trans('archive.attachment_type') }}

                                                        </span>

                                                    </div>

                                                    <select class="form-control AttahType" name="AttahType"
                                                            id="AttahType">

                                                        @foreach($attachment_type as $attachment)

                                                            <option
                                                                    value="{{$attachment->id}}"> {{$attachment->name}}   </option>

                                                        @endforeach

                                                    </select>

                                                    <div class="input-group-append"
                                                         onclick="ShowConstantModal(18,'AttahType','نوع المرفق')"
                                                         style="cursor:pointer">

                                                        <span class="input-group-text input-group-text2">

                                                            <i class="fa fa-external-link"></i>

                                                        </span>

                                                    </div>

                                                    </select>

                                                    {{--<div class="input-group-append" onclick="ShowConstantModal(22,'AttahType','نوع المرفق')" style="cursor:pointer">

                                                        <span class="input-group-text input-group-text2">

                                                            <i class="fa fa-external-link"></i>

                                                        </span>

                                                    </div>--}}
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-2 col-md-12 pr-0 pr-s-12" style="padding-right: 0px;">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <img src="{{asset('assets/images/ico/upload.png')}}" width="40"
                                                             height="40" style="cursor:pointer"
                                                             onclick="document.getElementById('formDataaaupload-file[]').click(); return false">
                                                        <img src="{{asset('assets/images/ico/scanner.png')}}"
                                                             style="cursor:pointer;    float: left;"
                                                             onclick="scanToJpg();">

                                                        <img src="{{asset('assets/images/ico/scannerpdf.png')}}"
                                                             style="cursor:pointer;    float: left;"
                                                             onclick="scanTopdf();">
                                                    </div>

                                                    <input type="hidden" name="fromname" value="formDataaa">

                                                    <input type="file" class="form-control-file"
                                                           id="formDataaaupload-file[]" name="formDataaaUploadFile[]"
                                                           onchange="doUploadAttach1('formDataaa')"

                                                           style="display: none">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div style="text-align: center;">

                                        <button type="submit" class="btn btn-primary" id="saveBtn" style="">

                                            {{ trans('admin.save') }}

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-5 col-lg-6">

                        <div class="card lSide" style="min-height:302.2px;">

                            <div class="card-header">

                                <h4 class="card-title"><img src="{{asset('assets/images/archive_ico.png')}}"
                                                            style="height: 32px"/>

                                    {{ trans('archive.license_attachments') }}

                                </h4>

                            </div>

                            <div class="card-body" id="attachList">

                                <div class="row formDataaaFilesArea" style="margin-left: 0px;">

                                </div>

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
            row = attacheWithAttachName(response.file, $("#AttahType option:selected").text())
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


      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });


      $('#formDataaa').submit(function (e) {

        e.preventDefault();

        if (parseInt($("#customerid").val()) <= 0) {

          alert("الرجاء اختيار مواطن");

        } else {
          $('#saveBtn').css('display', 'none');
          // $('#editBtn').css('display','none');
          $(".loader").removeClass('hide');

          let formData = new FormData(this);

          $.ajax({

            type: 'POST',

            url: "store_lince_archive",

            data: formData,

            contentType: false,

            processData: false,

            success: (response) => {
              $('#saveBtn').css('display', 'inline-block');
              // $('#editBtn').css('display','none');
              $('#customerid').val('');
              $('#customername').val('');
              $('#customername').val('');
              $('#customerType').val('');
              $('#ArchiveID').val('');
              $('#pk_i_id').val('');

              $(".loader").addClass('hide');

              Swal.fire({

                position: 'top-center',

                icon: 'success',

                title: '{{trans('admin.data_added')}}',

                showConfirmButton: false,

                timer: 1500

              })

              $(".formDataaaFilesArea").html('');

              this.reset();

              $('.wtbl').DataTable().ajax.reload();

            },

            error: function (response) {
              $('#saveBtn').css('display', 'inline-block');
              // $('#editBtn').css('display','none');
              // $('#pk_i_id').val('');
              // $('#ArchiveID').val('');
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

        }

      });


      $(function () {
        $(".cust").autocomplete({
          source: 'Linence_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $('#customerid').val(ui?.item?.userId);
            $('#customername').val(ui?.item?.userName);
            $('#customerType').val(ui?.item?.userModel);
            $('#licNo').val(ui?.item?.licNo);
            $('#fileNo').val(ui?.item?.fileNo);
            $('#license_date').val(ui?.item?.license_date);
            $('#licn').val(ui?.item?.hodNo);
            $('#licnfile').val(ui?.item?.peiceNo);
            $('#use_desc').val(ui?.item?.use_desc?.name);
            $('#pk_i_id').val(ui?.item?.licId);
          }
        });
      });

      function update($id) {
        let archive_id = $id;
        $('#saveBtn').text("تعديل");
        $(".formDataaaFilesArea").html('');

        $.ajax({
          type: 'get', // the method (could be GET btw)
          url: "{{ route('archieveLic_info') }}",
          data: {
            archive_id: archive_id,
          },

          success: function (response) {
            $('#customerName').val(response.info.name);
            $('#ArchiveID').val(response.info.id);
            $('#customerid').val(response.info.model_id);
            $('#customername').val(response.info.name);
            //$('#customerName').val(response.info.name);
            $('#pk_i_id').val(response.info.license_id);
            $('#customerType').val(response.info.model_name);
            $('#licNo').val(response.info.licNo);
            $('#fileNo').val(response.info.fileNo);
            $('#use_desc').val(response.info.use_desc);
            $('#license_date').val(response.info.license_date);
            $('#licn').val(response.info.licn);
            $('#licnfile').val(response.info.licnfile);
            $('#license_type').val(response.info.license_type);

            row = '';

            if (response.files) {
              for (j = 0; j < response.files.length; j++) {
                row += attacheWithAttachName(response.files[j], response.files[j].real_name)
              }

              $(".formDataaaFilesArea").html(row)

            }

            window.scrollTo(0, 0);

          },

        });

      }

      function fillData($id) {
        let license_id = $id;
        console.log(license_id);
        $.ajax({

          type: 'get', // the method (could be GET btw)

          url: "license_byFileNo",


          data: {

            license_id: license_id,

          },

          success: function (response) {

            $("#licn").val('');


            $("#licnfile").val('');
            $("#license_date").val('');
            $("#licNo").val('');
            $("#use_desc").val('');

            if (response.info.hod_tapo_No != null && response.info.hod_tapo_No != '') {
              $("#licn").val((response.info.hod_tapo_No));
            } else {
              $("#licn").val((response.info.hodNo ?? ''));
            }

            if (response.info.peiceNoTabo != null && response.info.peiceNoTabo != '') {
              $("#licnfile").val(response.info.peiceNoTabo);
            } else {
              $("#licnfile").val((response.info.peiceNo ?? ''));
            }

            // $("#licn").val((response.info.hodNo??''));
            $("#pk_i_id").val((response.info.id ?? ''));
            // $("#licnfile").val((response.info.peiceNo??''));

            let date = (response.info.license_date)

            dates = ""

            if (date) {

              dates = date.split("-");

              dates = dates[2] + '/' + dates[1] + '/' + dates[0];
            }

            $("#license_date").val(dates);
            $("#licNo").val((response.info.licNo ?? ''));
            $("#use_desc").val((response.info.use_desc != null ? (response?.info?.use_desc?.name) : ''));

          },

        });

      }


      function doUploadAttach1(formDataStr) {

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

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

            if (data.all_files) {
              for (j = 0; j < data.all_files.length; j++) {
                row = attacheWithAttachName(data.all_files[j], $("#AttahType option:selected").text())
              }

              $(".alert-danger").addClass("hide");

              $(".alert-success").removeClass('hide');

              $("." + formDataStr + "FilesArea").append(row)

              $(".loader").addClass('hide');
              $(".form-control-file").val('');

              //document.getElementById(""+formDataStr+"upload-file[]").value="";

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

      function delete_archive($id) {
        if (confirm('هل انت متاكد من حذف الارشيف؟ لن يمكنك استرجاعه فيما بعد')) {
          let archive_id = $id;
          var _token = '{{ csrf_token() }}';
          $.ajax({

            type: 'post',

            // the method (could be GET btw)

            url: "licArchive_delete",

            data: {

              archive_id: archive_id,
              _token: _token,
            },

            success: function (response) {

              $(".loader").addClass('hide');

              $('.wtbl').DataTable().ajax.reload();

              // setTimeout(function(){

              //     $(".alert-success").addClass("hide");

              // },2000)

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

              $("#formDataNameAR").on('keyup', function (e) {

                if ($(this).val().length > 0) {

                  $("#formDataNameAR").removeClass("error");

                }

              });

              if (response.responseJSON.errors.formDataNameAR) {

                $("#formDataNameAR").addClass("error");

              }

            }

          });
          return true;
        }
        return false;
      }

    </script>

@endsection
