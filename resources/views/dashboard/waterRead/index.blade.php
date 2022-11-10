@extends('layouts.admin')
@section('search')
<li class="dropdown dropdown-language nav-item hideMob">
            <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث" style="text-align: center;width: 350px; margin-top: 15px !important;">
          </li>
@endsection

@section('content')
<style>
    .detailsTB th{
        color:#ffffff;
    }
      .detailsTB th,.detailsTB td{
        text-align:right !important;
        
    }
    .recList>tr>td{
        font-size:12px;
    }
    table.dataTable tbody th, table.dataTable tbody td {
    padding-bottom: 5px !important;
}
.dataTables_filter{
    margin-top:-15px;
}
.even{
    background-color:#D7EDF9 !important;
}
.dt-buttons
{
    text-align: left;
    display: inline;
    float: left;
    position: relative;
    bottom: 10px;
    margin-right: 10px;
}

</style>
<div class="content-body">
    <form id="formData" method="post" novalidate onsubmit="return false;">
        <section class="horizontal-grid" id="horizontal-grid">
            <div class="row  white-row">
                <div class="col-sm-12 col-lg-12 col-md-12">
                    <div class="card leftSide">
                        <div class="card-header" style="margin-right: 5px;">
                            <h4 class="card-title">
                                <img src="https://db.expand.ps/images/water-faucet64.png" style="height:35px">
                                ادخال قراءة عداد مياه
                            </h4>
                        </div>
                        <div class="card-content collapse show" >
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    
                                    <div class="row mobRow" style="padding-top:15px;">
                                        <div class="col-lg-6 col-md-12 pr-s-12" style="">
                                            <div class="form-group">
                                                <div class="input-group w-s-87 mt-s-6">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                          اسم المشترك
                                                        </span>
                                                    </div>
                                                    <input type="hidden" name="SubscriberID" id="SubscriberID" >
                                                    <input type="text" id="subscriber_name" class="form-control  ac" placeholder="اسم المشترك" name="subscriber_name" style="height: 35px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12" style="padding-bottom:20px;">
                                            <div class="input-group" style="width: 240px;">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-phone" style="font-size:18px;" ></i>
                                                  </span>
                                                </div>
                                                <input type="text" id="PHnum1" style="padding-right: 46px !important;" maxlength="10" name="PHnum1"  class="form-control noleft numFeild" placeholder="أدخل رقم الهاتف المحمول" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="input-group" style="width: 240px;">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon1">
                                                    رقم الاشتراك
                                                  </span>
                                                </div>
                                                <select type="text" id="subscription_no" onchange="viewSubscription();" name="subscription_no" class="app_status form-control">
                                                    <option value="0"> اختر </option>
            									</select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row mobRow" >
                                        <div class="col-md-12" style="overflow-x: scroll;">
                                        <h5 class="sub-head" style="color:#ff9149;padding-top:15px;"><b>بيانات الإشتراك</b></h5>


                                        <table class="detailsTB table" style="margin-left: 15px;">
                                           {{-- <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">رقم الإشتراك</th>
                                                <th scope="col" class="hideMob" style="text-align: -webkit-center;">العداد</th>
                                                <th scope="col" style="text-align: -webkit-center;">وصف مكان العداد</th>
                                                <th scope="col" style="text-align: -webkit-center;">القراءة السابقة</th>
                                                <th scope="col" style="text-align: -webkit-center;">القراءة الحالية</th>
                                                <th scope="col"></th>

                                            </tr>--}}
                                            <tr>
                                                <th scope="col">رقم الإشتراك</th>
                                                <td scope="col">
                                                    <input type="text" readonly class="form-control form-control" id="subsNo" name="subsNo" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">القراءة السابقة</th>
                                                <td scope="col" id="lastread">
                                                    <input type="number" readonly class="form-control form-control" id="prev_read" name="prev_read" value="">
                                                    <input type="hidden" readonly class="form-control form-control" id="prev_id" name="prev_id" value="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">القراءة الحالية</th>
                                                <td scope="col" id="currentRead">
                                                    <input type="number" class="form-control form-control" id="current_read" name="current_read" onblur="calcInNIS();" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">قيمة الاستهلاك</th>
                                                <td scope="col" id="subsNo">
                                                    <input type="text" readonly class="form-control form-control" id="consumptionT" name="consumptionT" value="">
                                                    <input type="hidden" readonly class="form-control form-control" id="consumption" name="consumption" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">قيمة الفاتورة</th>
                                                <td scope="col" id="subsNo">
                                                    <input type="text" readonly class="form-control form-control" id="usage_costT" name="usage_costT" value="">
                                                    <input type="hidden" readonly class="form-control form-control" id="usage_cost" name="usage_cost" value="">
                                                </td>
                                            </tr>
                                            <tbody id="recList">

                                            </tbody>
                                        </table>

                                        </div>
                                    </div>
                                    <div class="row" style="    text-align: center;">
                                        <div class="form-group col-md-5 mb-2">
                                        </div>
                                        <div class="form-group col-md-2 mb-2 form-actions">
                                            <button type="submit" class="btn btn-primary" onclick="validForm()">
                                                <i class="la la-check-square-o"></i> 
                                                حفظ
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
var subscriptions = new Array();
$(document).ready(function () {
    $( "#subscriber_name" ).autocomplete({
    	source:"{{route('subscribe_auto_complete')}}",
    	minLength: 1,
        select: function( event, ui ) {
            $("#SubscriberID").val(ui.item.id)
            if(ui.item.phone_one != null && ui.item.phone_one != '')
                $("#PHnum1").val((ui.item.phone_one??''))
            else
                $("#PHnum1").val((ui.item.phone_two??''))
            getFullData(ui.item.id)
    	}
    });
});

