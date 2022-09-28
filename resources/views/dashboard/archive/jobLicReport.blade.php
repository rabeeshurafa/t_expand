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

    <!-- Hidden label form layout section start -->

    <section id="hidden-label-form-layouts">

        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title"><img src="{{ asset('assets/images/ico/report32.png') }}" />  تقرير </h4>

                    </div>

                    <div class="card-body">

                        <form id="formData" onsubmit="return false">

                            <div class="form-body">

                                <div class="row">

                                    <div class="col-lg-2 col-md-12 pr-0 pr-s-12"  >

                                        <div class="form-group">

                                            <div class="input-group w-s-87">

                                                <div class="input-group-prepend">

                                                    <span class="input-group-text" id="basic-addon1">

                                                        الحالة 

                                                    </span>

                                                </div>

                                                <select class="form-control" name="status" id="status" onchange="ShowYears()">

                                                    <option value="0" selected>اختر</option>

                                                    <option value="1">صادرة</option>
                                                    
                                                    <option value="3">مغلقة</option>

                                                    <option value="2">منتهية</option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>
                                    
                                    <div class="col-lg-2 col-md-12 pr-s-12 pr-0 date">
                                        <div class="form-group">
                                            <div class="input-group w-s-87">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        {{"من تاريخ"}}
                                                    </span>
                                                </div>
                                                <input type="text" id="from" maxlength="10" data-mask="00/00/0000" name="from" class="form-control singledate " placeholder="dd/mm/yyyy" aria-describedby="basic-addon1" aria-invalid="false" value="<?php echo date('d/m/Y')?>" autocomplete="off" onblur="calcDuration()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 pr-s-12 pr-0 date">
                                        <div class="form-group">
                                            <div class="input-group w-s-87">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        {{"الى تاريخ"}}
                                                    </span>
                                                </div>
                                                <input type="text" id="to" maxlength="10" data-mask="00/00/0000" name="to" class="form-control singledate " placeholder="dd/mm/yyyy" aria-describedby="basic-addon1" aria-invalid="false" value="<?php echo date('d/m/Y')?>" autocomplete="off" onblur="calcDuration()">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-12 pr-s-12 pr-0 years hide">
                                        <div class="form-group">
                                            <div class="input-group w-s-87">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        عدد السنوات
                                                    </span>
                                                </div>
                                                <input type="text" id="years"  name="years" class="form-control singledate " aria-describedby="basic-addon1" aria-invalid="false"  autocomplete="off" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-12">

                                        <div class="form-group">

                                            <button type="button" onclick="search()" class="btn btn-primary addBtn"  id="save">

                                                بحث

                                                <i class="ft-search"></i>

                                            </button>

                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="form-group res">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>



        </div>

    </section>

    <!-- // Hidden label form layout section end -->

</div>



<input type="hidden" id="type" name="type" value="{{$type}}">

<div class="content-body resultTblaa">

    <div class="row">

            <div class="col-xl-12 col-lg-12">

                <div class="card">

                    <div class="card-header" style="direction: rtl;">

                        <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}" /> 

                            {{ trans('archive.search_result') }}</h4>

                    </div>

                    <div class="card-body">

                        <div class="form-body">

                            <div class="row" id="resultTblaa">

                                <div class="col-xl-12 col-lg-12">

                                    <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right" class="detailsTB table wtbl">

                                        <thead>

                                            <tr style="text-align:center !important;background: #00A3E8;">
                                                <th width="50px">
                                                #
                                                </th>
                                                <th>
                                                   اسم حامل الرخصة
                                                </th>
                                                <th>
                                                الاسم التجاري
                                                </th>
                                                <th>
                                                  رقم الرخصة
                                                </th>
                                                <th>
                                                   الشارع / المنطقة
                                                </th>
                                                <th>
                                                    نوع الحرفة او الصناعة
                                                </th>
                                                <th>
                                                   تاريخ الاصدار
                                                </th>
                                                <th>
                                                   تاريخ الانتهاء
                                                </th>
                                                <th class="date">
                                                   رقم الوصل
                                                </th>
                                                <th class="years hide">
                                                   عدد السنوات
                                                </th>
                                                <th>
                                                    الحالة
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

