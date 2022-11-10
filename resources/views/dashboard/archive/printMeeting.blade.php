<style>
    body {
        font-family: serif !important;
        font-size: 18pt !important;
        direction: rtl;
    }

    h1, h2 {
        margin: 0px;
    }

    .footerLine {
        display: none;
    }

    .page {
        page-break-after: always;
    }

    @page {
        margin: 20mm;
    }

    @media print {
        @page {
            size: auto !important;
            margin: 20mm
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .footerLine {
            display: inline-block;
        }

        body {
            font-size: 18pt !important;
        }

        input {
            border: 0;
        }

        .hidePrint {
            display: none !important;
        }
    }

    .page-header, .page-header-space {
        height: 100px;
    }

    .page-footer, .page-footer-space {
        height: 50px;

    }

    .page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        border-top: 1px solid black; /* for demo */
    }

    .page-header {
        position: fixed;
        top: 2mm;
        width: 100%;
        background: white;
        /*border: 1px solid black; !* for demo *!*/
    }

    #apsent {
        font-size: 18pt;
    }

    #headerTable {
        font-size: 16pt;
    }

    #des > th, td {
        /*padding: 10px;*/
        border-bottom: 15px solid transparent;
        background-clip: padding-box;
        font-size: 18pt !important;
    }

    .border {
        border: 1px solid #000;
        padding: 1px;
    }

    #content {
        display: table;
    }

</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="page-header" style="text-align: center">
    <div class="row" style="border: 1px solid;margin: 10px;">
        <div class="col-3" >
            <img src="{{asset('assets/images/ico/tubaslogo.png')}}" style="margin: 2px">
        </div>
        <div class="col-6">
            <div>
                {{$data['meeting_name']}}
            </div>
            <di>
                جلسة رقم:
                {{$data['agendaDetail']->agenda_number}}
            </di>
        </div>
        <div class="col-3">
            <div>
                اليوم:
                {{$data['day']}}
            </div>
            <di>
                 التاريخ:
                {{$data['date']}}
            </di>
        </div>
    </div>
</div>

