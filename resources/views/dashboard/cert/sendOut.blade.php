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
#fullBody{
    height:382px;
}
.swal2-html-container{
    font-size: 18px !important;
    
}
</style>

<script src="https://template.expand.ps/public1/ckeditor/ckeditor.js"></script>
<div role="tabpanel" class="tab-pane active show" id="activeIcon1" aria-labelledby="activeIcon1-tab1" aria-expanded="true">
            <form id="ticketFrm" novalidate >
                <!-- horizontal grid start -->
                <section class="horizontal-grid" id="horizontal-grid">
                    <div class="row white-row">
                        <div class="col-sm-12 col-lg-6 col-md-12">
                            <div class="card leftSide">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <img src="https://template.expand.ps/images/personal-information.png" width="32" height="32">
                                        بيانات مقدم الطلب</h4>
                                </div>
                                <div class="card-content collapse show" >
                                    <div class="card-body" style="padding-bottom: 0px;">
                                        <div class="form-body">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 pr-0 pr-s-12 hide"  >
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
														<span class="input-group-text" id="basic-addon1" style="width: 81px ;">
															رقم الوصل
														</span>
                                                            </div>
                                                            <input type="text" id="recept_no" class="form-control numFeild" placeholder="رقم الوصل" name="recept_no"  autocomplete="off" style="color:darkslategrey; border-color: slategray;  margin-left: 15px;">
                                                            <input type="hidden" id="pk_i_id" name="pk_i_id" value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row hide">
                                                <div class="col-lg-8 col-md-12 pr-s-12 ">
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87 mt-s-6" >
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                  اسم مقدم الطلب
                                                                </span>
                                                            </div>
                                                            <input required type="text" id="citizen_name" class="form-control alphaFeild cust" placeholder="مقدم الطلب" name="citizen_name" style="color:darkslategrey; border-color: slategray" aria-required="true" aria-invalid="false">
                                                            <input type="hidden" value="0" id="applicantID" name="applicantID" class="form-control ccac alphaFeild">
                                                            <input type="hidden" id="model" name="model" value="App\Models\User">
                                                            <input type="hidden" value="0" id="cer_pk_id" class="form-control" placeholder="" name="cer_pk_id">
                                                            <input type="hidden" value="{{$e_type}}" id="e_type" class="form-control" placeholder="" name="e_type">
                                                            <input type="hidden" id="app_type" name="app_type" value="1">
                                                            <input type="hidden" id="app_no" name="app_no" value="<?php /* echo $res[0]->cnt*/ ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-header hide">
                                    <h4 class="card-title">تفاصيل المراسلة</h4>
                                    <!-- <a class="heading-elements-toggle">
                                        <i class="ft-align-justify font-medium-3"></i></a> -->
                                </div>

                                <div class="card-content collapse show">
                                    <div class="card-body" style="padding-top: 0px;">

                                        <div class="row">

                                            <div class="col-lg-5 col-md-12 pr-s-12" >
                                                <div class="form-group">
                                                    <div class="input-group w-s-87 mt-s-6">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                  عنوان المراسلة
                                                                </span>
                                                        </div>
                                                        <select type="text" id="msgTitle" class="form-control selectFullCorner" onchange="copytxt($(this).val())" name="msgTitle" style="color:darkslategrey; border-color: slategray">
                                                            <option value="0" style="font-size: 18px;"> -- المراسلة --</option>
                                                            @foreach($CertExtention as $cert)
                                                            <option id="certID" value="{{$cert->pk_i_id}}">{{$cert->s_name_ar}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append" onclick="AddNew('msgTitle','المراسلة')" style="cursor:pointer">
                                                                <span class="input-group-text input-group-text2">
                                                                <i class="fa fa-external-link"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-12 pr-s-12" style="padding-right: 0">
                                                <div class="form-group">
                                                    <div class="input-group w-s-87 mt-s-6">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                رقم المراسلة
                                                            </span>
                                                        </div>
                                                        <input  type="text" id="serial_per_year" class="form-control" name="serial_per_year" value="{{$CertCount}}"  onblur="$('#certCnt').html($(this).val());$('.serial_no').html($(this).val());"style="color:darkslategrey; border-color: slategray;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-12 " style="padding-right: 0">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                  تاريخ المراسلة
                                                </span>
                                                    </div>
                                                    <input required type="text" id="cer_date" data-mask="00/00/0000" maxlength="10"  class="form-control" onblur="$('.cer_date').html($(this).val());" name="cer_date" value="<?php  echo date('d/m/Y'); ?>"style="color:darkslategrey; border-color: slategray;">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">

                                            <div class="col-lg-6 col-md-12 pr-s-12" style="">
                                                <div class="form-group">
                                                    <div class="input-group w-s-87 mt-s-6" style="width:100% !important">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                   مقدم الطلب
                                                                </span>
                                                        </div>
                                                        <input  type="text" id="benefitS" name="benefitS" class="form-control cust" placeholder=" " aria-describedby="basic-addon1" style="color:darkslategrey; border-color: slategray" value="">
                                                        <input  type="hidden" id="benefitside_cd" name="benefitside_cd" value="0">
                                                        <input  type="hidden" id="benefitside_lbl" name="benefitside_lbl" value="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-5 col-md-12 pr-s-12" style="padding-right: 0">
                                                <div class="form-group">
                                                    <div class="input-group w-s-87 mt-s-6">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon2">
                                                                   صادرة الى
                                                                </span>
                                                        </div>
                                                        <input  type="text" id="sentDir" name="sentDir" class="form-control cust1" placeholder=" " aria-describedby="basic-addon1" style="color:darkslategrey; border-color: slategray" value="">
                                                        <input  type="hidden" id="sentId" name="sentId" value="0">
                                                        <input  type="hidden" id="sentModel" name="sentModel" value="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1 col-md-12" style="padding-right: 0;margin-top: 5px">
                                                <div class="form-group">
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                  اخفاء العنوان
                                                                </span>
                                                        </div>
                                                        <input class="form-check-input" type="checkbox" onclick="$('#msg_title').toggle()" value="" id="show_title">
                                                    </div>
                                                </div>
                                            </div>


                                        </div>


                                        <div class="row">

                                            <div class="col-lg-12 col-md-12 pr-s-12" style="">
                                                <div class="form-group">
                                                    <div class="input-group w-s-87 mt-s-6" style="width: 98% !important;">
                                                        <div  class="summernote"></div>
                                                        <textarea id="summary-ckeditor" name="summary-ckeditor"  class="form-control" onchange="$('#msg_content').html($('#msgContent').val())" onkeyup="$('#msg_content').html($('#msgContent').val())" style="color:darkslategrey; border-color: slategray; font-size: 14pt;"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @include('dashboard.includes.attachmentCert')
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-6 col-md-12">
                            <div class="card rightSide">

                                <div class="card-header">
                                    <h4 class="card-title">المراسلة
                                    &nbsp;(<span id="certCnt"> {{$CertCount}}
                                    </span>)</h4>
                                    <!-- <a class="heading-elements-toggle">
                                        <i class="ft-align-justify font-medium-3"></i></a> -->

                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div id="forPrint">
                                            <table width="100%"  style="color: black;direction:rtl; padding-bottom:150px;">
                                                <tr style="background-color: #FFFFFF;">
                                                    <td colspan="3">
                                                        <img src="{{$setting->header_img}}" width="100%" style="max-width:100%">
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td style="text-align:right; direction:rtl">التاريخ
                                                    <span class="cer_date">
                                                            <?php echo date('d/m/Y')?>
                                                        </span>
                                                    </td>
                                                    <td></td>
                                                    <td style="text-align:left; direction:ltr;    padding-bottom: 10px !important;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align:right; direction:rtl">رقم المراسلة:<span class="serial_no">{{$CertCount}}</span></td>
                                                    <td></td>
                                                    <td style="text-align:right; direction:ltr;    padding-bottom: 10px !important;">
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="center">
                                                        <h2 id="msg_title" style="font-family: Helvetica,Arial, sans-serif !important; font-weight:bold">
                                                            
                                                        </h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="center">
                                                        <h2 id="benefitside" style="font-family: Helvetica,Arial, sans-serif !important; font-weight:bold">
                                                            
                                                            
                                                        </h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="direction: rtl; line-height:1.5" id="fullBody">
                                                        <span id="msg_content" style="font-family: Arial, sans-serif !important; font-size: 18px !important; font-weight: 500;">
                                                            
                                                        </span>
                                                    </td>
                                                </tr>
                                             
                                            </table>
                                        
                                            <table  width="100%" class="footerLine" style="border:0px solid #ffffff; margin-bottom:20px;">
                                                <tr>
                                                    <td style="border:0px solid #ffffff;">
                                                        <img src="{{$setting->footer_img}}" width="100%">
                                                    </td>
                                                </tr>
                                            </table>
                                        
                                        </div>

                                        <div class="form-actions" style="border-top:0px;">
                                            <div class="text-right">
                                                <button class="btn btn-primary" type="button" id="saveBtn">حفظ وطباعة <i class="fa fa-print"></i></button>
                                                {{--<a class="btn btn-primary" style="color: #FFF;" onclick="printDiv()"> معاينة قبل الطباعة <i class="fa fa-print"></i></a>--}}
                                                <button type="reset" onclick="resetFunction();" class="btn btn-warning">اعادة تعيين <i class="ft-refresh-cw position-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-body resultTblaa">

                        <div class="row">
                    
                                <div class="col-xl-12 col-lg-12">
                    
                                    <div class="card">
                    
                                        <div class="card-header" style="direction: rtl;">
                    
                                            <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}" /> 
                    
                                                المراسلات الخارجية
                    
                                            </h4>
                    
                                        </div>
                    
                                        <div class="card-body">
                    
                                            <div class="form-body">
                    
                                                <div class="row" id="resultTblaa">
                    
                                                    <div class="col-xl-12 col-lg-12">
                    
                                                        <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right" class="detailsTB table wtbl">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>اسم المواطن</th>
                                                                    <th>صادر الى</th>
                                                                    <th >رقم المراسلة</th>
                                                                    <th >عنوان المراسلة</th>
                                                                    <th >تاريخ المراسلة</th>
                                                                    <th >الموظف </th>
                                                                    <th style="width: 90px !important"></th>
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
                </section>
                <!-- horizontal grid end -->
            </form>
        </div>
