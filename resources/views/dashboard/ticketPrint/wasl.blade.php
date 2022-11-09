<?php $readonly=true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



<style>
    body,td,th,span,h1,h2,h3,h4,h5,h6,div{
        font-family:"Times New Roman";
        color:#000000;
        font-size:20pt !important;
    }
    div{
        padding:10px;
    }
    @media print{
        input,textarea{
            border:0px solid #ffffff;
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
        .
            .input-group {
                width: 99% !important;
            }
            .marginrightminus30 {
                margin-right: 0px;
            }
        
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
<div style="margin-left: 60px; margin-right: 60px;">
    <div width="50%" align="right">
        
        <h6 style="font-size:16pt;font-weight:bold;">رقم الطلب :
            ({{$ticket->app_no}})</h6>
    </div>
                    <div width="50%" align="right">
            <h6 style="font-size:16pt;font-weight:bold;">تاريخ الطلب:
            {{$date}}</h6>
    </div>
</div>
<form method="post" id="rpFrm" dir="rtl" style="margin-top:120px;margin-left: 60px; margin-right: 60px;">
        <div class="row">
            
        <h1 class="col-sm-12 " style="text-align:center"> طلبات عامة </h1>
        </div>
        
        <div class="row">
        <span style="font-weight: bold;"> مقدم الطلب : </span>
        <span>
            {{$ticket->customer_name}}
        </span>
        </div>
        
        <div class="row">
            
            <span style="font-weight: bold;"> عنوانه : قطنة/ </span>
            <input name="address" id="address" value="{{($wasl!=null?$wasl->address:'')}}">
        </div>
        <div class="row">
        <span style="font-weight: bold;"> رقم الهوية : </span>
            {{$customer->national_id}}        </div>
         <div class="row">
        <span style="font-weight: bold;"> الجوال : </span>
            {{$ticket->customer_mobile}}         </div>
        <div class="row">
        <span style="font-weight: bold;"> موضوع الطلب :  </span>
        @if($config->ticket_no == 23)
        {{$ticket['ticketName']}}  
        @else
        {{$config->ticket_name}}  
        @endif
        </div>
        
        
        <hr>
        
        <div class="row">
                <span style="font-weight: bold;"> مختصر نص الطلب : </span>        
                <div class="col">
                    <textarea rows="5" style="width:100%; font-size:18px;" name="notes" id="notes">{{($wasl!=null?$wasl->text:'')}}</textarea>
                </div>
        </div>
        
        <div class="row my-3">
            
            <span class="col" style="text-align:left;font-weight: bold;"> توقيع مقدم الطلب  </span>
            
        </div>
        
         <div class="row hide">
            
        <h1 class="col-sm-12 hide" style="text-align:center">   </h1>
        </div>
        
        <input type="hidden" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">
        <input type="hidden" name="id" id="id" value="{{($wasl!=null?$wasl->id:0)}}">
        <input type="hidden" name="related_ticket" id="related_ticket" value="{{$config->ticket_no}}">
        <button type="button" class="hidePrint" style="position: fixed;bottom: 0px;left: 0px;">
            <img src="https://db.expand.ps/uploads/s1.jpg" id="makeResponse" height="32px" style="cursor: pointer" onclick="ManualSave()">
        </button>
        
</form>
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
                url: '{{route('saveWasl')}}',
                type: 'POST',
                data: formData,
                dataType:"json",
                async: true,
                success: function (data) {
                    if(data!=0){
                        alert('تمت عملية الحفظ')
                        $('#id').val(data.info.id) 
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

