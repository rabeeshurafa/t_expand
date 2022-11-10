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

        .rate:not(:checked)>label {
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

        .detailsTB th {
            color: #ffffff !important;
        }

    </style>


    <link rel="stylesheet" type="text/css"
        href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css" />

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>

    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="setting_form" enctype="multipart/form-data">
            @csrf
            <div class="row white-row">

                <div class="col-sm-12 col-lg-6 col-md-12">
                    <div class="card leftSide">
                        <div class="card-header">
                            <h4 class="card-title">
                                <img src="https://db.expand.ps/images/info.png" width="32" height="32">
                                ملفات الطابو
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-8">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            اسم الحوض
                                                        </span>
                                                    </div>
                                                    <input type="text" id="hod_name" required="" class="form-control"
                                                        placeholder="" name="hod_name" value="">
                                                    <input type="hidden" id="excelId"  name="excelId" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            رقم الحوض
                                                        </span>
                                                    </div>
                                                    <input type="text" id="hod_no" required="" class="form-control"
                                                        placeholder="" name="hod_no" value="">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <div class="input-group" style="width: 98% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            إختر الملف
                                                        </span>
                                                    </div>
                                                    <input type="file" id="file_tabo" accept="application/vnd.ms-excel" name="file_tabo">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="btn bg-success alert-icon-left alert-dismissible mb-2" role="alert"
                                                style="width: 100%;text-align: right;color:#ffffff;">
                                                <span class="alert-icon">
                                                    <i class="la la-thumbs-o-up"></i>
                                                </span>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong style="color:#ffffff">
                                                    تعليمات التحميل
                                                </strong>
                                                <ul>
                                                    <li>
                                                        يجب أن يكون الملف بإمتداد
                                                        <span
                                                            class="label label-lg label-light-danger label-inline">xls</span>
                                                    </li>
                                                    <li>
                                                        يجب مراعاة ترتيب الأعمدة كالتالي
                                                        <ol>
                                                            <li>
                                                                رقم القطعة المؤقت
                                                            </li>
                                                            <li>
                                                                اسم المالك
                                                            </li>
                                                            <li>
                                                                مساحة القطعة(متر مربع)
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions" style="border-top:0px;">
                                    <div class="text-right">
                                        <button type="button" onclick="upload();" class="btn btn-primary" name="addBtn">
                                            حفظ
                                            <i class="ft-thumbs-up position-right"></i></button>
                                        <button type="reset" onclick="$('#excelId').val(0);" class="btn btn-warning">
                                            اعادة تعيين
                                        <i class="ft-refresh-cw position-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6 col-md-12">
                    <div class="card rightSide">
                        <div class="card-header">
                            <h4 class="card-title">
                                <img src="https://db.expand.ps/images/maps-icon.png" width="32" height="32">
                                كشوفات طابو سابقة
                            </h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <table class="table wtbl">
                                    <tbody>
                                        <tr>
                                            <td>
                                                #
                                            </td>
                                            <td>
                                                الحوض
                                            </td>
                                            <td>
                                                <i class="fa fa-attach"></i>
                                                الرقم المؤقت
                                            </td>
                                            <td>
                                                <i class="fa fa-attach"></i>
                                                الرقم الدائم
                                            </td>
                                            <td>
                                                <i class="fa fa-attach"></i>
                                                حذف
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody id="excel">
                                        <?php  $i=1; ?>
                                        @foreach($taboExcels as $taboExcel)
                                        <tr>
                                            <td>
                                                {{$i++}}
                                            </td>
                                            <td>
                                                {{$taboExcel->hod_name}} ({{$taboExcel->hod_no}})
                                            </td>
                                            <td>
                                                <a href="{{asset('')}}{{$taboExcel->excel_path}}" target="_blank">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>
                                            @if($taboExcel->is_final==0)
                                            <td >
                                                <a  onclick="update({{$taboExcel->id}});" >
                                                    <i class="fa fa-upload" style="color: #1E9FF2;"></i>
                                                </a>
                                            </td>
                                            @else
                                            <td>
                                                <a href="{{asset('')}}{{$taboExcel->excel_path2}}" title="تحميل الملف">
                                                    <i class="fa fa-check"></i>
                                                </a>

                                            </td>
                                            @endif
                                            <td>
                                                <a  onclick="delete_Excel({{$taboExcel->id}})" style="margin-right:17px;">
                                                    <i class="fa fa-trash" style="color: #1E9FF2;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>




        </form>
    </section>


    {{-- @include('dashboard.component.fetch_table'); --}}


@stop
@section('script')

<script>

    function upload(){
        if($('#excelId').val()==0)
            doUploadExcel();
        else
            doUploadFinalExcel();
    }

    function doUploadExcel(){

	    $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(".loader").removeClass('hide');

        $(".form-actions").addClass('hide');

        var formData = new FormData($("#setting_form")[0]);

        $.ajax({

            url: 'uploadFile',

            type: 'POST',

            data: formData,

            dataType:"json",

            async: true,

            success: function (data) {
                if(data){
                    // console.log(data);
                    updateExcelTable();
                    $(".alert-danger").addClass("hide");

                    $(".alert-success").removeClass('hide');

                    //$("#userProfileImg").attr('src', window.location.origin+'/'+data.url);

				    $("#userProfileImg").attr('src', "{{asset('')}}"+data.file.url);

                    $("#userimgpath").val(data.file.url);

                    $("#file_id").val(data.file.id);

                    $("#userimgpath").trigger('change')

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: '{{ trans('admin.data_added') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })



                }

                else {

                    $(".alert-success").addClass("hide");

                    $(".alert-danger").removeClass('hide');

                    $("#errMsg").text(data.status.msg)

                }

                $(".loader").addClass('hide');

                $(".form-actions").removeClass('hide');

            },

            error:function(){

                $(".alert-success").addClass("hide");

                $(".alert-danger").removeClass('hide');

                $("#errMsg").text(data.status.msg)

                $(".loader").addClass('hide');

                $(".form-actions").removeClass('hide');

            },

            cache: false,

            contentType: false,

            processData: false

        });

    }

    function doUploadFinalExcel(){

	    $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $(".loader").removeClass('hide');

        $(".form-actions").addClass('hide');

        var formData = new FormData($("#setting_form")[0]);

        $.ajax({

            url: 'uploadFinalFile',

            type: 'POST',

            data: formData,

            dataType:"json",

            async: true,

            success: function (data) {

                if(data){
                    // console.log(data);

                    updateExcelTable();
                    $(".alert-danger").addClass("hide");

                    $(".alert-success").removeClass('hide');

                    //$("#userProfileImg").attr('src', window.location.origin+'/'+data.url);

				    $("#userProfileImg").attr('src', "{{asset('')}}"+data.file.url);

                    $("#userimgpath").val(data.file.url);

                    $("#file_id").val(data.file.id);

                    $("#userimgpath").trigger('change')

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: '{{ trans('admin.data_added') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })



                }

                else {

                    $(".alert-success").addClass("hide");

                    $(".alert-danger").removeClass('hide');

                    $("#errMsg").text(data.status.msg)

                }

                $(".loader").addClass('hide');

                $(".form-actions").removeClass('hide');

            },

            error:function(){

                $(".alert-success").addClass("hide");

                $(".alert-danger").removeClass('hide');

                $("#errMsg").text(data.status.msg)

                $(".loader").addClass('hide');

                $(".form-actions").removeClass('hide');

            },

            cache: false,

            contentType: false,

            processData: false

        });

    }

    function updateExcelTable(){
        $(".loader").removeClass('hide');

        $.ajax({

        type: 'get', // the method (could be GET btw)

        url: '{{route("getExcelInfo_all")}}',


            success:function(response){
                $(".loader").addClass('hide');
                Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: '{{ trans('admin.data_added') }}',

                        showConfirmButton: false,

                        timer: 1500

                })
                $('#excel').html('');
                rows='';
                for(i=0;i< response.length ; i++){
                    rows+=`<tr>
                            <td>
                                ${(i+1)}
                            </td>
                            <td>
                                ${response[i].hod_name} (${response[i].hod_no})
                            </td>
                            <td>
                                <a href="{{asset('')}}${response[i].excel_path}" target="_blank">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>`;
                            if(response[i].is_final==0){
                                rows+=`<td >
                                    <a  onclick="update(${response[i].id});">
                                        <i class="fa fa-upload" style="color: #1E9FF2;"></i>
                                    </a>
                                </td>`;

                            }else{
                                rows+=`<td>
                                    <a href="{{asset('')}}${response[i].excel_path2}" title="تحميل الملف">
                                        <i class="fa fa-check"></i>
                                    </a>

                                </td>`;
                            }
                            rows+=`<td>
                                <a  onclick="delete_Excel(${response[i].id})" style="margin-right:17px;">
                                    <i class="fa fa-trash" style="color: #1E9FF2;"></i>
                                </a>
                            </td>
                        </tr>`;

                }
                $('#excel').append(rows);
                $('#excelId').val(0);
                $("#setting_form")[0].reset();
            },

        });

    }

    function update($id){
        $(".loader").removeClass('hide');
        let id = $id;

        $.ajax({

        type: 'get', // the method (could be GET btw)

        url: '{{route("getExcelInfo")}}',

            data: {

                id: id,

            },

            success:function(response){
                $(".loader").addClass('hide');
                $('#hod_name').val(response.hod_name);
                $('#hod_no').val(response.hod_no);
                $('#excelId').val(response.id);
                window.scrollTo(0, 0);
            },

        });

    }

    function delete_Excel($id) {
            if(confirm('هل انت متاكد من حذف الحوض؟ لن يمكنك استرجاعه فيما بعد')){
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "deleteExcel",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');


                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: '{{ trans('admin.data_added') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })
                    $('#excel').html('');
                        rows='';
                        for(i=0;i< response.length ; i++){
                            rows+=`<tr>
                                    <td>
                                        ${(i+1)}
                                    </td>
                                    <td>
                                        ${response[i].hod_name} (${response[i].hod_no})
                                    </td>
                                    <td>
                                        <a href="{{asset('')}}${response[i].excel_path}" target="_blank">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>`;
                                    if(response[i].is_final==0){
                                        rows+=`<td >
                                            <a  onclick="update(${response[i].id});">
                                                <i class="fa fa-upload" style="color: #1E9FF2;"></i>
                                            </a>
                                        </td>`;

                                    }else{
                                        rows+=`<td>
                                            <a href="{{asset('')}}${response[i].excel_path2}" title="تحميل الملف">
                                                <i class="fa fa-check"></i>
                                            </a>

                                        </td>`;
                                    }
                                    rows+=`<td>
                                        <a  onclick="delete_Excel(${response[i].id})" style="margin-right:17px;">
                                            <i class="fa fa-trash" style="color: #1E9FF2;"></i>
                                        </a>
                                    </td>
                                </tr>`;

                        }
                        $('#excel').append(rows);
                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    $("#formDataNameAR").on('keyup', function(e) {

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
