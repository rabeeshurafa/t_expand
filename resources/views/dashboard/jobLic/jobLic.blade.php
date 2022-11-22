@extends('layouts.admin')
@section('search')
<li class="dropdown dropdown-language nav-item hideMob">
            <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث" style="text-align: center;width: 350px; margin-top: 15px !important;">
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
    td{
        height:40px;
    }
    u,li{
        font-weight: bold;
    }
    
    @media print{
        input,textarea{
            border:0px solid #ffffff!important;
        }
        textarea{
            width:100%;
        }
        body{
            margin:0px;
        }
        .hidePrint{
            display: none;
        }
        .hidePrintB{
            display: none;
        }
        #businessName{display:none}

        .header{margin-top: 50 px !important;}

    }
    
    </style>


    <link rel="stylesheet" type="text/css"
        href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css" />
        
       <div class="modal fade text-left" id="AppModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">

    <div class="modal-dialog" style="width: 30%;" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1"> 
                اعدادات رخص الحرف
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="background: #f4f5fa">
                <form method="post" id="setting_form" enctype="multipart/form-data">
                    <div class="form-body">
                        @csrf
                        <div class="row DisabledItem white-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card ">
                                    <div class="card-content collapse show">
                                        <div class="card-body" style="padding-bottom: 0px;">
                                            <div class="form-body">
                                                <div class="row mobRow">
                                                    <div class="input-group col-md-12" style=" padding-bottom: 10px">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                المبلغ المطلوب
                                                            </span>
                                                        </div>
                                                         <input type="text" id="price"  class="form-control numFeild modalAC" value="{{$setting->job_lic_cost}}"
                                                           name="price" placeholder="المبلغ المطلوب" >
                                                        <select id="CurrencyID" name="CurrencyID" type="text" class="form-control valid" aria-invalid="false">

                                                            <option value="26" {{($setting->cost_curr == 26 ? 'selected' :'')}} > شيكل </option>
                                        
                                                            <option value="28" {{($setting->cost_curr == 28 ? 'selected' :'')}}> دينار </option>
                                        
                                                            <option value="27" {{($setting->cost_curr == 27 ? 'selected' :'')}}> دولار </option>
                                        
                                                            <option value="31" {{($setting->cost_curr == 31 ? 'selected' :'')}}> يورو </option>
                                        
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mobRow">
                                                    <hr>
                                                    <div class="col-md-12">
                                                        <div class="card-header" style="padding-top:0px;">
                                                            <h4 class="card-title">
                                                                الترويسة
                                                            </h4>                    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card-content collapse show">
                                                            <div class="card-body" style="padding-bottom: 0px;">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 pr-s-12 pr-0" style="text-align: center;">
                                                                        <img id="userHeaderImg" src="{{$setting->job_lic_header}}" style="height: 50px; cursor:pointer" onclick="document.getElementById('header_img_file').click(); return false">
                                                                        <input type="file" class="form-control-file" id="header_img_file" name="header_img_file" style="display: none" onchange="doUploadPic()" aria-invalid="false">
                                                                        <input type="hidden" id="header_img" name="header_img">
                                                                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                {{--<div class="row mobRow">
                                                    <hr>
                                                    <div class="col-md-12">
                                                        <div class="card-header" style="padding-top:0px;">
                                                            <h4 class="card-title">
                                                                التذييل
                                                            </h4>                    
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card-content collapse show">
                                                            <div class="card-body" style="padding-bottom: 0px;">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 pr-s-12 pr-0" style="text-align: center;">
                                                                        <img id="userFooterImg" src="{{$setting->job_lic_footer}}" style="height: 50px; cursor:pointer" onclick="document.getElementById('footer_img_file').click(); return false">
                                                                        <input type="file" class="form-control-file" id="footer_img_file" name="footer_img_file" style="display: none" onchange="doUploadPic()" aria-invalid="false">
                                                                        <input type="hidden" id="footer_img" name="footer_img">
                                                                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>--}}
                                                
                                                <div class="form-actions" style="border-top:0px; padding-bottom:44px;">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary" id="saveBtn">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
        
    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="formDataaa" enctype="multipart/form-data" style="background: #FFF;margin-bottom: 50px;padding: 20px;">
            @csrf
            <div class="row white-row">
                <input type="hidden" id="customerId" name="customerId">
                <input type="hidden" id="jobLicId" name="jobLicId">
                <input type="hidden" id="customerType" name="customerType">
                <input type="hidden" id="pk_i_id" name="pk_i_id" value="">
                <table style="width:100%" dir="rtl">
                    <tr>
                        <td  align="left">
                            <a onclick="ShowConfigModal()" style="color:#000000">
                                <img src="{{ asset('assets/images/ico/config.png') }}" height="30px" style="cursor:pointer">
                            </a>
                        </td>
                    </tr>
                </table>
                <table style="width:100%" dir="rtl" id="for-print">
                    
                    <tr>
                        <td colspan="4" align="center">
                            <h2 class="header">
                                (رخصة حرف و صناعات)
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="12%">
                          رقم الرخصة
                            </td>
                            <td width="20%">
                            <input type="text" style="display: inline-block;width:70%;" value="{{$licNo}}" id="licNo" class="form-control hidePrintB" placeholder="أدخل رقم الرخصة " name="licNo">
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="12%">
                            اسم حامل الرخصة:
                            </td>
                            <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="name" class="form-control  cust" placeholder="أدخل اسم حامل الرخصة " name="name">
                            
                        </td>
                        <td  align="right" width="7%" class="businessName">
                            الاسم التجاري
                            </td>
                            <td class="businessName"> 
                            <input type="text" style="display: inline-block;width:28%;" value="" id="businessName" class="form-control businessName" placeholder=" " name="businessName">

                        </td>
                    </tr>
                    <tr>
                        <td  align="right" width="12%">
                            رقم الهوية:
                            </td>
                            <td>
                            <input type="text"  minlength="9"  maxlength="9" style="display: inline-block;width:70%;" value="" id="nationalId" class="form-control hidePrintB" placeholder="أدخل رقم الهوية " name="nationalId">
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>
                    <tr>
                        <td  align="right" width="10%">
                            العنوان:   
                            </td>
                            <td>
                            <input type="text" style="display: inline-block;width:70%;" value="{{($town->name ?? '')}}" id="address" class="form-control hidePrintB" placeholder=" " name="address">

                        </td>
                        <td  align="right" width="7%">
                            الشارع/المنطقة: 
                            </td>
                            <td > 
                            <input type="text" style="display: inline-block;width:28%;" value="" id="street" class="form-control hidePrintB" placeholder=" " name="street">

                        </td>
                    </tr>
                    <tr>
                        <td  align="right" width="12%">
                            صنف الرخصة: 
                            </td>
                            <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="lic_cat" class="form-control hidePrintB" placeholder="أدخل صنف الرخصة " name="lic_cat">
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>
                    <tr>
                        <td  align="right" width="12%">
                            نوع الحرفة أو الصناعة
                            </td>
                            <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="lic_type" class="form-control hidePrintB" placeholder="أدخل نوع الحرفة أو الصناعة " name="lic_type">
                        </td>
                        <td colspan="2">
                        </td>
                    </tr>
                    <tr class="had1">
                        <td width="13%">
                            رقم (الحد الرابع من التصنيف)
                            </td>
                        <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="hadNo" class="form-control hidePrintB had1_1" placeholder="أدخل رقم الحد الرابع من التصنيف " name="hadNo[]">
                        </td>
                        <td width="7%">
                            الاسم
                        </td>
                        <td>
                            <input type="text" style="display: inline-block;width:28%;" value="" id="lic_name" class="form-control hidePrintB had1_2" placeholder="أدخل اسم الحرفة " name="lic_name[]">
                            <a class="add-btn" onclick="addHad();" style="margin-left: 0px; margin-right: 36px; padding-top: 9px;">
                                <i class="fa fa-plus" style="color:#1E9FF2;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="had2" style="display: none;">
                        <td width="13%">
                            رقم (الحد الرابع من التصنيف)
                            </td>
                        <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="hadNo" class="form-control hidePrintB had2_1" placeholder="أدخل رقم الحد الرابع من التصنيف " name="hadNo[]">
                        </td>
                        <td width="7%">
                            الاسم
                        </td>
                        <td>
                            <input type="text" style="display: inline-block;width:28%;" value="" id="lic_name" class="form-control hidePrintB had2_2" placeholder="أدخل اسم الحرفة " name="lic_name[]">
                            <a class="add-btn" onclick="deleteHad(2);" style="margin-left: 0px; margin-right: 36px; padding-top: 9px;">
                                <i class="fa fa-trash" style="color:#1E9FF2;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="had3" style="display: none;">
                        <td width="13%">
                            رقم (الحد الرابع من التصنيف)
                            </td>
                        <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="hadNo" class="form-control hidePrintB had3_1" placeholder="أدخل رقم الحد الرابع من التصنيف " name="hadNo[]">
                        </td>
                        <td width="7%">
                            الاسم
                        </td>
                        <td>
                            <input type="text" style="display: inline-block;width:28%;" value="" id="lic_name" class="form-control hidePrintB had3_2" placeholder="أدخل اسم الحرفة " name="lic_name[]">
                            <a class="add-btn" onclick="deleteHad(3);" style="margin-left: 0px; margin-right: 36px; padding-top: 9px;">
                                <i class="fa fa-trash" style="color:#1E9FF2;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="had4" style="display: none;">
                        <td width="13%">
                            رقم (الحد الرابع من التصنيف)
                            </td>
                        <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="hadNo" class="form-control hidePrintB had4_1" placeholder="أدخل رقم الحد الرابع من التصنيف " name="hadNo[]">
                        </td>
                        <td width="7%">
                            الاسم
                        </td>
                        <td>
                            <input type="text" style="display: inline-block;width:28%;" value="" id="lic_name" class="form-control hidePrintB had4_2" placeholder="أدخل اسم الحرفة " name="lic_name[]">
                            <a class="add-btn" onclick="deleteHad(4);" style="margin-left: 0px; margin-right: 36px; padding-top: 9px;">
                                <i class="fa fa-trash" style="color:#1E9FF2;"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right; direction:rtl;"><span class=""></span></td>
                        <td></td>
                        <td class="br" style="text-align:right; direction:ltr;">
                        </td>
                    </tr>
                    <tr>
                        <td >
                            تاريخ الإصدار: 
                        </td>
                        <td>
                            <input type="text" value="<?php echo date('d/m/Y');?>" style="display: inline-block;width:70%;" value="" id="start_date" data-mask="00/00/0000" maxlength="10" class="form-control hidePrintB" placeholder="أدخل تاريخ الإصدار " name="start_date">
                        </td>
                        <td width="7%">
                            تاريخ الإنتهاء: 
                        </td>
                        <td>
                            <input type="text" style="display: inline-block;width:28%;" value="31/03/<?php echo date('m')<=3?date('Y'):date('Y')+1; ?>" id="end_date" data-mask="00/00/0000" maxlength="10" class="form-control hidePrintB" placeholder="أدخل تاريخ الإنتهاء " name="end_date">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            رقم الوصل: 
                        </td>
                        <td>
                            <input type="text" style="display: inline-block;width:70%;" value="" id="waselNo" class="form-control hidePrintB" placeholder="أدخل رقم الوصل " name="waselNo">
                        </td>
                        <td width="7%"> 
                            تاريخ الوصل: 
                        </td>
                        <td>
                            <input type="text" value="<?php echo date('d/m/Y');?>" style="display: inline-block;width:28%;" value="" id="wasel_date" data-mask="00/00/0000" maxlength="10" class="form-control hidePrintB" placeholder="أدخل تاريخ الوصل " name="wasel_date">
                        </td>
                    </tr>
                </table>
                
                <!--<button type="button" class="hidePrint" style="position: fixed;left: 50px;">-->
                <!--    <img src="https://y.expand.ps/images/printer.jpeg" id="makeResponse" height="32px" style="cursor: pointer" onclick="printData1();">-->
                <!--</button>-->
                 <button class="hidePrint btn btn-info" onclick="printData1();" style="position: fixed;left: 120px;" type="submit" >
                   <img src="https://db.expand.ps/images/printer.jpeg" id="makeResponse" height="32px" style="cursor: pointer" onclick="printData1();">
                   حفظ وطباعة 
                </button>
            </div>
            
        

        </form>
        
        
    </section>
