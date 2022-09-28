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
            <div class="col-7" style="text-align:left">
                <h1 class=" " style="text-align:left;font-weight: bold;display:inline;text-decoration: underline;">
                    {{ $config[0]->ticket_name }}
                </h1>
            </div>
            <div class="col-5" style="text-align:left">
                <div>
                    <span style="margin-top:10px;font-size:16pt;" align="left">
                        التاريخ  :
                        <?php echo date('d/m/Y',strtotime($ticket->created_at )); ?>
                    </span>
                </div>
                <div>
                    <span style="margin-top:10px;font-size:16pt;" align="left">
                        الرقم  :
                        {{$ticket->app_no}}
                    </span>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top:30px">
            <div class="col-12" style="text-align:right">
                <span>من : </span>
                <span>
                    {{ $ticket->customer_name }} / {{ $ticket->jobTitle }}
                </span>
            </div>
            <div class="col-12" style="text-align:right">
                
                <span> الي : </span>
                <span>
                    {{ $ticket->customer_name1 }} / {{ $ticket->jobTitle2 }}
                    
                </span>
            </div>
        </div>
        
        <div class="row" style="padding-top:50px;padding-bottom:50px;">
            <div class="col-12" style="text-align:center">
                <h2 class=" " style="text-align:left;font-weight: bold;display:inline;text-decoration: underline;">
                    الموضوع : {{$ticket->topic}}
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right">
                    <span style="margin-top:20px;font-size:20pt;white-space: pre-line;" align="right">
                        {{ $ticket->malDesc }}
                    </span>
            </div>
        </div>
        <div class="row" style="padding-top:80px;">
            <div class="col-12" style="text-align:center">
                <span style="margin-top:50px;font-size:20pt;" align="center">
                        وتفضلو بقبول فائق الاحترام
                </span>
            </div>
        </div>
    <div class="row" style="padding-top: 80px;">
        <div class="col-12" style="text-align:left">
            <span>
                {{$ticket->jobTitle}}
            </span>
        </div>
        
    </div>
    <div class="row" style="padding-top: 0;">
        <div class="col-12" style="text-align:left">
            <span>
                {{ $ticket->customer_name }}
            </span>
        </div>
        
    </div>
    <div class="row" >
        <div class="col-md-12 attachs-section"  style="margin-left: 25px; margin-right: 25px;text-align: right;margin-bottom: 0;right;margin-top: 25px;">

            <h2 class="cost-header " style="">{{ 'الردود علي هذه المذكرة' }}
            </h2>
        </div>
    </div>
    <div id="responseList">
    <?php 
    $lastReciver=$ticket->history[0]->sender_id ;  
    $tagArr=array() ; 
    $lastTicket=array(); $i=0;?>
    @foreach($ticket->history as $rowTicket)
   <?php  
   if($rowTicket->recive_type==1) 
            $lastReciver=$rowTicket->reciver_id;
        if(in_array($rowTicket->recive_type,array(1,2))) 
            $lastTicket=$rowTicket;
    ?>
    
    <div class="card-content collpase show ResponseList">
        <div class="card-body" style="padding-bottom:0;">
            <div class="row"
                style="background-color: #ffffff; margin-left: 15px;margin-right: 15px;">
                <!--<div class="col-sm-12 col-md-2 imgAvatar" style="text-align: center;">-->
                <!--    <span class="avatar" style="width: 60px;">-->
                <!--        <img src="{{ $rowTicket->sender_image }}"-->
                <!--            style="border: 1px solid #c7c7c7;padding: 2px; max-height:60px;">-->
                <!--    </span>-->
                <!--</div>-->
                <?php if($i!=0){?>
                <div class="col-sm-12 col-md-3 marginrightminus30 infoAvatar" style="text-align: right;">
                    <a style="color:#385898;font-weight: 600;font-size: 20pt !important;">{{ $rowTicket->sender_name }}</a>
                    <br>
                    <time class="fs14;font-size: 16pt !important;">
                        {{ date('d/m/Y',strtotime($rowTicket->created_at)) }}
                        الساعة : 
                        {{ date('H:i',strtotime($rowTicket->created_at)) }} </time>
                </div>
                <?php }?>
                <div class="col-sm-12 col-md-8 marginrightminus30">
                    <?php if($i==0){ $i++ ?>
                    <?php }else{ 
                    //var_dump($rowTicket);?><h5 style="text-align: right;">
                        <time style="font-family: Helvetica, Arial, sans-serif !important; color:#000000; font-size: 20pt !important;font-weight: 500;">
                            <?php  echo$rowTicket->s_note ?>
                            <?php 
                                if(in_array($rowTicket->recive_type,array(1,2))) 
                                echo strlen(trim($rowTicket->trans_note))>0?'<br />'.$rowTicket->trans_note:''?>
                        </time>
                    </h5>
                        <?php }
                        ?>
                </div>
                
                
            </div>
            
        </div>
        <div class="card-body"
            style="background-color: #F4F5FA; min-height:15px;padding-top: 0;padding-bottom: 0rem;">
        </div>
    </div>
    @endforeach
    </div>


</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

