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


<form method="post" id="rpFrm" dir="rtl" style="min-height:950px;padding-top: 35px;">
    <div class="row" style="text-align:center">
        <div class="col-12" style="text-align:center">
            <h1 class=" " style="text-align:center;font-weight: bold;display:inline;">
                اشتراكات مياه (
                {{$waters[0]->user_name}})
            </h1>
        </div>
    </div>
    @for($i=0; $i<sizeof($waters); $i++)
    <div class="row" style="padding-top: 50px;">
        <div class="col-4" style="text-align:right">
            <span> 
            رقم رخصة البناء:    
            {{$waters[$i]->licNo}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
            	رقم العداد :    
            {{$waters[$i]->counter_no}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
            	نوع العداد :    
            {{$waters[$i]->counter_Type_name}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
    		رقم الإشتراك :    
            {{$waters[$i]->subscription_no}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
    		تاريخ الإشتراك :    
            {{$waters[$i]->subscription_date}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
			نوع الإشتراك :    
            {{$waters[$i]->subscription_Type_name}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
			طريقة الدفع :    
            {{$waters[$i]->payType_name}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
			وصف مكان الإشتراك :    
            {{$waters[$i]->placeDesc}}
            </span>
        </div>
        <div class="col-4" style="text-align:right">
            <span> 
			 المستفيد :    
            {{(($waters[$i]->beneficiary==null || $waters[$i]->beneficiary=="")?$waters[0]->user_name:$waters[$i]->beneficiary)}}
            </span>
        </div>
    </div>
    <hr style="border: 2px solid;">
    @endfor
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