function getFullData(id){
    
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')

            }

        });
    formData={'subscriber_id':id}
       $.ajax({
          type:'get',
          url: "{{route('watersWithLastRead')}}",
           data: formData,
           /*contentType: false,
           processData: false,*/
           success: (response) => {
                if(response.info.length>0){
                    subscriptions = new Array();
                    $('#subscription_no').html('<option value="0"> اختر </option>');
                    $('#subsNo').val('');
                    $('#prev_read').val('');
                    $('#current_read').val('');
                    $('#consumptionT').val('');
                    $('#consumption').val('');
                    $('#usage_costT').val('');
                    $('#usage_cost').val('');
                    
                    response.info.forEach(licence => {
                        subscription=licence;
                        subscriptions.push(subscription);
                        $('#subscription_no').append(`
                            <option value="${subscription.id}"> ${(subscription.subscription_no??'بدون')} </option>
                        `);
                    });
                    if(response.info.length==1){
                        $('#subscription_no').val(response.info[0].id);
                        viewSubscription();
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
function viewSubscription(){
    subscriptionID=$('#subscription_no').val();
    for(i=0 ; i< subscriptions.length ; i++){
        if(subscriptionID == subscriptions[i].id ){
            $('#subsNo').val((subscriptions[i].subscription_no??''));
            $('#prev_read').val((subscriptions[i].lastread??0));
            $('#prev_id').val((subscriptions[i].lastread_id??0));
            break;
        }
    // var NewRow=`
    //     <tr>
    //         <td scope="col">#</td>
    //         <td scope="col">
    //         ${(subscriptions[i].subscription_no??'')}
    //         </td>
    //         <td scope="col" class="hideMob" style="text-align: -webkit-center;">
    //         ${(subscriptions[i].counter_Type_name??'')}
    //         </td>
    //         <td scope="col" style="text-align: -webkit-center;">
    //         ${(subscriptions[i].placeDesc??'')}
    //         </td>
    //         <td scope="col" style="text-align: -webkit-center;">
    //         <input type="text" class="form-control form-control" id="lastread" name="lastread" readonly="" value="0">
    //         </td>
    //         <td scope="col" style="text-align: -webkit-center;">
    //         <input type="text" class="form-control form-control" id="newread" name="newread" onblur="calcInNIS(this)" value="">
    //         </td>
    //         <td scope="col"></td>

    //     </tr>
    // `
    //         $("#recList").append(NewRow)
        
    }
}

function calcInNIS(){
    var newVal=$('#current_read').val();
    var oldVal=$('#prev_read').val();
    var total=5;
    
    var spent=newVal-oldVal;
    if(spent<=10)
        total+=spent*5;
    else if(spent<=20)
        total+=50+((spent-10)*7)
    else if(spent<=99999)
        total+=120+((spent-20)*10)
    
    $('#usage_costT').val(total+' شيكل');
    $('#usage_cost').val(total);
    $('#consumptionT').val(spent+ ' كوب ');
    $('#consumption').val(spent);
}

$('#formData').submit(function(e) {
    
    $(".loader").removeClass('hide');
    $(".form-actions").addClass('hide');
    e.preventDefault();
    
    let formData = new FormData(this);
    $.ajax({
      type:'POST',
      url: "{{ route('store_read') }}",
       data: formData,
       contentType: false,
       processData: false,
    success: (response) => {
        $(".form-actions").removeClass('hide');  ;
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
        $('#subsNo').val('');
        $('#prev_read').val('');
        $('#current_read').val('');
        $('#consumptionT').val('');
        $('#consumption').val('');
        $('#usage_costT').val('');
        $('#usage_cost').val('');
     }else{
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
    // function calcInNIS(ctrl){
    //     var newVal=parseInt($(ctrl).val());
    //     var oldVal=parseInt($(ctrl).parent().prev().children().first().val());
    //     var total=0;
    //     /*$(ctrl).parent().next().children().first().html(total+' شيكل')
    //     console.log(newVal,oldVal); return;*/
    //     var spent=newVal-oldVal;
    //     if(spent<=10)
    //         total+=spent*5;
    //     else if(spent<=20)
    //         total+=50+((spent-10)*7)
    //     else if(spent<=99999)
    //         total+=120+((spent-20)*10)
        
    //     $(ctrl).parent().next().html(total+' شيكل')
    // }
</script>
@endsection
