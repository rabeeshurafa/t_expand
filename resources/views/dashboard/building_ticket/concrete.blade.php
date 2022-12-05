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

        .phoneDiv {
            padding-left: 0px !important;
        }

        .engOfficeDiv {
            padding-left: 51px;
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

                <div class="col-sm-12 col-md-6">
                    <div class="card leftSide">
                        @include('dashboard.component.ticketHeader',['ticketInfo'=>$ticketInfo])
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    @include('dashboard.includes.wasel')
                                    <div class="row">
                                        <div class="col-md-4" style=" ">
                                            <div class="form-group paddmob">
                                                <div class="input-group" style=" ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            طبيعة العمل
                                                        </span>
                                                    </div>
                                                    <select id="workType" name="workType" type="text"
                                                            class="form-control valid workType" aria-invalid="false">
                                                        <option> {{ '-- اختر --' }} </option>
                                                        @foreach($workTypeList as $workType)
                                                            <option value="{{ $workType->id }}">{{ $workType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hidemob"
                                                         onclick="ShowConstantModal(6268,'workType','طبيعة العمل')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="app_type" name="app_type" value="3">
                                    <input type="hidden" id="is_lic_defined" name="is_lic_defined" value="0">

                                    <input type="hidden" id="buildingStatus" name="buildingStatus" value="0">
                                    @include('dashboard.includes.subscriber')

                                    <div class="row" style="position: relative; ">
                                        @if($ticketInfo->show_nationalID == 1)
                                            <div class="col-lg-4 col-md-12 pr-s-12">
                                                <div class="form-group paddmob">
                                                    <div class="input-group subscribermob">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الهوية' }}
                                                        </span>
                                                        </div>
                                                        <input type="text" id="national_id" maxlength="9" minlength="9"
                                                               class="form-control numFeild"
                                                               placeholder="{{ 'رقم الهوية' }}"
                                                               @if(isset($ticket))
                                                                   value="{{ $ticket->national_id }}"
                                                               readonly
                                                               @endif
                                                               name="national_id">

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-lg-3 col-md-12 pr-s-12"
                                             style="padding-left: 23px;padding-right: 0px;">
                                            <div class="form-group">
                                                <div class="input-group licNoGroup" id="licGroup">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الرخصة' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="licNo" name="licNo"
                                                           class="form-control" placeholder="0000"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'رقم قرار الترخيص' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="licDecisionNo" name="licDecisionNo"
                                                           class="form-control" placeholder="0000"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 pr-s-12">
                                            <div class="form-group paddmob">
                                                <div class="input-group subscribermob">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'رقم الحوض' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="hodNo" name="hodNo"
                                                           class="form-control" placeholder="0000"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 pr-s-12"
                                             style="padding-left: 23px;padding-right: 0px;">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'رقم القطعة' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="pieceNo" name="pieceNo"
                                                           class="form-control" placeholder="0000"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'نوع المبني' }}
                                                        </span>
                                                    </div>

                                                    <select id="buildingType" name="buildingType" type="text"
                                                            class="form-control valid buildingType"
                                                            aria-invalid="false">
                                                        <option> {{ '-- اختر --' }} </option>
                                                        @foreach($buildingTypes as $buildingType)
                                                            <option value="{{ $buildingType->id }}">{{ $buildingType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hidemob"
                                                         onclick="ShowConstantModal(6016,'buildingType','نوع البناء')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('dashboard.includes.regionsTemplate')
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md attachs-section" style="margin-left:25px; margin-right: 25px ">
                                {{--<img src="https://db.expand.ps/images/neighbor.png" width="40" height="40">--}}
                                <span class="attach-header">
                                    {{"تفاصيل العمل"}}
                                </span>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-left: 25px">
                            <div class="col-lg-4 col-md-12 pr-s-12">
                                <div class="form-group paddmob">
                                    <div class="input-group subscribermob">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1">
                                                {{ 'اليوم' }}
                                            </span>
                                        </div>
                                        <input type="text" id="day" name="day"
                                               class="form-control" placeholder="السبت"
                                               aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 23px;padding-right: 0px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1">
                                                {{ 'التاريخ' }}
                                            </span>
                                        </div>
                                        <input type="text" id="date" name="date"
                                               class="form-control" data-mask="00/00/0000" placeholder="00/00/0000"
                                               aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pr-s-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1">
                                                {{ 'الوقت' }}
                                            </span>
                                        </div>
                                        <input type="text" id="time" name="time"
                                               class="form-control" placeholder=""
                                               aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-left: 25px">
                            <div class="col-md-7">
                                <div class="form-group paddmob">
                                    <div class="input-group" style="width: 94.6% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1">
                                                الشركة المنفذة 
                                            </span>
                                        </div>
                                        <select id="implementedCompany" name="implementedCompany" type="text"
                                                class="form-control valid implementedCompany" aria-invalid="false">
                                            <option> {{ '-- اختر --' }} </option>
                                            @foreach($componyList as $compony)
                                                <option value="{{ $compony->id }}">{{ $compony->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append hidemob"
                                             onclick="ShowConstantModal(6269,'implementedCompany','الشركة المنفذة')">
                                            <span class="input-group-text input-group-text2">
                                                <i class="fa fa-external-link"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pr-s-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1">
                                                {{ 'الزمن المتوقع' }}
                                            </span>
                                        </div>
                                        <input type="text" id="duration" name="duration"
                                               class="form-control" placeholder=""
                                               aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-right: 25px; padding-left: 25px">
                            <div class="col-md-7">
                                <div class="form-group paddmob">
                                    <div class="input-group" style="width: 94.6% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text " id="basic-addon1">
                                                المكتب الهندسي/ الشركة
                                            </span>
                                        </div>
                                        <select id="engOffice" name="engOffice" type="text"
                                                class="form-control valid engOffice" aria-invalid="false">
                                            <option> {{ '-- اختر --' }} </option>
                                            @foreach($officeAreaList as $officeArea)
                                                <option value="{{ $officeArea->id }}">{{ $officeArea->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append hidemob"
                                             onclick="ShowConstantModal(6272,'engOffice','المكتب الهندسي')">
                                            <span class="input-group-text input-group-text2">
                                                <i class="fa fa-external-link"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('dashboard.includes.costs',['ticketInfo'=>$ticketInfo,'department'=>$department])
                        @include('dashboard.includes.attachment')

                    </div>
                </div>
                @include('dashboard.includes.forward')
            </div>
        </form>
    </section>

    @include('dashboard.component.ticket_config',['ticketInfo'=>$ticketInfo,'department'=>$department])
    @include('dashboard.component.tasks_table')
    @include('dashboard.component.fetch_Task_table')


    <script>
      var lics = new Array();

      function setLicenceData() {
        $('#hodNo').val('');
        $('#pieceNo').val('');
        for (i = 0; i < lics.length; i++) {
          if ($('#licNo').val() == lics[i]['id']) {
            $('#hodNo').val(lics[i]['hodNo']);
            $('#pieceNo').val(lics[i]['pieceNo']);
            $('#licDecisionNo').val(lics[i]['licDecisionNo']);
          }

        }
      }

      $(document).ready(function () {

        $("#subscriber_name").autocomplete({
          source: 'subscribe_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#subscriber_id").val(ui.item.id)
            $('#is_lic_defined').val(0);
            $('#hodNo').val('');
            $('#pieceNo').val('');
            getFullData(ui.item.id)

            subscriber_id = ui.item.id;

            $.ajax({

              type: 'get', // the method (could be GET btw)

              url: "{{route('license_info_byUser')}}",
              data: {

                subscriber_id: subscriber_id,

              },
              success: function (response) {

                template = ""

                count = 0;

                $('#licNo').remove('');

                if (response.info.length > 0) {
                  lics = new Array();
                  template += '<select onchange="setLicenceData(); ' + "$('#is_lic_defined').val(1);" + '" class="form-control" name="licNo" id="licNo">'

                  template += '<option value="">-- اختر --</option>'

                  response.info.forEach(licence => {
                    licDecisionNo = '';
                    if (licence.bSeatNoList != null) {
                      lastDecisionIndex = JSON.parse(licence.bSeatNoList).length - 1;
                      if (lastDecisionIndex >= 0) {
                        licDecisionNo = JSON.parse(licence.bSeatNoList)[lastDecisionIndex];
                      }
                    }
                    lic = {
                      'hodNo': (licence.hodNo ?? ''),
                      'pieceNo': (licence.peiceNo ?? ''),
                      'id': (licence.id ?? ''),
                      'licDecisionNo': (licDecisionNo),
                    }
                    // console.log(JSON.parse(licence.bSeatNoList));
                    lics.push(lic);
                    count++;

                    template += '<option value="' + licence.id + '"> ' + (licence.licNo ?? 'بدون') + '</option>'


                  });
                  template += '</select>'

                } else {

                  template += '<input type="text" id="licNo" name="licNo" class="form-control eng-sm  valid" value="" placeholder="" autocomplete="off">'

                }

                $('#licGroup').append(template);


              },

            });
            if ({{$ticketInfo->apps_btn}} == 1)
              getSubscriberTasks(ui.item.id)
          }
        });


        $('#ticketFrm').submit(function (e) {
          e.preventDefault();
          if ((validateAttachments()??false)) {
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          $("#subscriber_name").removeClass("error");
          $("#subscriber_id").removeClass("error");
          $("#MobileNo").removeClass("error");
          $("#AreaID").removeClass("error");
          $("#hodNo").removeClass("error");
          $("#pieceNo").removeClass("error");
          $("#engOffice").removeClass("error");
          $("#buildingType").removeClass("error");
          let formData = new FormData(this);
          $.ajax({
            type: 'POST',
            url: "{{ route('saveTicket39') }}",
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

//             if(print==true){
//                 self.location=`{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
//                 print=false;
// 				}
// writeUserData('viewTicket/'+response.app_id+'/'+response.app_type)
//         				setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
//               this.reset();
              } else {
                console.log(response.error);
                if (response.error == 'no_nationalID') {

                  $("#national_id").addClass('error');
                  Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'أدخل رقم الهوية',
                    showConfirmButton: true,
                    timer: 2000
                  })
                  $(".loader").addClass('hide');
                  return false;
                }
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
              if (response.responseJSON.errors.subscriber_name) {
                $("#subscriber_name").addClass("error");
                $("#subscriber_name").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $("#subscriber_name").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.subscriber_id) {
                $("#subscriber_name").addClass("error");
                $("#subscriber_name").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $("#subscriber_name").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.MobileNo) {
                $("#MobileNo").addClass("error");
                $("#MobileNo").get(0).setCustomValidity('أدخل رقم جوال ');
                $("#MobileNo").on('blur', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.AreaID) {
                $("#AreaID").addClass("error");
                $("#AreaID").get(0).setCustomValidity('يرجى اختيار منطقة ');
                $("#AreaID").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.hodNo) {
                $("#hodNo").addClass("error");
                $("#hodNo").get(0).setCustomValidity('يرجى ادخال رقم الحوض ');
                $("#hodNo").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.pieceNo) {
                $("#pieceNo").addClass("error");
                $("#pieceNo").get(0).setCustomValidity('يرجى ادخال رقم القطعة ');
                $("#pieceNo").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.engOffice) {
                $("#engOffice").addClass("error");
                $("#engOffice").get(0).setCustomValidity('يرجى اختيار مكتب مساحة ');
                $("#engOffice").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.buildingType) {
                $("#buildingType").addClass("error");
                $("#buildingType").get(0).setCustomValidity('يرجى اختيار نوع البناء ');
                $("#buildingType").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.date) {
                $("#date").addClass("error");
                $("#date").get(0).setCustomValidity('يرجى ادخال التاريخ');
                $("#date").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.day) {
                $("#day").addClass("error");
                $("#day").get(0).setCustomValidity('يرجى ادخال اليوم');
                $("#day").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.duration) {
                $("#duration").addClass("error");
                $("#duration").get(0).setCustomValidity('يرجى ادخال الزمن المتوقع');
                $("#duration").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.implementedCompany) {
                $("#implementedCompany").addClass("error");
                $("#implementedCompany").get(0).setCustomValidity('يرجى ادخال الزمن الشركة المنفذة');
                $("#implementedCompany").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.licDecisionNo) {
                $("#licDecisionNo").addClass("error");
                $("#licDecisionNo").get(0).setCustomValidity('يرجى ادخال رقم قرار الترخيص');
                $("#licDecisionNo").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.licNo) {
                $("#licNo").addClass("error");
                $("#licNo").get(0).setCustomValidity('يرجى ادخال رقم الرخصة');
                $("#licNo").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.licNo) {
                $("#licNo").addClass("error");
                $("#licNo").get(0).setCustomValidity('يرجى ادخال رقم الرخصة');
                $("#licNo").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.time) {
                $("#time").addClass("error");
                $("#time").get(0).setCustomValidity('يرجى ادخال الوقت');
                $("#time").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.workType) {
                $("#workType").addClass("error");
                $("#workType").get(0).setCustomValidity('يرجى ادخال طبيعة العمل');
                $("#workType").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.AreaID) {
                $("#AreaID").addClass("error");
                $("#AreaID").get(0).setCustomValidity('يرجى ادخال المنطقة');
                $("#AreaID").on('input', function () {
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

      function getFullData(id) {

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')

          }

        });
        formData = {'id': id}
        $.ajax({
          type: 'POST',
          url: "appCustomer",
          data: formData,
          /*contentType: false,
          processData: false,*/
          success: (response) => {
            if (response) {
              srch = response.phone_one == null ? (response.phone_two == null ? '' : response.phone_two) : response.phone_one
              if (srch.search("056") >= 0)
                $('#mobImg').attr('src', '{{asset('assets/images/w35.png')}}');
              else
                $('#mobImg').attr('src', '{{asset('assets/images/jawwal35.png')}}');
              $('#MobileNo').val(response.phone_one == null ? (response.phone_two == null ? '' : response.phone_two) : response.phone_one)
              $('#national_id').val((response.national_id ?? ''))
              $(".loader").addClass('hide');
              if (response.warning.length != 0) {
                $(".btnArea").addClass("hide");
                warningText = '  المواطن لديه اخطار';
                for (i = 0; i < response.warning.length; i++) {
                  warningOpj = response.warning[i];
                  if (response.warning.length != 1 && i >= 1) {
                    warningText += ' - ';
                  }
                  warningText += warningOpj.type.name;
                  warningText += ' بسبب ';
                  warningText += warningOpj.warning_reason;
                  warningText += ' يرجى مراجعة قسم ';
                  warningText += warningOpj.dept.name;
                }

                Swal.fire({
                  title: 'لايمكن تقديم الطلب',
                  text: warningText,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'متابعة الطلب',
                  cancelButtonText: 'الغاء الطلب',
                }).then((result) => {
                  if (result.isConfirmed) {
                    $(".btnArea").removeClass("hide");
                  } else {
                    setTimeout(function () {
                      self.location = '{{asset('/ar/admin')}}'
                    }, 1500)
                  }
                })
              }
              getCert(response.id, response.archive.certCount);
                @can('subscriberContractArchive')
                getContractArchive(response.id, response.archive.contractArchiveCount);
                @endcan

                @can('subscriberLicArchive')
                getLicArchive(response.id, response.archive.licArchiveCount);
                @endcan

                @can('subscriberOutArchive')
                getOutArchive(response.id, response.archive.outArchiveCount);
                @endcan

                @can('subscriberInArchive')
                getInArchive(response.id, response.archive.inArchiveCount);
                @endcan

                @can('subscriberOtherArchive')
                getOtherArchive(response.id, response.archive.otherArchiveCount);
                @endcan

                @can('subscriberCopyArchive')
                getCopyArchive(response.id, response.archive.copyToCount);
                @endcan

                @can('subscriberJalArchive')
                getJalArchive(response.id, response.archive.linkToCount);
                @endcan
            }

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

      $(document).ready(function () {

        $("#requieredAttatch").on("blur keypress", "#plusRequieredAttach", function () {
          if ($(".attatchName").last().val().length > 0) {
            lastC1 = $("#attachReceive1N").val();
            $("#requieredAttatch").append(''
              + '<tr>'
              + '<td class="col-md-1">'
              + '<input type="checkbox" value="' + lastC1 + '" name="attachReceive[]"  class="condition">'
              + '</td>'
              + '<td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >'
              + '<input class="form-control attatchName"  type="text" name="attatchName[]"  >'
              + '</td>'
              + '<td onclick="$(this).parent().remove()" >'
              + '<i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor:pointer;  color:#1E9FF2;font-size: 15pt; "></i>'
              + '</td>'
              + '</tr>'
            );
            $("#attachReceive1N").val(++lastC1);
          }
        });
      });

      function getSubscriberTasks(id) {

        let subscribe_id = id;

        $.ajax({

          type: 'get',

          url: "subscriber_tasks",

          data: {

            subscribe_id: subscribe_id,

          },

          success: function (response) {

            if (response.status != false) {

              drawtasks(response.tikets);

            } else {
              Swal.fire({

                position: 'top-center',

                icon: 'error',

                title: 'لايوجد طلبات لهاذا المواطن',

                showConfirmButton: false,

                timer: 1500

              })
            }
          },

        });

      }

      $(function () {
        var table = $('.tasktbl1').DataTable({
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
      });
      $(function () {
        var table = $('.tasktbl2').DataTable({
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
      });
      $(function () {
        var table = $('.tasktbl3').DataTable({
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
      });
      $(function () {
        var table = $('.tasktbl4').DataTable({
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
      });

      function drawtasks($tickets) {

        if ($.fn.DataTable.isDataTable('.tasktbl1')) {

          $(".tasktbl1").dataTable().fnDestroy();

          $('#cMyTask1').empty();

        }
        if ($.fn.DataTable.isDataTable('.tasktbl2')) {

          $(".tasktbl2").dataTable().fnDestroy();

          $('#cMyTask2').empty();

        }
        if ($.fn.DataTable.isDataTable('.tasktbl3')) {

          $(".tasktbl3").dataTable().fnDestroy();

          $('#cMyTask3').empty();

        }
        if ($.fn.DataTable.isDataTable('.tasktbl4')) {

          $(".tasktbl4").dataTable().fnDestroy();

          $('#cMyTask4').empty();

        }

        engCount = 0;
        waterCount = 0;
        elecCount = 0;
        otherCount = 0;

        for (i = 0; i < $tickets.length; i++) {
          taskRow = '';
          link = '/admin/viewTicket/' + $tickets[i]['trans']['ticket_id'] + '/' + $tickets[i]['trans']['related'];
          if ($tickets[i]['0']['app_type'] == 1) {
            elecCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + elecCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask2').append(taskRow);
          }
          if ($tickets[i]['0']['app_type'] == 2) {
            waterCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + waterCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask3').append(taskRow);
          }
          if ($tickets[i]['0']['app_type'] == 3) {
            engCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + engCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask1').append(taskRow);
          }
          if ($tickets[i]['0']['app_type'] == 4 || $tickets[i]['0']['app_type'] == 5) {
            otherCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + otherCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask4').append(taskRow);
          }
        }

        $('#ctabCnt1').html(engCount);
        $('#ctabCnt2').html(elecCount);
        $('#ctabCnt3').html(waterCount);
        $('#ctabCnt4').html(otherCount);

        $('.tasktbl1').DataTable({
          dom: 'Bfltip',
          buttons: [{
            extend: 'excel',
            tag: 'img',
            title: '',
            attr: {
              title: 'excel',
              src: '{{ asset('assets/images/ico/excel.png') }}',
              style: 'cursor:pointer;height: 32px;',
            },

          },
            {
              extend: 'print',
              tag: 'img',
              title: '',
              attr: {
                title: 'print',
                src: '{{ asset('assets/images/ico/Printer.png') }} ',
                style: 'cursor:pointer;height: 32px;',
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
        $('.tasktbl2').DataTable({
          dom: 'Bfltip',
          buttons: [{
            extend: 'excel',
            tag: 'img',
            title: '',
            attr: {
              title: 'excel',
              src: '{{ asset('assets/images/ico/excel.png') }}',
              style: 'cursor:pointer;height: 32px;',
            },

          },
            {
              extend: 'print',
              tag: 'img',
              title: '',
              attr: {
                title: 'print',
                src: '{{ asset('assets/images/ico/Printer.png') }} ',
                style: 'cursor:pointer;height: 32px;',
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
        $('.tasktbl3').DataTable({
          dom: 'Bfltip',
          buttons: [{
            extend: 'excel',
            tag: 'img',
            title: '',
            attr: {
              title: 'excel',
              src: '{{ asset('assets/images/ico/excel.png') }}',
              style: 'cursor:pointer;height: 32px;',
            },

          },
            {
              extend: 'print',
              tag: 'img',
              title: '',
              attr: {
                title: 'print',
                src: '{{ asset('assets/images/ico/Printer.png') }} ',
                style: 'cursor:pointer;height: 32px;',
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
        $('.tasktbl4').DataTable({
          dom: 'Bfltip',
          buttons: [{
            extend: 'excel',
            tag: 'img',
            title: '',
            attr: {
              title: 'excel',
              src: '{{ asset('assets/images/ico/excel.png') }}',
              style: 'cursor:pointer;height: 32px;',
            },

          },
            {
              extend: 'print',
              tag: 'img',
              title: '',
              attr: {
                title: 'print',
                src: '{{ asset('assets/images/ico/Printer.png') }} ',
                style: 'cursor:pointer;height: 32px;',
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

      }
    </script>
@stop

