<?php $readonly=true; ?>
@if(in_array(Auth()->user()->id,json_decode($config[0]->emp_to_update_json)))
    <?php $readonly=false; ?>
@endif
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



<style>
    body,td,th,span,h1,h2,h3,h4,h5,h6{
        font-family:"Times New Roman";
        color:#000000;
        direction:rtl;
    }
    
        input,teatarea,label,span{
            color:#000000!important;
            font-weight:bold!important;
           
        }    
        input{
             font-size:17pt;
        }
        .response{
            position: fixed;
            bottom: 50%;
            left: 40px;
        }
    @media print{
        input,textarea{
            
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
            .input-group {
                width: 99% !important;
            }
            .marginrightminus30 {
                margin-right: 0px;
            }
        
        input,teatarea,label,span,form-control{
            color:#000000!important;
            font-weight:bold!important;

        }   
        th,div,span{
                        font-size:17pt!important;

        }
        body,div,td,th,input,table,.table,tr,teatarea,label,span,h1,h2,h3,h4,h5,h6,.form-check-input,.form-check,.table-bordered,thead,tbod{
            border:0px solid #ffffff!important;

    }
        input,teatarea,span{
                        font-size:19pt!important;

        }
        
    }
    .form-check-inline .form-check-input{
        margin-left: 10px;
    }
</style>
<img src="{{$setting->header_img}}" width="100%" style="max-width:100%">
<!--<div>-->
<!--    <span width="50%" align="right">-->
        
<!--    </span>-->
<!--    <span width="50%" align="right">-->
<!--            <h6 style="margin-top:10px;font-size:16pt;font-weight:bold;">تاريخ الطلب :-->
<!--            <?php //echo date('d/m/Y',strtotime($ticket->created_at )); ?>-->
<!--            </h6>-->
<!--    </span>-->

<!--</div>-->


<form method="post" id="rpFrm" dir="rtl" style="min-height:950px;padding-top: 10px;padding-left: 47px; padding-right: 47px;">
    
        <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:0px;">
            <tbody>
                <tr style="background-color: #FFFFFF;">
                    <td style="padding:0px; margin:0px;text-align: center;">
                                        </td>
                </tr>
            </tbody>
        </table>
        <div>
            <div width="50%" align="left">
                
                <h6 style="font-size:16pt;font-weight:bold;">رقم الطلب :
                    (<input type="number" name="customer_ticket_no" value="{{$customer_ticket_no}}">)</h6>
            </div>
            <div width="50%" align="left">
                    <h6 style="font-size:16pt;font-weight:bold;">تاريخ الطلب:
                       <?php echo date('d/m/Y',strtotime($ticket->created_at )); ?>
                    </h6>
            </div>
        </div>
        <div style="background-color: #FFFFFF;">
            <div colspan="2" style="padding:0px; margin:0px;text-align: center;">
                <h2 style="font-size:20pt; font-weight:bold;">
                    {{ $config[0]->ticket_name }}                     
                </h2>
            </div>
        </div>
   
        <div>
            <label class="form-label col-sm-12 col-md-12" style="text-align:right; ">
                <h6 style="font-size:20pt; font-weight:bold;  ">
                    رقم الملف:
                    &nbsp;
                </h6>
            </label>
        </div>
                
        <div class="row">
            <table cellpadding="4" cellspacing="0" width="100%">
                <tbody>
                    <tr class="row" style="font-size:16pt; font-weight:bold;">
                        <td class="col-5" style="font-size:16pt !important;font-weight:bold;">
                            مقدم الطلب:               {{$ticket->customer_name}}
                        </td>
                        <td class="col-3" style="font-size:16pt !important;font-weight:bold;">
                            رقم الهوية:               {{$ticket->national_id}}
                        </td>
                        <td class="col-4" style="font-size:16pt !important;font-weight:bold;">
                            رقم الهاتف:               {{$ticket->customer_mobile}}
                        </td>
                        
                    </tr>
                <tr class="row" style="font-size:16pt; font-weight:bold;">
                    <td class="col-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text " id="basic-addon1">
                                    صاحب رخص البناء:
                                  </span>
                                </div>                              
                                <input type="text" id="owner_lic_name" name="owner_lic_name" value="{{$ticket->owner_lic_name}}" class="form-control " placeholder="  " aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </td>
                    <td class="col-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text " id="basic-addon1">
                                    رقم الهوية:
                                  </span>
                                </div>                              
                                    <input type="text" maxlength="9" id="nationalId" name="nationalId" value="{{$ticket->national_id}}" class="form-control " placeholder="  " aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="row" style="font-size:16pt; font-weight:bold;">
                    <td class="col-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text " id="basic-addon1">
                                        المالك:
                                  </span>
                                </div>                              
                                <input type="text" id="owner_name" name="owner_name" value="{{$ticket->owner_name}}" class="form-control " placeholder="  " aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr class="row" style="font-size:16pt; font-weight:bold;">
                    <td class="col-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text " id="basic-addon1">
                                    مقدم الطلب:
                                  </span>
                                </div>                              
                                    <input type="text" id="customer_name" name="customer_name" value="{{$ticket->customer_name}}" class="form-control " placeholder="  " aria-describedby="basic-addon1">
                            </div>
                        </div>
                        
                    </td>
                    <td class="col-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text " id="basic-addon1">
                                 علاقته ب صاحب الطلب:
                                  </span>
                                </div>                              
                                    <input type="text" id="customer_owner_state" name="customer_owner_state" value="{{$ticket->customer_owner_state}}" class="form-control " placeholder="  " aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </td>
                </tr>
                
            </tbody>
            </table>
        </div>
        <hr>
        
        <div style="font-size:16pt !important; font-weight:bold;text-align: right;">لاستعمالات قسم التنظيم : </div>
        <br>
        <div class="row business_container">
                        
            <div class="input-group mb-2 col-lg-6 col-md-12">
                 <div class="input-group-prepend">
                   <span class="input-group-text"> موقع الطلب </span>
                 </div>
                <div class="form-check-inline form-control">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" {{$ticket->regionBuild ==1 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} value="1" name="regionbuild" id="regionbuild1">خارج الحدود
                  </label>
                </div>
                <div class="form-check-inline form-control">
                  <label class="form-check-label">
                    <input type="checkbox" {{$ticket->regionBuild == 2 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} class="form-check-input" value="2" name="regionbuild" id="regionbuild2">داخل الحدود 
                  </label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text " id="basic-addon1">
                             رقم الحوض                                                           
                          </span>
                        </div>                              
                        <input type="text" id="hodNo" name="hodNo"  value='{{$ticket->hodNo}}' {{ $readonly?"readonly":"" }} class="form-control" placeholder="  " aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text " id="basic-addon1">
                            رقم القطعة
                      </span>
                    </div>
                    <input type="text" id="pieceNo" name="pieceNo" value="{{$ticket->pieceNo}}" {{ $readonly?"readonly":"" }} class="form-control " placeholder="  " aria-describedby="basic-addon1">
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
                    <input type="checkbox" id="typebuild1" {{$ticket->typebuild ==1 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild"  value="1" class="form-check-input" >بناء مقترح
                  </label>
                </div>
                <div class="form-check-inline form-control">
                  <label class="form-check-label">
                    <input type="checkbox" id="typebuild2" {{$ticket->typebuild ==2 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild" value="2" class="form-check-input" >بناء قائم  
                  </label>
                </div>
                <div class="form-check-inline form-control">
                  <label class="form-check-label">
                    <input type="checkbox" id="typebuild3" {{$ticket->typebuild ==3 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild" value="3" class="form-check-input">فوق بناء قائم 
                  </label>
                </div>
                <div class="form-check-inline form-control">
                  <label class="form-check-label">
                    <input type="checkbox" id="typebuild3" {{$ticket->typebuild ==4 ? 'checked' : ''}} {{ $readonly?"disabled":"" }} name="typebuild" value="3" class="form-check-input">ارض خالية 
                  </label>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="form">
                <div class="input-group">
                    <label class="form-label" style="color: #ff9149; font-weight:bold">مشتملات العقار </label>
                    <div class="col-sm-12 col-md-10">
                        <input onchange="if($(this).prop('checked'))$('.rent2').hide()" {{ $readonly?"disabled":"" }} type="radio" name="typeship" value="1" {{$ticket->typeship ==1 ? 'checked' : ''}} id="typeship1" class="jui-radio-buttons"  >
                        <label for="radio-3">العقار منفصل </label>
                        <input onchange="if($(this).prop('checked'))$('.rent2').show()" {{ $readonly?"disabled":"" }} type="radio" name="typeship" value="2" {{$ticket->typeship ==2 ? 'checked' : ''}} id="typeship2" class="jui-radio-buttons" >
                        <label for="radio-4">العقار ضمن عمارة </label>
    
                    </div>
                </div>
            </div>
        </div>
        
        <table cellspacing="0" width="100%" style="margin-top: 25px;">      
            <tbody><tr>
                <td style="border: 0px solid #000000;font-size:17pt !important; font-weight:bold;">
                    
                </td>
                <td style="border: 0px solid #000000;font-size:17pt !important; font-weight:bold; width:50%">
                     مهندس التنظيم                </td>
            </tr>      
            <tr>
                <td style="border-bottom: 0px dashed #000000;font-size:17pt !important; font-weight:bold;">
                
                </td>
                <td style="border-bottom: 1px dashed #000000;font-size:17pt !important; font-weight:bold; width:50%">
                &nbsp;
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
        <div style="text-align: right;">
            *******************
        </div>
        
    
        <div class="row">
            <div class="col-md-6 pr-s-12" dir="ltr" style="text-align: right;">
                       
               : السيد مدير مجلس الخدمات المشترك لمياه الشرب 
        
                </div>
        </div>
        <div class="row">
            <div class="col-md-6 pr-s-12" style="text-align: right;">
               
                لا مانع لدى بلدية اليامون من توصيل اشتراك مياه للموقع المذكور 
        
            </div>
        </div>      
    
    

    
                <table cellspacing="0" width="100%" style="margin-top: 25px;">      
                    <tbody>
                        <tr>
                            <td style="border: 0px solid #000000;font-size:18pt !important; font-weight:bold;">
                                
                            </td>
                            <td style="border: 0px solid #000000;font-size:20pt !important; font-weight:bold; width:50%">
                            رئيس البلدية                          
                            </td>
                        </tr>      
                        <tr>
                            <td style="border-bottom: 0px dashed #000000;font-size:18pt !important; font-weight:bold;">
                            
                            </td>
                            <td style="border-bottom: 1px dashed #000000;font-size:18pt !important; font-weight:bold; width:50%">
                            &nbsp;
                            </td>
                        </tr>
                    </tbody>
                </table>
        
        <input type="hidden" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">
        <input type="hidden" name="related_ticket" id="related_ticket" value="{{$config[0]->ticket_no}}">
        <button class=" btn btn-info hideprint" style="position: fixed;bottom: 50%;left: 140px;" onclick="ManualSave()" type="button" >
           <img src="https://db.expand.ps/images/printer.jpeg" height="32px" style="cursor: pointer" >
           حفظ ما تم عمله
        </button>
        <button class=" btn btn-info response hideprint" onclick="window.print()"type="button" >
           <img src="https://db.expand.ps/images/printer.jpeg" height="32px" style="cursor: pointer" >
           طباعة
        </button>

</form>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $(".lblDepts").attr("readonly","")
        $(".lblDept29").removeAttr("readonly")
       
    })
    function ManualSave(){
        var formData = new FormData($("#rpFrm")[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                    'ContentType': 'application/json'
                }
            });
            $.ajax({
                url: '{{route('saveEditTicket')}}',
                type: 'POST',
                data: formData,
                dataType:"json",
                async: true,
                success: function (data) {
                    if(data!=0){
                        alert('تمت عملية الحفظ')
                        $('#id').val(data) 
                    }else{
                        alert('خطاء في الحفظ')
                    }
                   
                },
                error:function(){
                    alert('خطاء في الحفظ')
                },
                    cache: false,
                    contentType: false,
                    processData: false
            });
    }

    $(document).ready(function(){
        
        
        $(".lblDepts").on('change blur keypress keyup',function(){
            var formData = new FormData($("#rpFrm")[0]);
        $.ajax({
            url: 'https://y.expand.ps/services/C_print/addRptJson2',
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
            },
            error:function(){
            },
                cache: false,
                contentType: false,
                processData: false
        });
            
        })
        $("#input9").on('change blur keypress keyup',function(){
            var formData = new FormData($("#rpFrm")[0]);
        $.ajax({
            url: 'https://y.expand.ps/services/C_print/addRptJson2',
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
            },
            error:function(){
            },
                cache: false,
                contentType: false,
                processData: false
        });
            
        })
    })
    $('input[name="regionbuild"]').on('change', function() {
          $('input[name="regionbuild"]').not(this).prop('checked', false);
        });
    
    $('input[name="typebuild"]').on('change', function() {
           $('input[name="typebuild"]').not(this).prop('checked', false);
        });
    $('input[name="typestate"]').on('change', function() {
           $('input[name="typestate"]').not(this).prop('checked', false);
        });
    $('input[name="typebuilding"]').on('change', function() {
           $('input[name="typebuilding"]').not(this).prop('checked', false);
            // $('#typebuilding').val($(this).val());
    });
    $(document).ready(function(){
        
    $("#input19").on('change blur keyup',function(){
        var formData = {'pk_i_id':34,'startid':0};
        
                    var formData = {'pk_i_id':34,'startid':0};
                formData['CntrNo']=$("#input19").val();
        formData['tbl']=3;
        formData['step']=0;
        $.ajax({
            url: 'https://y.expand.ps/services/ticket/updateFees',
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
                alert('تمت العملية بنجاح')
                self.location='/';
            },
            error:function(){
            },
        });
            
        })
        $(".FessVals").on('change blur keyup',function(){
            var total=0;
            $(".FessVals").each(function( index ) {
                if($.isNumeric($( this ).val())){
                    total+= parseInt($( this ).val() );
                    //console.log(total,$( this ).val())
                }
            });

        console.log(total)
        $("#total").html(total)
                    var formData = {'pk_i_id':34,'startid':0};
                formData['feesValue0']=$("#feesValue0").val();
        formData['feestxt0']=$("#feestxt0").val();
        total+=parseInt(formData['feesValue0']);
                formData['feesValue1']=$("#feesValue1").val();
        formData['feestxt1']=$("#feestxt1").val();
        total+=parseInt(formData['feesValue1']);
                formData['feesValue2']=$("#feesValue2").val();
        formData['feestxt2']=$("#feestxt2").val();
        total+=parseInt(formData['feesValue2']);
                formData['feesValue3']=$("#feesValue3").val();
        formData['feestxt3']=$("#feestxt3").val();
        total+=parseInt(formData['feesValue3']);
                formData['feesValue4']=$("#feesValue4").val();
        formData['feestxt4']=$("#feestxt4").val();
        total+=parseInt(formData['feesValue4']);
                formData['feesValue5']=$("#feesValue5").val();
        formData['feestxt5']=$("#feestxt5").val();
        total+=parseInt(formData['feesValue5']);
                formData['feesValue6']=$("#feesValue6").val();
        formData['feestxt6']=$("#feestxt6").val();
        total+=parseInt(formData['feesValue6']);
                formData['feesValue7']=$("#feesValue7").val();
        formData['feestxt7']=$("#feestxt7").val();
        total+=parseInt(formData['feesValue7']);
                formData['tbl']=3;
        formData['step']=7;
        $.ajax({
            url: 'https://y.expand.ps/services/ticket/updateFees',
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
            },
            error:function(){
            },
        });
            
        })
    })
    
    $("input[name=notes1]").val('');
$("input[name=notes2]").val('');
$("input[name=notes3]").val('');
$("input[name=notes4]").val('');
        
    $('input[name="BusinessName"]').on('change', function() {
           $('input[name="BusinessName"]').not(this).prop('checked', false);
        });
    $('input[name="typebuild"]').on('change', function() {
           $('input[name="typebuild"]').not(this).prop('checked', false);
        });
    $('input[name="typestate"]').on('change', function() {
           $('input[name="typestate"]').not(this).prop('checked', false);
        });
        
    $('input[name="typebuildingt"]').on('change', function() {
           $('input[name="typebuildingt"]').not(this).prop('checked', false);
            $('#typebuilding').val($(this).val());

        });
   
</script>

