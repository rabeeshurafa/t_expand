@if($ticketInfo->has_attach==1)
    <div class="row">
        <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
            <img src="https://db.expand.ps/images/upload.png" width="40" height="40">
            <span class="attach-header">{{ 'المرفقات' }}
            <span id="attach-required" class="attach-required" style="display: none;">*</span>

        </span>
            <img src="https://t.palexpand.ps/assets/images/ico/scanner.png" style="cursor:pointer;    float: left;"
                 onclick="scanToJpg();">

            <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png" style="cursor:pointer;    float: left;"
                 onclick="scanTopdf();">
        </div>

    </div>
    <div class="row attachs-body">
        <div class="form-group col-12 mb-2">

            <ol class="vasType 1vas addAttatch olmob">
                <li style="font-size: 17px !important;color:#000000">
                    <div class="row">
                        <div class="col-sm-5 attmob">
                            <input type="text" id="attachName1" key="1" name="attachName[]"
                                   class="form-control attachName"
                                   placeholder="أخل اسم المرفق"
                                   {{$ticketInfo->force_attach==1?"required":"" }}   value="">
                        </div>
                        <div class="attdocmob col-sm-5 attach_row_1 ">
                            <input type="hidden" id="attach_ids1" name="attach_ids[]" value="">
                        </div>
                        <div>
                            <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                                 height="40" style="cursor:pointer"
                                 onclick="$('#currFile').val(1);validateName(1);">
                        </div>
                        <div class="attdelmob">
                            <i class="fa fa-trash" id="plusElement1"
                               style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "
                               onclick="$('.attach_row_1').children().remove();"></i>
                        </div>
                    </div>

                </li>
            </ol>
            <input type="hidden" id="currFile" name="currFile">
            <input type="file" style="display:none" id="attachfile" name="attachfile"
                   onchange="startUpload('ticketFrm')">
        </div>
    </div>


    <script>
      attach_index = 2;

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
          $(".loader").removeClass('hide');
          uploadScannedfile(scannedImage);
          $(".loader").addClass('hide');
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
        // $(".loader").removeClass('hide');
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
            // $(".loader").addClass('hide');
            $(".archive_type").removeClass("error");

            const row = ticketScannedAttache(response.file, attach_index)
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

      function validateName(key) {
        const name = $(`#attachName${key}`).val()
        if (name.trim().length > 0) {
          $(`#attachName${key}`).removeClass('error')
          $('#attachfile').trigger('click');
        } else {
          $(`#attachName${key}`).addClass('error')
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

      function checkRequiredAttach() {
        let error = false
        const attachmentRequired = +'{{$ticketInfo->force_attach}}'
        if (attachmentRequired === 1) {
          error = true;
          for (let i = 1; i < attach_index; i++) {
            const id = $(`#attach_ids${i}`).val()
            if (id?.trim()?.length > 0) {
              error = false;
              break
            } else {
              error = true;
            }
          }
        } else {
          return false
        }
        if (error) {
          $(".attachName").addClass('error');
          Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'أدخل المرفقات',
            showConfirmButton: true,
            timer: 2000
          })
        }
        return error
      }

      function validateAttachments() {
        if (checkRequiredAttach()) {
          return true;
        }
        if (validateAllAttachmentNames()) {
          return true;
        }
        return false;
      }

      function addNewAttatch() {

        // if($(".attachName").last().val().length>0){
        var row = '<li style="font-size: 17px !important;color:#000000">' +
          '<div class="row">' +
          '<div class="col-sm-5 attmob">' +
          `<input type="text" id="attachName${attach_index}" key=${attach_index} name="attachName[]" class="form-control attachName">` +
          '</div>' +
          '<div class="attdocmob col-sm-5 attach_row_' + attach_index + '">' +
          `<input type="hidden" id="attach_ids${attach_index}" name="attach_ids[]" value="">` +
          '</div>' +
          '<div class="attdelmob">' +
          `<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$('#currFile').val(${attach_index});validateName(${attach_index});">` +
          '</div>' +
          '<div class="attdelmob">' +
          '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>' +
          '</div>' +
          ' </div>' +

          ' </li>'
        attach_index++
        $(".addAttatch").append(row)
        // }
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
          url: "{{route('uploadTicketAttach')}}",
          type: 'POST',
          data: formData,
          dataType: "json",
          async: true,
          success: function (data) {
            row = '';
            console.log(data.all_files);
            if (data.all_files) {
              addNewAttatch()
              var j = 0;
              $actionBtn = '';
              for (j = 0; j < data.all_files.length; j++) {
                $(".attach_row_" + id).html('')
                $actionBtn += ticketNormalAttache(data.all_files[j], id)
                $actionBtn += '</div>';
              }
              $('#attachfile').val('');
              $(".alert-danger").addClass("hide");
              $(".alert-success").removeClass('hide');
              $(".attach_row_" + id).append($actionBtn)
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
    </script>
@endif
