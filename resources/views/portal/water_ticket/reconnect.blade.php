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

        .detailsTB th {
            color: #ffffff !important;
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
                                    @include('portal.includes.subscriber')
                                    <input type="hidden" id="app_type"  name="app_type" value="2">
                                    <input type="hidden" id="dept_id"  name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="rec_id"  name="rec_id" value="{{$ticketInfo->emp_to_access_portal}}">
                                    <input type="hidden" id="app_no"  name="app_no" value="{{$app_no}}">
                                    @include('portal.includes.regionsTemplate')

                                    <div class="row mobRow">
                                        <div class="col-md-12">
                                            <h5 class="sub-head" style="color:#ff9149">
                                                <b>
                                                    {{ 'بيانات الإشتراك' }}
                                                </b>
                                            </h5>

                                            <table class="detailsTB table" style="margin-left: 15px;">
                                                <tbody>
                                                    <tr>
                                                        <th scope="col">
                                                            {{ '#' }}
                                                        </th>
                                                        <th scope="col">
                                                            {{ 'رقم الإشتراك' }}
                                                        </th>
                                                        <th scope="col" class="hideMob"
                                                            style="text-align: -webkit-center;">
                                                            {{ 'العداد' }}
                                                        </th>
                                                        <th scope="col" style="text-align: -webkit-center;">
                                                            {{ 'وصف مكان العداد' }}
                                                        </th>
                                                        <th scope="col"></th>

                                                    </tr>
                                                </tbody>
                                                <tbody id="recList">

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="row mobRow">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group" style="padding-left: 0px; width: 100% !important;">
                                                    <h5 class="sub-head" style="color:#ff9149">
                                                        <b>
                                                            {{ 'سبب الوصل' }}
                                                        </b>
                                                    </h5>
                                                    <br>
                                                    <textarea required="" type="text" id="malDesc" class="form-control"
                                                        placeholder="سبب الوصل" name="malDesc"
                                                        style="width:100% ; border-radius:5px !important;height: 35px;"
                                                        aria-invalid="false"></textarea>

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
            getFullData(ui.item.id)
		}
	});
	
    $('#ticketFrm').submit(function(e) {
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide'); 
       e.preventDefault();
       $( "#subscriber_name" ).removeClass( "error" );
        $( "#subscriber_id" ).removeClass( "error" );
        $( "#MobileNo" ).removeClass( "error" );
        $( "#AreaID" ).removeClass( "error" );
        $( "#malDesc" ).removeClass( "malDesc" );
       let formData = new FormData(this);
       $.ajax({
          type:'POST',
          url: '{{route("portal_saveTicket7")}}',
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
                 console.log(response.error);
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
            // if(response.responseJSON.errors.Address){
            //     $( "#Address" ).addClass( "error" );
            // }
            if(response.responseJSON.errors.malDesc){
                $( "#malDesc" ).addClass( "error" );
                $( "#malDesc" ).get(0).setCustomValidity('يرجى ادخال العطل  ');
                $( "#malDesc" ).on('input',function(){
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
                if(response.water!=null){
                     var len = response.water.length;
                     $row='';
                    for(var i=0; i<len; i++){
                       $row+= 
                        '<tr id="memRow1">'+
                        '<td style="color:#1E9FF2">'+(i+1)+'</td> '+
                        '<td>'+
                            (response.water[i].subscription_no??'')+
                            '<input type="hidden" name="SubscribtionIdList[]" value="'+response.water[i].id+'"><input type="text" class="form-control form-control1 numFeild hide" name="SubscribtionNumList[]" value="'+(response.water[i].subscription_no??'')+'">'+
                        '</td>'+
                        '<td class="hideMob" style="text-align: -webkit-center;">'+
                            (response.water[i].counter==null?'':response.water[i].counter.name)+
                            '<input type="text" class="form-control form-control1 alphaFeild hide" name="CounterTypeList[]" value="'+(response.water[i].counter==null?'':response.water[i].counter.name)+'">'+
                        '</td>'+
                        '<td style="text-align: -webkit-center;">'+
                            (response.water[i].placeDesc??'')+
                            '<input type="text" class="form-control form-control1   hide" name="CapacityList[]" value="'+(response.water[i].placeDesc??'')+'">'+
                        '</td>'+
                        '<td>'+
                            '<a class="remove-btn" onclick="$(this).parent().parent().remove()" >'+
                                '<i class="fa fa-trash" style="color:#1E9FF2;"></i>'+
                            '</a>'+
                        '</td>'+
                        '</tr>';
                    }
                    $("#recList").append($row);
                    
                }
                
                console.log(response.errorList.length)
                
                if(response.water.length!=0){
                    $("#saveBtn").removeClass("hide");
                    $("#saveBtnSend").removeClass("hide");
                    //$(".errArea").addClass("hide");
                }
                else
                {
                    
                        $("#saveBtn").addClass("hide");
                        $("#saveBtnSend").addClass("hide");
                        $("#recList").html('');
                        //$(".errArea").removeClass("hide");
                        Swal.fire({
            				position: 'top-center',
            				icon: 'error',
            				title: 'لا يمكن تقديم الطلب لعدم وجود اشتراك معرف في النظام',
            				showConfirmButton: true,
            				})
                }
                
                
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


</script>


@stop

