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
        }

        body {
            zoom: 80%;
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
        height: 135px;
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
        top: 11mm;
        width: 100%;
        /*background: white;*/
        /*border: 1px solid black; !* for demo *!*/
    }

    #apsent {
        
    }

    #headerTable {
        font-size: 16pt;
    }

    #des > th, td {
        /*padding: 10px;*/
        /*border-bottom: 15px solid transparent;*/
        background-clip: padding-box;
        font-size: 18pt !important;
    }

    #content {
        display: table;
    }

</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<div class="page-header" style="text-align: center">
    <div class="row" style="border: 1px solid;margin: 10px 1.1rem 10px 12px;">
        <div class="col-3">
            <img src="{{asset('assets/images/ico/tubaslogo.png')}}" style="margin: 2px;height: 50px;">
        </div>
        <div class="col-6">
            <div class="font-16" style="font-weight: 900 !important;">
                {{$data['meeting_name']}}
            </div>
            <div class="font-16"  style="font-weight: 900 !important;">
                جلسة رقم:
                {{$data['agendaDetail']->agenda_number}}
            </div>
        </div>
        <div class="col-3" style="text-align: right;">
            <div class="font-14" style="padding-bottom: 5px;padding-top: 5px">
                &nbsp;&nbsp;&nbsp;اليوم:
                {{$data['day']}}
            </div>
            <div class="font-14">
                التاريخ:
                {{$data['date']}}
            </div>
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
                        <table class="table"
                               style="width: 96.8%; margin-top:10px;margin-right:2rem; line-height:1.6"
                               id="des" cellspacing="1">
                            <tr class="border">
                                <td class="border font-14" rowspan="5" width="60px"
                                    style="text-align:right; vertical-align: middle;padding: 0px;">
                                    <b>
                                        الحضور
                                    </b>
                                </td>
                                <td class="border font-14" rowspan="1" style="text-align:left;padding: 0px;">
                                    <input id="chairmanTitle" name="chairmanTitle"
                                           onchange="modifyChairmanTitle();"
                                           style="width:100%;text-align:left;font-weight: bold"
                                           value="رئيس اللجنة :"/>
                                </td>
                                <td class="border font-14" rowspan="1" colspan="5"
                                    style="text-align:right;padding: 0px;">
                                    <input id="chairmanName" name="chairmanName"
                                           onchange="modifyChairmanName();"
                                           style="width:100%;text-align:right;"
                                           value="{{$data['adminData']?$data['adminData']->name:''}}"/>
                                </td>
                            </tr>
                            <tr class="border">
                                <td class="border font-14" rowspan="1" style="text-align:left;padding: 0px; ">
                                    <b>
                                        السادة الأعضاء :
                                    </b>
                                </td>
                                <td class="border font-14" rowspan="1" colspan="5"
                                    style="text-align:right;padding: 0px; ">

                                    <textarea class=" font-14" id="employeeName" name="employeeName" onchange="drawAttendees();"
                                              style="width:100%"
                                    >{{$data['employeeName']}}</textarea>
                                </td>
                            </tr>
                            <tr class="border">
                                <td class="border font-14" rowspan="1"
                                    style="text-align:left;width: 235px;padding: 0px; ">
                                    <input id="input1Title" name="input1Title" class=" font-14"
                                           style="width:100%;text-align:left;font-weight: bolder;"
                                           value="مدير دائرة التخطيط والتطوير :"/>
                                </td>
                                <td class="border font-14" rowspan="1"
                                    style="text-align:right;padding: 0px; ">
                                    <input id="input1Name" name="input1Name" class=" font-14"
                                           style="width:100%;text-align:right;"
                                           value="مها مجاهد"/>
                                </td>
                                <td class="border font-14" rowspan="1"
                                    style="text-align:left;padding: 0px; ">
                                    <input id="input2Title" name="input2Title" class=" font-14"
                                           style="width:100%;text-align:left;font-weight: bolder;"
                                           value="مهندس التنظيم والبناء :"/>
                                </td>
                                <td class="border font-14" rowspan="1"
                                    style="text-align:right;padding: 0px; ">
                                    <input id="input2Name" name="input2Name" class=" font-14"
                                           style="width:100%;text-align:right;"
                                           value="ميساء صوافطة"/>
                                </td>
                                <td class="border font-14" rowspan="1"
                                    style="text-align:left;padding: 0px; ">
                                    <input id="input3Title" name="input3Title" class=" font-14"
                                           style="width:100%;text-align:left;font-weight: bolder;"
                                           value="رئيس قسم المشاريع :"/>
                                </td>
                                <td class="border font-14" rowspan="1"
                                    style="text-align:right;padding: 0px; ">
                                    <input id="input3Name" name="input3Name" class=" font-14"
                                           style="width:100%;text-align:right;"
                                           value="علا ظاهر"/>
                                </td>
                            </tr>
                            <tr class="border font-14">
                                <td class="border font-14" rowspan="1" style="text-align:left;padding: 0px; ">
                                    <b>
                                        الغياب :
                                    </b>
                                </td>
                                <td class="border font-14" rowspan="1" colspan="5" style="padding: 0px;">
                                    <input id="apsent" class=" font-14" name="apsent" style="width:100%"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h4 style="width:94%;font-weight:bold;text-align: right;margin-right: 2rem;">
            <textarea id="tableHeaderText" class=" font-14" name="tableHeaderText" style="width: 100%;border: none;"> في هذا اليوم {{$data['day']}} الموافق {{$data['date']}}  اجتمعت {{$data['meeting_name']}} في مكتب رئيس اللجنة وذلك للنظر في طلبات الترخيص وبعد دراسة ومناقشة الملفات قررت اللجنة ما يلي :
            </textarea>
                    </h4>
                    <div>
                        <table class="table"
                               style="width: 96.8%; margin-top:10px;margin-right:2rem; line-height:1.6"
                               id="des" cellspacing="1">
                            <thead class="border">
                            <th class="border font-14" style="text-align:center;padding:1rem;font-weight:bold;"
                                width="3%">
                                البند
                            </th>
                            <th class="border font-14" style="text-align:center;font-weight:bold;" width="15%">
                                اسم مقدم
                                الطلب
                            </th>
                            <th class="border font-14" style="text-align:center;font-weight:bold;" width="20%">
                                الموضوع
                            </th>
                            <th class="border font-14" style="text-align:center;font-weight:bold;" width="5%">
                                تاريخ
                            </th>
                            <th class="border font-14" style="text-align:center;padding:1rem;font-weight:bold;"
                                width="5%">
                                قطعة
                            </th>
                            <th class="border font-14" style="text-align:center;padding:1rem;font-weight:bold;"
                                width="5%">
                                حوض
                            </th>
                            <th class="border font-14" style="text-align:center;font-weight:bold;" width="25%">
                                تقرير
                                المهندس
                            </th>
                            <th class="border font-14" style="text-align:center;font-weight:bold;" width="18%">
                                قرار
                                اللجنة
                            </th>
                            </thead>
                            <tbody class="border">
                            <?php $i = 1; ?>
                            @foreach($data['agendaDetail']->AgendaTopic as $topic)
                                <tr style="margin-bottom:1rem">
                                    <td class="border font-14"
                                        style="margin-bottom:1rem;text-align:center;vertical-align: middle;"
                                        scope="col">
                                        {{$i++}}</td>
                                    <td class="border font-14" scope="col"
                                        style="text-align:right;vertical-align: middle;">
                                        {{$topic->connected_to_txt}}
                                    </td>
                                    <td class="border font-14" style="text-align:right;vertical-align: middle;"
                                        scope="col">
                                        {{$topic->title}}
                                    </td>
                                    <td class="border font-14" style="text-align:center;vertical-align: middle;"
                                        scope="col"
                                        class="building_column">
                                        {{$topic->invocationDate}}
                                    </td>
                                    <td class="border font-14"
                                        style="text-align:center;vertical-align: middle;padding:1rem;"
                                        scope="col"
                                        class="building_column">
                                        {{$topic->pieceNo}}

                                    </td>
                                    <td class="border font-14"
                                        style="text-align:center;vertical-align: middle;padding:1rem;"
                                        scope="col"
                                        class="building_column">

                                        {{$topic->hodNo}}
                                    </td>
                                    <td class="border font-14" style="text-align:right;vertical-align: middle;"
                                        scope="col"
                                        class="building_column">

                                        {{$topic->engReport}}
                                    </td>
                                    <td class="border font-14"
                                        style="text-align:right;vertical-align: middle;padding:1rem;"
                                        scope="col">
                                        {{$topic->descision}}
                                    </td>
                                <tr/>
                            @endforeach

                            </tbody>
                        </table>
                        <div style="text-align: center" class=" font-14">
                            وقد اقفل المحضــــــــــــــر في حينه وتاريخه
                        </div>
                        <table style="width: 96.8%; margin-top:10px;margin-right:2rem; line-height:1.6">
                            <tbody class="attendees_tbody">
                            <tr>
                                <td class="border chairmanTitle font-14" style="text-align:left; ">
                                    رئيس اللجنة :
                                </td>
                                <td class="border chairmanName font-14" colspan="6" style="text-align:right; ">
                                    {{$data['adminData']->name}}
                                </td>
                            </tr>
                            @for($i=0; $i<sizeof(($data['employeeNameArr']??[]));($i+=3))
                                <tr class="attendees_tr">
                                    @if($i==0)
                                        <td rowspan="{{sizeof(($data['employeeNameArr']??[]))>0?(sizeof(($data['employeeNameArr']??[]))/3+sizeof(($data['employeeNameArr']??[]))%3):1}}"
                                            class="border font-14"
                                            style="text-align:left;width: 150px;vertical-align: baseline; ">
                                            السادة الأعضاء :
                                        </td>
                                    @endif
                                    @for($c=$i;($c<($i+3) && $c<sizeof(($data['employeeNameArr']??[])));$c++)
                                        <td class="border font-14" style="text-align:right; ">
                                            {{$data['employeeNameArr'][$c]}}
                                        </td>
                                        <td class="border" style="text-align:right;width: 150px ">
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
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
<style>
    .border {
        border: 1px solid #000 !important;
        padding: 1px;
    }

    .font-14 {
        font-size: 14px !important;
    }

    .font-16 {
        font-size: 16px !important;
    }