<div class="modal fade text-left" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog2" role="document" style="max-width: 42%!important;">
        <div class="modal-content" style="width: 700px;">
            <div class="modal-header modal-header2">
                <h4 class="modal-title" id="myModalLabel1" style="color: #ffffff;"><span>تعريف الشهادات</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <div class="input-group" style="max-height: 200px; overflow: auto;">
                            <table style="width:100%" class="detailsTB table">
                                <tbody>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">العنوان</th>
                                    <th scope="col"></th>
                                </tr>
                                <tbody id="subTask">
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group w-s-87">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 85px;">
                                    عنوان المراسلة
                                </span>
                            </div>
                            <input type="text" id="s_name_ar1" class="form-control" placeholder="" name="s_name_ar1">
                            <input type="hidden" id="s_name_en1" class="form-control" placeholder="" name="s_name_en1">
                            <input type="hidden" id="pk_id" class="form-control" placeholder="" name="pk_id">
                            <input type="hidden" id="fk_i_constant_id1" class="form-control" placeholder="Label (En)" name="fk_i_constant_id1">
                            <input type="hidden" id="fk_i_constantdet_id1" class="form-control" placeholder="Label (En)" name="fk_i_constantdet_id1">
                            <input type="hidden" id="ctrlToRefresh1" class="form-control" placeholder="Label (En)" name="ctrlToRefresh1">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group w-s-87">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1" style="width: 85px;">
                                    نص المراسلة
                                </span>
                            </div>
                            <textarea id="cercontent" class="form-control" placeholder="" name="cercontent"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group" style="text-align:center">
                        <button type="button" class="btn btn-info modalBtn" onclick="saveNewCert()">حفظ </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
    
