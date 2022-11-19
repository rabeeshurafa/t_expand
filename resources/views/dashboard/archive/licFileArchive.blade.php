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

                    <div class="col-xl-6 col-lg-6">

                        <div class="card rSide">

                            <div class="card-header">

                                <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}"/>
                                    {{trans('archive.finance_achive')}}
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

                                        <div class="col-lg-8 col-md-12 pr-0 pr-s-12">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">
                                                            
                                                            {{trans('archive.supp_name')}}
                                                        </span>

                                                    </div>

                                                    <input type="text" id="supplierName" class="form-control cust"
                                                           name="supplierName">

                                                    <input type="hidden" id="suppliername" name="suppliername"
                                                           value="0">

                                                    <input type="hidden" id="supplierType" name="supplierType"
                                                           value="0">

                                                    <input type="hidden" id="msgType" name="msgType"
                                                           value="<?php echo $type ?>">

                                                    <input type="hidden" id="url" name="url" value="<?php echo $url ?>">

                                                    <input type="hidden" id="pk_i_id" name="pk_i_id" value="">

                                                    <input type="hidden" id="ArchiveID" name="ArchiveID" value="">

                                                    <input type="hidden" id="supplierid" name="supplierid" value="0">

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
                                                    <input type="text" id="date" name="date" data-mask="00/00/0000"
                                                           maxlength="10" class="form-control eng-sm  valid"
                                                           value="<?php echo date('d/m/Y')?>" placeholder=""
                                                           autocomplete="off">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-4 col-md-12 pr-0 pr-s-12">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{trans('archive.deal_type')}}
                                                        </span>

                                                    </div>

                                                    <select class="form-control financeType" name="financeType"
                                                            id="financeType">

                                                        <option value="">{{trans('admin.select')}}</option>

                                                        @foreach($license_type as $license)

                                                            <option value="{{$license->id}}"> {{$license->name}}   </option>

                                                        @endforeach

                                                    </select>

                                                    <div class="input-group-append"
                                                         onclick="ShowConstantModal(6485,'financeType','نوع المعاملة')"
                                                         style="cursor:pointer;max-width: 15px;

                                                    margin-left: 0px !important;

                                                    padding-left: 0px !important;

                                                    padding-right: 0px !important;

                                                    margin-right:15px;

                                                     ">

                                                        <span class="input-group-text input-group-text2">

                                                            <i class="fa fa-external-link"></i>

                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-8 col-md-12 pr-0 pr-s-12" style="min-width: 21%">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" style="width:97.5% !important">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            {{trans('admin.notes')}}

                                                        </span>

                                                    </div>

                                                    <input type="text" id="notes" class="form-control " name="notes">

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

                                                        <option value="">{{trans('admin.select')}}</option>

                                                        @if($attachment_type)

                                                            @foreach($attachment_type as $attachment)

                                                                <option value="{{$attachment->id}}"> {{$attachment->name}}   </option>

                                                            @endforeach

                                                        @endif

                                                    </select>

                                                    <div class="input-group-append"
                                                         onclick="ShowConstantModal(106,'AttahType','نوع المرفق')"
                                                         style="cursor:pointer">

                                                        <span class="input-group-text input-group-text2">

                                                            <i class="fa fa-external-link"></i>

                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-2 col-md-12 pr-0 pr-s-12" style="padding-right: 0px;">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <img src="{{asset('assets/images/ico/upload.png')}}" width="40"
                                                             height="40" style="cursor:pointer;float: left;"
                                                             onclick="document.getElementById('formDataaaupload-file[]').click(); return false">
                                                        <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"
                                                             style="cursor:pointer;    float: left;"
                                                             onclick="scanToJpg();">

                                                        <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            @include('dashboard.archive.connectedArchive')
                                        </div>
                                    </div>
                                    <div style="text-align: center;">

                                        <button type="submit" class="btn btn-primary" id="saveBtn" style="">

                                            {{ trans('admin.save') }}

                                        </button>

                                        @can('trackingArchive')
                                            <input type="hidden" id="track" name="track" value="0">
                                            <button onclick="$('#track').val(1);save();" type="button"
                                                    class="btn btn-primary save" id="saveBtn" style="">
                                                حفظ ومتابعة
                                            </button>
                                        @endcan

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-6 col-lg-6">

                        <div class="card lSide" style="min-height:302.2px;">

                            <div class="card-header">

                                <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}"/>

                                    {{ trans('archive.attach') }}
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
            row=attacheWithAttachName(response.file, $("#AttahType option:selected").text())
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

      function save() {
        if (parseInt($("#customerid").val()) <= 0) {

          alert("الرجاء اختيار مورد");

        } else {

          $(".loader").removeClass('hide');

          form = $('#formDataaa')[0]
          let formData = new FormData(form);

          $.ajax({

            type: 'POST',

            url: "store_finance_archive",

            data: formData,

            contentType: false,

            processData: false,

            success: (response) => {

              $(".loader").addClass('hide');

              $('#supplierid').val('');

              $('#ArchiveID').val('');

              $('#supplierName').val('');

              $('#suppliername').val('');

              $('#supplierType').val('');

              Swal.fire({

                position: 'top-center',

                icon: 'success',

                title: '{{trans('admin.data_added')}}',

                showConfirmButton: false,

                timer: 1500

              })
              $('.connected-to').html('')
              $(".formDataaaFilesArea").html('');
              if ($('#track').val() == 1) {
                let url = `{{ route('admin.dashboard') }}/trackingArchive/${$('#url').val()}/${response.id}`
                window.open(url, '_blank');
                $('#track').val(0);
              }
              this.reset();

              $('.wtbl').DataTable().ajax.reload();

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

        }

      }


      $('#formDataaa').submit(function (e) {

        e.preventDefault();

        if (parseInt($("#customerid").val()) <= 0) {

          alert("الرجاء اختيار مورد");

        } else {

          $(".loader").removeClass('hide');

          let formData = new FormData(this);

          $.ajax({

            type: 'POST',

            url: "store_finance_archive",

            data: formData,

            contentType: false,

            processData: false,

            success: (response) => {

              $(".loader").addClass('hide');

              $('#supplierid').val('');

              $('#ArchiveID').val('');

              $('#supplierName').val('');

              $('#suppliername').val('');

              $('#supplierType').val('');

              Swal.fire({

                position: 'top-center',

                icon: 'success',

                title: '{{trans('admin.data_added')}}',

                showConfirmButton: false,

                timer: 1500

              })

              $(".formDataaaFilesArea").html('');
              $('.connected-to').html('')
              this.reset();

              $('.wtbl').DataTable().ajax.reload();

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

        }

      });


      $(function () {

        $(".cust").autocomplete({

          source: 'archive_auto_complete',

          minLength: 1,


          select: function (event, ui) {

            // console.log(ui.item.model);

            $('#supplierid').val(ui.item.id);

            $('#suppliername').val(ui.item.name);

            $('#supplierName').val(ui.item.name);

            $('#supplierType').val(ui.item.model);

            // $('#date').val(ui.item.date);

          }

        });

      });

      function update($id) {

        let archive_id = $id;

        $('#saveBtn').text("تعديل");

        $(".formDataaaFilesArea").html('');

        $.ajax({

          type: 'get', // the method (could be GET btw)

          url: "{{ route('financeArchive_info') }}",

          data: {

            archive_id: archive_id,

          },

          success: function (response) {

            $('#supplierid').val(response.info.model_id);

            $('#ArchiveID').val(response.info.id);

            $('#supplierName').val(response.info.name);

            $('#suppliername').val(response.info.name);

            $('#supplierType').val(response.info.model_name);

            $('#notes').val(response.info.title);

            $('#financeType').val(response.info.type_id);
            setConnected(response?.connect_to??[]);
            let date = (response.info.date)

            dates = ""

            if (date) {

              dates = date.split("-");

              dates = dates[2] + '/' + dates[1] + '/' + dates[0];
            }

            $('#date').val(dates);


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

          url: "license_info",


          data: {

            license_id: license_id,

          },

          success: function (response) {

            $("#licn").val('');

            $("#licnfile").val('');

            $("#licn").val(response.info.hodNo);

            $("#licnfile").val(response.info.peiceNo);

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
                row=attacheWithAttachName(data.all_files[j], $("#AttahType option:selected").text())
              }

              $(".alert-danger").addClass("hide");

              $(".alert-success").removeClass('hide');

              $("." + formDataStr + "FilesArea").append(row)

              $(".loader").addClass('hide');
              $('.form-control-file').val('')
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

            url: "archive_delete",

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

    @section('script')

    @endsection
@endsection