{{--<div class="page-footer">--}}
{{--    I'm The Footer--}}
{{--</div>--}}
<table dir="rtl">

    <thead>
    <tr>
        <td>
            <!--place holder for the fixed-position header-->
            <div class="page-header-space"></div>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <div class="row" id="forPrint" style="direction:rtl;">
                <form method="post" id="rpFrm" dir="rtl" style="">
                    <div>
                        <table class="table table-bordered"
                               style="width: 95%; margin-top:10px;margin-right:1rem; line-height:1.6"
                               id="des" cellspacing="1">
                            <tr>
                                <td rowspan="5" width="60px"
                                    style="text-align:right;font-size: 18pt; vertical-align: middle;">
                                    <b>
                                        الحضور
                                    </b>
                                </td>
                                <td rowspan="1" style="text-align:left;font-size: 18pt; ">
                                    <input id="chairmanTitle" name="chairmanTitle"
                                           style="width:100%;text-align:left;font-size: 18pt;font-weight: bold"
                                           value="رئيس اللجنة :"/>
                                </td>
                                <td rowspan="1" colspan="5" style="text-align:right;font-size: 18pt; ">
                                    <input id="chairmanName" name="chairmanName"
                                           style="width:100%;text-align:right;font-size: 18pt;"
                                           value="{{$data['adminData']->name??''}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="1" style="text-align:left;font-size: 18pt; ">
                                    <b>
                                        السادة الأعضاء :
                                    </b>
                                </td>
                                <td rowspan="1" colspan="5" style="text-align:right;font-size: 18pt; ">

                                    <input id="employeeName" name="employeeName" style="width:100%"
                                           value="{{$data['employeeName']}}"/>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="1" style="text-align:left;font-size: 14pt !important; ">
                                    <input id="input1Title" name="input1Title"
                                           style="width:100%;text-align:left;font-size: 14pt;"
                                           value="مدير دائرة التخطيط والتطوير :"/>
                                </td>
                                <td rowspan="1" style="text-align:right;font-size: 14pt !important; ">
                                    <input id="input1Name" name="input1Name"
                                           style="width:100%;text-align:right;font-size: 14pt;"
                                           value="مها مجاهد"/>
                                </td>
                                <td rowspan="1" style="text-align:left;font-size: 14pt !important; ">
                                    <input id="input2Title" name="input2Title"
                                           style="width:100%;text-align:left;font-size: 14pt;"
                                           value="مهندس التنظيم والبناء :"/>
                                </td>
                                <td rowspan="1" style="text-align:right;font-size: 14pt !important; ">
                                    <input id="input2Name" name="input2Name"
                                           style="width:100%;text-align:right;font-size: 14pt;"
                                           value="ميساء صوافطة"/>
                                </td>
                                <td rowspan="1" style="text-align:left;font-size: 14pt !important; ">
                                    <input id="input3Title" name="input3Title"
                                           style="width:100%;text-align:left;font-size: 14pt;"
                                           value="رئيس قسم المشاريع :"/>
                                </td>
                                <td rowspan="1" style="text-align:right;font-size: 14pt !important; ">
                                    <input id="input3Name" name="input3Name"
                                           style="width:100%;text-align:right;font-size: 14pt;"
                                           value="علا ظاهر"/>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="1" style="text-align:left;font-size: 18pt; ">
                                    <b>
                                        الغياب :
                                    </b>
                                </td>
                                <td rowspan="1" colspan="5">
                                    <input id="apsent" name="apsent" style="width:100%"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h4 style="width:94%;font-weight:bold;text-align: right;margin-right: 1rem;">
            <textarea id="tableHeaderText" name="tableHeaderText" style="width: 100%;border: none;font-weight: bold;"> في هذا اليوم {{$data['day']}} الموافق {{$data['date']}}  اجتمعت {{$data['meeting_name']}} في مكتب رئيس اللجنة وذلك للنظر في طلبات الترخيص وبعد دراسة ومناقشة الملفات قررت اللجنة ما يلي :
            </textarea>
                    </h4>
                    <div>
                        <table class="table table-bordered"
                               style="width: 95%; margin-top:10px;margin-right:1rem; line-height:1.6"
                               id="des" cellspacing="1">
                            <thead class="border">
                            <th class="border" style="text-align:center;padding:1rem;font-weight:bold;font-size: 15pt;"
                                width="7%">
                                البند
                            </th>
                            <th class="border" style="text-align:center;font-weight:bold;font-size: 15pt;" width="15%">
                                اسم مقدم
                                الطلب
                            </th>
                            <th class="border" style="text-align:center;font-weight:bold;font-size: 15pt;" width="20%">
                                الموضوع
                            </th>
                            <th class="border" style="text-align:center;font-weight:bold;font-size: 15pt;" width="5%">
                                تاريخ
                            </th>
                            <th class="border" style="text-align:center;padding:1rem;font-weight:bold;font-size: 15pt;"
                                width="5%">
                                قطعة
                            </th>
                            <th class="border" style="text-align:center;padding:1rem;font-weight:bold;font-size: 15pt;"
                                width="5%">
                                حوض
                            </th>
                            <th class="border" style="text-align:center;font-weight:bold;font-size: 15pt;" width="25%">
                                تقرير
                                المهندس
                            </th>
                            <th class="border" style="text-align:center;font-weight:bold;font-size: 15pt;" width="18%">
                                قرار
                                اللجنة
                            </th>
                            </thead>
                            <tbody class="border">
                            <?php $i = 1; ?>
                            @foreach($data['agendaDetail']->AgendaTopic as $topic)
                                <tr  style="margin-bottom:1rem">
                                    <th class="border"
                                        style="margin-bottom:1rem;text-align:center;vertical-align: middle;"
                                        scope="col">
                                        {{$i++}}</th>
                                    <th class="border" scope="col" style="text-align:right;vertical-align: middle;">
                                        {{$topic->connected_to_txt}}
                                    </th>
                                    <th class="border" style="text-align:right;vertical-align: middle;" scope="col">
                                        {{$topic->title}}
                                    </th>
                                    <th class="border" style="text-align:center;vertical-align: middle;" scope="col"
                                        class="building_column">
                                        {{$topic->invocationDate}}
                                    </th>
                                    <th class="border" style="text-align:center;vertical-align: middle;padding:1rem;"
                                        scope="col"
                                        class="building_column">
                                        {{$topic->pieceNo}}

                                    </th>
                                    <th class="border" style="text-align:center;vertical-align: middle;padding:1rem;"
                                        scope="col"
                                        class="building_column">

                                        {{$topic->hodNo}}
                                    </th>
                                    <th class="border" style="text-align:right;vertical-align: middle;" scope="col"
                                        class="building_column">

                                        {{$topic->engReport}}
                                    </th>
                                    <th class="border" style="text-align:right;vertical-align: middle;padding:1rem;"
                                        scope="col">
                                        {{$topic->descision}}
                                    </th>
                                <tr/>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="meeting_id" id="meeting_id" value="{{$data['agendaDetail']->id}}">
                    <button type="button" class="hidePrint" style="position: fixed;bottom: 20px;left: 20px;">
                        <img src="https://db.expand.ps/uploads/s1.jpg" id="makeResponse" height="32px"
                             style="cursor: pointer"
                             onclick="ManualSave()">
                    </button>
                    <button type="button" class="hidePrint print btn btn-primary" onclick="window.print()"
                            style="position: fixed;bottom: 20px;left: 80px;">
                        طباعة
                    </button>
                </form>
            </div>
        </td>
    </tr>
    </tbody>
    {{--    <tfoot>--}}
    {{--    <tr>--}}
    {{--        <td>--}}
    {{--            <!--place holder for the fixed-position footer-->--}}
    {{--            <div class="page-footer-space"></div>--}}
    {{--        </td>--}}
    {{--    </tr>--}}
    {{--    </tfoot>--}}
</table>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script>
    <?php if (isset($data['print_input'])) { ?>
    @foreach($data['print_input'] as $key=>$val)
    $('#{{$key}}').val('{{$val}}')
    $('#{{$key}}').html(`{{$val}}`)
    @endforeach
    <?php } ?>
    function ManualSave() {
        var formData = new FormData($("#rpFrm")[0]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                'ContentType': 'application/json'
            }
        });
        $.ajax({
            url: '{{route('savePrintMeeting')}}',
            type: 'POST',
            data: formData,
            dataType: "json",
            async: true,
            success: function (data) {
                if (data.status) {
                    alert('تمت عملية الحفظ')
                } else {
                    alert('خطاء في الحفظ')
                }

            },
            error: function () {
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
