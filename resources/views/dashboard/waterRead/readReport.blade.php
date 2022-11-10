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
    <section id="hidden-label-form-layouts">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}" style="height: 32px" />
                    {{'ارشيف القراءات'}} 
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="formDataaa" onsubmit="return false">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-12 pr-0 pr-s-12"  >
                                        <div class="form-group">
                                            <div class="input-group w-s-87">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        {{'نوع القراءة'}}  
                                                    </span>
                                                </div>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="1">مياه</option>
                                                    <option value="2">كهرباء</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-12 pr-0 pr-s-12"  >
                                        <div class="form-group">
                                            <div class="input-group w-s-87">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        {{trans('archive.from_date')}}
                                                    </span>
                                                </div>
                                                <input type="text" id="frmDate" name="frmDate" data-mask="00/00/0000" maxlength="10" class="form-control eng-sm  valid" value="<?php echo date('d/m/Y', strtotime(date('Y-m-d') . " -30 days"))?>" onblur="calcDuration()" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 pr-0 pr-s-12"  >
                                        <div class="form-group">
                                            <div class="input-group w-s-87">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        {{trans('archive.to_date')}}
                                                    </span>
                                                </div>
                                                <input type="text" id="toDate" name="toDate" data-mask="00/00/0000" maxlength="10" class="form-control eng-sm  valid" value="<?php echo date('d/m/Y')?>" onblur="calcDuration()" placeholder="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="form-group res">
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align:center">
                                    <button type="button" class="btn btn-primary" onclick="search();" style="">
                                    بحث
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
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

</style>

<div class="modal fade text-left" id="readSMSModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog" STYLE="max-width: 40%!important;"  role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel1">إرسالة رسالة نصية قصيرة</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-body">
                    <form id="SMSFormData" >
                        <table width="100%" class="detailsTB table engTbl">
    						<tr>
    							<td>
    							    أدخل نص الرسالة
    							</td>
    						</tr>
    						<tr>
    							<td>
    							    <textarea type="text" id="smsText1" class="form-control" value="" name="smsText1" style="height: 60px;"></textarea>
    							</td>
    						</tr>
    						<tr>
    							<td colspan="4" style="text-align: center !important;">
    							    <button type="button" class="btn btn-primary" id="" style="" onclick="sendReadSMS()">
    							        إرسال    
    							    </button>
    							</td>
    						</tr>
    					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade text-left" id="updateRead" tabindex="-1" role="dialog" aria-labelledby="updateRead"aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:600px!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تعديل قراءة العداد </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <form id="updateReadForm" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                اسم المشترك   
                                            </span>
                                        </div>
                                        <input type="text" id="subscriber_name" readonly class="form-control alphaFeild cust" placeholder="اسم المشترك " name="subscriber_name">
                                        <input type="hidden" id="SubscriberID"readonly class="form-control alphaFeild" value="" name="SubscriberID">
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                             رقم الهاتف
                                            </span>
                                        </div>
                                        <input type="text" id="PHnum1" style="padding-right: 46px !important;" maxlength="10" name="PHnum1"  class="form-control noleft numFeild" placeholder="أدخل رقم الهاتف المحمول" aria-describedby="basic-addon1">
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                             رقم الاشتراك
                                            </span>
                                        </div>
                                        <input type="text" readonly class="form-control form-control" readonly id="subsNo" name="subsNo" value="">
                                        <input type="hidden" id="subscription_no" readonly class="form-control alphaFeild" value="" name="subscription_no">
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                القراءة السابقة   
                                            </span>
                                        </div>
                                        <input type="number" readonly class="form-control form-control" id="prev_read" name="prev_read" value="">
                                        <input type="hidden" readonly class="form-control form-control" id="prev_id" name="prev_id" value="0">
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                القراءة الحالية   
                                            </span>
                                        </div>
                                        <input type="number" class="form-control form-control" id="current_read" name="current_read" onblur="calcInNIS();" value="">
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;" >
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                قيمة الاستهلاك 
                                            </span>
                                        </div>
                                        <input type="text" readonly class="form-control form-control" id="consumptionT" name="consumptionT" value="">
                                        <input type="hidden" readonly class="form-control form-control" id="consumption" name="consumption" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group" style="width: 98% !important;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                قيمة الفاتورة  
                                            </span>
                                        </div>
                                        <input type="text" readonly class="form-control form-control" id="usage_costT" name="usage_costT" value="">
                                        <input type="hidden" readonly class="form-control form-control" id="usage_cost" name="usage_cost" value="">
                                    </div>
    
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="data_id" name="data_id" value="" />
                        <input type="hidden" id="update" name="update" value="1" />
                        <div class="row" style="    text-align: center;">
                            <div class="form-group col-md-5 mb-2">
                            </div>
                            <div class="form-group col-md-2 mb-2">
                                <button type="submit" class="btn btn-primary">
                                    تعديل
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="type" name="type" value="{{$type}}">
<div class="content-body resultTblaa">
    <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header datatable_header" style="direction: rtl;">
                        <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}" /> 
                            {{ trans('archive.search_result') }}
                        </h4>
                        <div class="heading-elements1 onOffArea form-group mt-1" style="height: 20px; margin: 0px !important" title="ارسال رسالة نصية">
                            <img src="https://template.expand.ps/images/mob32.png" height="40px" onclick="smsWarning();/*$('#readSMSModal').modal('show');*/" style="cursor:pointer">
                                
                            <div class="form-group">
                                <a onclick="smsWarning();/*$('#readSMSModal').modal('show');*/" style="color:#000000">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row" id="resultTblaa">
                                <div class="col-xl-12 col-lg-12">
                                    <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right" class="detailsTB table wtbl">
                                        <thead>
                                            <tr style="text-align:center !important;background: #00A3E8;">
                                                <th width="30px">
                                                #
                                                </th>
                                                
                                                <th>
                                                   اسم المشترك 
                                                </th>
                                                <th>
                                                    رقم الهاتف  
                                                </th>
                                                <th>
                                                    رقم الاشتراك 
                                                </th>
                                                <th>
                                                    القراءة السابقة
                                                </th>
                                                <th>
                                                    تاريخها
                                                </th>
                                                <th>
                                                    القراءة الحالية
                                                </th>
                                                
                                                <th>
                                                    تاريخ الادخال
                                                </th>
                                                <th>
                                                     الوقت
                                                </th>
                                                <th>
                                                     الاستهلاك
                                                </th>
                                                <th>
                                                     التكلفة
                                                </th>
                                                <th>
                                                     حالة الارسال
                                                </th>
                                                <th>
                                                     تعديل
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="recListaa">
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>

