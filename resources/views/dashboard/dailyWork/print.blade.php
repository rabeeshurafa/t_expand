<?php $readonly=true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    body,td,th,span,h1,h2,h3,h4,h5,h6{
        font-family:"Times New Roman";
        color:#000000;
        font-size:20pt;
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
                تقرير عمل
            </h1>
        </div>
    </div>
    <div class="row" style="padding-left: 20px;padding-right: 20px;">
        <div class="col-6" style="text-align:right">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                من تاريخ :
                {{$from}}
            </span>
        </div>
        <div class="col-6" style="text-align:left">
            <span style="margin-top:10px;font-size:16pt;" align="left">
                إلى تاريخ :
                {{$to}}
            </span>
        </div>
    </div>
    <div class="row" style="padding-left: 20px;padding-right: 20px;">
        <div class="col-6" style="text-align:right">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                اسم الموظف :
                {{$emp_name}}
            </span>
        </div>
        <div class="col-6" style="text-align:right">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                حالة المهام :
                {{$stateName}}
            </span>
        </div>
    </div>
    <div class="row" style="padding-left: 20px;padding-right: 20px;">
        <div class="col-6" style="text-align:right">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                عدد المهام :
                {{$works->count()}}
            </span>
        </div>
        <div class="col-6" style="text-align:right">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                عدد المستفيدين :
                {{$beneficialCount}}
            </span>
        </div>
    </div>
    <div class="row" style="padding-left: 20px;padding-right: 20px;padding-top: 50px">
{{--        <div class="col-1" style="text-align:center;border: 1px solid;">--}}
{{--            <span style="margin-top:10px;font-size:16pt;" align="right">--}}
{{--                م--}}
{{--            </span>--}}
{{--        </div>--}}
        <div class="col-2" style="text-align:center;border: 1px solid;">
            <span style="margin-top:10px;font-size:16pt;">
                التاريخ
            </span>
        </div>
        <div class="col-3" style="text-align:center;border: 1px solid;">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                 العمل
            </span>
        </div>
        <div class="col-1" style="text-align:center;border: 1px solid;">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                 من
            </span>
        </div>
        <div class="col-1" style="text-align:center;border: 1px solid;">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                 إلى
            </span>
        </div>
        <div class="col-3" style="text-align:center;border: 1px solid;">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                 المستفيد
            </span>
        </div>
        <div class="col-2" style="text-align:center;border: 1px solid;">
            <span style="margin-top:10px;font-size:16pt;" align="right">
                 الحالة
            </span>
        </div>
    </div>
    @foreach($works as $work)
        <div class="row" style="padding-left: 20px;padding-right: 20px">
            {{--        <div class="col-1" style="text-align:center;border: 1px solid;">--}}
            {{--            <span style="margin-top:10px;font-size:16pt;" align="right">--}}
            {{--                م--}}
            {{--            </span>--}}
            {{--        </div>--}}
            <div class="col-2" style="text-align:center;border: 1px solid;">
                <span style="margin-top:10px;font-size:16pt;">
                    {{$work->date}}
                </span>
            </div>
            <div class="col-3" style="text-align:center;border: 1px solid;">
                <span style="margin-top:10px;font-size:16pt;" align="right">
                     {{$work->work}}
                </span>
            </div>
            <div class="col-1" style="text-align:center;border: 1px solid;">
                <span style="margin-top:10px;font-size:16pt;" align="right">
                     {{$work->start}}
                </span>
            </div>
            <div class="col-1" style="text-align:center;border: 1px solid;">
                <span style="margin-top:10px;font-size:16pt;" align="right">
                     {{$work->end}}
                </span>
            </div>
            <div class="col-3" style="text-align:center;border: 1px solid;">
                <span style="margin-top:10px;font-size:16pt;" align="right">
                     {{$work->beneficial_name}}
                </span>
            </div>
            <div class="col-2" style="text-align:center;border: 1px solid;">
                <span style="margin-top:10px;font-size:16pt;" align="right">
                     {{$work->stateName->name}}
                </span>
            </div>
        </div>
    @endforeach
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