</style>
<script>
    <?php if (isset($data['print_input'])) { ?>
    @foreach($data['print_input'] as $key=>$val)
    @if($val!=null)
    $('#{{$key}}').val('{{$val}}')
    $('#{{$key}}').html(`{{$val}}`)
    $('.{{$key}}').html(`{{$val}}`)
    @endif
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

    function modifyChairmanTitle() {
      $('.chairmanTitle').html($('#chairmanTitle').val())
    }

    function modifyChairmanName() {
      $('.chairmanName').html($('#chairmanName').val())
    }

    function drawAttendees() {
      const AttendeesString = $('#employeeName').val()
      const AttendeesArr = AttendeesString.split(",");
      $('.attendees_tr').remove();
      let Attendees_tr = ''
      const rowspan = (AttendeesArr?.length > 0 ? (AttendeesArr?.length / 3 + AttendeesArr?.length % 3) : 1);
      for (let i = 0; i < AttendeesArr?.length; (i += 3)) {
        Attendees_tr += `<tr class="attendees_tr" >`
        if (i === 0) {
          Attendees_tr += `<td rowspan="${rowspan}"
                            class="border" style="text-align:left;width: 150px;vertical-align: baseline; ">
                            السادة الأعضاء :
                          </td>`
        }
        for (let c = i; (c < (i + 3) && c < AttendeesArr?.length); c++) {
          Attendees_tr += `<td class="border" style="text-align:right; ">
                        ${AttendeesArr[c]}
                      </td>
                      <td class="border" style="text-align:right;width: 150px ">
                      </td>`
        }
        Attendees_tr += `</tr>`
      }
      $('.attendees_tbody').append(Attendees_tr);
    }
</script>