@include('dashboard.component.fetch_table')
        @endsection

@section('script')

<script>

function ShowConfigModal() {

// $("#CitizenName").html($("#formDataNameAR").val())

$("#AppModal").modal('show')

}
had2active=0;
had3active=0;
had4active=0;
function addHad(){
    if(had2active==0){
        $('.had2').show();
        had2active=1;
    }else if(had3active==0){
        $('.had3').show();
        had3active=1;
    }else if(had4active==0){
        $('.had4').show();
        had4active=1;
    }
}
function deleteHad(index){
    
    $(('.had'+index)).hide();
    if(index==2){
        $('.had2_1').val('');
        $('.had2_2').val('');
        had2active=0;
    }else if(index==3){
        $('.had3_1').val('');
        $('.had3_2').val('');
        had3active=0;
    }else if(index==4){
        $('.had4_1').val('');
        $('.had4_2').val('');
        had4active=0;
    }
    
}

function printData1()
{
//   var divToPrint=document.getElementById("for-print");
//       console.log(divToPrint);

//   newWin= window.open("");
//   newWin.document.write(divToPrint.outerHTML);
//   newWin.print();
//   newWin.close();
var html='';
$('#formDataaa input').each(function(){
    txt=$(this).val();
if($(this).attr('name')!='_token'||$(this).attr('type')!='hidden'){
    $(this).hide();
    $(this).parent().append('<span class="txt">'+txt+'</span>')
}
});
   var mywindow = window.open('', 'PRINT', 'height=400,width=600');

                  mywindow.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">');
                  mywindow.document.write('<style>'
                  +'td{width:150px !important;height:40px!important;font-size:14pt!important;}'
                  +'.header{margin-top:20px !important;}'
                  +' input,textarea{'
                    +'     border:0px solid #ffffff !important;'
                   +'  }'
                +'.businessName{display:none}'
                  +'@media print {'
                  +'      .footerLine{'
                +'            display:block;'
                 +'           bottom:0;'
                  +'          width: 100%;'
                +'            position:fixed; '   
                 +'           text-align: center;'
                  +'          font-weight: bold;'
                +'            font-size: 16px;'
                +'       }'
                +'td {'
                +      'width: .1% !important;'
                + '}'
                 +' input,textarea{'
                    +'     border:0px solid #ffffff !important;font-size:14pt!important;height:40px!important;'
                   +'  }'
                   +'.header{margin-top:20px !important;}'
                  +'  }'
                  +'</style>');
                  mywindow.document.write('</head><body style=" line-height: 24; font-size: 14px;" ><img src="{{$setting->job_lic_header}}" width="100%" style="max-width:100%">');
                  

                    mywindow.document.write('<table style="width:100%" dir="rtl" id="for-print">');
    //  console.log($("#for-print").html());
                    var footer='<tr>'
                                    
                                    +'<tr>'
                                    +'<td></td>'
                                    +'</tr>'
                                    +'<td colspan="4" align="left">'
                                      +'  توقيع سلطة الترخيص'
                                      +' <br><br>'
                                    +'</td>'
                                    +'</tr>'
                                    +'<tr>'
                                    +'  <td colspan="4" align="left" style="padding-top:70px; width:100% !important;">'
                                     +'    <hr style="border:2px solid #000000">'
                                     +'   </td>'
                                    +'</tr>'
                                    +   '<tr>'
                                    +'<td colspan="4" align="right">'
                                    +'    <b>الشروط:'
                                     +'   </b>'
                                      +'  <ul>'
                                    +'        <li>'
                                     +'       يعمل بهذه الرخصة لمدة سنة واحدة تبدأ في أول نيسان من كل سنة وتنتهي في 31 آذار من السنة التي تليها.'
                                      +'      </li>'
                                    +'        <li>'
                                     +'           لا يجوز تحويل الرخصة الى شخص آخر.'
                                      +'      </li>'
                                        +'    <li>'
                                          +'      يجب عرض الرخصة في مكان بارز.'
                                            +'</li>'
                                    +'    </ul>'
                                    +'</td>'
                            +'    </tr>'
                  mywindow.document.write($("#for-print").html());
                  mywindow.document.write(footer);
                  mywindow.document.write('</table></body></html>');
                    
                  mywindow.document.close(); // necessary for IE >= 10
                  mywindow.focus();
                  
    $(".txt").remove()
    $('#formDataaa input').show();
}

