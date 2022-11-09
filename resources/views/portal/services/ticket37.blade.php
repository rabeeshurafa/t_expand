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

        .phoneDiv {
            padding-left: 0px;
        }

    </style>


    <link rel="stylesheet" type="text/css"
          href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css"/>

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>
    <section class="horizontal-grid" id="horizontal-grid">
        <form method="post" id="ticketFrm" enctype="multipart/form-data">
            @csrf
            <div class="row  white-row">
                <div class="col-sm-12 col-md-12">
                    <div class="card leftSide">
                        @include('portal.includes.ticketHeader')
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1">
															نوع الطلب
														</span>
                                                    </div>
                                                    <select class="form-control subscriptionType" name="task_type"
                                                            id="task_type">
                                                        @foreach($ticketTypeList as $sub)
                                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('portal.includes.subscriber')
                                    <input type="hidden" id="app_type" name="app_type" value="1">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="app_no" name="app_no" value="{{$app_no}}">
                                    <input type="hidden" id="rec_id" name="rec_id"
                                           value="{{$ticketInfo->emp_to_access_portal}}">
                                    @include('portal.includes.regionsTemplate')
                                    @include('portal.includes.maldesc_ticket',['name_maldesc'=>'سبب الطلب'])
                                    @include('portal.includes.forward')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


    <script>

        $(document).ready(function () {

            $("#subscriber_name").autocomplete({
                source: '{{route("portal_auto_complete")}}',
                minLength: 1,
                select: function (event, ui) {
                    $("#subscriber_id").val(ui.item.id)
                }
            });

            $('#ticketFrm').submit(function (e) {
                $(".loader").removeClass('hide');

                e.preventDefault();
                $("#subscriber_name").removeClass("error");
                $("#subscriber_id").removeClass("error");
                $("#MobileNo").removeClass("error");
                $("#AreaID").removeClass("error");
                $("#task_type").removeClass("error");
                $("#malDesc").removeClass("error");
                let formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route("portal_saveTicket12")}}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response.success != null) {
                            $(".loader").addClass('hide');
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: '{{trans('admin.data_added')}}',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#subscriber_id").val('')
                            this.reset();

                        } else {
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

                    },
                    error: function (response) {
                        $(".loader").addClass('hide');

                        if (response.responseJSON.errors.subscriber_name) {
                            $("#subscriber_name").addClass("error");
                            $("#subscriber_name").get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                            $("#subscriber_name").on('input', function () {
                                this.setCustomValidity('')
                            })
                        }
                        if (response.responseJSON.errors.subscriber_id) {
                            $("#subscriber_id").addClass("error");
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
                        if (response.responseJSON.errors.task_type) {
                            $("#task_type").addClass("error");
                            $("#task_type").get(0).setCustomValidity('يرجى اختيار نوع الطلب ');
                            $("#task_type").on('input', function () {
                                this.setCustomValidity('')
                            })
                        }
                        if (response.responseJSON.errors.malDesc) {
                            $("#malDesc").addClass("error");
                            $("#malDesc").get(0).setCustomValidity('يرجى ادخال سبب الطلب ');
                            $("#malDesc").on('input', function () {
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