var cerIn = CKEDITOR.replace('cercontent', {
      // Define the toolbar groups as it is a more accessible solution.
    defaultLanguage : 'ar',
    font_defaultLabel : 'Arial',
  fontSize_defaultLabel : '16px',
    language:'ar',
    height:200,
    allowedContent : true,
    enterMode : CKEDITOR.ENTER_BR,
    shiftEnterMode: CKEDITOR.ENTER_P,

      toolbarGroups : [
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	],
      
    //   removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
      removeButtons : 'Source,Save,Templates,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,CreateDiv,Language,Link,Unlink,Anchor,Image,Flash,Smiley,SpecialChar,PageBreak,Iframe,ShowBlocks,About,ExportPdf,NewPage,Preview,Print'

    });
    
    //  let str='<h3 style="text-align: right;"><span style="font-size:16px;"><strong>رقم الشهادة : </strong></span><span class="serial_no"></span></h3>'
    //                 +'<h3 style="text-align: right;"><span style="font-size:16px;"><strong>تاريخ الشهادة : </strong></span><span class="cer_date"></span></h3><br>'
    //                 // +'<h2 style="text-align: center;"><span style="font-size:24px;"><strong>لمن يهمه الامر</strong></span><br></h2><br>'
    //                 // +'<span style="font-size: 22px;"> تشهد '
    //                 // +'{{$setting->name_ar}}'                                        
    //                 // +' بأن السيد/ة '
    //                 // +'<b class="citizenName">محمد محمد محمد محمد</b>'                                        
    //                 // +' حامل هوية رقم/ '
    //                 // +'<b class="citizenID" id="citizenID"> 1234567890 </b> ';
    //                 // str+=' </span>';
    //                 let g = cerIn.getData()
    //                 str+= g;
    //             cerIn.setData(str)
    </script>