$('#setting_form').submit(function(e) {
    $(".loader").removeClass('hide');
   let formData = new FormData(this);
   
   e.preventDefault();
   $.ajax({
      type:'POST',
      url: "{{route('store_JobLic_settings')}}",
       data: formData,
       contentType: false,
       processData:false ,
       //dataType:json ,
       success: (response) => {
         if (response) {
            $(".loader").addClass('hide');
		    Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: 'تم حفظ الإعدادات',
				showConfirmButton: false,
				timer: 1500
				})
             }
             
            $("#AppModal").modal('show')
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
});

$('#formDataaa').submit(function(e) {
    $(".loader").removeClass('hide');
    
    if($('#name').val()==null || $('#name').val().length==0){
        $('#name').addClass('error');
        $(".loader").addClass('hide');
        return false;
    }
    if($('#customerId').val()==null || $('#customerId').val().length==0){
        $('#name').addClass('error');
        $(".loader").addClass('hide');
        return false;
    }
    
    $( "#customerName" ).removeClass( "error" );
    $( "#licNo" ).removeClass( "error" );
    
       e.preventDefault();
       let formData = new FormData(this);
        /////////////////////////////to not increment currunt LicNo on update////////////////
        isupdate=false;
        if($('#jobLicId').val() != null && $('#jobLicId').val() != ''){
            isupdate=true;
        }
        ////////////////////////////////////////////////////////////////////////////////////
       $.ajax({
          type:'POST',
          url: "{{route('store_jobLic')}}",
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
            $(".loader").addClass('hide');
             $('.wtbl').DataTable().ajax.reload();
            //  console.log(response);
             if (response) {
                Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '{{trans('admin.data_added')}}',
				showConfirmButton: false,
				timer: 1500
				})
               this.reset();
               $('#customerId').val('');
                $('#jobLicId').val('');
                $('#pk_i_id').val('');
               if(isupdate){
                   licNo=({{$licNo}});
               }else{
                   licNo=({{$licNo}}+1);
               }
                $('#licNo').val(licNo);
             }
              
           },
           error: function(response){
            $(".loader").addClass('hide');
            if(response.responseJSON.errors.name){
                $( "#name" ).addClass( "error" );
                $( "#name" ).get(0).setCustomValidity('يرجى ادخال اسم معرف في النظام  ');
                $( "#name" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.customerId){
                $( "#name" ).addClass( "error" );
                $( "#name" ).get(0).setCustomValidity('يرجى ادخال اسم معرف في النظام  ');
                $( "#customerId" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: '{{trans('admin.error_save')}}',
				showConfirmButton: false,
				timer: 1500
				})

           }
       });
  });

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
  $( function() {
      
    $( ".cust_auto" ).autocomplete({
		source: 'subscribe_auto_complete',
		minLength: 1,
		
        select: function( event, ui ) {
           
            var currentIndex=$("input[name^=copyToID]").length -1;
            $('input[name="copyToID[]"]').eq(currentIndex).val(ui.item.id);
            $('input[name="copyToCustomer[]"]').eq(currentIndex).val(ui.item.name);
            $('input[name="copyToType[]"]').eq(currentIndex).val(ui.item.model);
        }
	});
});
$( function() {
    $( ".cust" ).autocomplete({
		source: 'subscribe_auto_complete',
		minLength: 1,
		
        select: function( event, ui ) {
            // console.log(ui.item);
            $('#name').val(ui.item.name);
            $('#customerId').val(ui.item.id);
            $('#customerType').val(ui.item.model);
            $("#nationalId").val(ui.item.national_id);
            
           }
	    });
    });
