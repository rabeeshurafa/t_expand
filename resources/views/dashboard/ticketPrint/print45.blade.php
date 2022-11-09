<?php $readonly=true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    body,input,td,th,span,h1,h2,h3,h4,h5,h6{
        font-family:"Times New Roman";
        color:#000000;
        font-size:18pt !important;
    }
    div{
        padding:3x;
    }
    .ticket_name{
            font-size:20pt!important;
        }
        .response{
            position: fixed;
            bottom: 50%;
            left: 40px;
        }
    @media print{
        input,textarea{
            border:0px solid #ffffff;
        }
        .hideprint{
            display:none;
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
        body,input,td,th,span,h1,h2,h3,h4,h5,h6{
            font-family:"Times New Roman";
            color:#000000!important;
            font-size:18pt !important;
        }
        .ticket_name{
            font-size:25pt!important;
        }
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
    .m5{
        margin-right:5px!important;
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


<form method="post" id="rpFrm" dir="rtl" style="min-height:950px;padding-top: 10px;">
    <div class="row" style="text-align:center;margin-bottom:30px">
        <div class="col-12" style="text-align:center">
            <h1 class="ticket_name" style="text-align:center;font-weight: bold;display:inline;">
                تقرير نقل حالة بسيارة الإسعاف
            </h1>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               اسم السائق :
               {{$ticket->driverName->name}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               اليوم :
               {{$ticket->day_name}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               التاريخ :
               {{$ticket->date}}
            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               الممرض المرافق :
               {{($ticket->nurses!=null?$ticket->nurses->name:'')}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>

            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>

            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               اسم الحالة :
               {{$ticket->customer_name}}
            </span>
        </div>
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
           <div class="row" style="margin-right: 0px;">
                <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
                    <span>
                       العمر :

                    </span>
                </div>
                <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
                    <span>
                       رقم الهوية :
                       {{$ticket->national_id}}
                    </span>
                </div>
            </div>
           <div class="row" style="margin-right: 0px;">
                <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
                    <span>
                       العنوان :
                       {{$ticket->region_name}}
                    </span>
                </div>
                <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
                    <span>
                       رقم الهاتف :
                       {{$ticket->customer_mobile}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               نقل الحالة من  :
               {{($ticket->transfer_from!=null?$ticket->transfer_from->name:'')}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              الساعة :
              {{$ticket->time}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>

            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               نقل الحالة إلى  :
               {{($ticket->transfer_to!=null?$ticket->transfer_to->name:'')}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              ساعة الوصول :
              {{$ticket->arrival_time}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              ساعة المغادرة :
              {{$ticket->Departure_time}}
            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
               نوع الحالة :
               {{$ticket->status_type}}
            </span>
        </div>
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;height: 90px;max-height:90px;min-height: 90px;">
            <span>
              ملاحظات آخرى :
              {{--<textarea type="text" id="notes" class="form-control" placeholder="" name="notes"
            style="width:100% ; border-radius:5px !important;height: 90px;max-height:90px;min-height: 90px;font-size:18pt !important;" aria-invalid="false"></textarea>--}}
            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
                 رقم المطالبة المالية :
               {{$ticket->financial_no}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              المبلغ المطلوب :
              {{$ticket->required_amount}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              رقم الوصل :
              {{$ticket->voucher_no}}
            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-6" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>

            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              المبلغ المدفوع :
              {{$ticket->paid_amount}}
            </span>
        </div>
        <div class="col-3" style="text-align:right;padding-right: 0px;border: 1px solid;">
            <span>
              تاريخ الوصل :
              {{($ticket->paid_amount > 0 ? $ticket->voucher_date : '')}}
            </span>
        </div>
    </div>
    <div class="row" style="margin-right: 2px;">
        <div class="col-12" style="text-align:right;padding-top: 50px;padding-right: 0px;">
            <span>
              قام بإعطاء المعلومات سائق الإسعاف، توقيع السائق
              ........................................................................................
            </span>

        </div>
        <div class="col-12" style="text-align:right;padding-top: 50px;padding-right: 0px;">
            <span>
              تم تفريغ المعلومات من قبل موظف البلدية، التوقيع
              .........................................................................................
            </span>

        </div>
        <div class="col-12" style="text-align:right;padding-top: 50px;padding-right: 0px;">
            <span>
              تم اطلاع أمين الصندوق، التوقيع
              ...............................................................................................................
            </span>

        </div>
        <div class="col-12" style="text-align:right;padding-top: 50px;padding-right: 0px;">
            <span>
              تم اطلاع محاسب البلدية، التوقيع
              ...............................................................................................................
            </span>

        </div>
        <div class="col-12" style="text-align:right;padding-top: 50px;padding-right: 0px;">
            <span>
              اعتماد رئيس البلدية،
              ..............................................................................................................................
            </span>

        </div>

    </div>

    <input type="hidden" name="ticket_id" id="ticket_id" value="{{$ticket->id}}">
    <input type="hidden" name="related_ticket" id="related_ticket" value="31">
    {{--<button type="button" class="hidePrint" style="position: fixed;bottom: 0px;left: 0px;">
        <img src="https://db.expand.ps/uploads/s1.jpg" id="makeResponse" height="32px" style="cursor: pointer" onclick="ManualSave()">
    </button>--}}
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/Tafqeet.js')}}"></script>

<script>
// $("#moneyText").html(tafqeet (+{{$ticket->total}}));
//     function ManualSave(){
//         var formData = new FormData($("#rpFrm")[0]);
//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
//                     'ContentType': 'application/json'
//                 }
//             });
//             $.ajax({
//                 url: '{{route('saveEditTicket')}}',
//                 type: 'POST',
//                 data: formData,
//                 dataType:"json",
//                 async: true,
//                 success: function (data) {
//                     if(data!=0){
//                         alert('تمت عملية الحفظ')
//                         $('#id').val(data)
//                     }else{
//                         alert('خطاء في الحفظ')
//                     }

//                 },
//                 error:function(){
//                     alert('خطاء في الحفظ')
//                 },
//                     cache: false,
//                     contentType: false,
//                     processData: false
//             });
//     }
</script>

