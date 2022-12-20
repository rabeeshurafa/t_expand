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
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}"/>
                                    أرشيف الجلسات
                                </h4>
                            </div>
                            <div class="card-body">
                                <form id="formDataaa" onsubmit="return false">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 pr-0 pr-s-12">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12 pr-0 pr-s-12">
                                                        <div class="form-group">
                                                            <div class="input-group w-s-87">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style="width: 81px; ">
                                                                اسم الاجتماع
                                                            </span>
                                                                </div>
                                                                <input type="hidden" id="customerid" name="customerid"
                                                                       value="0">
                                                                <input type="hidden" id="customername"
                                                                       name="customername" value="0">
                                                                <input type="hidden" id="customerType"
                                                                       name="customerType" value="0">
                                                                <input type="hidden" id="msgType" name="msgType"
                                                                       value="<?php echo $type ?>">
                                                                <input type="hidden" id="url" name="url"
                                                                       value="<?php echo $url ?>">
                                                                <input type="hidden" id="pk_i_id" name="pk_i_id"
                                                                       value="">
                                                                <input type="hidden" id="ArchiveID" name="ArchiveID"
                                                                       value="">

                                                                <select type="text" id="archive_type"
                                                                        name="archive_type"
                                                                        class="form-control alphaFeild archive_type"
                                                                        style=" width: 115px;"
                                                                        aria-invalid="false"
                                                                >
                                                                    <option value="0">-- اختر --</option>
                                                                    @foreach($archive_type as $archive)
                                                                        <option
                                                                                value="{{$archive->id}}"> {{$archive->name}}   </option>
                                                                    @endforeach
                                                                </select>

                                                                <div class="input-group-append"
                                                                     onclick="ShowConstantModal(99,'archive_type','اسم الاجتماع')"
                                                                     style="cursor:pointer">
                                                                <span class="input-group-text input-group-text2">
                                                                    <i class="fa fa-external-link"></i>
                                                                </span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                                                        <div class="form-group">
                                                            <div class="input-group w-s-87">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                {{trans('archive.datejal')}}
                                                            </span>
                                                                </div>
                                                                <input type="text" id="msgDate" name="msgDate"
                                                                       data-mask="00/00/0000" maxlength="10"
                                                                       class="form-control eng-sm  valid"
                                                                       value="<?php echo date('d/m/Y')?>" placeholder=""
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 copyto p-0">
                                                        <div class="row col-md-12 link_to_count link_to1 p-0 m-0">
                                                            <div class="col-md-8 pr-0 pr-s-12">
                                                                <div class="form-group">
                                                                    <div class="input-group w-s-87">
                                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                {{trans('admin.related_to')}}
                                                            </span>
                                                                        </div>
                                                                        <input type="text" id="copyToText[]"
                                                                               class="form-control cust_auto name"
                                                                               name="copyToText[]" index="1">
                                                                        <input type="hidden" class="copyToID"
                                                                               id="copyToID[]"
                                                                               name="copyToID[]" value="0">
                                                                        <input type="hidden" class="copyToCustomer"
                                                                               id="copyToCustomer[]"
                                                                               name="copyToCustomer[]"
                                                                               value="0">
                                                                        <input type="hidden" class="copyToType"
                                                                               id="copyToType[]" name="copyToType[]"
                                                                               value="0">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                                                                <div class="form-group">
                                                                    <div class="input-group w-s-87"
                                                                         style="width: 85% !important;">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text"
                                                                                  id="basic-addon1">
                                                                                رقم الهوية
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" id="national_id[]"
                                                                               name="national_id[]"
                                                                               class="form-control eng-sm valid national_id1">
                                                                        <div class="input-group-append"
                                                                             onclick="addRec()"
                                                                             style="cursor:pointer">
                                                                                <span class="input-group-text input-group-text2">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-12 pr-0 pr-s-12">
                                                        <div class="form-group">
                                                            <div class="input-group w-s-87">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                ملاحظات
                                                            </span>
                                                                </div>
                                                                <input type="text" id="notes" name="notes"
                                                                       class="form-control ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                                                        <div class="form-group">
                                                            <div class="input-group w-s-87">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                {{trans('archive.numjal')}}

                                                            </span>
                                                                </div>
                                                                <input type="text" id="msgid" name="msgid"
                                                                       class="form-control eng-sm valid"
                                                                       style="text-align: left;direction: ltr;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 pr-0 pr-s-12">
                                                        <div class="form-group">
                                                            <div class="input-group w-s-87"
                                                                 style="width: 97% !important;">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                الموضوع
                                                            </span>
                                                                </div>
                                                                <input type="text" id="subject" name="subject"
                                                                       class="form-control eng-sm valid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 pr-0 pr-s-12">
                                                        <div class="form-group">
                                                            <div class="input-group w-s-87"
                                                                 style="width: 97% !important;">
                                                                <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                القرار
                                                            </span>
                                                                </div>
                                                                <input type="text" id="decision" name="decision"
                                                                       class="form-control eng-sm valid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-md-12 pr-0 pr-s-12">
                                                <div class="row attachs-body">
                                                    <div class="form-group col-12 mb-2">
                                                        <div class="progress">
                                                            <div class="bar"></div>
                                                            <div class="percent">0%</div>
                                                        </div>
                                                        <input type="hidden" name="fromname" value="formDataaa">
                                                        <meta name="csrf-token" content="{{ csrf_token() }}"/>

                                                        <input type="file" class="form-control-file"
                                                               id="formDataaaupload-file[]" multiple=""
                                                               name="formDataaaUploadFile[]"
                                                               onchange="doUploadAttach('formDataaa')"
                                                               style="display: none">
                                                        <div class="row formDataaaFilesArea" style="margin-left: 0px;">
                                                        </div>
                                                        <div class="row formDataaaLinkArea" style="margin-left: 0px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-md-12 pr-0 pr-s-12">
                                                <img src="{{asset('assets/images/ico/upload.png')}}" width="40"
                                                     height="40" style="cursor:pointer"
                                                     onclick="document.getElementById('formDataaaupload-file[]').click(); return false">
                                                <!-- <a onclick="showLinkModal('formDataaa')" class="attach-icon">
                                                    <img src="images/hyper.png" width="35" height="35" style="cursor:pointer">
                                                </a>-->
                                                <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"
                                                     style="cursor:pointer;    float: left;" onclick="scanToJpg();">

                                                <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"
                                                     style="cursor:pointer;    float: left;" onclick="scanTopdf();">
                                            </div>
                                        </div>
                                        <div style="text-align: center;">
                                            <button type="submit" class="btn btn-primary" id="saveBtn" style="">
                                                {{ trans('admin.save') }}
                                            </button>
                                            {{--                                            @can('trackingArchive')--}}
                                            <input type="hidden" id="track" name="track" value="0">
                                            <button onclick="$('#track').val(1);save();" type="button"
                                                    class="btn btn-primary save" id="saveBtn" style="">
                                                حفظ ومتابعة
                                            </button>
                                            {{--                                            @endcan--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </section>
    </div>
    @include('dashboard.component.fetch_table')
    @section('script')
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

                let urlfile = getFileUrl(response.file);

                shortCutName = shortCutName.substring(0, 40)

                row = '<div id="attach" class=" col-lg-6 ">' +
                  '   <div class="attach" onmouseover="$(this).children().first().next().show()">'
                  + '    <a class="attach-close1" href="' + urlfile + '" style="color: #74798D;" target="_blank">'
                  + '    <span class="attach-text">' + shortCutName + '</span> </a>'
                  + '    <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>'
                  + '      <input type="hidden" id="formDataaaimgUploads[]" name="formDataaaimgUploads[]" value="' + shortCutName + '">'
                  + '             <input type="hidden" id="formDataaaorgNameList[]" name="formDataaaorgNameList[]" value="' + shortCutName + '">'
                  + '             <input type="hidden" id="formDataaaorgIdList[]" name="formDataaaorgIdList[]" value="' + shortCutID + '">'
                  + '    </div>'
                  + '  </div>'
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
            $(".loader").removeClass('hide');
            form = $('#formDataaa')[0]
            let formData = new FormData(form);
            $.ajax({
              type: 'POST',
              url: "store_jal_archive",
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
                $(".loader").addClass('hide');
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: '{{trans('admin.data_added')}}',
                  showConfirmButton: false,
                  timer: 1500
                })
                if ($('#track').val() == 1) {
                  let url = `{{ route('admin.dashboard') }}/trackingArchive/${$('#url').val()}/${response.id}`
                  window.open(url, '_blank');
                  $('#track').val(0);
                }
                $(".formDataaaFilesArea").html('');
                form.reset();
                // $('.wtbl').DataTable().ajax.reload();
                setTimeout(function () {
                  self.location = '{{route("jal_archieve")}}'
                }, 500)
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
                if (response.responseJSON.errors.archive_type) {
                  $("#archive_type").addClass("error");
                  $("#archive_type").get(0).setCustomValidity('يرجى اختيار نوع الجلسة  ');
                  $("#archive_type").on('change', function () {
                    this.setCustomValidity('')
                  })
                }
                if (response.responseJSON.errors.subject) {
                  $("#subject").addClass("error");
                  $("#subject").get(0).setCustomValidity('يرجى الموضوع');
                  $("#subject").on('input', function () {
                    this.setCustomValidity('')
                  })
                }
              }
            });
            return true;


          };

          $('#formDataaa').submit(function (e) {
            $(".loader").removeClass('hide');
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
              type: 'POST',
              url: "store_jal_archive",
              data: formData,
              contentType: false,
              processData: false,
              success: (response) => {
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
                // $('.wtbl').DataTable().ajax.reload();
                $(".formDataaaFilesArea").html('');
                setTimeout(function () {
                  self.location = '{{route("jal_archieve")}}'
                }, 500)
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
                if (response.responseJSON.errors.archive_type) {
                  $("#archive_type").addClass("error");
                  $("#archive_type").get(0).setCustomValidity('يرجى اختيار نوع الجلسة  ');
                  $("#archive_type").on('input', function () {
                    this.setCustomValidity('')
                  })
                }
                if (response.responseJSON.errors.subject) {
                  $("#subject").addClass("error");
                  $("#subject").get(0).setCustomValidity('يرجى الموضوع');
                  $("#subject").on('input', function () {
                    this.setCustomValidity('')
                  })
                }
              }
            });
          });
          $(function () {
            $(".cust_auto").autocomplete({
              source: 'archive_auto_complete',
              minLength: 1,

              select: function (event, ui) {
                // var currentIndex=$("input[name^=copyToID]").length -1;
                // $('input[name="copyToID[]"]').eq(currentIndex).val(ui.item.id);
                // $('input[name="copyToCustomer[]"]').eq(currentIndex).val(ui.item.name);
                // $('input[name="copyToType[]"]').eq(currentIndex).val(ui.item.model);
                $(this).next().val(ui.item.id);
                $(this).next().next().val(ui.item.name);
                $(this).next().next().next().val(ui.item.model);
                $(`.national_id${$(this)[0].attributes.index.value}`).val(ui.item.national_id);
              }
            });
          });
          $(function () {
            $(".cust").autocomplete({
              source: 'archive_auto_complete',
              minLength: 1,

              select: function (event, ui) {
                $('#customerid').val(ui.item.id);
                $('#customerName').val(ui.item.name);
                $('#customername').val(ui.item.name);
                $('#customerType').val(ui.item.model);
              }
            });
          });

          /*$(function () {
              $("#search_Linked_to").autocomplete({
                  source: 'archive_auto_complete',
                  minLength: 1,

                  select: function (event, ui) {
                      $('#search_Linked_to_id').val(ui.item.id);
                      $('#search_Linked_to').val(ui.item.name);
                      $('#search_Linked_to_model').val(ui.item.model);
                  }
              });
          });*/

          function update($id) {
            let archive_id = $id;
            $('#saveBtn').text("تعديل");
            $(".formDataaaFilesArea").html('');
            $.ajax({
              type: 'get', // the method (could be GET btw)
              url: "{{ route('archieve_jal_info') }}",
              data: {
                archive_id: archive_id,
              },
              success: function (response) {
                const archive_type = document.getElementById('archive_type');
                const subject = document.getElementById('subject');
                archive_type.setCustomValidity('');
                subject.setCustomValidity('');
                $("#subject").removeClass("error");
                $("#archive_type").removeClass("error");

                $('#customerid').val(response.info.model_id);
                $('#ArchiveID').val(response.info.id);
                $('#customerName').val(response.info.name);
                $('#customername').val(response.info.name);
                $('#customerType').val(response.info.model_name);
                $('#msgTitle').val(response.info.title);
                $('#archive_type').val(response.info.type_id);
                $('#subject').val(response.info.subject);
                $('#decision').val(response.info.decision);
                $('#notes').val(response.info.notes);
                let date = (response.info.date)
                dates = ""
                if (date) {
                  dates = date.split("-");
                  dates = dates[2] + '/' + dates[1] + '/' + dates[0];
                }
                $("#msgDate").val(dates);
                $('#msgid').val(response.info.serisal);
                row = '';
                if (response.files) {
                  var j = 0;
                  for (j = 0; j < response.files.length; j++) {
                    shortCutName = response.files[j].real_name;
                    shortCutID = response.files[j].id;
                    let urlfile = getFileUrl(response.files[j]);
                    formDataStr = "formDataaa";
                    shortCutName = shortCutName.substring(0, 20)
                    row += '<div id="attach" class=" col-sm-6 ">' +
                      '   <div class="attach" onmouseover="$(this).children().first().next().show()">'
                      + '    <span class="attach-text">' + shortCutName + '</span>'
                      + '    <a class="attach-close1" href="' + urlfile + '" style="color: #74798D; float:left;" target="_blank"><i class="fa fa-eye"></i></a>'
                      + '    <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>'
                      + '      <input type="hidden" id="' + formDataStr + 'imgUploads[]" name="' + formDataStr + 'imgUploads[]" value="' + shortCutName + '">'
                      + '             <input type="hidden" id="' + formDataStr + 'orgNameList[]" name="' + formDataStr + 'orgNameList[]" value="' + shortCutName + '">'
                      + '             <input type="hidden" id="' + formDataStr + 'orgIdList[]" name="' + formDataStr + 'orgIdList[]" value="' + shortCutID + '">'
                      + '    </div>'
                      + '  </div>' +
                      '</div>'
                  }
                  $(".formDataaaFilesArea").html(row)
                }

                row = '';
                if (response.CopyTo) {
                  var j = 0;
                  for (j = 0; j < response.CopyTo.length; j++) {
                    if (j == 0) {
                      $('.name').val(response.CopyTo[j].name);
                      $('.copyToID').val(response.CopyTo[j].model_id);
                      $('.copyToCustomer').val(response.CopyTo[j].name);
                      $('.copyToType').val(response.CopyTo[j].model_name);
                      $('.national_id1').val(response.CopyTo[j].national_id);
                    } else {
                      addRec()
                      $('input[name="copyToText[]"]').eq(j).val(response.CopyTo[j].name);
                      $('input[name="copyToID[]"]').eq(j).val(response.CopyTo[j].model_id);
                      $('input[name="copyToCustomer[]"]').eq(j).val(response.CopyTo[j].name);
                      $('input[name="copyToType[]"]').eq(j).val(response.CopyTo[j].model_name);
                      $('input[name="national_id[]"]').eq(j).val(response.CopyTo[j].national_id);
                    }
                  }
                  if (response.CopyTo.length > 0)
                    $('.copyto').css('display', 'block');
                }
                window.scrollTo(0, 0);
              },
            });
          }

          function CopyRec(id) {

            var formData = {'id': id};
            $.ajax({
              url: 'c_archive/GetMunArchByID',
              type: 'POST',
              data: formData,
              dataType: "json",
              async: true,
              success: function (data) {
                if (data.inCharge.length > 0) {

                  for (i = 0; i < data.inCharge.length; i++) {
                    attach = '';
                    for (j = 0; j < data.inCharge[i].attach.length; j++)
                      attach += '<div id="attach' + data.inCharge[i].attach[j].ID + '" class=" col-sm-6 ">'
                        + '  <div class="attach">'
                        + '<span class="attach-text">' + data.inCharge[i].attach[j].AttachName + '</span><a onclick="delAttach(' + data.inCharge[i].attach[j].ID + ')"><i class="fa fa-trash"></i></a>'
                        + '<a class="attach-close1" href="' + realPath + 'uploads/' + data.inCharge[i].attach[j].AttachServerName + '" style="color: #74798D; float:left;" target="_blank">'
                        + '  <i class="fa fa-eye"> </i>'
                        + '</a><input type="hidden" value="' + data.inCharge[i].attach[j].pk_i_id + '" name="attach[]" >'
                        + '</div>'
                        + '</div>';
                    $(".formDataaaFilesArea").html(attach)
                    $("#pk_i_id").val(data.inCharge[i].pk_i_id)
                    d = new Date(data.inCharge[i].arch_date);
                    $("#msgDate").val(d.getDate() + '/' + ((d.getMonth() + 1) < 10 ? '0' + (d.getMonth() + 1) : (d.getMonth() + 1)) + '/' + d.getFullYear())
                    $("#customerName").val(data.inCharge[i].receiver_name)
                    $("#msgTitle").val(data.inCharge[i].arch_title)
                    $("#msgid").val(data.inCharge[i].arch_no)

                  }
                } else
                  alert('لا يوجد بيانات')
              },
              error: function () {
              },
            });
          }

          linkToCount = $('.link_to_count').length + 1;

          function addRec() {

            $('.copyto').append(`<div class="row col-md-12 link_to_count link_to${linkToCount} p-0 m-0">`
              + '<div class="col-md-8 pr-0 pr-s-12">'
              + '     <div class="form-group">'
              + '         <div class="input-group w-s-87">'
              + '             <div class="input-group-prepend">'
              + '			        <span class="input-group-text" id="basic-addon1">'
              + '			        	 {{trans('admin.related_to')}}'
              + '			        </span>'
              + '             </div>'
              + `             <input type="text" id="copyToText[]" class="form-control cust_auto ui-autocomplete-input" index="${linkToCount}"  name="copyToText[]" autocomplete="off">`
              + '             <input type="hidden" id="copyToID[]" name="copyToID[]" value="0">'
              + '             <input type="hidden" id="copyToCustomer[]" name="copyToCustomer[]" value="0">'
              + '             <input type="hidden" id="copyToType[]" name="copyToType[]" value="0">'
              + '         </div>'
              + '     </div>'
              + '</div>'
              + `<div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                            <div class="form-group">
                                <div class="input-group w-s-87" style="width: 85% !important;">
                                    <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    رقم الهوية
                                </span>
                                    </div>
                                    <input type="text" id="national_id[]" name="national_id[]"
                                           class="form-control eng-sm valid national_id${linkToCount}">
                                    <div class="input-group-append" onclick="$(this).parent().parent().parent().parent().remove()" style="cursor:pointer">
                                        <span class="input-group-text input-group-text2">
                                            <i class="fa fa-trash"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>`
              + '</div>'
            )
            linkToCount++;
            $(".cust_auto").autocomplete({
              source: 'archive_auto_complete',
              minLength: 1,

              select: function (event, ui) {
                // var currentIndex=$("input[name^=copyToID]").length -1;
                // $('input[name="copyToID[]"]').eq(currentIndex).val(ui.item.id);
                // $('input[name="copyToCustomer[]"]').eq(currentIndex).val(ui.item.name);
                // $('input[name="copyToType[]"]').eq(currentIndex).val(ui.item.model);
                console.log($(this));
                $(this).next().val(ui.item.id);
                $(this).next().next().val(ui.item.name);
                $(this).next().next().next().val(ui.item.model);
                $(`.national_id${$(this)[0].attributes.index.value}`).val(ui.item.national_id);
              }
            });
          }

          function delete_archive($id) {
            if (confirm('هل انت متاكد من حذف الارشيف؟ لن يمكنك استرجاعه فيما بعد')) {
              let archive_id = $id;
              var _token = '{{ csrf_token() }}';
              $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "deleteJalArchive",

                data: {

                  id: archive_id,
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
@endsection
