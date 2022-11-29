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
                                    {{trans('archive.trade_achive')}}
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

                                        <div class="col-lg-3 col-md-3 pr-0 pr-s-3">

                                            <div class="form-group">

                                                <div class="input-group w-s-87" style="width: 100% !important;">

                                                    <div class="input-group-prepend" style="height: 38px;">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            رقم المعاملة
                                                        </span>

                                                    </div>

                                                    <input type="text" id="tradeNo" class="form-control" name="tradeNo"
                                                           value="{{ $tradeNo }}">

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

                                                    <select class="form-control tradeType" name="tradeType"
                                                            id="tradeType">

                                                        <option value="">{{trans('admin.select')}}</option>
                                                        n>
                                                        @foreach($license_type as $license)

                                                            <option
                                                                    value="{{$license->id}}"> {{$license->name}}   </option>

                                                        @endforeach

                                                    </select>

                                                    <div class="input-group-append"
                                                         onclick="ShowConstantModal(105,'tradeType','نوع المعاملة')"
                                                         style="cursor:pointer">

                                                        <span class="input-group-text input-group-text2">

                                                            <i class="fa fa-external-link"></i>

                                                        </span>

                                                    </div>

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

                                                    <input type="text" id="supplierName" class="form-control cust"
                                                           name="supplierName">

                                                    <input type="hidden" id="suppliername" name="suppliername" value="">

                                                    <input type="hidden" id="supplierType" name="supplierType" value="">

                                                    <input type="hidden" id="msgType" name="msgType" value="{{$type}}">

                                                    <input type="hidden" id="url" name="url" value="{{$url}}">

                                                    <input type="hidden" id="pk_i_id" name="pk_i_id" value="">

                                                    <input type="hidden" id="ArchiveID" name="ArchiveID" value="">

                                                    <input type="hidden" id="supplierid" name="supplierid" value="">

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

                                        <div class="col-lg-4 col-md-4 pr-0 pr-s-12">

                                            <div class="form-group">

                                                <div class="input-group w-s-87">

                                                    <div class="input-group-prepend">

                                                        <span class="input-group-text" id="basic-addon1">

                                                            رقم الهوية
                                                        </span>

                                                    </div>

                                                    <input type="text" id="vehicleName" class="form-control vehicle"
                                                           name="vehicleName">

                                                    <input type="hidden" id="vehicleId" name="vehicleId" value="">

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
                                                    <input type="text" id="plateNo" class="form-control plateNo"
                                                           name="plateNo">
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
                                                    <input type="text" id="vehicleNo" class="form-control vehicleNo"
                                                           name="vehicleNo">
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
                                                    <input type="text" id="driverName" class="form-control"
                                                           name="driverName">
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
                                                    <input type="text" id="driverPhone" class="form-control"
                                                           name="driverPhone">
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
                                                    <input type="text" id="documentPlace" class="form-control"
                                                           name="documentPlace">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 pr-0 pr-s-12" style="min-width: 21%">

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

                                        <div class="col-lg-8 col-md-12 pr-0 pr-s-12">

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

                                                                <option
                                                                        value="{{$attachment->id}}"> {{$attachment->name}}   </option>

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
                                                             height="40" style="cursor:pointer"
                                                             onclick="document.getElementById('formDataaaupload-file[]').click(); return false">
                                                        <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"
                                                             style="cursor:pointer;    float: left;"
                                                             onclick="scanToJpg();">

                                                        <img
                                                                src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"
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
                                        <input type="hidden" id="print" class="form-control"
                                               name="print" value="0">
                                        @can('trackingArchive')
                                            <input type="hidden" id="track" name="track" value="0">
                                            <button onclick="$('#track').val(1);save();" type="button"
                                                    class="btn btn-primary save" id="saveBtn" style="">
                                                حفظ ومتابعة
                                            </button>
                                        @endcan
                                        {{-- <input type="hidden" id="send_email" name="send_email" value="0">
                                        <button onclick="$('#send_email').val(1);save();" type="button"
                                                class="btn btn-primary save" id="saveBtn" style="">
                                            حفظ وارسال
                                        </button> --}}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-6 col-lg-6">

                        <div class="card lSide" style="min-height:421.2px;">

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
    @include('dashboard.archive.email_archive')
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
            shortCutName = response.file.real_name;

            shortCutID = response.file.id;

            urlfile = getFileUrl(response.file);

            shortCutName = shortCutName.substring(0, 40)

            row = '<div class="col-sm-12"><div class="form-group">'

              + '  <div class="input-group w-s-87">'

              + '      <div class="input-group-prepend">  			'

              + '          <span class="input-group-text" id="basic-addon1">'

              + '              {{ trans('archive.attachment_type') }}            '

              + '          </span>          '

              + '      </div>          '

              + '      <input type="text" id="attachName[]" class="form-control" name="attachName[]" value="' + $("#AttahType option:selected").text() + '">     '

              // + '      <input type="hidden" id="attachFile[]" name="attachFile[]" value="' + response.file.url + '">        '
              + `      <input type="hidden" id="attachFile[]" name="attachFile[]" value="'${urlfile}'">        `
              + '      <input type="hidden" id="attachIds[]" name="attachIds[]" value="' + response.file.id + '">        '
              + '      <a href="' + urlfile + '" target="_blank">     '

              + '          <span class="input-group-text input-group-text2">       '

              + '              <i class="fa fa-download"></i>       '

              + '          </span>            '

              + '      </a>            '

              + '      <a onclick="$(this).parent().parent().remove()">       '

              + '          <span class="input-group-text input-group-text2">          '

              + '              <i class="fa fa-trash"></i>    '

              + '          </span> '

              + '      </a>'

              + '  </div>'

              + '</div></div>'

            //                     row='<div id="attach" class=" col-lg-6 ">' +
            //                         '   <div class="attach" onmouseover="$(this).children().first().next().show()">'
            //                         +'    <a class="attach-close1" href="'+urlfile+'" style="color: #74798D;" target="_blank">'
            //                         +'    <span class="attach-text">'+shortCutName+'</span> </a>'
            //                         +'    <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>'
            //                         +'      <input type="hidden" id="formDataaaimgUploads[]" name="formDataaaimgUploads[]" value="'+shortCutName+'">'
            //                         +'             <input type="hidden" id="formDataaaorgNameList[]" name="formDataaaorgNameList[]" value="'+shortCutName+'">'
            // +'             <input type="hidden" id="formDataaaorgIdList[]" name="formDataaaorgIdList[]" value="'+shortCutID+'">'
            //   +'    </div>'
            //                         +'  </div>'
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
        if ($("#supplierid").val() == '' || $("#supplierid").val() == null) {

          alert("الرجاء اختيار زبون");

        } else {

          $(".loader").removeClass('hide');
          form = $('#formDataaa')[0]
          let formData = new FormData(form);

          $("#customerName").removeClass("error");

          $.ajax({

            type: 'POST',

            url: "store_trade_archive",

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
              $('.connected-to').html('')
              Swal.fire({

                position: 'top-center',

                icon: 'success',

                title: '{{trans('admin.data_added')}}',

                showConfirmButton: false,

                timer: 1500

              })

              $(".formDataaaFilesArea").html('');

              document.getElementById("formDataaa").reset();
              if ($('#print').val() == '1') {
                console.log('hi')
                let url = `{{ route('admin.dashboard') }}/printArchive/trade/${response.id}}`
                window.open(url, '_blank');
                $('#print').val(0);
              }
              if ($('#track').val() == 1) {
                let url = `{{ route('admin.dashboard') }}/trackingArchive/${$('#url').val()}/${response.id}`
                window.open(url, '_blank');
                $('#track').val(0);
              }
              // if ($('#send_email').val() == 1) {
              //   send_email_archive(response.id)
              //   $('#send_email').val(0);
              // }
              // $('.kt_ecommerce_products_table').DataTable().ajax.reload();
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

        if ($("#supplierid").val() == '' || $("#supplierid").val() == null) {

          alert("الرجاء اختيار زبون");

        } else {

          $(".loader").removeClass('hide');

          let formData = new FormData(this);

          $.ajax({

            type: 'POST',

            url: "store_trade_archive",

            data: formData,

            contentType: false,

            processData: false,

            success: (response) => {
              $('.wtbl').DataTable().ajax.reload();
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

              this.reset();

              // $('.kt_ecommerce_products_table').DataTable().ajax.reload();

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

          source: 'subscribe_auto_complete',

          minLength: 1,


          select: function (event, ui) {
            // console.log(ui.item.model);
            $('#supplierid').val(ui.item.id);
            $('#suppliername').val(ui.item.name);
            $('#supplierName').val(ui.item.name);
            $('#supplierType').val(ui.item.model);
            $('#vehicleName').val((ui.item.national_id ?? ''));
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

          url: "{{ route('tradeArchive_info') }}",

          data: {

            archive_id: archive_id,

          },

          success: function (response) {

            $('#supplierid').val(response.info.model_id);

            $('#ArchiveID').val(response.info.id);

            $('#tradeNo').val(response.info.trade_no);
            $('#tradeType').val(response.info.trade_type);
            $('#vehicleName').val(response.info.vehicle_name);
            $('#vehicleId').val(response.info.vehicle_id);
            $('#vehicleNo').val(response.info.vehicle_no);
            $('#documentPlace').val(response.info.document_place);
            $('#documentCode').val(response.info.document_code);
            $('#supplierName').val(response.info.name);
            $('#suppliername').val(response.info.name);
            $('#supplierType').val(response.info.model_name);
            $('#plateNo').val(response.info.plateNo);
            $('#driverName').val(response.info.driverName);
            $('#driverPhone').val(response.info.driverPhone);
            $('#notes').val(response.info.notes);
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

              var j = 0;

              for (j = 0; j < response.files.length; j++) {
                shortCutName = response.files[j].real_name;
                shortCutID = response.files[j].id;
                urlfile = getFileUrl(response.files[j]);
                formDataStr = "formDataaa";
                row += '<div class="col-sm-12"><div class="form-group">'
                  + '  <div class="input-group w-s-87">'
                  + '      <div class="input-group-prepend">  			'
                  + '          <span class="input-group-text" id="basic-addon1">'
                  + '              {{ trans('archive.attachment_type') }}            '
                  + '          </span>          '
                  + '      </div>          '
                  + '      <input type="text" id="attachName[]" class="form-control" name="attachName[]" value="' + response.files[j].real_name + '">'
                  // + '      <input type="hidden" id="attachFile[]" name="attachFile[]" value="' + response.files[j].url + '">'
                  + `      <input type="hidden" id="attachFile[]" name="attachFile[]" value="'${urlfile}'">        `
                  + '      <input type="hidden" id="attachIds[]" name="attachIds[]" value="' + response.files[j].id + '">'
                  + `      <a href="${urlfile.replace(/'/g, '')}" target="_blank">     `
                  + '          <span class="input-group-text input-group-text2">       '
                  + '              <i class="fa fa-download"></i>       '
                  + '          </span>            '
                  + '      </a>            '
                  + '      <a onclick="$(this).parent().parent().remove()">       '
                  + '          <span class="input-group-text input-group-text2">          '
                  + '              <i class="fa fa-trash"></i>    '
                  + '          </span> '
                  + '      </a>'
                  + '  </div>'
                  + '</div></div>'

              }

              $(".formDataaaFilesArea").html(row)

            }

            window.scrollTo(0, 0);

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

              var j = 0;

              for (j = 0; j < data.all_files.length; j++) {

                shortCutName = data.all_files[j].real_name;

                shortCutID = data.all_files[j].id;
                urlfile = getFileUrl(data.all_files[j]);

                shortCutName = shortCutName.substring(0, 40)

                row += '<div class="col-sm-12"><div class="form-group">'

                  + '  <div class="input-group w-s-87">'

                  + '      <div class="input-group-prepend">  			'

                  + '          <span class="input-group-text" id="basic-addon1">'

                  + '              {{ trans('archive.attachment_type') }}            '

                  + '          </span>          '

                  + '      </div>          '

                  + '      <input type="text" id="attachName[]" class="form-control" name="attachName[]" value="' + $("#AttahType option:selected").text() + '">     '

                  // + '      <input type="hidden" id="attachFile[]" name="attachFile[]" value="' + data.all_files[j].url + '">        '
                  + `      <input type="hidden" id="attachFile[]" name="attachFile[]" value="'${urlfile}'">        `

                  + '      <input type="hidden" id="attachIds[]" name="attachIds[]" value="' + data.all_files[j].id + '">        '

                  + '      <a href="' + urlfile + '" target="_blank">     '

                  + '          <span class="input-group-text input-group-text2">       '

                  + '              <i class="fa fa-download"></i>       '

                  + '          </span>            '

                  + '      </a>            '

                  + '      <a onclick="$(this).parent().parent().remove()">       '

                  + '          <span class="input-group-text input-group-text2">          '

                  + '              <i class="fa fa-trash"></i>    '

                  + '          </span> '

                  + '      </a>'

                  + '  </div>'

                  + '</div></div>'

              }

              $(".alert-danger").addClass("hide");

              $(".alert-success").removeClass('hide');

              $("." + formDataStr + "FilesArea").append(row)

              $(".loader").addClass('hide');

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

            url: "tradeArchive_delete",

            data: {

              archive_id: archive_id,
              _token: _token,
            },

            success: function (response) {

              $(".loader").addClass('hide');

              // $('.kt_ecommerce_products_table').DataTable().ajax.reload();
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