@endsection

@section('script')

<script>  

function ShowYears(){
    if($('#status').val()==2){
        $('.years').removeClass('hide');
        $('.date').addClass('hide');
    }else{
        $('.years').addClass('hide');
        $('.date').removeClass('hide');
    }
}
calcDuration();
        

    $( function(){

        var table = $('.wtbl').DataTable({

                        dom: 'Bfltip',

                        buttons: [

                            {

                                extend: 'excel',

                                tag: 'img',

                                title:'',

                                attr:  {

                                    title: 'excel',

                                    src:'{{asset('assets/images/ico/excel.png')}}',

                                    style: 'cursor:pointer; height:32px',

                                },

                            },

                            {

                                extend: 'print',

                                tag: 'img',

                                title:'',

                                attr:  {

                                    title: 'print',

                                    src:'{{asset('assets/images/ico/Printer.png')}} ',

                                    style: 'cursor:pointer;height: 32px;',

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

            

    });

    function search(){

        if ( $.fn.DataTable.isDataTable( '.wtbl' ) ) {

        $(".wtbl").dataTable().fnDestroy();

        $('#recListaa').empty();

        }

        var table=$('.wtbl').DataTable({

                processing:true,

                serverSide:true,

                info:true,

                ajax: {

                    url: '{{ route('getJobLicReport') }}',

                    data: function (d) {
                        
                        d.from = $("#from").val();
                        d.to = $("#to").val();
                        d.statuse = $("#status").val();
                        d.years = $("#years").val();
                    }

                },

                fixedHeader: true,

                columns:[
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {
                    data: null, 
                    render:function(data,row,type){
                        $actionBtn = '<a target="_blank" href="{{ route('admin.dashboard') }}/subscribers'+'?id='+data.user_id+'">'+data.name+'</a>';
                            return $actionBtn;
                    },
                    name:'name',
                
                },
                {data:'business_name'},
                {data:'licNo'},
                {data:'street'},
                {data:'lic_type'},
                {data:'start_date'},
                {data:'end_date'},
                {data:'waselNo'},

                // { 
                //     data: null, 
                //     render:function(data,row,type){
                //         if($('#status').val()==2)
                //             return data.years;
                //         else
                //             return data.waselNo;
                //     },
                    
                //     name:'waselNo',
                // },
                { 
                    data: null, 
                    render:function(data,row,type){
                        if(data.isSertEnd==false)
                            if(data.is_stoped==0)
                                $statuse = '<span style="color: red;">'+data.statuse+'</span>';
                            else
                                $statuse = '<span >'+data.statuse+'</span>';
                        else
                            $statuse = '<span>'+data.statuse+'</span>';
                        return $statuse;
                    },
                    name:'status',
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

                        style: 'cursor:pointer;display:inline; height:32px',

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

            table.buttons().container().appendTo($('.datatable_header'));





    }

        function calcDuration(str){

            twoDatesArr= new Array();

            twoDatesArr[0]= $('#period1').val();

            twoDatesArr[1]= $('#period2').val();

            

    

    

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

        $( function() {

        $( ".ac" ).autocomplete({

		source: 'subscribe_auto_complete',

		minLength: 1,

		

        select: function( event, ui ) {

            let subscribe_id = (ui.item.id)

            $("#customerid").val(ui.item.id);

            $("#customerName").val(ui.item.label);
            $("#model").val(ui.item.model);
            

        }

	});

    } );
function calcDuration(str){
    twoDatesArr= new Array();
    twoDatesArr[0]= $('#from').val();
    twoDatesArr[1]= $('#to').val();
    


    d1Arr=twoDatesArr[0].split('/')
    d2Arr=twoDatesArr[1].split('/')
    d1Date=new Date(d1Arr[1]+'/'+d1Arr[0]+'/'+d1Arr[2])
    d2Date=new Date(d2Arr[1]+'/'+d2Arr[0]+'/'+d2Arr[2])
    if(d1Date>d2Date){
        alert('تاريخ النهاية اقل من البداية')
        //$('#from').val()=$('#to').val();
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
    // console.log(diffinyear,diffinmonth,diffinday);
}


</script>

@endsection