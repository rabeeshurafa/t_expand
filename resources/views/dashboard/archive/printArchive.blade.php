<?php $readonly = true; ?>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="{{ asset('assets/js/qrcode.min.js') }}"></script>
<style>
    body, td, th, span, h1, h2, h3, h4, h5, h6 {
        font-family: "Times New Roman";
        color: #000000;
        font-size: 20pt;
    }

    div {
        padding: 3x;
    }

    @media print {
        input, textarea {
            border: 0px solid #ffffff;
        }

        textarea {
            width: 100%;
        }

        body {
            margin: 0px;
            direction: rtl;
        }

        .hidePrint {
            display: none;
        }

        .form-check-input {
            position: relative;
            margin-right: -0.25rem;
        !important
        }

        .form-control input {
            background-color: #e9ecef !important;
            opacity: 1 !important;
        }

        .
        .input-group {
            width: 99% !important;
        }

        .marginrightminus30 {
            margin-right: 0px;
        }

    }

    span {
        margin-right: 20px;
    }

    .footerLine {
        width: 100%;
        text-align: center;
        margin-top: 10%;
    }

</style>

<form method="post" id="rpFrm" dir="rtl" style="min-height:950px;padding-top: 35px;">
    <div class="row" style="text-align:center">
        <div class="col-12" style="text-align:center">
            <h1 class=" " style="text-align:center;font-weight: bold;display:inline;">
                Expand
            </h1>
        </div>
        <div class="col-12" style="text-align:center;padding-top:10px">
            <h1 class=" " style="text-align:center;font-weight: bold;display:inline;">
                @if($archive->url=='trade_archive')
                ارشيف معاملات
                @elseif($archive->url=='finance_archive')
                ارشيف قسم المالية
                @elseif($archive->url=='assets_archieve')
                ارشيف الاصول 
                @elseif($archive->url=='cit_archieve')
                ارشيف الزبائن 
                @elseif($archive->url=='contract_archieve')
                ارشيف الاتفاقيات والعقود 
                @elseif($archive->url=='emp_archieve')
                ارشيف الموظفين 
                @elseif($archive->url=='in_archieve')
                ارشيف المراسلات الواردة 
                @elseif($archive->url=='out_archieve')
                ارشيف المراسلات الصادرة 
                @elseif($archive->url=='law_archieve')
                ارشيف القوانين والاجراءات 
                @elseif($archive->url=='mun_archieve')
                ارشيف المؤسسة 
                @elseif($archive->url=='mun_archieve')
                ارشيف المؤسسة 
                @elseif($archive->url=='specialEmpArchive')
                ارشيف الموظف الخاص 
                @elseif($archive->url=='proj_archive')
                ارشيف المشاريع  
                @endif
            </h1>
        </div>
    </div>
    <div class="row" style="padding-top: 80px">
        <div class="col-4" style="text-align:right">
            <div class="row">
                @if($archive->url!='trade_archive' && $archive->url != 'finance_archive')
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        مرتبط ب :
                        {{$archive->name}}
                        </span>
                    </div>
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        عنوان الوثيقة :
                        {{$archive->title}}
                        </span>
                    </div>
                @elseif($archive->url == 'finance_archive')
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        مرتبط ب :
                        {{$archive->name}}
                        </span>
                    </div>
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        نوع المعاملة :
                        {{$archive->archiveType->name}}
                        </span>
                    </div>
                @else
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        اسم المستفيد :
                        {{$archive->name}}
                        </span>
                    </div>
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        اسم المركبة :
                        {{$archive->vehicle_name}}
                        </span>
                    </div>
                    <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                        <span style="text-align:right;font-size: 24px">
                        رقم الشصي :
                        {{$archive->vehicle_no}}
                        </span>
                    </div>
                    <div class="col-12" style="padding-top: 10px;">
                        <div class="row">
                            <div class="col-3" style="text-align:right;font-size: 24px;">
                                <span style="text-align:right;font-size: 24px">
                                رقم اللوحة :
                                </span>
                            </div>
                            <div class="col-9" style="text-align: end;font-size: 24px !important;direction: ltr;padding-right: 0px;">
                                {{$archive->plateNo}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div id="qrcode" class="col-4" style="text-align:center">
            <script type="text/javascript">

                new QRCode(document.getElementById("qrcode"), "{{$archive->link}}");
            </script>
        </div>
        <div class="col-4" style="text-align:left">
            <div class="row">
                <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                    @if($archive->url != 'trade_archive')
                    <span style="text-align:right;font-size: 24px">
                    رقم المراسلة:
                    {{$archive->serisal}}
                    </span>
                    @else
                    <span style="text-align:right;font-size: 24px">
                    رقم المعاملة:
                    {{$archive->trade_no}}
                    </span>
                    @endif
                </div>
                <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                    <span style="text-align:right;font-size: 24px">
                    التاريخ:
                    {{$archive->date}}
                    </span>
                </div>
                <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                    <span style="text-align:right;font-size: 24px">
                    تم الأرشفة بواسطة:
                    {{$archive->admin->nick_name}}
                    </span>
                </div>
                @if($archive->url=='trade_archive')
                <div class="col-12" style="text-align:right;font-size: 24px;padding-top: 10px;">
                    <span style="text-align:right;font-size: 24px">
                    مكان وجود الوثيقة :
                    {{$archive->document_place}}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
    <hr>
<div class="row" style="padding-left: 70px;">
    <div class="col-10" style="text-align:left;font-size: 24px;padding-top: 10px;">
        
    </div>
    <div class="col-2" style="text-align:center;font-size: 24px;padding-top: 10px;">
        <span style="text-align:center;font-size: 27px">
        التوقيع
        </span>
    </div>
    <div class="col-10" style="text-align:left;font-size: 24px;padding-top: 10px;">
        
    </div>
    <div class="col-2" style="text-align:center;font-size: 24px;padding-top: 10px;">
        <span style="text-align:center;font-size: 27px">
        {{$archive->admin->nick_name}}
        </span>
    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

