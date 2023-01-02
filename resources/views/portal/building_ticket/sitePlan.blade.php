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
                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="app_type" name="app_type" value="3">
                                    <input type="hidden" id="rec_id"  name="rec_id" value="{{$ticketInfo->emp_to_access_portal}}">
                                    <input type="hidden" id="AreaID"  name="AreaID" value="0">
                                    @include('portal.includes.subscriber')

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="form-label"
                                                           style="color: #ff9149;"><b>{{ 'مقدم الطلب' }}</b>:</label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <label for="radio-3">{{"المالك"}} </label>
                                                        <input
                                                                type="radio" name="Applicanttype" checked=""
                                                                id="radio-3"
                                                                class="jui-radio-buttons" value="1"
                                                                onclick="$('.Acting').hide();">
                                                        <label for="radio-4">{{"ممثل عنه"}} </label>
                                                        <input
                                                                type="radio" name="Applicanttype" id="radio-4"
                                                                class="jui-radio-buttons" value="2"
                                                                onclick="$('.Acting').show();">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row Acting" style="position: relative; display: none;" id="Acting">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'مقدم الطلب' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="representative_name1"
                                                           class="form-control numFeild"
                                                           placeholder="{{ 'مقدم الطلب' }}"
                                                           name="representative_name1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <div class="input-group subscribermob">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الهوية' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="national_id1" maxlength="9" minlength="9"
                                                           class="form-control numFeild" placeholder="{{ 'رقم الهوية' }}"
                                                           name="national_id1">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <div class="input-group" >
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text input-group-text1" id="basic-addon1">
                                                            <img id="mobImg" src="https://db.expand.ps/images/w35.png">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="MobileNo1" maxlength="10" name="MobileNo1"
                                                           class="form-control noleft numFeild" placeholder="0590000000"
                                                           aria-describedby="basic-addon1"
                                                           onblur="$('#username').val($(this).val())">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
      function validate(){
        let error=false;
        if($('#subscriber_name1')?.val()?.trim()?.length<=0){
          $('#subscriber_name1').addClass('error');
          error=true;
        }else{
          $('#subscriber_name1').removeClass('error');
        }

        if($('#subscriber_name2')?.val()?.trim()?.length<=0){
          $('#subscriber_name2').addClass('error');
          error=true;
        }else{
          $('#subscriber_name2').removeClass('error');
        }

        if($('#subscriber_name3')?.val()?.trim()?.length<=0){
          $('#subscriber_name3').addClass('error');
          error=true;
        }else{
          $('#subscriber_name3').removeClass('error');
        }

        if($('#subscriber_name4')?.val()?.trim()?.length<=0){
          $('#subscriber_name4').addClass('error');
          error=true;
        }else{
          $('#subscriber_name4').removeClass('error');
        }

        if($('#national_id')?.val()?.trim()?.length<=0){
          $('#national_id').addClass('error');
          error=true;
        }else{
          $('#national_id').removeClass('error');
        }

        if($('#MobileNo')?.val()?.trim()?.length<=0){
          $('#MobileNo').addClass('error');
          error=true;
        }else{
          $('#MobileNo').removeClass('error');
        }
        return error;
      }
      $(document).ready(function () {

        $( "#subscriber_name" ).autocomplete({
          source:'{{route("portal_auto_complete")}}',
          minLength: 1,
          select: function( event, ui ) {
            $("#subscriber_id").val(ui.item.id)
          }
        });


        $('#ticketFrm').submit(function(e) {
          e.preventDefault();
          if(validate()){
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          $( "#subscriber_name1" ).removeClass( "error" );
          $( "#subscriber_name2" ).removeClass( "error" );
          $( "#subscriber_name3" ).removeClass( "error" );
          $( "#subscriber_name4" ).removeClass( "error" );
          $( "#subscriber_id" ).removeClass( "error" );
          $( "#MobileNo" ).removeClass( "error" );
          $( "#national_id" ).removeClass( "error" );
          let formData = new FormData(this);
          $.ajax({
            type:'POST',
            url: '{{route("portal_saveTicket21")}}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
              $(".form-actions").removeClass('hide');
              // console.log('response');
              if (response.success!=null) {
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

              }else{
                if(response.error=='no_attatch'){
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
            error: function(response){
              $(".loader").addClass('hide');
              $(".form-actions").removeClass('hide');
              if(response.responseJSON.errors.subscriber_name1){
                $( "#subscriber_name1" ).addClass( "error" );
                $( "#subscriber_name1" ).get(0).setCustomValidity('أدخل الاسم الاول');
                $( "#subscriber_name1" ).on('input',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.subscriber_name2){
                $( "#subscriber_name2" ).addClass( "error" );
                $( "#subscriber_name2" ).get(0).setCustomValidity('أدخل الاسم الثاني');
                $( "#subscriber_name2" ).on('input',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.subscriber_name3){
                $( "#subscriber_name3" ).addClass( "error" );
                $( "#subscriber_name3" ).get(0).setCustomValidity('أدخل الاسم الثالث');
                $( "#subscriber_name3" ).on('input',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.subscriber_name4){
                $( "#subscriber_name4" ).addClass( "error" );
                $( "#subscriber_name4" ).get(0).setCustomValidity('أدخل الاسم الرابع');
                $( "#subscriber_name4" ).on('input',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.subscriber_id){
                $( "#subscriber_id" ).addClass( "error" );
                $( "#subscriber_name" ).get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $( "#subscriber_name" ).on('input',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.national_id){
                $( "#national_id" ).addClass( "error" );
                $( "#national_id" ).get(0).setCustomValidity('أدخل رقم الهوية ');
                $( "#national_id" ).on('input',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.MobileNo){
                $( "#MobileNo" ).addClass( "error" );
                $( "#MobileNo" ).get(0).setCustomValidity('أدخل رقم جوال ');
                $( "#MobileNo" ).on('blur',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.AreaID){
                $( "#AreaID" ).addClass( "error" );
                $( "#AreaID" ).get(0).setCustomValidity('يرجى اختيار المنطقة ');
                $( "#AreaID" ).on('blur',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.malDesc){
                $( "#malDesc" ).addClass( "error" );
                $( "#malDesc" ).get(0).setCustomValidity('يرجى ادخال سبب الطلب ');
                $( "#malDesc" ).on('blur',function(){
                  this.setCustomValidity('')
                })
              }
              if(response.responseJSON.errors.task_type){
                $( "#task_type" ).addClass( "error" );
                $( "#task_type" ).get(0).setCustomValidity('يرجى اختيار نوع الاشتراك ');
                $( "#task_type" ).on('blur',function(){
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

