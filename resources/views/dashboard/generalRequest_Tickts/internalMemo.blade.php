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
                                        <div class="col-md-3">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'العام' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="year"
                                                           class="form-control numFeild" placeholder="{{ 'العام' }}"
                                                           name="year" value="<?php echo date('Y')?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'الرقم' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="app_no"
                                                           class="form-control numFeild" placeholder="{{ 'الرقم' }}"
                                                           name="app_no" value="{{$max}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'الموضوع' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="topic"
                                                           class="form-control numFeild" placeholder="{{ 'الموضوع' }}"
                                                           name="topic">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'من' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="subscriber_name"
                                                           class="form-control numFeild"
                                                           placeholder="{{ 'اسم الموظف' }}"
                                                           name="subscriber_name">
                                                    <input type="hidden" id="subscriber_id" name="subscriber_id"
                                                           value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'المسمي الوظيفي' }}
                                                        </span>
                                                    </div>
                                                    <select class="form-control position" disabled name="position"
                                                            id="position">
                                                        <option value="">
                                                            {{ 'المسمي الوظيفي' }}
                                                        </option>
                                                        @foreach($positions as $position)
                                                            <option value="{{$position->id}}">{{$position->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'الي' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="subscriber_name1"
                                                           class="form-control numFeild"
                                                           placeholder="{{ 'اسم الموظف' }}"
                                                           name="subscriber_name1">
                                                    <input type="hidden" id="subscriber_id1" name="subscriber_id1"
                                                           value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group w-96">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'المسمي الوظيفي' }}
                                                        </span>
                                                    </div>
                                                    <select class="form-control position1" disabled name="position1"
                                                            id="position1">
                                                        <option value="">
                                                            {{ 'المسمي الوظيفي' }}
                                                        </option>
                                                        @foreach($positions as $position)
                                                            <option value="{{$position->id}}">{{$position->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="app_type" name="app_type" value="5">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">

                                    <div class="row mobRow">
                                        <div class="col-md-12 paddzeromob">
                                            <div class="form-group">
                                                <div class="input-group"
                                                     style="padding-left: 0px; width: 100% !important;">
                                                    <h5 class="sub-head" style="color:#ff9149">
                                                        <b>
                                                            @if(isset($name_maldesc))
                                                                {{$name_maldesc}}
                                                            @else
                                                                {{ 'الموضوع' }}
                                                            @endif
                                                        </b>
                                                    </h5>
                                                    <br>
                                                    <textarea type="text" id="malDesc" class="form-control"
                                                              placeholder="{{isset($name_maldesc)?$name_maldesc:'الموضوع'}}"
                                                              name="malDesc"
                                                              style="width:100% ; border-radius:5px !important;height: 200px;"
                                                              aria-invalid="false">@if(isset($ticket))
                                                            {{ $ticket->malDesc }}
                                                        @else
                                                            بالإشارة إلى الموضوع أعلاه
                                                        @endif</textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

      $(document).ready(function () {
        $("#subscriber_name").val('{{Auth()->user()->nick_name}}');
        $("#subscriber_id").val({{Auth()->user()->id}});
        $("#position").val({{Auth()->user()->job_title_id}});

        getArchive({{Auth()->user()->id}});

        $("#subscriber_name").autocomplete({
          source: 'emp_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#subscriber_id").val(ui.item.id)
            $("#position").val(ui.item.job_title_id)
            getArchive(ui.item.id);
          }
        });
        $("#subscriber_name1").autocomplete({
          source: 'emp_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#subscriber_id1").val(ui.item.id)
            $("#position1").val(ui.item.job_title_id)
          }
        });

        function getArchive($id) {

          let emp_id = $id;
          $.ajax({
            type: 'get', // the method (could be GET btw)
            url: "emp_info",
            data: {
              emp_id: emp_id,
            },
            success: function (response) {
              if (response.status != false) {

                  @can('empContractArchive')
                  getContractArchive(response.info.id, response.contractArchiveCount);
                // $archiveCount+=response.contractArchiveCount;
                  @endcan

                  @can('empOutArchive')
                  getOutArchive(response.info.id, response.outArchiveCount);
                // $archiveCount+=response.outArchiveCount;
                  @endcan

                  @can('empInArchive')
                  getInArchive(response.info.id, response.inArchiveCount);
                // $archiveCount+=response.inArchiveCount;
                  @endcan

                  @can('empOtherArchive')
                  getOtherArchive(response.info.id, response.otherArchiveCount);
                // $archiveCount+=response.otherArchiveCount;
                  @endcan

                  @can('empCopyArchive')
                  getCopyArchive(response.info.id, response.copyToCount);
                // $archiveCount+=response.copyToCount;
                  @endcan

                  @can('empJalArchive')
                  getJalArchive(response.info.id, response.linkToCount);
                // $archiveCount+=response.linkToCount;
                  @endcan


              } else {
                // window.location = "{{route('deptNotAllowed')}}";
              }
            },
          });
        }

        $('#ticketFrm').submit(function (e) {
          e.preventDefault();
          if (validateAttachments()) {
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          $("#subscriber_name").removeClass("error");
          $("#subscriber_id").removeClass("error");
          $("#desc").removeClass("error");
          $("#vac_type").removeClass("error");
          let formData = new FormData(this);
          $.ajax({
            type: 'POST',
            url: "saveTicket44",
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
              if (response.responseJSON.errors.subscriber_name1) {
                $("#subscriber_name1").addClass("error");
                $("#subscriber_name1").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $("#subscriber_name1").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.subscriber_id1) {
                $("#subscriber_name1").addClass("error");
                $("#subscriber_name1").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $("#subscriber_name1").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.malDesc) {
                $("#malDesc").addClass("error");
                $("#malDesc").get(0).setCustomValidity('أدخل الموضوع  ');
                $("#malDesc").on('blur', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.year) {
                $("#year").addClass("error");
                $("#year").get(0).setCustomValidity('ادخل العام');
                $("#year").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.app_no) {
                $("#app_no").addClass("error");
                $("#app_no").get(0).setCustomValidity('ادخل رقم المذكرة');
                $("#app_no").on('input', function () {
                  this.setCustomValidity('')
                })
              }
              if (response.responseJSON.errors.topic) {
                $("#topic").addClass("error");
                $("#topic").get(0).setCustomValidity('ادخل الموضوع ');
                $("#topic").on('input', function () {
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