</div>
@stop

@section('script')
<script>
var editor = CKEDITOR.replace('summary-ckeditor', {
      // Define the toolbar groups as it is a more accessible solution.
      defaultLanguage : 'ar',
      language:'ar',
      allowedContent : true,
      font_defaultLabel : 'Arial',
      fontSize_defaultLabel : '16px',
      enterMode : CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
      height:350,
      toolbarGroups : [
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	],
      
    //   removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
      removeButtons : 'Source,Save,Templates,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,CreateDiv,Language,Link,Unlink,Anchor,Image,Flash,Smiley,SpecialChar,PageBreak,Iframe,ShowBlocks,About,ExportPdf,NewPage,Preview,Print'

    });
    $("#citizen_name").keyup(function () {
    if($("#citizen_name").val()=='')
    {
        $('#applicantID').val(0);
    }
    });

function resize(){
    leftSide=$(".leftSide").height()
		rightSide=$(".rightSide").height()

		setTimeout(function() {
		    if(screen.width>600){
			if (leftSide > rightSide)
				$(".rightSide").attr("style", "min-height:" + ($(".leftSide").height() + "px"))
			else
				$(".leftSide").attr("style", "min-height:" + ($(".rightSide").height() + "px"))
			
			$(".selectize-input .item").html('')
		    }
			
		},1000)
}
function resetFunction()
{   
    $("#ticketFrm")[0].reset();
    $('#applicantID').val();
    editor.setData("");
    resize();
}
$( function() {
    $( ".cust1" ).autocomplete({

        source: 'archive_auto_complete',
        minLength: 1,



        select: function( event, ui ) {
            $('#sentId').val(ui.item.id);
            $('#sentModel').val(ui.item.model);
            $('#sentDir').val(ui.item.name);

        }

    });
    
    $( ".cust" ).autocomplete({

		source: 'archive_auto_complete',
		minLength: 1,

		

        select: function( event, ui ) {
            if(ui.item.model=="App\\Models\\User")
                getFullData(ui.item.id)
            $('#applicantID').val(ui.item.id);
            $('#model').val(ui.item.model);
            $('#citizen_name').val(ui.item.name);
            $('#NationalID').val(ui.item.national_id);
            $(".citizenName").html(ui.item.name)
            $(".citizenID").html(ui.item.national_id)
           }

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
            url: "{{route('appCustomer')}}",
            data: formData,
           /*contentType: false,
           processData: false,*/
            success: (response) => {
                if (response) {
                    
                    if(response.warning.length!=0){
                        $(".form-actions").addClass("hide");
                        warningText='  المواطن لديه اخطار';
                        for(i=0 ; i< response.warning.length ; i++){
                            warningOpj=response.warning[i];
                            if(response.warning.length!=1 && i>=1){
                                warningText+=' - ';
                            }
                            warningText+=warningOpj.type.name;
                            warningText+=' بسبب ';
                            warningText+=warningOpj.warning_reason;
                            warningText+=' يرجى مراجعة قسم ';
                            warningText+=warningOpj.dept.name;
                        }
                        
                        Swal.fire({
                            title: 'لايمكن تقديم الطلب',
                            text: warningText,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'متابعة الطلب',
                            cancelButtonText: 'الغاء الطلب',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $(".form-actions").removeClass("hide");
                            }else{
                                setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
                            }
                        })
                    }
                    
                }
           },
           error: function(response){
            $(".loader").addClass('hide');
           }
       });
    }
    
