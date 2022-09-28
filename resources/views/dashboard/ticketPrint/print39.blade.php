<?php $readonly=true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    body,td,th,span,h1,h2,h3,h4,h5,h6{
        font-family:"Times New Roman";
        color:#000000;
        font-size:20pt;
    }
    div{
        padding:3x;
    }
    @media print{
        input,textarea{
            border: none !important;
        }
        textarea{
            width:100%;
        }
        body{
            margin:0px;
            direction:rtl;
        }
        .hidePrint{
            display: none;
        }
    .form-check-input{
        position:relative;
        margin-right:-0.25rem;!important
        }
        .form-control input{
            background-color: #e9ecef!important;
            opacity: 1!important;
        }
        .
            .input-group {
                width: 99% !important;
            }
            .marginrightminus30 {
                margin-right: 0px;
            }
        
    }
    span{
            margin-right: 20px;
    }
    .footerLine{
        width:100%;
        text-align:center;
        margin-top:10%;
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


<form method="post" id="rpFrm" dir="rtl" style="min-height:950px;padding-top: 11px;padding-left: 136px;padding-right: 99px;">
        <div class="row">
            <div class="row col-6" style="text-align:right">
                    <span style="margin-top:10px;font-size:16pt;" align="right">
                        الرقم :(
                    </span>
                    
                    <span style="padding-top: 7px;margin-right: 7px;">
                        <input type="number" style="font-weight:bold;text-align: center; width:100px;" class="form-control alphaFeild" id="printno" name="printno" value="{{$printno}}">
                    </span>
                    <span style="margin-top:10px;font-size:16pt;margin-right: 7px;">
                        )
                    </span>
            </div>
            <div class="col-6" style="text-align:left">
                    <span style="margin-top:10px;font-size:16pt;" align="right">
                        التاريخ :
                        <?php echo date('d/m/Y',strtotime($ticket->created_at )); ?>
                    </span>
            </div>
        </div>
        <div class="row" style="text-align:center">
            <div class="col-12" style="text-align:center">
                <h1 class=" " style="text-align:center;font-weight: bold;display:inline;">
                        تصريح صب باطون جاهز
                </h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12" style="text-align:right">
                <span> 
                بموجب ترخيص المبني باسم السيد /
                </span>
                
                <span>
                    {{ $ticket->customer_name }}
                </span>
            </div>
            
            
        </div>
        
        <div class="row">
            <div class="col-12" style="text-align:right">
                <span>
                وبموجب رخصة رقم  @if(isset($ticket->license))
                ({{ $ticket->license->licNo}})
                @else
                ({{ $ticket->licNo }})
                @endif  
                </span>
                <span>
                    والصادرة بتاريخ
                </span>
                <span>
                @if($ticket->license != null && $ticket->license->releas_date != null && $ticket->license->releas_date != '')
                {{ date('d/m/Y',strtotime($ticket->license->releas_date)) }}
                @else
                &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                @endif
                </span> 
                <span> 
                وحسب قرار الترخيص رقم ({{ $ticket->licDecisionNo }})
                </span>
                <span>
                    بتاريخ
                </span>
                <span>
                @if($ticket->license != null && $ticket->license->bSeatDateList != null && $ticket->license->bSeatDateList != '')
                {{ $ticket->license->bSeatDateList }}
                @else
                &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                @endif
                </span>
                <span>
                  في القطعة رقم ({{ $ticket->pieceNo }})
                </span>
                <span>
                  ، حوض رقم ({{ $ticket->hodNo }})   
                </span>
                <span>
                   فإنه لامانع من القيام بعملية الصب.
                </span>
            </div>
        </div>
        
        <div class="row" style="padding-top: 25px;">
            <div class="col-12" style="text-align:right">
                
                <span>
                    اسم الشركة :-
                </span>
                <span>
                    {{ ($helpers['compony']==null?'':$helpers['compony']->name) }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right">
                
                <span>
                    نوع المبنى :-
                </span>
                <span>
                    {{ ($helpers['buildingType']==null?'':$helpers['buildingType']->name) }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6" style="text-align:right">
                
                <span> العنوان :- </span>
                <span>
                    {{ $ticket->region_name }} /
                    {{ $ticket->address }}  
                    
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right">
                
                <span>
                    اليوم والتاريخ :-
                </span>
                <span>
                    {{ $ticket->day }} - 
                    {{date('d/m/Y',strtotime($ticket->date ))}}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right">
                
                <span>
                    الوقت :-
                </span>
                <span>
                    {{ $ticket->time }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right">
                <span> طبيعة العمل :- </span>
                <span>{{($helpers['workType']==null?'':$helpers['workType']->name)}}</span>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12" style="text-align:right">
                
                <span>
                    الزمن المتوقع لعملية الصب :-
                </span>
                <span>
                    {{ $ticket->duration }}
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right">
                
                <span>
                    المكتب الهندسي المشرف :-
                </span>
                <span>
                    {{($helpers['office']==null?'':$helpers['office']->name)}}
                </span>
            </div>
        </div>
        
        <div class="row" style="padding-top: 30px;">
            <div class="col-6" style="text-align:right">
                
                <u>
                    <span>
                      مراقب الابنية
                    </span>   
                </u>
            </div>
            <div class="col-6" style="text-align:left">
                
                <u>
                    <span>
                      مهندس التنظيم 
                    </span> 
                </u>
            </div>
        </div>
        <div class="row" style="padding-top: 100px;">
            <div class="col-12" style="text-align:right">
                <span>
                  ملاحظات :- 
                </span>  
            </div>
        </div>
        <div class="row" style="padding-right: 100px;">
            <div class="col-12" style="text-align:right">
                <span>
                   1- يجب حمل وتواجد تصريح الصب فى الموقع أثناء عملية الصب. 
                </span>  
            </div>
        </div>
        <div class="row" style="padding-right: 100px;">
            <div class="col-12" style="text-align:right">
                <span>
                   2- يجب تواجد مراقب الأبنية أثناء عملية الصب المسائية. 
                </span>  
            </div>
        </div>
        <div class="row" style="padding-right: 100px;">
            <div class="col-12" style="text-align:right">
                <span>
                   3- لا يحق إغلاق الشارع أثناء عملية الصب إلا بموافقة الجهات المختصة. 
                </span>  
            </div>
        </div>
        <div class="row" style="padding-right: 100px;">
            <div class="col-12" style="text-align:right">
                <span>
                   4- عدم ترك أي باطون في الشارع العام وإن حصل ذلك فسيجري اتخاذ الاجراءات اللازمة بهذا الخصوص. 
                </span>  
            </div>
        </div>
        
        
        <button class=" btn btn-info hideprint" style="position: fixed;bottom: 50%;left: 140px;" onclick="ManualSave()" type="button" >
           <img src="https://db.expand.ps/images/printer.jpeg" height="32px" style="cursor: pointer" >
           حفظ ما تم عمله
        </button>
        <button class=" btn btn-info response hideprint" style="position: fixed;bottom: 50%;left: 35px;" onclick="window.print()"type="button" >
           <img src="https://db.expand.ps/images/printer.jpeg" height="32px" style="cursor: pointer" >
           طباعة
        </button>
        <input type="hidden" name="ticket_id" id="ticket_id" value="{{($ticket->id??0)}}" />

</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    
    function ManualSave(){
        var formData = new FormData($("#rpFrm")[0]);
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                    'ContentType': 'application/json'
                }
            });
            $.ajax({
                url: '{{route('savePrintTicket39No')}}',
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
    
</script>
