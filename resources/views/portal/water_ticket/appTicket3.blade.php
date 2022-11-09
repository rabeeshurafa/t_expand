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
                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    <div class="row exonmobile">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">نوع
                                                            الإشتراك</span>
                                                    </div>
                                                    <select id="subscriptionType" name="subscriptionType" 
=                                                        class="form-control subscriptionType" >
                                                        <option value="">-- يرجى اختيار نوع الاشتراك --</option>
                                                        @foreach($subsList as $sub)
                                                        <option value="{{ $sub->id }}" 
                                                        @if(isset($ticket))
                                                        {{$ticket->subscription_type==$sub->id?'selected':"" }}
                                                        @endif
                                                        >{{ $sub->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append" onclick="ShowConstantModal(39,'subscriptionType','نوع اشتراك مياه')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>


                                </div>
                                    @include('portal.includes.subscriber')
                                    <input type="hidden" id="app_type"  name="app_type" value="2">
                                    <input type="hidden" id="dept_id"  name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="app_no"  name="app_no" value="{{$app_no}}">
                                    <input type="hidden" id="rec_id"  name="rec_id" value="{{$ticketInfo->emp_to_access_portal}}">
                                    
                                    <div class="row business_container">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                          <span class="input-group-text " id="basic-addon1">
                                                             موقع الطلب                                                           
                                                          </span>
                                                        </div>                              
                                                        <input type="text" id="address" name="address"  value='' class="form-control" placeholder="  " aria-describedby="basic-addon1">
                                                    </div>
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
                                        <div class="col-md-5 ownertypes rent" style="display: none;">
                                            <div class="form-group">
                                                <div class="input-group licNoGroup" id="licGroup" style="width: 93% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        {{"رقم الرخصة"}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="LicenceNo" name="LicenceNo" class="form-control eng-sm  valid" value="@if(isset($ticket)){{($ticket->licNo??'')}}@endif" placeholder="" autocomplete="off">
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
                                    @include('portal.includes.forward')
                                </div>
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
            $("#subscriber_id1").val(ui.item.id)
		}
	});

    $('#ticketFrm').submit(function(e) {
        e.preventDefault();
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide'); 
    $( "#subscriber_name" ).removeClass( "error" );
    $( "#subscriber_id" ).removeClass( "error" );
    $( "#MobileNo" ).removeClass( "error" );
    $( "#national_id" ).removeClass( "error" );
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

