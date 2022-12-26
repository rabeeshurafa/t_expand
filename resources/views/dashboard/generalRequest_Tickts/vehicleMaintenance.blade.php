@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection
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

        .tdborder {
            padding: 1px !important;
            padding-right: 5px !important;
            border: 1px solid #000000;
        }

        .thborder {
            background-color: #0073AA;
            border: 1px solid #000000;
            color: #ffffff;
        }

    </style>


    <link rel="stylesheet" type="text/css"
          href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css"/>

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>
    <?php
    $debt0Setting=$ticketInfo->debt_settings[0];
    $debt1Setting=$ticketInfo->debt_settings[1];
    $debt2Setting=$ticketInfo->debt_settings[2];
    $debt3Setting=$ticketInfo->debt_settings[3];
    $debt4Setting=$ticketInfo->debt_settings[4];
    $debt5Setting=$ticketInfo->debt_settings[5];
    ?>
    @include('dashboard.component.dept_config',['ticketInfo'=>$ticketInfo])
    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="ticketFrm" enctype="multipart/form-data">
            @csrf
            <div class="row white-row">

                <div class="col-sm-12 col-md-6">
                    <div class="card leftSide">

                        @include('dashboard.component.ticketHeader',['ticketInfo'=>$ticketInfo])
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'اسم المركبة' }}
                                                        </span>
                                                    </div>
                                                    <input type="hidden" id="vehicle_name" name="vehicle_name"
                                                           value="0">

                                                    <select class="form-control" name="vehicle_id" id="vehicle_id"
                                                            onchange="putVehiclName();">
                                                        <option value="">{{ 'اختر' }} </option>
                                                        @foreach($vehicles as $vehicle)
                                                            <option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم المركبة' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="vehicle_no"
                                                           class="form-control numFeild"
                                                           placeholder="{{ 'رقم المركبة' }}"
                                                           name="vehicle_no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="app_type" name="app_type" value="5">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">

                                    @include('dashboard.includes.maldesc_ticket',['name_maldesc'=>'وصف الصيانة المطلوبة'])
                                </div>
                            </div>

                        </div>

                        @include('dashboard.includes.attachment')
                    </div>
                </div>
                @include('dashboard.includes.forward')
            </div>
        </form>
    </section>

    @include('dashboard.component.fetch_Task_table')
    @include('dashboard.component.ticket_config',['ticketInfo'=>$ticketInfo,'department'=>$department])






    <script>
      function putVehiclName() {
        document.getElementById("vehicle_name").value = $("#vehicle_id option:selected").text();

        $.ajax({

          type: 'get', // the method (could be GET btw)

          url: "vehcile_info",

          data: {

            vehcile_id: $("#vehicle_id").val(),

          },

          success: function (response) {

            $("#vehicle_no").val(response.info.serial_number)
          },

        });
      }

      $(document).ready(function () {

        $("#vehicle_name").autocomplete({
          source: 'vehicle_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#vehicle_id").val(ui.item.id)
            $("#vehicle_no").val(ui.item.serial_number)
          }
        });


        $('#ticketFrm').submit(function (e) {

          e.preventDefault();
          if ((validateAttachments()??false)) {
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          $("#vehicle_name").removeClass("error");
          $("#vehicle_id").removeClass("error");
          $("#malDesc").removeClass("error");
          let formData = new FormData(this);
          $.ajax({
            type: 'POST',
            url: "saveTicket37",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
              $(".form-actions").removeClass('hide');
              $('.wtbl').DataTable().ajax.reload();
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

                writeUserData('viewTicket/' + response.app_id + '/' + response.app_type)
                if (print == true) {
                  let url = `{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
                  window.open(url, '_blank');
                  print = false;
                }
                setTimeout(function () {
                  self.location = '{{asset('/ar/admin')}}'
                }, 1500)
                this.reset();
                // if(print==true){
                //             self.location=`{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
                //             print=false;
                // }
                //             writeUserData('viewTicket/'+response.app_id+'/'+response.app_type)
                //     				setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
                //           this.reset();
              } else {
                console.log(response.error);
                if (response.error == 'no_attatch') {

                  $(".attachName").addClass('error');
                  Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'أدخل المرفقات',
                    showConfirmButton: true,
                    timer: 2000
                  })
                  $(".loader").addClass('hide');
                  return false;
                }
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
              if (response.responseJSON.errors.vehicle_name) {
                $("#vehicle_name").addClass("error");
                $("#vehicle_name").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $("#vehicle_name").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.vehicle_id) {
                $("#vehicle_name").addClass("error");
                $("#vehicle_name").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $("#vehicle_name").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.malDesc) {
                $("#malDesc").addClass("error");
                $("#malDesc").get(0).setCustomValidity('أدخل سبب الاجازة ');
                $("#malDesc").on('blur', function () {
                  this.setCustomValidity('')
                })
              }
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