<script>
    calcDuration();
    var searchResCount=0;
    
    function SubtractDates(d1,d2,returnFeild){
    d1Arr=d1.split('/')
    d2Arr=d2.split('/')
    d1Date=new Date(d1Arr[1]+'/'+d1Arr[0]+'/'+d1Arr[2])
    d2Date=new Date(d2Arr[1]+'/'+d2Arr[0]+'/'+d2Arr[2])
    if(d1Date>d2Date)
        alert('Ending date less than strartingdate')
    var diff = Math.abs(d1Date - d2Date);
    diffinyear=diff/(24*60*60*1000*30*12);
    diffinmonth=diff/(24*60*60*1000*30);
    month1=Math.floor(diffinmonth)-(Math.floor(diffinyear)*12)
    $("#"+returnFeild).val(Math.floor(diffinyear)+'Year,'+Math.floor(month1)+'M');
    console.log(diffinyear,diffinmonth);
}

    function calcDuration(str){
        twoDatesArr= new Array();
        twoDatesArr[0]= $('#frmDate').val();
        twoDatesArr[1]= $('#toDate').val();
        


        d1Arr=twoDatesArr[0].split('/')
        d2Arr=twoDatesArr[1].split('/')
        d1Date=new Date(d1Arr[1]+'/'+d1Arr[0]+'/'+d1Arr[2])
        d2Date=new Date(d2Arr[1]+'/'+d2Arr[0]+'/'+d2Arr[2])
        if(d1Date>d2Date){
            alert('تاريخ النهاية اقل من البداية')
            return;
        }
        var diff = Math.abs(d2Date - d1Date);
        diffinyear=diff/(24*60*60*1000*30*12);
        diffinmonth=diff/(24*60*60*1000*30);
        diffinday=diff/(24*60*60*1000);
        month1=Math.floor(diffinmonth)-(Math.floor(diffinyear)*12)
        day=Math.floor(diffinday)-(Math.floor(diffinmonth)*30)
        txt='';
        txt1='';
        strr='';
        if(Math.floor(diffinyear)>0)
            txt=Math.floor(diffinyear)+' سنة'

        if(Math.floor(month1)>0)
            txt1=Math.floor(month1)+' شهر, '
        if(txt.length>0) {
            strr = txt
            if(txt1.length>0)
                strr+=', '+txt1
            else
                strr+=', 0 شهر, '
        }
        else {
            if(txt1.length>0)
                strr+=txt1

        }
        $(".res").text(strr+Math.floor(day)+'يوم');
        //console.log(d2Date-d1Date);
        console.log(diffinyear,diffinmonth,diffinday);
    }
    
    $( function(){
            var table=$('.wtbl').DataTable({
                "language": {
                                    "sEmptyTable":     "ليست هناك بيانات متاحة في الجدول",
                                    "sLoadingRecords": "جارٍ التحميل...",
                                    "sProcessing":   "جارٍ التحميل...",
                                    "sLengthMenu":   "أظهر _MENU_ مدخلات",
                                    "sZeroRecords":  "لم يعثر على أية سجلات",
                                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                                    "sInfoPostFix":  "",
                                    "sSearch":       "ابحث:",
                                    "sUrl":          "",
                                    "oPaginate": {
                                        "sFirst":    "الأول",
                                        "sPrevious": "السابق",
                                        "sNext":     "التالي",
                                        "sLast":     "الأخير"
                                    },
                                    "oAria": {
                                        "sSortAscending":  ": تفعيل لترتيب العمود تصاعدياً",
                                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                                    }
                                }
            });
    });
    
    function search(){
        $('.loader').removeClass('hide');
        searchResCount=0;
        if ( $.fn.DataTable.isDataTable( '.wtbl' ) ) {
        $(".wtbl").dataTable().fnDestroy();
        $('#recListaa').empty();
        }
        let from = $("#frmDate").val();
        let to = $("#toDate").val();
        let type = $("#type").val();
        table=$('.wtbl').DataTable({
            processing:true,
            serverSide:true,
            info:true,
            
            ajax: {
                url: '{{ route('read_info_all') }}',
                data: function (d) {
                    d.from = from;
                    d.to = to;
                    d.type = type;
                }
            },
            columns:[
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'subscriper.name',name:'subscriper.name'},
                {data: 'phone',name:'phone'},
                {data: 'w_subscription.subscription_no',name:'w_subscription.subscription_no'},
                {data: 'prev_read',name:'prev_read'},
                {
                    data:null, 
                    render:function(data,row,type){
                        if(data.last_read != null){
                            $rowDateTime=data.last_read.created_at.split('T');
                            $rowDate=$rowDateTime[0].split('-');
                            $date=$rowDate[2]+'/'+$rowDate[1]+'/'+$rowDate[0];
                            
                            $actionbtn='<span class="hideMob" >'+ $date +'</span>'
                                        
                            return $actionbtn;
                            
                        }else{
                            return '_';
                        }
                    },
                    name:'last_read.created_at',
                        
                },
                {data: 'current_read',name:'current_read'},
                {
                    data:null, 
                    render:function(data,row,type){
                            $rowDateTime=data.created_at.split('T');
                            $rowDate=$rowDateTime[0].split('-');
                            $date=$rowDate[2]+'/'+$rowDate[1]+'/'+$rowDate[0];
                            $actionbtn='<span class="hideMob" >'+ $date +'</span>'
                            return $actionbtn;
                    },
                    name:'created_at',
                        
                },
                {
                        data:null, 
                        render:function(data,row,type){
                            $rowDateTime=data.created_at.split('T');
                            $time=$rowDateTime[1].substring(0, 5);
                            
                            $actionbtn='<span class="hideMob" >'+$time +'</span>'
                                        
                            return $actionbtn;
                        },
                        name:'created_at',
                        
                },
                {
                    data:null,
                    render:function(data,row,type){
                            return data.consumption+' كوب ';
                    },
                    name:'consumption'
                    
                },
                {
                    data:null,
                    render:function(data,row,type){
                            return data.usage_cost+' شيقل ';
                    },
                    name:'usage_cost'
                    
                },
                // {data: 'sms_statuse',name:'sms_statuse'},
                {
                    data:null,
                    render:function(data,row,type){
                        if(data.sms_statuse!=1001)
                            return ` <i title="لم يتم الارسال" 
                            class="fa fa-times" style="color: red;padding-right: 38px;"></i>`
                        else
                            return `<i title="تم الارسال" 
                                        class="fa fa-check" style="color: limegreen;padding-right: 38px;"></i>
                                    `
                    },
                    name:'sms_statuse'
                    
                },
                {
                    data: null, 
                    render:function(data,row,type){
                        userName=data.subscriper.name;
                        id=data.id;
                        phone=data.phone;
                        prev_read=data.prev_read;
                        current_read=data.current_read;
                        consumption=data.consumption;
                        usage_cost=data.usage_cost;
                        subsNo=data.w_subscription.subscription_no;
                        
                        $actionBtn = '<a onclick="update('+id+",'"+userName+"',"+phone+','+prev_read+','+current_read+','+consumption+','+usage_cost+",'"+subsNo+"')"+'"'+' class="btn btn-info" style="margin-left: 5px;"><i style="color:#ffffff" class="fa fa-edit"></i> </a>';
                        return $actionBtn;
                    },
                    name:'name',
                },
            ],
            dom: 'Bflrtip',
            buttons: [
                {
                    extend: 'excel',
                    tag: 'img',
                    title:'',
                    attr:  {
                        title: 'excel',
                        src:'{{asset('assets/images/ico/excel.png')}}',
                        style: 'cursor:pointer;display:inline;height: 40px; padding-top: 4px;',
                    },

                },
                {
                    extend: 'print',
                    tag: 'img',
                    title:'',
                    attr:  {
                        title: 'print',
                        src:'{{asset('assets/images/ico/Printer.png')}} ',
                        style: 'cursor:pointer;height: 32px;display:inline',
                        class:"fa fa-print"
                    },
                    customize: function ( win ) {
                  
 
                    $(win.document.body).find( 'table' ).find('tbody')
                        .css( 'font-size', '20pt' );
                    }
                },
                ],
            "language": {
                        "sEmptyTable":     "ليست هناك بيانات متاحة في الجدول",
                        "sLoadingRecords": "جارٍ التحميل...",
                        "sProcessing":   "جارٍ التحميل...",
                        "sLengthMenu":   "أظهر _MENU_ مدخلات",
                        "sZeroRecords":  "لم يعثر على أية سجلات",
                        "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                        "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",
                        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                        "sInfoPostFix":  "",
                        "sSearch":       "ابحث:",
                        "sUrl":          "",
                        "oPaginate": {
                            "sFirst":    "الأول",
                            "sPrevious": "السابق",
                            "sNext":     "التالي",
                            "sLast":     "الأخير"
                        },
                        "oAria": {
                            "sSortAscending":  ": تفعيل لترتيب العمود تصاعدياً",
                            "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                        }
                    }
    
        });
        table.on('init.dt', function() {
            $('.loader').addClass('hide');
            searchResCount=table.page.info().recordsTotal;
        })
    }
    
    function update(id,name,phone,prev_read,current_read,consumption,usage_cost,subsNo){
        $('#subscriber_name').val(name);
        $('#PHnum1').val(phone);
        $('#subsNo').val(subsNo);
        $('#prev_read').val(prev_read);
        $('#current_read').val(current_read);
        $('#consumption').val(consumption);
        $('#consumptionT').val(consumption+' كوب ');
        $('#usage_cost').val(usage_cost);
        $('#usage_costT').val(usage_cost+' شيكل ');
        $('#data_id').val(id);
        $('#updateRead').modal('show');
    }
    
    $('#updateReadForm').submit(function(e) {
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')

            }

        });
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
    