function AddNew(ctrl,title){

    $(".loader").removeClass('hide');
    //$(".form-actions").addClass('hide');

    DrawCert()
    //$("#fk_i_constant_id1").val(contid);
    $("#ctrlToRefresh1").val(ctrl);
    $("#ModalTitle").html(title);
    $("#ModalTitle1").html(title);
    $("#AddNew").modal('show');

    $(".loader").addClass('hide');
}
function saveCertD(){

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide');
        
         var attach_ids = $("input[name='attach_ids[]']")
              .map(function(){return $(this).val();}).get();
        var attachName = $("input[name='attachName[]']")
              .map(function(){return $(this).val();}).get();
        
        var formData = {
            "_token": "{{ csrf_token() }}",
            'citizen_name': $("#citizen_name").val(),
            'citizen_id': $("#applicantID").val(),
            'cercontent': editor.getData(),
            'cer_pk_id': $("#cer_pk_id").val(),
            'msgTitle': $("#msgTitle").val(),
            'recept_no': $("#recept_no").val(),
            'serial_per_year': $("#serial_per_year").val(),
            'NationalID': $("#NationalID").val(),
            'cer_date': $("#cer_date").val(),
            'msg_content': $("#forPrint").html(),
            'e_type': $("#e_type").val(),
            'benefitS': $("#benefitS").val(),
            'model': $("#model").val(),
            'attach_ids' : attach_ids,
            'attachName' : attachName,
            'sentDir' : $("#sentDir").val(),
            'sentId' : $("#sentId").val(),
            'sentModel' : $("#sentModel").val(),
            };
        $.ajax({
            url: 'saveCertDetails',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {

                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '{{trans('admin.data_added')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $(".loader").addClass('hide');
            $('.wtbl').DataTable().ajax.reload();
                resetFunction();
                $('.addAttatch').html('');
                $('.addAttatch').append(`
                    <li style="font-size: 17px !important;color:#000000">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" id="attachName[]" name="attachName[]" class="form-control attachName" placeholder="أخل اسم المرفق"  value="">
                            </div>
                            <div class="col-sm-5 attach_row_1">
                                
                            </div>
                            <div>
                                <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                                    height="40" style="cursor:pointer"
                                    onclick="$('#currFile').val(1);$('#attachfile').trigger('click');">
                            </div>
                        </div>
                    </li>
                `);
                
                $(".form-actions").removeClass('hide');
                $("#applicantID").val('');
                $("#sentId").val('');
                $("#sentModel").val('');
            },
            error: function(response) {
                $(".form-actions").removeClass('hide');
                if(response.responseJSON.errors.name_ar1){
                    $( "#name_ar1" ).addClass( "error" );
                }
                $(".loader").addClass('hide');
            }



        });
                  
        return true;
    }
function saveNewCert(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide');
        
        var formData = {
            "_token": "{{ csrf_token() }}",
            's_name_ar1': $("#s_name_ar1").val(),
            'cercontent': cerIn.getData(),
            'pk_id': $("#pk_id").val(),
            'e_type': $("#e_type").val(),
            };
        $.ajax({
            url: 'saveCert',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {

                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '{{trans('admin.data_added')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $(".loader").addClass('hide');
                $("#subTask").html("");
                $('#s_name_ar1').val('');
                $('#pk_id').val('');
                DrawCert()
                DrawCertOut();
                // $("#" + fillIn).html(new Option(" Select ", ''));
                // if (data.constList.length > 0) {
                //     for (i = 0; i < data.constList.length; i++)
                //         $("#" + fillIn).append(new Option(data.constList[i].s_name_ar, data.constList[i].pk_i_id));
                // }
                // else {
                //     //$("#"+fillIn).append(new Option(data.constList[0].s_name_ar, data.currNode[0].pk_i_id));
                // }
                    // location.reload();
            },
            error: function(response) {
                if(response.responseJSON.errors.name_ar1){
                    $( "#name_ar1" ).addClass( "error" );
                }
                $(".loader").addClass('hide');
            }



        });
                  
        return true;
    }
function editCerConstant(id,title){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide');
        $(".modalBtn").text('تعديل')
        var formData = {
            "_token": "{{ csrf_token() }}",
            'id': id,'i_type':0,
            's_name_ar1': title,
            'cercontent': cerIn.getData(),
            };
        $.ajax({
            url: 'getCertification',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {
                $(".loader").addClass('hide');
                cerIn.setData(data.cercontent)     
                // $("#msg_content").html(cerIn.getData())
                $("#s_name_ar1").val(data.s_name_ar);
                $("#pk_id").val(data.pk_i_id);
                $("#subTask").html("");
                DrawCert()
            },
            error: function(response) {
                if(response.responseJSON.errors.name_ar1){
                    $( "#s_name_ar1" ).addClass( "error" );
                }
                $(".loader").addClass('hide');
            }



        });
                  
        return true;
    }
    
function deleteCer(id){
    if(confirm('هل انت متاكد من حذف المراسلة')){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide');
        var formData = {
            "_token": "{{ csrf_token() }}",
            'pk_id': id,'i_type':0,
            };
        $.ajax({
            url: 'deleteCert',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {
                $(".loader").addClass('hide');
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: '{{trans('admin.data_added')}}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                $("#subTask").html("");
                DrawCert()
                DrawCertOut()
            },
            error: function(response) {
                if(response.responseJSON.errors.name_ar1){
                    $( "#s_name_ar1" ).addClass( "error" );
                }
                $(".loader").addClass('hide');
            }



        });
                  
        return true;
    }
    return false;
    }
