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
                                    @include('portal.includes.regionsTemplate')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                         {{"قدرة المشروع (كيلو وات)"}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="kwatt" class="form-control"  placeholder="" name="kwatt" style="height: 35px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group " style="padding-left: 47px;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                         {{"مكان التركيب"}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="placement" class="form-control" placeholder="" name="placement" style="height: 35px;">
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group licNoGroup" id="licGroup"
                                                    style="width:99% !important; padding-left: 56px">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الرخصة' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="licNo" name="licNo" class="form-control eng-sm " value="" placeholder="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="row" style="margin-left: 0;">-->
                                    <!--    <div class="col-sm-12">-->
                                    <!--        <h5 class="sub-head" style="color:#ff9149;padding-bottom: 7px;"><b>بيانات الأشتراك</b></h5>-->
                                    
                                    
                                    <!--        <table style="width:95%; margin-top: -10px;" class="detailsTB table">-->
                                    <!--            <tbody>-->
                                    <!--                <tr>-->
                                    <!--                    <th scope="col" style="color: white">#</th>-->
                                    <!--                    <th scope="col" style="color: white">رقم الإشتراك</th>-->
                                    <!--                    <th scope="col" style="text-align: -webkit-center;color: white;">العداد</th>-->
                                    <!--                    <th scope="col" style="text-align: -webkit-center;color: white;">وصف مكان العداد</th>-->
                                    <!--                    <th scope="col" style="color: white"></th>-->
                                    
                                    <!--                </tr>-->
                                    <!--            </tbody>-->
                                    <!--            <tbody id="recList">-->
                                    
                                    <!--            </tbody>-->
                                    <!--        </table>-->
                                    
                                    <!--    </div>-->
                                    <!--</div>-->
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

    $( "#subscriber_name" ).autocomplete({
		source:'{{route("portal_auto_complete")}}',
		minLength: 1,
        select: function( event, ui ) {
            $("#subscriber_id").val(ui.item.id)
            // $("#national_id").val(ui.item.national_id)
            // getFullData(ui.item.id)
            
            // subscriber_id=ui.item.id;
            
            // if( {{$ticketInfo->apps_btn}}==1)
            //     getSubscriberTasks(ui.item.id)
		}
	});
	
    
	
    $('#ticketFrm').submit(function(e) {
        $(".loader").removeClass('hide');

       e.preventDefault();
       $( "#subscriber_name" ).removeClass( "error" );
        $( "#subscriber_id" ).removeClass( "error" );
        $( "#MobileNo" ).removeClass( "error" );
        $( "#national_id" ).removeClass( "error" );
        $( "#AreaID" ).removeClass( "error" );
       let formData = new FormData(this);
       $.ajax({
          type:'POST',
          url: "{{route("portal_saveTicket15")}}",
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
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
             //location.reload();

           },
           error: function(response){
            $(".loader").addClass('hide');

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
            if(response.responseJSON.errors.MobileNo){
                $( "#MobileNo" ).addClass( "error" );
                $( "#MobileNo" ).get(0).setCustomValidity('أدخل رقم جوال ');
                $( "#MobileNo" ).on('blur',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.AreaID){
                $( "#AreaID" ).addClass( "error" );
                $( "#AreaID" ).get(0).setCustomValidity('يرجى اختيار منطقة ');
                $( "#AreaID" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.national_id){
                $( "#national_id" ).addClass( "error" );
                $( "#national_id" ).get(0).setCustomValidity('أدخل رقم هوية ');
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
                if(response.errorList.length==0){
                    $(".btnArea").removeClass("hide");
                    //$(".errArea").addClass("hide");
                }

                // if(response.elec!=null){
                //      var len = response.elec.length;
                //      $row='';
                //     for(var i=0; i<len; i++){
                //         // if(response.elec[i].counter==null)
                //         //       continue;
                //       $row+= 
                //         '<tr id="memRow1">'+
                //         '<td style="color:#1E9FF2">'+(i+1)+'</td> '+
                //         '<td>'+
                //             (response.elec[i].subscription_no??'')+
                //             '<input type="hidden" name="SubscribtionIdList[]" value="'+response.elec[i].id+'"><input type="text" class="form-control form-control1 numFeild hide" name="SubscribtionNumList[]" value="'+(response.elec[i].licNo??'')+'">'+
                //         '</td>'+
                //         '<td class="hideMob" style="text-align: -webkit-center;">'+
                //             (response.elec[i].counter==null?'':response.elec[i].counter.name)+
                //             '<input type="text" class="form-control form-control1 alphaFeild hide" name="CounterTypeList[]" value="'+(response.elec[i].counter==null?'':response.elec[i].counter.name)+'">'+
                //         '</td>'+
                //         '<td style="text-align: -webkit-center;">'+
                //             (response.elec[i].placeDesc??'')+
                //             '<input type="text" class="form-control form-control1   hide" name="CapacityList[]" value="'+(response.elec[i].placeDesc??'')+'">'+
                //         '</td>'+
                //         '<td>'+
                //                 '<a class="remove-btn" onclick="$(this).parent().parent().remove()" >'+
                //                     '<i class="fa fa-trash" style="color:#1E9FF2;"></i>'+
                //                 '</a>'+
                //         '</td>'+
                //         '</tr>';
                //     }
                //     $("#recList").append($row);
                    
                // }
                
                // if(response.water.length!=0){
                //     $("#saveBtn").removeClass("hide");
                //     $("#saveBtnSend").removeClass("hide");
                //     //$(".errArea").addClass("hide");
                // }
                // else
                // {
                    
                        // $("#saveBtn").addClass("hide");
                        // $("#saveBtnSend").addClass("hide");
                //         $("#recList").html('');
                //         //$(".errArea").removeClass("hide");
                //         Swal.fire({
            				// position: 'top-center',
            				// icon: 'error',
            				// title: 'لا يمكن تقديم الطلب لعدم وجود اشتراك معرف في النظام',
            				// showConfirmButton: true,
            				// })
                // }
             }

           },
           error: function(response){
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
// function getSubscriberTasks(id){
    
//         let subscribe_id = id;

//             $.ajax({

//                 type: 'get',

//                 url: "subscriber_tasks",

//                 data: {

//                     subscribe_id: subscribe_id,

//                 },

//                 success: function(response) {
                   
//                     if (response.status!=false) {  
                        
//                         drawtasks(response.tikets);
                        
//                     }else{
//                         Swal.fire({

//             				position: 'top-center',
            
//             				icon: 'error',
            
//             				title: 'لايوجد طلبات لهاذا المواطن',
            
//             				showConfirmButton: false,
            
//             				timer: 1500
        
//         				})
//                     }
//                 },

//             });
    
// }
        
</script>
@stop

