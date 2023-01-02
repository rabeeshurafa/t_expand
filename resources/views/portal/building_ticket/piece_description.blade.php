@extends('portal.portal')
@section('content')

    <style>
        /* The Modal (background) */
        .modal1 {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content1 {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            /*   float: right; */
            font-size: 28px;
            font-weight: bold;
            margin-left: auto;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .rate:not(:checked) > label {
            font-size: 30px !important;
        }

        .rate {
            width: auto;
            position: relative;
            float: left;
            height: 40px;
            margin-top: -3px;
        }

        .Priority {
            padding: 0;
            position: relative;
            left: 0;
            line-height: 39px;
            float: left;
        }

        .fa-2x {
            font-size: 24px !important;
        }

        .swal2-html-container {
            font-size: 18px !important;

        }
    </style>


    <link rel="stylesheet" type="text/css"
          href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css"/>

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>

    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="ticketFrm" enctype="multipart/form-data">
            @csrf
            <div class="row white-row">

                <div class="col-sm-12 col-md-12">
                    <div class="card leftSide">
                        @include('portal.includes.ticketHeader')
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group" style="">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            الحوض
                                                        </span>
                                                    </div>
                                                    <input type="text" id="hod_no" class="form-control"
                                                           name="hod_no">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group" style="">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            القطعة
                                                        </span>
                                                    </div>
                                                    <input type="text" id="piece_no" class="form-control"
                                                           name="piece_no" >

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group" style=" width: 90% !important;">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        صادر إلى
                                                    </span>
                                                    </div>
                                                    <input type="text" id="send_to" class="form-control"
                                                           name="send_to" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group" style="">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'وصف الطلب' }}
                                                        </span>
                                                    </div>
                                                    <textarea type="text" id="malDesc" class="form-control"
                                                              placeholder="وصف الطلب" name="malDesc"
                                                              style="height: 35px;"></textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('portal.includes.regionsTemplate')
                                </div>
                            </div>
                        </div>

                        <div class="row mobRow" style="padding-right: 10px; padding-left: 10px">

                            <div class="col-md attachs-section">

                                <i class="fa fa-users"></i>

                                <span class="attach-header"> {{ 'المستفيد' }}</span>

                            </div>

                        </div>
                        <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">
                        <input type="hidden" id="app_type" name="app_type" value="3">
                        <input type="hidden" id="rec_id"  name="rec_id" value="{{$ticketInfo->emp_to_access_portal}}">
                        <div style="padding-right:20px">
                            @include('portal.includes.subscriber')
                        </div>
                        @include('portal.includes.forward')
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script>

      function validate() {
        let error = false
        if ($("#subscriber_id")?.val()?.trim()?.length === 0) {
          error = true;
          $("#subscriber_name").addClass('error')
        } else {
          $("#subscriber_name").removeClass('error')
        }

        if ($("#subscriber_name")?.val()?.trim()?.length === 0) {
          error = true;
          $("#subscriber_name").addClass('error')
        } else {
          $("#subscriber_name").removeClass('error')
        }

        if ($("#malDesc")?.val()?.trim()?.length === 0) {
          error = true;
          $("#malDesc").addClass('error')
        } else {
          $("#malDesc").removeClass('error')
        }

        if ($("#MobileNo")?.val()?.trim()?.length === 0) {
          error = true;
          $("#MobileNo").addClass('error')
        } else {
          $("#MobileNo").removeClass('error')
        }

        if ($("#national_id")?.val()?.trim()?.length === 0) {
          error = true;
          $("#national_id").addClass('error')
        } else {
          $("#national_id").removeClass('error')
        }

        if ($("#AreaID")?.val()?.trim()?.length === 0) {
          error = true;
          $("#AreaID").addClass('error')
        } else {
          $("#AreaID").removeClass('error')
        }

        if ($("#send_to")?.val()?.trim()?.length === 0) {
          error = true;
          $("#send_to").addClass('error')
        } else {
          $("#send_to").removeClass('error')
        }

        if ($("#piece_no")?.val()?.trim()?.length === 0) {
          error = true;
          $("#piece_no").addClass('error')
        } else {
          $("#piece_no").removeClass('error')
        }

        if ($("#hod_no")?.val()?.trim()?.length === 0) {
          error = true;
          $("#hod_no").addClass('error')
        } else {
          $("#hod_no").removeClass('error')
        }
        return error;
      }

      $(document).ready(function () {

        $("#subscriber_name").autocomplete({
          source: 'portal_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#subscriber_id").val(ui.item.id)
          }
        });


        $('#ticketFrm').submit(function (e) {
          e.preventDefault();
          if (validate()) {
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          $("#subscriber_name").removeClass("error");
          $("#subscriber_id").removeClass("error");
          $("#MobileNo").removeClass("error");
          $("#AreaID").removeClass("error");
          $("#malDesc").removeClass("error");
          $("#task_type").removeClass("error");
          let formData = new FormData(this);
          $.ajax({
            type: 'POST',
            url: "{{route('portal_saveTicket47')}}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
              $(".form-actions").removeClass('hide');
              // console.log('response');
              if (response.success != null) {
                $(".loader").addClass('hide');
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: '{{trans('admin.data_added')}}',
                  showConfirmButton: false,
                  timer: 1500
                })

                // setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
                this.reset();

              } else {
                $(".loader").addClass('hide');
                Swal.fire({
                  position: 'top-center',
                  icon: 'error',
                  title: '{{trans('admin.error_save')}}',
                  showConfirmButton: false,
                  timer: 1500
                })
              }
              //location.reload();

            },
            error: function (response) {
              $(".loader").addClass('hide');
              $(".form-actions").removeClass('hide');
              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'يرجى تعبئة الحقول الاجبارية',
                showConfirmButton: false,
                timer: 1500
              })
            }
          });
        });
      });
    </script>
@stop