editor.on( 'change', function( evt ) {
    
    $("#msg_content").html(evt.editor.getData());
});
// cerIn.on( 'change', function( evt ) {
    
    
// });
$("#cer_date").on( 'change', function( evt ) {
    
    $(".cer_date").html($("#cer_date").val());
});
// $("#serial_per_year").on( 'change', function( evt ) {
    
//     $(".serial_no").html($("#serial_per_year").val());
// });
function copytxt(id){
    if(id!=0)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            'id': id,'i_type':0,
            "_token": "{{ csrf_token() }}"
        };
        $.ajax({
            url: 'getCertification',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {
                  
                    // str='<h3 style="text-align: right;"><span style="font-size:16px;"><strong>رقم الشهادة : </strong></span><span class="serial_no">'+$("#serial_per_year").val()+'</span></h3>'
                    // +'<h3 style="text-align: right;"><span style="font-size:16px;"><strong>تاريخ الشهادة : </strong></span><span class="cer_date">'+$("#cer_date").val()+'</span></h3><br>'
                    // str='<span style="font-size: 22px;"> تشهد '
                    // +'{{$setting->name_ar}}'                                        
                    // +' بأن السيد/ة '
                    // +'<b class="citizenName">'+$("#citizen_name").val()+'</b>'                                        
                    // +' حامل هوية رقم/ '
                    // +'<b class="citizenID" id="citizenID">'+$("#NationalID").val()+'</b>';
                    // data.cercontent=str+' '+data.cercontent+'</span>'
                    // console.log(data.cercontent);
                    editor.setData(data.cercontent)
                    $("#msg_title").html(data.s_name_ar);
                    // $("iframe").contents().find(".serial_no").html($("#serial_per_year").val())
                    // $("iframe").contents().find(".cer_date").html($("#cer_date").val())
                    // $("iframe").contents().find(".citizenName").html($("#citizen_name").val())
                    // $("iframe").contents().find(".citizenID").html($("#NationalID").val()+' ')

  
                
                        resize();

            },
            error: function () {
                $(".alert-success").addClass("hide");
                $(".alert-danger").removeClass('hide');
                $("#errMsg").text(data.status.msg)
                $(".loader").addClass('hide');
            },
        });
        // $("iframe").contents().find(".cer_date").html('01/01/2021')
        
    }
}
// $('iframe').load(function(){
//                 $("iframe").contents().find(".serial_no").html($("#serial_per_year").val())
//                 $("iframe").contents().find(".cer_date").html($("#cer_date").val())
//                 $("iframe").contents().find(".citizenName").html($("#citizen_name").val())
//                 $("iframe").contents().find(".citizenID").html($("#NationalID").val())   
// });
$("#saveBtn").click(function(event) {
    
    if((!$('#applicantID').val()||$('#applicantID').val()==0)&& $('#benefitS').val().length>0)
    {
        alert('الرجاء اختيار مواطن');
        return;
    }
    
    if($('#sentDir').val()!='' && (!$('#sentId').val()||$('#sentId').val()==0))
    {
        alert('الرجاء اختيار جهة معرفة مسبقاً');
        return;
    }
    
    if($('#benefitS').val().length==0 && $('#sentDir').val().length==0){
        alert('الرجاء ادخال المستفيد');
        return;
    }
    
    event.preventDefault();
    saveCertD();
    printDiv();
    // $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //     var formData = {
    //         'id': id,'i_type':0,
    //         "_token": "{{ csrf_token() }}"
    //     };
    //     $.ajax({
    //         url: 'getUserCertification',
    //         type: 'POST',
    //         data: formData,
    //         dataType: "json",
    //         async: true,
    //         success: function (data) {
    //             editor.setData(data.cercontent)     
    //             $("#msg_content").html(editor.getData())
    //             $("#citizen_name").val(data.citizen_name)
    //             $("#citizen_id").val(data.citizen_id)
    //             $("#msgTitle").val(data.msgTitle)
    //             $("#recept_no").val(data.recept_no)
    //             $("#serial_per_year").val(data.serial_per_year)
    //             $("#NationalID").val(data.NationalID)
    //         },
    //         error: function () {
    //             $(".alert-success").addClass("hide");
    //             $(".alert-danger").removeClass('hide');
    //             $("#errMsg").text(data.status.msg)
    //             $(".loader").addClass('hide');
    //         },
    //     });
        
});
function update(id){
    if(id!=0)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var formData = {
            'id': id,'i_type':0,
            "_token": "{{ csrf_token() }}"
        };
        $.ajax({
            url: 'getUserCertification',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {
                editor.setData(data.cercontent)     
                $("#msg_content").html(editor.getData())
                $("#citizen_name").val(data.citizen_name)
                $("#applicantID").val(data.citizen_id)
                $("#msgTitle").val(data.msgTitle)
                $("#recept_no").val(data.recept_no)
                $("#serial_per_year").val(data.serial_per_year)
                $("#NationalID").val(data.NationalID)
                $("#cer_pk_id").val(data.pk_i_id)
                $('#model').val(data.model);
                // $('#benefitside').html(data.benefitS);
                $('#benefitS').val(data.benefitS);
                $("#msg_title").html($("#msgTitle  option:selected").text());
                
                $('#certCnt').html(data.serial_per_year);
                $('.serial_no').html(data.serial_per_year);
                
                $("#sentDir").val(data.sentDir);
                $("#sentId").val(data.sentId);
                $("#sentModel").val(data.sentModel);
                
                var attach_template='';
                if(data.all_files.length>0)
                {
                    $('.addAttatch').html(' ');
                    for(let i=0;i<=data.all_files.length;i++)
                    {
                        if(i==data.all_files.length)
                        {
                            attach_template+=`<li style="font-size: 17px !important;color:#000000">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" id="attachName[]" name="attachName[]" class="form-control attachName" placeholder="أدخل اسم المرفق" value="">
                                    </div>
                                    <div class="col-sm-5 attach_row_${i}">
                                        
                                    </div>
                                    <div class="col-sm-1">
                                        <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                                            height="40" style="cursor:pointer"
                                            onclick="$('#currFile').val(${i});$('#attachfile').trigger('click');">
                                    </div>
                                </div>
                            </li>`
                            attach_index=i+1;
                        }
                        else{
                        attach_template+=`<li style="font-size: 17px !important;color:#000000">
                            <div class="row">
                                <div class="col-sm-6">
                              <input type="text" reuired="" id="attachName[]" name="attachName[]" class="form-control attachName" value="${data.all_files[i].attachName}">
                                </div>
                                <div class="col-sm-5 attach_row_${i+1}">
                                    <div id="attach" class=" col-sm-12 ">
                                        <div class="attach"> 
                                            <a class="attach-close1" href="https://t.expand.ps/expand_repov1/public/${data.all_files[i].Files[0].url}" style="color: #74798D; float:left;" 
                                            target="_blank">  
                                                <span class="attach-text">${data.all_files[i].Files[0].real_name}</span>    
                                                <img style="width: 20px;" src="https://t.expand.ps/expand_repov1/public/assets/images/ico/image.png">
                                            </a>
                                            <input type="hidden" id="attach_ids[]" name="attach_ids[]" value="${data.all_files[i].attach_ids}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>
                                </div> 
                            </div> 
                        </li>`
                        }
                    }
                }
                
                $('.addAttatch').append(attach_template);
                 window.scrollTo(0, 0);
            },
            error: function () {
                $(".alert-success").addClass("hide");
                $(".alert-danger").removeClass('hide');
                $("#errMsg").text(data.status.msg)
                $(".loader").addClass('hide');
            },
        });
    }
}
function DrawCert(){
    var formData = {
            "_token": "{{ csrf_token() }}",
            'e_type': $("#e_type").val(),
            };
    $.ajax({
        url:'getCertifications',
        
        data: formData,
        dataType: "json",
        type: 'get',
        async: true,
        success: function (data) {
            console.log(data);
            i=1;
            row='';
            for(j=0; j<data.length;j++) {
                row += '<tr>'
                    + '<td width="20px">'
                    + i
                    + '</td>'
                    + '<td>'
                    + data[j].s_name_ar
                    + '</td>'
                    + '<td width="40px">'
                    + '<i class="fa fa-edit" id="trash" aria-hidden="true" style="color:#1E9FF2;padding-top:10px;position: relative;left: 3%;cursor: pointer;" onclick="editCerConstant('+data[j].pk_i_id+',\''+data[j].s_name_ar+'\')"></i>'
                    + '<i class="fa fa-trash" id="trash" aria-hidden="true" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;" onclick="deleteCer('+data[j].pk_i_id+')"></i>'
                    + '</td>'
                    + '</tr>'
                i++
            }

            $("#subTask").html(row);
        },
        error:function(){
            $(".alert-success").addClass("hide");
            $(".alert-danger").removeClass('hide');
            $("#errMsg").text(data.status.msg)
            $(".loader").addClass('hide');
            //$(".form-actions").removeClass('hide');
        },
    });
}
function DrawCertOut(){
    var formData = {
            "_token": "{{ csrf_token() }}",
            'e_type': $("#e_type").val(),
            };
    $.ajax({
        url:'getCertifications',
        data: formData,
        dataType: "json",
        type: 'get',
        async: true,
        success: function (data) {
            fillIn="msgTitle"
            $("#" + fillIn).children().remove();
            $("#" + fillIn).html(new Option(" -- المراسلة -- ", ''));
                if (data.length > 0) {
                    for (i = 0; i < data.length; i++)
                        $("#" + fillIn).append(new Option(data[i].s_name_ar, data[i].pk_i_id));
                }
                else {
                    //$("#"+fillIn).append(new Option(data.constList[0].s_name_ar, data.currNode[0].pk_i_id));
                }
           
        },
        error:function(){
            $(".alert-success").addClass("hide");
            $(".alert-danger").removeClass('hide');
            $("#errMsg").text(data.status.msg)
            $(".loader").addClass('hide');
            //$(".form-actions").removeClass('hide');
        },
    });
}
function printDiv()
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
      mywindow.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">');
      mywindow.document.write('</head><body style=" line-height: 24; font-size: 14px;" >');
      mywindow.document.write('<style>'
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
      +'  }'
      +'</style>');

      mywindow.document.write($("#forPrint").html());
      mywindow.document.write('</body></html>');

      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

}
function printDivP(m)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
      mywindow.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">');
      mywindow.document.write('</head><body style=" line-height: 24; font-size: 14px;" >');
      mywindow.document.write('<style>'
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
      +'  }'
      +'</style>');

      mywindow.document.write(m);
      mywindow.document.write('</body></html>');

      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

}

