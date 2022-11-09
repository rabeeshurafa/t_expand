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
        .phoneDiv  {
             padding-left: 0px;
        }
        .subs_padd45  {
             padding-left: 45px;
        }
        .swal2-html-container{
            font-size: 18px !important;
            
        }
        .form-check-input{
    position:relative;
    margin-right:0;
    }
    </style>


    <link rel="stylesheet" type="text/css"
        href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css" />

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
                                    @include('portal.includes.qudra')
                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    @include('portal.includes.subscriber')
                                    <input type="hidden" id="app_type"  name="app_type" value="1">
                                    <input type="hidden" id="dept_id"  name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="app_no"  name="app_no" value="{{$app_no}}">
                                    <input type="hidden" id="rec_id"  name="rec_id" value="{{$ticketInfo->emp_to_access_portal}}">
                                    <input type="hidden" id="subscriptionType"  name="subscriptionType" value="6051">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="input-group licNoGroup" id="licGroup">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        {{"رقم الرخصة"}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="LicenceNo" name="LicenceNo" class="form-control valid" value="@if(isset($ticket)){{($ticket->licNo??'')}}@endif" placeholder="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row business_container">
                        
                                            <div class="input-group mb-2 col-lg-6 col-md-12">
                                                 <div class="input-group-prepend">
                                                   <span class="input-group-text"> موقع الطلب </span>
                                                 </div>
                                                <div class="form-check-inline form-control">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value="1" name="regionbuild" id="regionbuild1">خارج الحدود
                                                  </label>
                                                </div>
                                                <div class="form-check-inline form-control">
                                                  <label class="form-check-label">
                                                    <input type="checkbox" checked class="form-check-input" value="2" name="regionbuild" id="regionbuild2">داخل الحدود 
                                                  </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text " id="basic-addon1">
                                                             رقم الحوض                                                           
                                                          </span>
                                                        </div>                              
                                                        <input type="text" id="hodNo" name="hodNo"  value='' class="form-control" placeholder="  " aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text " id="basic-addon1">
                                                            رقم القطعة
                                                      </span>
                                                    </div>
                                                    <input type="text" id="pieceNo" name="pieceNo" value="" class="form-control " placeholder="  " aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                    </div>
                                    
                                    
                                    <div class="row">
                                        <div class="input-group mb-2 col-sm-12">
                                             <div class="input-group-prepend">
                                               <span class="input-group-text"> وضعية البناء </span>
                                             </div>
                                            <div class="form-check-inline form-control">
                                              <label class="form-check-label">
                                                <input type="checkbox" checked id="typebuild1" name="typebuild"  value="1" class="form-check-input" >بناء مقترح
                                              </label>
                                            </div>
                                            <div class="form-check-inline form-control">
                                              <label class="form-check-label">
                                                <input type="checkbox" id="typebuild2" name="typebuild" value="2" class="form-check-input" >بناء قائم  
                                              </label>
                                            </div>
                                            <div class="form-check-inline form-control">
                                              <label class="form-check-label">
                                                <input type="checkbox" id="typebuild3" name="typebuild" value="3" class="form-check-input">فوق بناء قائم 
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <table class="table table-bordered mb-3 st" style="text-align:center">
                                            <thead>
                                                <th> أ </th>
                                                <th> ب </th>
                                                <th> ج </th>
                                                <th> تجارية </th>
                                                <th> زراعية </th>
                                                <th> صناعية </th>
                                                <th> قديمة </th>
                                                <th> اخرى </th>
                                                <th> ملاحظات </th>
                                            </thead
                                            <tbody>
                                                <tr>
                                                        <td><input checked name="typestate" id= "typestate1"  type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="typestate" id= "typestate2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td><input name="typestate" id= "typestate3" type="checkbox" class="form-check-input" value="3"></td>
                                                    <div class="form">
                                                        <td><input checked name="typebuilding" id="typebuilding1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="typebuilding" id="typebuilding2" type="checkbox"   class="form-check-input" value="2"></td>
                                                        <td><input name="typebuilding" id="typebuilding3" type="checkbox"   class="form-check-input" value="3"></td>
                                                        <td><input name="typebuilding" id="typebuilding4" type="checkbox"   class="form-check-input" value="4"></td>
                                                        <!--<input type="hidden" id="typebuilding" value="تجارية" name="typebuilding">-->
                                                        <td style="max-width:50px;background-color:#fff;"><input type="text" name="typebuildingother" id="typebuildingother" class="form-control" placeholder=" اخرى  "></td>
                                                        <td style="max-width:300px"><input type="text" class="form-control" value="" name="typebuildingnote" id="typebuildingnote" placeholder=" ملاحظات "></td>
                                                    </div>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="form">
                                            <div class="input-group">
                                                <label class="form-label" style="color: #ff9149; font-weight:bold">مشتملات العقار </label>
                                                <div class="col-sm-12 col-md-10">
                                                    <input onchange="if($(this).prop('checked'))$('.rent2').hide()" type="radio" name="typeship" value="1" checked id="typeship1" class="jui-radio-buttons"  >
                                                    <label for="radio-3">العقار منفصل </label>
                                                    <input onchange="if($(this).prop('checked'))$('.rent2').show()" type="radio" name="typeship" value="2" id="typeship2" class="jui-radio-buttons" >
                                                    <label for="radio-4">العقار ضمن عمارة </label>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row rent2 hide">
                                        <table class="table table-bordered mb-3 st" style="text-align:center">
                                            <thead>
                                                <th> الرقم </th>
                                                <th> الوصف </th>
                                                <th> شقة </th>
                                                <th> مخزن </th>
                                                <th> مكتب </th>
                                                <th> طابق </th>
                                                <th> مطلع درج </th>
                                                <th> مصعد </th>
                                                <th> ملاحظات </th>
                                            </thead
                                            <tbody>
                                                <tr>
                                                    
                                                        <td> 1. </td>
                                                        <td> قائم </td>
                                                        <td><input name="appart[]" id="appart1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="typeStore[]" id="typeStore1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="office[]" id="office1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="floor[]" id="floor1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="stairs[]" id="stairs1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td><input name="elev[]" id="elev1" type="checkbox" class="form-check-input" value="1"></td>
                                                        <td style="max-width:60px"><input type="text" name="notes1" class="form-control" placeholder=" ملاحظات "></td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                        <td> 2. </td>
                                                        <td> مرخص غير قائم </td>
                                                        <td><input name="appart[]" id="appart2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td><input name="typeStore[]" id="typeStore2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td><input name="office[]" id="office2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td><input name="floor[]" id="floor2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td><input name="stairs[]" id="stairs2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td><input name="elev[]" id="elev2" type="checkbox" class="form-check-input" value="2"></td>
                                                        <td style="max-width:300px"><input type="text" name="notes2" class="form-control" placeholder=" ملاحظات "></td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                        <td> 3. </td>
                                                        <td> مستقبلي (غير مرخص) </td>
                                                        <td><input name="appart[]" id="appart3" type="checkbox" class="form-check-input" value="3"></td>
                                                        <td><input name="typeStore[]" id="typeStore3" type="checkbox" class="form-check-input" value="3"></td>
                                                        <td><input name="office[]" id="office3" type="checkbox" class="form-check-input" value="3"></td>
                                                        <td><input name="floor[]" id="floor3" type="checkbox" class="form-check-input" value="3"></td>
                                                        <td><input name="stairs[]" id="stairs3" type="checkbox" class="form-check-input" value="3"></td>
                                                        <td><input name="elev[]" id="elev3" type="checkbox" class="form-check-input" value="3"></td>
                                                        <td style="max-width:300px"><input type="text" name="notes3" class="form-control" placeholder=" ملاحظات "></td>
                                                    
                                                </tr>
                                                <tr style="display:none">
                                                    
                                                        <td> 4. </td>
                                                        <td> المجموع </td>
                                                        <td><input name="appart[]" id="appart4" type="checkbox" class="form-check-input" value="4"></td>
                                                        <td><input name="typeStore[]" id="typeStore4" type="checkbox" class="form-check-input" value="4"></td>
                                                        <td><input name="office[]" id="office4" type="checkbox" class="form-check-input" value="4"></td>
                                                        <td><input name="floor[]" id="floor4" type="checkbox" class="form-check-input" value="4"></td>
                                                        <td><input name="stairs[]" id="stairs4" type="checkbox" class="form-check-input" value="4"></td>
                                                        <td><input name="elev[]" id="elev4" type="checkbox" class="form-check-input" value="4"></td>
                                                        <td style="max-width:300px"><input type="text" name="notes4" class="form-control" placeholder=" ملاحظات "></td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="form-label" style="color: #ff9149; font-weight:bold">
                                                        {{ 'نوع الملكية' }}
                                                    </label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <label for="radio-3">{{ 'ملك' }} </label>
                                                        <input
                                                            onchange="if($(this).prop('checked'))$('.attach-required').hide()"
                                                            type="radio" name="Ownership[]" checked="" id="radio-3"
                                                            class="jui-radio-buttons" value="1"
                                                            onclick="$('.ownertypes').hide();$('.owner').show();">
                                                        <label for="radio-4">{{ 'إيجار' }} </label>
                                                        <input
                                                            onchange="if($(this).prop('checked'))$('.attach-required').show()"
                                                            type="radio" name="Ownership[]" id="radio-4"
                                                            class="jui-radio-buttons" value="2"
                                                            onclick="$('.ownertypes').hide();$('.rent').show();">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-7 ownertypes rent" style="display: none;">
                                            <div class="form-group">
                                                <div class="input-group" style="width:99% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'اسم المالك' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="OwnerName"
                                                        class="form-control ac10 ui-autocomplete-input"
                                                        placeholder="اسم المالك" name="OwnerName" style="height: 35px;"
                                                        autocomplete="off">
                                                    <input type="hidden" id="SubscriberID1" name="SubscriberID1">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row ownertypes rent1 hide" style="display:none">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group" style="width:99% !important;">
                                                    <input type="checkbox" class="hide" id="NoObjection"
                                                        name="NoObjection">
                                                    No- objection of the owner
                                                    <span style="color:#ff0000">*</span>
                                                    <span>
                                                        <i class="fas fa-paperclip"
                                                            onclick="document.getElementById('Attach1').click();$('#fileName').val('attach1');return false">
                                                        </i></span>
                                                    <input type="file" id="Attach1" name="attach1" class="hide"
                                                        onchange="doUploadPic1('formData','attach1Img','attach1Path')">
                                                    <img src="" id="attach1Img" style="width:30%">
                                                    <input type="text" class="hide" id="attach1Path"
                                                        name="attach1Path">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group licNoGroup222" style="width:99% !important;">

                                                    <input type="checkbox" class="hide" id="RentContract"
                                                        name="RentContract">
                                                    RentContract<span style="color:#ff0000">*</span><span><i
                                                            class="fas fa-paperclip"
                                                            onclick="document.getElementById('Attach2').click(); $('#fileName').val('attach2');return false"></i></span>
                                                    <input type="file" id="Attach2" name="attach2" class="hide"
                                                        onchange="doUploadPic1('formData','attach2Img','attach2Path')">
                                                    <img src="" id="attach2Img" style="width:30%">
                                                    <input type="text" class="hide" id="attach2Path"
                                                        name="attach2Path">
                                                    <input type="text" class="hide" id="fileName" name="fileName">
                                                </div>
                                            </div>
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
        </form>
    </section>
<script>
$(document).ready(function () {
    $( "#subscriber_name" ).autocomplete({
		source:'{{route("portal_auto_complete")}}',
		minLength: 1,
        select: function( event, ui ) {
            $("#subscriber_id").val(ui.item.id)
            // $("#national_id").val(ui.item.national_id)
            // getFullData(ui.item.id)
		}
	});
    $( ".ac10" ).autocomplete({
		source:'{{route("portal_auto_complete")}}',
		minLength: 1,
        select: function( event, ui ) {
            $("#SubscriberID1").val(ui.item.id)
		}
	});

    $('#ticketFrm').submit(function(e) {
        e.preventDefault();
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide'); 
    $( "#subscriber_name" ).removeClass( "error" );
    $( "#national_id" ).removeClass( "error" );
    $( "#subscriber_id" ).removeClass( "error" );
    $( "#MobileNo" ).removeClass( "error" );
    // $( "#Address" ).removeClass( "error" );
    $( "#subscriptionType" ).removeClass( "error" );
      let formData = new FormData(this);
      $.ajax({
          type:'POST',
          url: '{{route("portal_saveTicket3")}}',
          data: formData,
          contentType: false,
          processData: false,
          success: (response) => {
            $(".form-actions").removeClass('hide'); 
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
                setTimeout(function(){location.reload();},1500)
             }else{
                 console.log(response.error);
                 
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
          error: function(response){
            $(".loader").addClass('hide');
            $(".form-actions").removeClass('hide'); 
			if(response.responseJSON.errors.subscriber_name){
                $( "#subscriber_name" ).addClass( "error" );
                $( "#subscriber_name" ).get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $( "#subscriber_name" ).on('input',function(){
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
            if(response.responseJSON.errors.MobileNo){
                $( "#MobileNo" ).addClass( "error" );
                $( "#MobileNo" ).get(0).setCustomValidity('أدخل رقم جوال ');
                $( "#MobileNo" ).on('blur',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.subscriptionType){
                $( "#subscriptionType" ).addClass( "error" );
                $( "#subscriptionType" ).get(0).setCustomValidity('يرجى اختيار نوع الاشتراك  ');
                $( "#subscriptionType" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.national_id){
                console.log('hiiiiiiii')
                $( "#national_id" ).addClass( "error" ); 
                $( "#national_id" ).get(0).setCustomValidity('يرجى ادخال رقم الهوية');
                $( "#national_id" ).on('input',function(){
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

function getFullData(id){
    
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')

            }

        });
    formData={'id':id}
      $.ajax({
          type:'POST',
          url: '{{route("portal_appCustomer")}}',
          data: formData,
          /*contentType: false,
          processData: false,*/
          success: (response) => {
             if (response) {
                 srch=response.phone_one==null?(response.phone_two==null?'':response.phone_two):response.phone_one
                if(srch.search("056")>=0)
                    $('#mobImg').attr('src','{{asset('assets/images/w35.png')}}');
                else
                    $('#mobImg').attr('src','{{asset('assets/images/jawwal35.png')}}');
                $('#MobileNo').val(response.phone_one==null?(response.phone_two==null?'':response.phone_two):response.phone_one)
                $(".loader").addClass('hide');
                console.log(response.errorList.length)
                if(response.errorList.length==0){
                    $(".btnArea").removeClass("hide");
                    //$(".errArea").addClass("hide");
                }
                else
                {
                    
                    //     $(".btnArea").addClass("hide");
                    //     //$(".errArea").removeClass("hide");
                    //     err='هل تريد المتابعة رغم الأخطاء التالية'
                    //     +'<ul>'
                    // for(i=0;i<response.errorList.length;i++)
                    //     err+="<li>"+response.errorList[i]+"</li>";
                    //     err+='<ul>'
                    //     Swal.fire({
                    //       title: err,//'Do you want to save the changes?',
                    //       showDenyButton: true,
                    //       showCancelButton: true,
                    //       confirmButtonText: 'Save',
                    //       denyButtonText: `Don't save`,
                    //     }).then((result) => {
                    //       /* Read more about isConfirmed, isDenied below */
                    //       if (result.isConfirmed) {
                    //         Swal.fire('Saved!', '', 'success')
                    //       } else if (result.isDenied) {
                    //         Swal.fire('Changes are not saved', '', 'info')
                    //       }
                    //     })
                }
                
                
                
             }

          },
          error: function(response){
            $(".loader").addClass('hide');

			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'خطاء بالنظام',
				showConfirmButton: false,
				timer: 1500
				})
          }
      });
}

</script>
@stop