function update($id)
{
    
    let jobLic_id = $id;
    $.ajax({
    type: 'get', // the method (could be GET btw)
    url:"{{route('jobLic_info')}}",

        data: {
            jobLic_id: jobLic_id,
        },
        success:function(response){
            // console.log(response.info)
        $('#customerId').val(response.info.user_id);
        $('#jobLicId').val(response.info.id);
        
        $('#name').val(response.info.name);
        $("#address").val(response.info.address);
        $("#street").val(response.info.street);
        $("#lic_cat").val(response.info.lic_cat);
        $("#nationalId").val(response.info.nationalId);
        $("#lic_type").val(response.info.lic_type);
        // $("#hadNo").val(response.info.hadNo);
        // $("#lic_name").val(response.info.lic_name);
        $("#waselNo").val(response.info.waselNo);   
        $("#businessName").val(response.info.business_name);   
        for(i=0 ; i< response.info.hadNo.length ; i++){
            hadNo=response.info.hadNo[i];
            licName=response.info.lic_name[i];
            if(hadNo != null){
                if(i==0){
                    $('.had'+(i+1)+'_1').val(hadNo);
                    $('.had'+(i+1)+'_2').val(licName);
                    
                }else{
                    $('.had'+(i+1)+'_1').val(hadNo);
                    $('.had'+(i+1)+'_2').val(licName);
                    if(i==1){
                        $('.had2').show();
                        had2active=1;
                    }else if(i==2){
                        $('.had3').show();
                        had3active=1;
                    }else if(i==3){
                        $('.had4').show();
                        had4active=1;
                    }
                }
            }
        }
        if(response.renew!=1){
            $("#licNo").val(response.info.licNo);
            let date=(response.info.start_date)
            dates=""
            if(date){
            dates=date.split("-");
            dates = dates[2]+'/'+dates[1]+'/'+dates[0];}
            $("#start_date").val(dates);
            
             date=(response.info.end_date)
            dates=""
            if(date){
            dates=date.split("-");
            dates = dates[2]+'/'+dates[1]+'/'+dates[0];}
            $("#end_date").val(dates);
            
             date=(response.info.wasel_date)
            dates=""
            if(date){
            dates=date.split("-");
            dates = dates[2]+'/'+dates[1]+'/'+dates[0];}
            $("#wasel_date").val(dates);
            
        }else{
            $("#start_date").val('');
            $("#end_date").val('');
            $("#wasel_date").val('');
            $("#waselNo").val('');
        }
       
        },
    });
}
</script>

@endsection

