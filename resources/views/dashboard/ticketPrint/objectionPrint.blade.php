<?php $readonly=true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



<style>
    body,input,td,th,span,h1,h2,h3,h4,h5,h6,div{
        font-family:"Times New Roman";
        color:#000000;
        font-size:18pt;
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

<form method="post" id="rpFrm" dir="rtl" style="margin-left: 60px; margin-right: 60px;">
       <div class="row" style="margin-right: 60px;">
            @if($ticket->app_type == 2  || $ticket->related == 15 )
            <div class=""  align="right">
                <span style="font-size:16pt;">
                     الرقم:
                </span>
            </div>
            
            <div class="col-md-5" align="right">
                <input name="printNo" id="printNo" style="font-size:16pt !important;" value="{{$ticket->printNo}}">
            </div>
            @else
            <div class="col-md-6" align="right">
                
            </div>
            @endif
            <div class="col-md-6">
                <span style="font-size:16pt;">
                     التاريخ:
                </span>
                <input maxlength="10" placeholder="dd/mm/yyyy" name="printDate" id="printDate" style="font-size:16pt !important;" value="{{($ticket->printDate??date('d/m/Y'))}}">
            </div>
        </div> 
        @if($ticket->app_type == 2 && $ticket->related == 3  )
        <div class="row" style="text-align:center;padding-top:100px">
            <div class="col-12" style="text-align:right">
                <h1 class="ticket_name" style="text-align:right;font-weight: bold;display:inline;">
                    رئيس مجلس خدمات المياه والصرف الصحي طوباس
                </h1>
            </div>
        </div>
        @endif
        @if($ticket->app_type == 1 && $ticket->related == 3)
        {{--<div class="row" style="text-align:center;padding-top:100px">
            <div class="col-12" style="text-align:right">
                <h1 class="ticket_name" style="text-align:right;font-weight: bold;display:inline;">
                   حضرة المهندس ثائر جرادات حفظه الله
                </h1>
            </div>
        </div>--}}
        <div class="row" style="text-align:center;">
            <div class="col-12" style="text-align:right">
                <h1 class="ticket_name" style="text-align:right;font-weight: bold;display:inline;">
                   مدير عام شركة كهربا منطقة طوباس
                </h1>
            </div>
        </div>
        @endif
        @if( $ticket->related == 15)
        <div class="row" style="text-align:center;padding-top:100px">
            <div class="col-12" style="text-align:right">
                <h1 class="ticket_name" style="text-align:right;font-weight: bold;display:inline;">
                   حضرة المهندس محمد زيدان المحترم
                </h1>
            </div>
        </div>
        <div class="row" style="text-align:center;">
            <div class="col-12" style="text-align:right">
                <h1 class="ticket_name" style="text-align:right;font-weight: bold;display:inline;">
                   مدير عام فرع رام الله والبيرة لشركة كهرباء محافظة القدس
                </h1>
            </div>
        </div>
        @endif
        <div class="row" style="text-align:center;">
            <div class="col-12" style="text-align:right">
                <h1 class="ticket_name" style="text-align:right;font-weight: bold;display:inline;">
                   تحيــــة القدس الشريف وبعــــد،،،،
                </h1>
            </div>
        </div>
        <div class="row" style="text-align:center;">
            <div class="col-12" style="text-align:center">
                <h1 class="ticket_name" style="text-align:center;font-weight: bold;display:inline;">
                    <u>
                        الموضـــــوع :  عدم ممانعة
                   </u>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right;padding-right: 0px;">
               {{-- <span style="padding-right: 50px;"> 
                               بالإشارة إلى الموضوع أعلاه إننا في بلدية قطنة لا مانع لدينا من تركيب عداد خدمة مياه للسيد
                </span>
                <span>
                    <u>
                        {{$ticket->customer_name}}
                    </u>
                </span>
                <span>
                    حامل هوية رقم 
                </span>
                <span>
                    <u>
                        {{$ticket->national_id}}
                    </u>
                </span>
                <span>
                    من بلدة قطنة وسكانها خدمة كهرباء لبيته الواقع في بلدة قطنة حي واد العوينة، حوض رقم 
                </span>
                <span>
                    (  {{$ticket->hodNo}}  )
                </span>
                <span>
                    طبيعي رقم القطعة 
                </span>
                <span>
                    (  {{$ticket->pieceNo}}  )، 
                </span>
                <span>
                    علماً بأن البيت ملك له.
                </span>--}}
                <textarea type="text" id="printText" class="form-control" name="printText"
                        style="width: 100%; height: 200px; color: black; border: none; overflow: hidden; border-radius: 5px !important; font-size: 18pt !important;"
                aria-invalid="false"></textarea>
            </div>
        </div>
        <div class="row" style="text-align:center;padding-top:50px">
            <div class="col-12" style="text-align:center">
                <h1 class="ticket_name" style="text-align:center;font-weight: bold;display:inline;">
                    مع فائق الاحترام والتقدير ،،،،،،،،،،،،،،،،،،،،،،،،
                </h1>
            </div>
        </div>
        <div class="row" style="text-align:left;padding-top:30px;">
            <div class="col-12" style="text-align:left">
                <span>
                    رئيس بلدية طمون
                </span>
            </div>
            <div class="col-12" style="text-align:left">
                <span>
                   معاذ فهد بني عودة 
                </span>
            </div>
        </div>
        <input type="hidden" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">
        <input type="hidden" name="related_ticket" id="related_ticket" value="{{$ticket->related}}">
        <input type="hidden" name="app_type" id="app_type" value="{{$ticket->app_type}}">
        <input type="hidden" name="printType" id="printType" value="2">
        <button type="button" class="hidePrint" style="position: fixed;bottom: 0px;left: 0px;">
            <img src="https://db.expand.ps/uploads/s1.jpg" id="makeResponse" height="32px" style="cursor: pointer" onclick="ManualSave()">
        </button>
        
</form>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {
        if(("{{$ticket->printText}}" == null || "{{$ticket->printText}}" == '') && "{{$ticket->app_type}}" == "2" && "{{$ticket->related}}" == "3" ){
            $('#printText').html(`
                بالإشارة إلى الموضوع أعلاه إننا في بلدية قطنة لا مانع لدينا من تركيب عداد خدمة مياه للسيد {{$ticket->customer_name}} حامل هوية رقم {{$ticket->national_id}} من بلدة قطنة وسكانها خدمة كهرباء لبيته الواقع في بلدة قطنة حي واد العوينة، حوض رقم  (  {{$ticket->hodNo}}  ) طبيعي رقم القطعة (  {{$ticket->pieceNo}}  )، علماً بأن البيت ملك له.
                        
            `);
            
        }else if (("{{$ticket->printText}}" == null || "{{$ticket->printText}}" == '')&& "{{$ticket->app_type}}" == "1" && "{{$ticket->related}}" == "3"){
            $('#printText').html(`
                بالإشارة إلى الموضوع أعلاه إننا في بلدية قطنة لا مانع لدينا من منح السيد {{$ticket->customer_name}} حامل هوية رقم {{$ticket->national_id}} من بلدة قطنة وسكانها خدمة كهرباء لبيته الواقع في بلدة قطنة حي واد العوينة، حوض رقم (  {{$ticket->hodNo}}  ) طبيعي رقم القطعة (  {{$ticket->pieceNo}}  )، علماً بأن البيت ملك له.
            `);
        }else if (("{{$ticket->printText}}" == null || "{{$ticket->printText}}" == '')&& "{{$ticket->app_type}}" == "1" && "{{$ticket->related}}" == "15"){
            $('#printText').html(`
                بالإشارة إلى الموضوع أعلاه إننا في بلدية قطنة لا مانع لدينا من منح السيد {{$ticket->customer_name}} حامل هوية رقم {{$ticket->national_id}} من بلدة قطنة وسكانها خدمة وحدة خلايا شمسية لبيته الواقع في بلدة قطنة قطعة رقم(    ) من الحوض رقم (  {{$ticket->pieceNo}}  ) المسمي وادي المدينة الحي الشرقي رقم 1 ، علماً بأن البيت ملك له.
            `);
        }else {
            $('#printText').html(`
             {{$ticket->printText}}
            `)
        }
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