$( function(){

    var table = $('.wtbl').DataTable({

        ajax: {
                url: '{{ route('getCertificationsUser') }}',
                data: function (d) {
                    d.e_type = $('#e_type').val();
                }
            },

        columns:[

                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},

                // {data:'benefitS',name:'benefitS'},
                
                {
                    data: null, 
                    render:function(data,row,type){
                        //$actionBtn = '<a ondblclick="update('+data.id+')">'+data.name+'</a>';
                        if(data.citizen_id != null && data.citizen_id != 0  && data.citizen_id != ''){
                        $actionBtn = '<a target="_blank" href="{{ route('admin.dashboard') }}/'+data.url.url+'?id='+data.citizen_id+'">'+data.benefitS+'</a>';
                        }
                        else
                        {
                        $actionBtn =(data.benefitS??'');
                        }
                            return $actionBtn;
                    },
                    name:'benefitS',
                
                },

                {data:'sentDir',name:'sentDir'},
                
                {data:'serial_per_year',name:'serial_per_year'},

                {data:'cer_name',name:'t_certification.s_name_ar'},

                {data:'cer_date',name:'cer_date'},
                
                {
                    data: null, 
                    render:function(data,row,type){
                        // $time=data.created_at.substring(11,19);
                        $date=data.created_at.substring(8,10)+'/'+data.created_at.substring(7,5)+'/'+data.created_at.substring(4,0);
                        $tooltip='<a data-toggle="tooltip" data-placement="top" data-original-title="'+ ' تمت الإضافة بواسطة ' +  data.admin.nick_name  +' بتاريخ '+$date +'" >'+data.admin.nick_name+'</a>';
                        return $tooltip;
                    },
                    name:'name',
                
                },

                {

                    data: null, 

                    render:function(data,row,type){

                            $actionBtn = '<a onclick="update('+data.pk_i_id+')" class="btn btn-info"><i style="color:#ffffff" class="fa fa-edit"></i> </a>';
                            if(data.msg_content)
                            {
                                var mm =data.msg_content
                                $actionBtn += '<a  style="margin-right: 10px;" onclick="printDivP('+mm+')" > <img class="fa fa-print" title="print" src="https://t.expand.ps/expand_repov1/public/assets/images/ico/Printer.png " style="cursor:pointer;height: 32px;"> </a>';
                            }
                                return $actionBtn;

                        },

                        name:'name',

                },

            ],

                    dom: 'Bfltip',

                    buttons: [

                        {

                            extend: 'excel',

                            tag: 'img',

                            title:'',

                            attr:  {

                                title: 'excel',

                                src:'{{asset('assets/images/ico/excel.png')}}',

                                style: 'cursor:pointer;',

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
</script>

  
@endsection