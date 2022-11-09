<?php $readonly=true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    body,td,th,span,h1,h2,h3,h4,h5,h6{
        font-family:"Times New Roman";
        color:#000000;
        font-size:16pt;
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
        body,td,th,span,h1,h2,h3,h4,h5,h6{
            font-family:"Times New Roman";
            color:#000000!important;
            font-size:16pt;
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
    <div class="row">
        <div class="col-12 style="text-align:left">
            <span style="font-size:16pt;" align="left">
                تاريخ الطلب :
                <?php echo date('d/m/Y',strtotime($ticket->created_at )); ?>
            </span>
        </div>
    </div>
    <div class="row" style="margin-bottom:10px;margin-top:20px;">
        <div class="col-6" style="text-align:right">
            <span style="font-size: 20px;"> لأمر السادة /السيد : </span>
            <span class="m5">{{$ticket->customer_name}}</span>
        </div>
    </div>
    <div class="row" style="margin-bottom:10px;margin-top:20px;">
        <div class="col-6" style="text-align:right">
            <span style="font-size: 20px;">   
                تحية طيبة وبعد،،،
            </span>
        </div>
    </div>
    <div class="row" style="text-align:center;margin-bottom:30px">
        <div class="col-12" style="text-align:center">
            <h1 class="ticket_name" style="text-align:center;font-weight: bold;display:inline;">
                 مطالبة مالية / {{$apptype??''}}
            </h1>
            <span class="hide" style="font-size:16pt;">رقم الطلب :
                ({{$ticket->app_no}})  
            </span>
        </div>
    </div>
        
        <div class="row">
            <div class="col-12" style="text-align:right">
                
                <span style="font-size: 20px;">
                    نهديكم اطيب التحيات، بالإشارة الى الموضوع أعلاه نود اعلام حضرتكم انه يترتب عليكم دفع مبلغ وقدره
                </span>
                <span style="font-size: 20px;">
                    {{ $ticket->totalamount}} {{ $helpers['CurrencyList'][$ticket->CurrencyID1] }}
                </span>
                <span style="font-size: 20px;">
                    حسب الكشف التالي، يرجى العمل على الدفع خلال أسبوع من تاريخه
                </span>
                
            </div>
        </div>
        <div class="row">
                                        
                <div class="col-md-12">
                <table id="myTable"  class="table table-bordered order-list" cellpadding="0" cellspacing="0" width="100%" table-borderd>
                    <thead>
                        <tr style="text-align:center !important;background: #0073AA;">
                            <th style="color: white">رقم</th>
                            <th style="color: white">البيان</th>
                            <th style="color: white">المبلغ / شيكل</th>
                        </tr>
                    </thead>
                    <tbody id="mytbody">
                        <?php 
                        $count = 1;
                        ?>
                        @foreach($helpers['orders'] as $order)
                            <tr>
                                <input type="hidden" id="order_id"  name="order_id[]" value="{{($order->id)}}">
                                <td class="col-sm-4 " style="width: 5%; border: none;">
                                    <input readonly type="text" name="count[]" id="count" {{ $readonly?"readonly":"" }} value="{{$count++}}" class="form-control " />
                                </td>
                                <td class="col-sm-4 " style="width: 35%;  border: none;">
                                    <input readonly type="text" name="itemname[]" id="itemname" {{ $readonly?"readonly":"" }} value="{{($order->itemname??'')}}" class="form-control ac text-center" />
                                </td>
                                <td class="col-sm-4" style="width: 15%; border: none;">
                                    <input readonly type="text" name="total[]" {{ $readonly?"readonly":"" }} value="{{($order->total??'')}}"  class="form-control text-center"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    @if( $config[0]->ticket_no!=33)
                    <tfoot>
                        <tr>
                            <td class="col-sm-4"  colspan="2" style="text-align: left; height: 100%; border: none;">
                                <span class="input-group-text" id="basic-addon1" style="background-color:whitesmoke; display: grid; height:45px;margin-right:0; width: 100%; color:#000000;text-align: right;font-weight: bold;font-size:15pt!important;">
                                    المبلغ الصافي للدفع
                                     </span>
                            </td>
                            <td class="col-sm-4" style="width: 15%; border: none;">
                                <input type="text" style="font-weight: bold;font-size:15pt!important;" id="totalamount" name="totalamount" {{ $readonly?"readonly":"" }} value="{{ $ticket->totalamount }}"  class="form-control text-center"/>
                            </td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
                
            </div>
        </div>
        <div class="row">
            @if($ticket->fin_desc == 6329)
            <div class="col-12" style="text-align:right">
                <span style="font-size: 20px;">
                    علماً أنه إذا لم يتم الدفع خلال أسبوع من تاريخه وبناءً على توصيات وزارة الحكم المحلي سيتم اتخاذ كافة الاجراءات القانونية بحقك
                </span>
            </div>
            @endif
            <div class="col-12" style="text-align:center;padding-top:20px;">
                <span style="font-size: 20px;">
                    وتفضلو بقبول فائق الاحترام والتقدير
                </span>
            </div>
        </div>
        <div class="row" style="padding-top: 50px;">
            <div class="col-12" style="text-align:left">
                <span> 
                سعد فتحي عواد
                </span>
                
            </div>
            <div class="col-12" style="padding-top: 50px;text-align:left">
                <span>رئيس المجلس </span>
                
            </div>
        </div>
        <button class=" btn btn-info response hideprint" onclick="window.print()"type="button" >
           <img src="https://db.expand.ps/images/printer.jpeg" height="32px" style="cursor: pointer" >
           طباعة
        </button>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="{{asset('assets/js/Tafqeet.js')}}"></script>


