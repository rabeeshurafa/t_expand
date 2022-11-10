<style>
    h1, h2 {
        margin: 0px;
    }
    .footerLine{
        display: none;
    }
    @media print {
        .divFooter {
            width: 100%;
            position: fixed;
            bottom: 0;
        }
        .footerLine{
            display: inline-block;
        }
    }
</style>
<?php //dd($res)//var_dump($ticket[0]); ?>
<div class="row" id="forPrint" style="">
    <!-- header -->
    <table width="100%" style="color: black;direction:rtl; padding-bottom:20px;">
        <tr style="background-color: #FFFFFF;">
            <td colspan="3">
                <img src="{{$setting->header_img}}" width="100%" style="max-width:100%">
            </td>
        </tr>
    </table>
    <hr style="border: 2px solid #000000; display:none;"/>
    <form method="post" id="rpFrm" dir="rtl" style="">
    @if($res->AgendaDetail->agenda_extention_id!= 1)
        <div>
            <table style="width: 100%; margin-top:10px; line-height:62px ">
                <tr>
                    <td colspan="2" style="text-align:right;font-size: 14pt; ">
                        <b>
                            التاريخ :
                        </b>
                            <?php //echo date('Y/m/d') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;padding-top:0px;">
                        <h1>
                    <span style="border-bottom: 3px solid #000000;font-size: 16pt;  font-weight: bold">
                    قـــرار جلســــــــة
                    </span>
                        </h1>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"
                        style="text-align:right;direction: rtl;padding-top:0px;padding-right:40px;font-size: 16pt; font-weight: bold">
                        الموضوع:
                            <?php echo $res->title ?><br/>
                    </td>
                </tr>
                {{--<?php if($res->connected_to_txt!=null){?>
                <tr>
                    <td colspan="2" style="text-align:right;direction: rtl;padding-top:0px;padding-right:40px;font-size: 16pt;">
                        مقدم الطلب:
                        <?php echo $res->connected_to_txt==null?'':$res->connected_to_txt?><br />
                    </td>
                </tr>
                <?php }?>--}}
                <tr>
                    <td colspan="2"
                        style="text-align:right;direction: rtl;padding-top:0px;padding-right:40px;font-size: 16pt;">
                        قرر
                            <?php echo $res->AgendaDetail->AgendaExtention->name ?>
                        في جلسته رقم
                        (<?php echo $res->AgendaDetail->agenda_number ?> )
                        والمنعقدة بتاريخ

                            <?php echo $res->AgendaDetail->agenda_date ?>
                        ما يلي
                        :
                        <div style=" text-align: right;padding-right:0px">
                                <?php echo strlen($res->descision) > 0 ? $res->descision : 'لم يتخذ قرار'; ?>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td style="font-size: 16pt;  width: 50%;text-align:center; vertical-align:top; font-weight: bold;    line-height: 25px;">
                            <?php echo $res->AgendaDetail->AgendaExtention->Admin ? $res->AgendaDetail->AgendaExtention->Admin->name : '' ?>

                        <br/>
                        <br/>
                            <?php echo $res->AgendaDetail->AgendaExtention->signature_jobtitle ? $res->AgendaDetail->AgendaExtention->signature_jobtitle : '' ?>

                        </b>
                    </td>
                    <td style="font-size: 20px;text-align:center">

                    </td>
                </tr>
            </table>
        </div>
    @else
        <div class="row">
            <div class="col-12" style="text-align:right">
                    <span style="margin-top:10px;font-size:16pt;" align="right">
                         الرقم
                    </span>
            </div>
            <div class="col-12" style="text-align:right">
                    <span style="margin-top:10px;font-size:16pt;" align="right">
                        التاريخ  :
                         <!--{{date('d/m/Y',strtotime($res->AgendaDetail->agenda_date ))}}-->
                         {{$res->AgendaDetail->agenda_date}}
                    </span>
            </div>
        </div>
        <div class="row" style="text-align:right;padding-top: 50px;">
            <div class="col-12" style="text-align:right">
                <h2 class=" " style="text-align:right;display:inline;">
                    السيد
                    {{$res->connected_to_txt}}
                    المحترم
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right;padding-top: 50px;">
                    <span style="margin-top:10px;font-size:16pt;" align="right">
                        ،،،، تحية طيبة وبعد
                    </span>
            </div>
        </div>
        <div class="row" style="text-align:center;padding-top: 50px;">
            <div class="col-12" style="text-align:center">
                <h2 class=" " style="text-align:center;display:inline;text-decoration: underline;">
                    الموضوع :
                    {{$res->title}}
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right;padding-top: 50px;">
                    <textarea type="text" id="printText" class="form-control" name="printText"
                              style="width: 100%;height: 150px;color: black;border: none;overflow: hidden;border-radius: 5px !important;font-size: 16pt !important;direction: rtl;padding-left: 50px;padding-right: 50px;"
                              aria-invalid="false">     إشارة إلى الموضوع اعلاه، وإلى الإستدعاء المقدم منك تاريخ {{$res->invocationDate}} بخصوص {{$res->title}} فى القطعة رقم {{$res->pieceNo}} حوض رقم {{$res->hodNo}}، نحيطك علماً أن لجنة التنظيم والبناء المحلية قررت فى جلستها رقم {{$res->AgendaDetail->agenda_number}} بتاريخ {{date('d/m/Y',strtotime($res->AgendaDetail->agenda_date ))}} {{$res->descision}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:center;padding-top: 50px;">
                    <span style="margin-top:10px;font-size:16pt;" align="center">
                       واقبلوا الاحترام
                    </span>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:left; padding-left: 20px">
                <h2 style="margin-top:10px;font-size:16pt;padding-top: 20px;">
                    حسام دراغمة
                </h2>
                <h2 style="margin-top:10px;font-size:16pt;padding-top: 10px;">
                    رئيس بلدية طوباس
                </h2>
                <h2 style="margin-top:10px;font-size:16pt;padding-top: 10px;">
                    رئيس لجنة التنظيم والبناء
                </h2>
            </div>
        </div>
    @endif
    <input type="hidden" name="topic_id" id="topic_id" value="{{$res->id}}">
    </form>
    <table width="100%" class="footerLine"
           style="border:0px solid #ffffff; margin-bottom:20px;position:absolute;bottom: 0;">
        <tr>
            <td style="border:0px solid #ffffff;">
                <img src="{{$setting->footer_img}}" width="100%">
            </td>
        </tr>
    </table>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
<?php if(isset($res->print_input)) { ?>
    @foreach($res->print_input as $key=>$val)
    $('#{{$key}}').val(`{{$val}}`)
    $('#{{$key}}').html(`{{$val}}`)
    @endforeach
    <?php }?>
$("body").on('change', '#printText', function(){
    ManualSave()
});
function ManualSave(){
        var formData = new FormData($("#rpFrm")[0]);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                    'ContentType': 'application/json'
                }
            });
            $.ajax({
                url: '{{route('savePrintDes')}}',
                type: 'POST',
                data: formData,
                dataType:"json",
                async: true,
                success: function (data) {
                    if(data.status){
                        alert('تمت عملية الحفظ')
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
    // var mywindow = window.open('', 'PRINT', 'height=1080,width=600');
    //
    // mywindow.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">');
    // mywindow.document.write('</head><body style="padding-top: 150px; line-height: 24; font-size: 14px;" >');
    //
    // mywindow.document.write(document.getElementById("forPrint").innerHTML);
    // mywindow.document.write("<img src='https://chart.googleapis.com/chart?cht=qr&chl=https://stage.expand.ps/viewCert/" + data.id1 + "&chs=180x180&choe=UTF-8&chld=L|2' alt=''>");
    // mywindow.document.write('</body></html>');
    //
    // mywindow.document.close(); // necessary for IE >= 10
    // mywindow.focus(); // necessary for IE >= 10*/
</script>