/////////////////////////for Production////////////////////////////////////////////////
    smstext='';
    function sendReadSMS(){
        // $('.loader').show()
        // if($('#smsText1').val().length==0){
        //     $('#smsText1').addClass('error');
        //     console.log('hi1')
        //     return;
        // }
        if($('#frmDate').val().length==0){
            $('#frmDate').addClass('error');
            console.log('hi2')
            return;
        }
        if($('#toDate').val().length==0){
            $('#toDate').addClass('error');
            console.log('hi3')
            return;
        }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                    'ContentType': 'application/json'
                }
            });
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            var formData={
                    'from':$('#frmDate').val(),
                    'to':$('#toDate').val(),
                }
            $.ajax({
                type: "post",
                url: "{{route('waterReadSMS')}}",
                ContentType: 'application/json',
                data: formData,
                dataType:'json',
                success: function (data) {
                    text='تم ارسال '+data.sucsessCount+' رسالة جديدة';
                    text+=' وفشل ارسال '+data.failCount;
                    text+=' وتم ارسال '+data.sentBeforeCount+' من قبل';
                    text+=' من اصل '+searchResCount+' رسالة'
                    Swal.fire(
                      'تم',
                      text
                    )
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                },
                error:function(){
                    return false;
                    $(".alert-success").addClass("hide");
                    $(".alert-danger").removeClass('hide');
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                    $(".loader").addClass('hide');
                },
            });
    }
    function smsWarning(){{
        if(searchResCount != 0)
            text='يرجي العلم انه سيتم ارسال رسالة بقيمة الاستهلاك الي '+searchResCount+' مواطن هل انت من ذلك '
            Swal.fire({
                title: 'تحذير',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ارسال',
                cancelButtonText: 'الغاء',
            }).then((result) => {
                if (result.isConfirmed) {
                    sendReadSMS();
                }else{
                }
            })
        }
    }
//////////////////////////////////////////////////////////////////////////////////////
    
    
// $( function() {
//     $(".cust").on("keyup",function(){
//         $("#customername").val($(this).val())
//     })
//     $( ".cust" ).autocomplete({
// 		source: 'archive_auto_complete',
// 		minLength: 1,
//         select: function( event, ui ) {
//             console.log(ui.item);
//             $('#customerid').val(ui.item.id);
//             $('#customerName').val(ui.item.name);
//             $('#customerType').val(ui.item.model);
//           }
// 	    });
//     });
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
</script>
@endsection