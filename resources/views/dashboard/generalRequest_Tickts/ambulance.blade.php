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

        .w-m-84 {
            width: 84% !important;
        }

        .w-m-96 {
            width: 96% !important;
        }

        .w-m-97 {
            width: 97.7% !important;
        }

        @media (max-width: 767.98px) {
            .w-m-84, .w-m-96, .w-m-97 {
                width: 98% !important;
            }
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
                                    <input type="hidden" id="app_type" name="app_type" value="5">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">اليوم</span>
                                                    </div>
                                                    <input type="text" id="day" maxlength="10" name="day"
                                                           class="form-control singledate "
                                                           aria-describedby="basic-addon1" aria-invalid="false" value=""
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group w-m-84">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">التاريخ </span>
                                                    </div>
                                                    <input type="text" id="date" maxlength="10" data-mask="00/00/0000"
                                                           name="date"
                                                           class="form-control singledate " placeholder="dd/mm/yyyy"
                                                           aria-describedby="basic-addon1" aria-invalid="false"
                                                           value="<?php echo date('d/m/Y')?>" autocomplete="off"
                                                           onkeyup="getDay()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           اسم السائق
                                                       </span>
                                                    </div>
                                                    <input type="text" id="emp_name" name="emp_name"
                                                           class="form-control" aria-describedby="basic-addon1"
                                                           aria-invalid="false" autocomplete="off" value="حسن الفقيه">
                                                    <input type="hidden" id="emp_id" name="emp_id" value="163">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">اسم الممرض </span>
                                                    </div>
                                                    <select class="form-control nurse" name="nurse" id="nurse">
                                                        <option value="">{{ 'اسم الممرض' }} </option>
                                                        @foreach($nurses as $nurse)
                                                            <option value="{{$nurse->id}}">{{$nurse->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hideMob"
                                                         onclick="ShowConstantModal(6395,'nurse','الممرض')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'مقدم الطلب' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="subscriber_name"
                                                           class="form-control numFeild"
                                                           placeholder="{{ 'مقدم الطلب' }}"
                                                           name="subscriber_name">
                                                    <input type="hidden" id="subscriber_id" name="subscriber_id"
                                                           value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text input-group-text1"
                                                              id="basic-addon1">
                                                            <img id="mobImg"
                                                                 src="https://db.expand.ps/images/jawwal35.png">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="MobileNo" maxlength="10" name="MobileNo"
                                                           class="form-control noleft numFeild" placeholder="0590000000"
                                                           aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($ticketInfo->show_nationalID == 1)
                                        <div class="row">
                                            <div class="col-md-7 col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الهوية' }}
                                                        </span>
                                                        </div>
                                                        <input type="text" id="national_id" maxlength="9" minlength="9"
                                                               class="form-control numFeild"
                                                               placeholder="{{ 'رقم الهوية' }}"
                                                               name="national_id">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @include('dashboard.includes.regionsTemplate')
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
                                <span class="attach-header">
                                    {{ 'تفاصيل الحالة' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;padding-top: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        نقل الحالة من
                                                        </span>
                                                    </div>
                                                    <select class="form-control transfer_from" name="transfer_from"
                                                            id="transfer_from">
                                                        <option value="">{{ 'نقل الحالة من' }} </option>
                                                        @foreach($transfer_froms as $transfer_from)
                                                            <option
                                                                value="{{$transfer_from->id}}">{{$transfer_from->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hideMob"
                                                         onclick="ShowConstantModal(6396,'transfer_from','نقل من')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group w-m-96">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           الساعة
                                                       </span>
                                                    </div>
                                                    <input type="text" id="time" name="time" class="form-control"
                                                           data-mask="00:00" maxlength="5"
                                                           aria-describedby="basic-addon1" aria-invalid="false"
                                                           autocomplete="off" value="">
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
                                                        نقل الحالة إلى
                                                        </span>
                                                    </div>
                                                    <select class="form-control transfer_to" name="transfer_to"
                                                            id="transfer_to">
                                                        <option value="">{{ 'نقل الحالة إلى' }} </option>
                                                        @foreach($transfer_tos as $transfer_to)
                                                            <option
                                                                value="{{$transfer_to->id}}">{{$transfer_to->name}} </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hideMob"
                                                         onclick="ShowConstantModal(6397,'transfer_to','نقل إلى')">
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
                                                           ساعة الوصول
                                                       </span>
                                                    </div>
                                                    <input type="text" id="arrival_time" name="arrival_time"
                                                           class="form-control"
                                                           data-mask="00:00" maxlength="5"
                                                           aria-describedby="basic-addon1" aria-invalid="false"
                                                           autocomplete="off" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           ساعة المغادرة
                                                       </span>
                                                    </div>
                                                    <input type="text" id="Departure_time" name="Departure_time"
                                                           class="form-control" data-mask="00:00" maxlength="5"
                                                           aria-describedby="basic-addon1" aria-invalid="false"
                                                           autocomplete="off" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group w-m-97">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           نوع الحالة
                                                       </span>
                                                    </div>
                                                    <textarea type="text" id="status_type" class="form-control"
                                                              placeholder="نوع الحالة  "
                                                              name="status_type" style="height: 35px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
                                <span class="attach-header">
                                    {{ 'المطالبة المالية' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;padding-top: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           رقم المطالبة المالية
                                                       </span>
                                                    </div>
                                                    <input type="text" id="financial_no" name="financial_no"
                                                           class="form-control" aria-describedby="basic-addon1"
                                                           aria-invalid="false" autocomplete="off" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        المبلغ المطلوب
                                                        </span>
                                                    </div>
                                                    <select class="form-control" name="required_amount"
                                                            id="required_amount">
                                                        <option value="0">{{ 'اختر' }} </option>
                                                        <option value="100"> 100</option>
                                                        <option value="200"> 200</option>
                                                        <option value="300"> 300</option>
                                                        <option value="400"> 400</option>
                                                        <option value="500"> 500</option>
                                                        <option value="600"> 600</option>
                                                        <option value="700"> 700</option>
                                                        <option value="800"> 800</option>
                                                        <option value="900"> 900</option>
                                                        <option value="1000"> 1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           المبلغ المدفوع
                                                       </span>
                                                    </div>
                                                    <select class="form-control" name="paid_amount" id="paid_amount"
                                                            onchange="showVoucher();">
                                                        <option value="0">{{ 'اختر' }} </option>
                                                        <option value="100"> 100</option>
                                                        <option value="200"> 200</option>
                                                        <option value="300"> 300</option>
                                                        <option value="400"> 400</option>
                                                        <option value="500"> 500</option>
                                                        <option value="600"> 600</option>
                                                        <option value="700"> 700</option>
                                                        <option value="800"> 800</option>
                                                        <option value="900"> 900</option>
                                                        <option value="1000"> 1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row voucher hide">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           رقم الوصل
                                                       </span>
                                                    </div>
                                                    <input type="text" id="voucher_no" name="voucher_no"
                                                           class="form-control"
                                                           aria-describedby="basic-addon1" aria-invalid="false"
                                                           autocomplete="off" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                       <span class="input-group-text" id="basic-addon1">
                                                           تاريخ الوصل
                                                       </span>
                                                    </div>
                                                    <input type="text" id="voucher_date" name="voucher_date"
                                                           class="form-control"
                                                           maxlength="10" data-mask="00/00/0000"
                                                           placeholder="yyyy/mm/dd"
                                                           aria-describedby="basic-addon1" aria-invalid="false"
                                                           autocomplete="off" value="<?php echo date('d/m/Y')?>">
                                                </div>
                                            </div>
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

    @include('dashboard.component.fetch_Task_table')
    @include('dashboard.component.ticket_config',['ticketInfo'=>$ticketInfo,'department'=>$department])




    <script>
        function showVoucher() {
            if ($("#paid_amount").val() > 0) {
                $(".voucher").removeClass('hide');
            } else {
                $(".voucher").addClass('hide');
            }
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $(document).ready(function () {
            let ds = $('#date').val();
            var spt = ds.split('/');
            let d = spt[0];
            let m = spt[1];
            let y = spt[2];
            days = Array();
            days[0] = 'الأحد';
            days[1] = 'الإثنين';
            days[2] = 'الثلاثاء';
            days[3] = 'الأربعاء';
            days[4] = 'الخميس';
            days[5] = 'الجمعة';
            days[6] = 'السبت';
            d = new Date(m + '/' + d + '/' + y);
            let dss = days[d.getDay()];
            $('#day').val(dss);
        })

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        function getDay() {
            let ds = $('#date').val();
            var spt = ds.split('/');
            let d = spt[0];
            let m = spt[1];
            let y = spt[2];
            days = Array();
            days[0] = 'الأحد';
            days[1] = 'الإثنين';
            days[2] = 'الثلاثاء';
            days[3] = 'الأربعاء';
            days[4] = 'الخميس';
            days[5] = 'الجمعة';
            days[6] = 'السبت';
            d = new Date(m + '/' + d + '/' + y);
            let dss = days[d.getDay()];
            $('#day').val(dss);
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $(document).ready(function () {
            $("#emp_name").autocomplete({
                source: 'emp_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                    $("#emp_id").val(ui.item.id);
                }
            });

            $("#subscriber_name").autocomplete({
                source: 'subscribe_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                    $("#subscriber_id").val(ui.item.id)
                    getFullData(ui.item.id)

                    if ({{$ticketInfo->apps_btn}} == 1)
                        getSubscriberTasks(ui.item.id)

                }
            });

            $('#ticketFrm').submit(function (e) {
                e.preventDefault();
                $(".loader").removeClass('hide');
                $(".form-actions").addClass('hide');
                $("#subscriber_name").removeClass("error");
                $("#subscriber_id").removeClass("error");
                $("#MobileNo").removeClass("error");
                $("#AreaID").removeClass("error");
                // $( "#Address" ).removeClass( "error" );
                $("#subscriptionType").removeClass("error");
                let formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{route('saveTicket45')}}",
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
                            //             self.location=`{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
                            //             print=false;
                            // }
                            //             if(writeUserData('viewTicket/'+response.app_id+'/'+response.app_type))
                            //     				setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
                            //           this.reset();
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
                        // if(response.responseJSON.errors.Address){
                        //     $( "#Address" ).addClass( "error" );
                        // }
                        if (response.responseJSON.errors.subscriptionType) {
                            $("#subscriptionType").addClass("error");
                            $("#subscriptionType").get(0).setCustomValidity('يرجى اختيار نوع الاشتراك  ');
                            $("#subscriptionType").on('input', function () {
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
                url: "{{route('appCustomer')}}",
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
                        console.log(response.errorList.length)
                        if (response.errorList.length == 0) {
                            $(".btnArea").removeClass("hide");
                            //$(".errArea").addClass("hide");
                        } else {
                            $(".btnArea").addClass("hide");
                            //$(".errArea").removeClass("hide");
                            err = '<ul>'
                            for (i = 0; i < response.errorList.length; i++)
                                err += '<li style="font-size: 16px !important;font-weight: bold;">' + response.errorList[i] + "</li>";
                            err += '<ul>'
                            Swal.fire({
                                title: err,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'متابعة الطلب',
                                cancelButtonText: 'الغاء الطلب',
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    $(".btnArea").removeClass("hide");

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
                                    // Swal.fire('Saved!', '', 'success')
                                } else {
                                    setTimeout(function () {
                                        self.location = '{{asset('/ar/admin')}}'
                                    }, 1500)
                                }
                            })
                        }
                        if (response.warning.length != 0 && response.errorList.length == 0) {
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

        function getSubscriberTasks(id) {

            let subscribe_id = id;

            $.ajax({

                type: 'get',

                url: "{{route('subscriber_tasks')}}",

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

