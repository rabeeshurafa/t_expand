@canany(['taskiconmob'])
    <div class="row hidemob hide TaskModel TaskMobile">
        <div class="col-sm-12">
            <div class="form-group">
                    <?php $days = array(
                        'Mon' => 'الإثنين',
                        'Tue' => 'الثلاثاء',
                        'Wed' => 'الأربعاء',
                        'Thu' => 'الخميس',
                        'Fri' => 'الجمعة',
                        'Sat' => 'السبت',
                        'Sun' => 'الأحد',
                ); ?>
                <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active list1" style="color: #0073AA;" id="base-tab1"
                           data-toggle="tab" aria-controls="ctab1" href="#ctab1"
                           aria-expanded="true">
                            <b>
                                <span class="list1Title">مهامى</span>
                                (<span id="ctabCnt1">{{sizeof($myTask)}}</span>)

                            </b></a>
                    </li>
                    <!--style="width: max-content;"-->
                    <li class="nav-item">
                        <a class="nav-link list2" style="color: #0073AA;" id="base-tab2"
                           data-toggle="tab" aria-controls="ctab2" href="#ctab2"
                           aria-expanded="false">
                            <b>
                                <span class="list2Title">مهام مؤجله</span>
                                (<span id="ctabCnt2">{{sizeof($waittingTask)}}</span>)</b></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link list3" style="color: #0073AA;" id="base-tab3"
                           data-toggle="tab" aria-controls="ctab3" href="#ctab3"
                           aria-expanded="false">
                            <b>
                                <span class="list3Title">مهام للاطلاع</span>
                                (<span id="ctabCnt3">{{sizeof($taggedTask)}}</span>)

                            </b></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link list4" style="color: #0073AA;" id="base-tab4"
                           data-toggle="tab" aria-controls="ctab4" href="#ctab4"
                           aria-expanded="false">
                            <b>
                                <span class="list4Title">مهام قمت بتحويلها</span>
                                (<span id="ctabCnt4">{{sizeof($sentTask)}}</span>)

                            </b>
                        </a>
                    </li>
                </ul>
                <div class="tab-content px-1 pt-1"
                     style="direction: rtl;max-height: 400px;overflow: auto;">
                    <div role="tabpanel" class="tab-pane active" id="ctab1" aria-expanded="true"
                         aria-labelledby="base-tab1">
                        <p>
                        <table style="width:100%; margin-top: 10px;direction: rtl;"
                               class="detailsTB table hdrTbl1 myTaskTable">

                            <thead width='100%'>

                            <tr>

                                <th class="" scope="col" style="text-align: right; color:#ffffff">
                                    #
                                </th>

                                <th class="col-md-2 hideMob" scope="col"
                                    style="text-align:  right; direction:rtl;   color:#ffffff">

                                    {{"المرسل"}}  </th>

                                <th class="col-md-2" scope="col"
                                    style="text-align: right; color:#ffffff">

                                    {{"اسم المستفيد"}}</th>

                                <th class="col-md-2" scope="col"
                                    style="text-align: right; color:#ffffff">

                                    {{trans('admin.task_title')}}</th>

                                <th class="col-md-3 hideMob" scope="col"
                                    style="text-align: center; color:#ffffff">

                                    {{trans('admin.opening_date')}}</th>

                                <th class="col-md-3 hideMob" scope="col"
                                    style="text-align: center; color:#ffffff">

                                    {{'الإجراءات'}}</th>

                            </tr>

                            </thead>

                            <tbody id="cMyTask1">

                            </tbody>

                        </table>

                        </p>

                    </div>
                    <div class="tab-pane" id="ctab2" aria-labelledby="base-tab2">

                        <p>
                        <table style="width:100%; margin-top: 10px;direction: rtl;"
                               class=" detailsTB table hdrTbl1 wtbl2">

                            <thead width='100%' id="wtbl2Header">

                            <tr>

                                <th class="" style="text-align: right; color:#ffffff">#</th>

                                <th class="col-md-2 hideMob"
                                    style="text-align:  right; color:#ffffff;">

                                    {{"المرسل"}}  </th>

                                <th class="col-md-2" style="text-align: right;  color:#ffffff;">

                                    {{"اسم المستفيد"}}</th>

                                <th class="col-md-2" style="text-align: right; color:#ffffff;">

                                    {{trans('admin.task_title')}}</th>

                                <th class="col-md-1 hideMob"
                                    style="text-align: right;  color:#ffffff;">

                                    {{'الحالة'}}</th>

                                <th class="col-md-2 hideMob"
                                    style="text-align: center; color:#ffffff;">

                                    {{trans('admin.opening_date')}}</th>

                                <th class="col-md-3 hideMob"
                                    style="text-align: center; color:#ffffff; width:100% !important;"
                                    colspan="1">

                                    {{'الإجراءات'}}</th>

                            </tr>

                            </thead>

                            <tbody id="cMyTask2">

                            </tbody>

                        </table>

                        </p>

                    </div>
                    <div class="tab-pane" id="ctab3" aria-labelledby="base-tab3">

                        <p>

                        <table style="width:100%; margin-top: 10px;direction: rtl;"
                               class="detailsTB table hdrTbl1 wtbl3">

                            <thead width='100%'>

                            <tr>

                                <th class="" scope="col" style="text-align: right; color:#ffffff">
                                    #
                                </th>

                                <th class="col-md-2 hideMob"
                                    style="text-align:  right; direction:rtl;   color:#ffffff">

                                    {{"المرسل"}}  </th>

                                <th class="col-md-2" style="text-align: right;   color:#ffffff">

                                    {{"اسم المستفيد"}}</th>

                                <th class="col-md-2" style="text-align: right;   color:#ffffff">

                                    {{trans('admin.task_title')}}</th>

                                <th class="col-md-3 hideMob"
                                    style="text-align: center;   color:#ffffff">

                                    {{trans('admin.opening_date')}}</th>

                                <th class="col-md-3 hideMob"
                                    style="text-align: center;   color:#ffffff">

                                    {{'الإجراءات'}}</th>

                            </tr>

                            </thead>

                            <tbody id="cMyTask3">

                            </tbody>

                        </table>

                        </p>

                    </div>
                    <div class="tab-pane" id="ctab4" aria-labelledby="base-tab4">

                        <p>

                        <table style="width:100%; margin-top: 10px;direction: rtl;"
                               class="detailsTB table hdrTbl1 wtbl4">

                            <thead width='100%'>

                            <tr>

                                <th class="" scope="col" style="text-align: right; color:#ffffff">
                                    #
                                </th>

                                <th class="col-md-2 hideMob"
                                    style="text-align:  right; direction:rtl;   color:#ffffff">

                                    {{"تم تحويلها إلى"}}  </th>

                                <th class="col-md-2" style="text-align: right;   color:#ffffff">

                                    {{"اسم المستفيد"}}</th>

                                <th class="col-md-2" style="text-align: right;   color:#ffffff">

                                    {{trans('admin.task_title')}}</th>
                                <th class="col-md-3 hideMob"
                                    style="text-align: center;   color:#ffffff">

                                    {{trans('admin.opening_date')}}</th>
                                <!-- <th class="col-md-3" scope="col" style="text-align: center;   color:#ffffff">

                        									{{'الإجراءات'}}</th> -->

                            </tr>

                            </thead>

                            <tbody id="cMyTask4">

                            </tbody>

                        </table>

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @canany([ 'taskiconmob'])
        $(function () {
          myTaskTable = $('.myTaskTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            "ajax": "{{ route('getMyTaskAjax') }}",
            "language": {
              "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
              "sLoadingRecords": "جارٍ التحميل...",
              "sProcessing": "جارٍ التحميل...",
              "sLengthMenu": "أظهر _MENU_ مدخلات",
              "sZeroRecords": "لم يعثر على أية سجلات",
              "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
              "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
              "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
              "sInfoPostFix": "",
              "sSearch": "ابحث:",
              "sUrl": "",
              "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
              },
              "oAria": {
                "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
              }
            },
            "deferRender": true,
            "columns": [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "noP", orderable: false, searchable: false},
              {
                className: "hideMob",
                data: 'trans',
                render: function (data, row, type) {
                  $actionBtn = `<div class="hideMob"><img src="${data.image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                                                ${data.nick_name}</div>`

                  return $actionBtn;
                },

                name: 'trans.nick_name'
              },
              {
                data: '.0',
                className: "setWidth",
                render: function (data, row, type) {
                  $actionBtn = `<a href="javascript:void(0)" style="text-align: right;; color: #000000; font-weight:bold;font-size: 14px !important;">
                                            ${(data.customer_name ?? '')}`
                  return $actionBtn;
                },
                name: '0.customer_name'
              },
              {
                data: null,
                className: "setWidth",
                render: function (data, row, type) {
                  rout = '{{ route('admin.dashboard')}}'
                  ticket_name_o = '';
                  if (data['trans'].related == 23) {
                      @foreach($ticketTypeList as $ticketType)
                      if (data[0].task_type ==<?php echo $ticketType->id ?>)
                        ticket_name_o = '<?php echo $ticketType->name ?>'
                      @endforeach
                  }
                  $actionBtn = `<a onclick="$('body').trigger('click');$('.loader').removeClass('hide')" href="${rout}/viewTicket/${data['trans'].ticket_id}/${data['trans'].related}">
                                                                ${data['trans'].related != 23 ? data['config'].ticket_name : ticket_name_o}
                                                                    <span class="hideMob">(${data[0].app_no})</span>
                                                                </a>`
                  return $actionBtn;
                },
                name: 'config.ticket_name'
              },
              {
                data: null,

                render: function (data, row, type) {
                  days = Array();
                  days[0] = 'الأحد';
                  days[1] = 'الإثنين';
                  days[2] = 'الثلاثاء';
                  days[3] = 'الأربعاء';
                  days[4] = 'الخميس';
                  days[5] = 'الجمعة';
                  days[6] = 'السبت';
                  d = new Date(data['trans'].created_at)
                  $actionBtn = `<div class="row hideMob">
                                                <div class="col-sm-2">${days[d.getDay()]}</div>
                                                <div class="col-sm-4">${d.getDate()}/${d.getMonth() + 1}/${data['trans'].created_at.substr(0, 4)}</div>
                                                <div class="col-sm-5">
                                                    <img src="{{ asset('assets/images/ico/clock.png') }}" width="32" height="32"> ${d.getHours()}:${d.getMinutes()}
                                                </div>
                                            </div>`
                  return $actionBtn;
                },
                name: 'trans.created_at'
              },
              {
                data: null,
                render: function (data, row, type) {
                  if (data.response.length > 0) {
                    var txt = decodeURI(data['response'][0].s_text);
                    var temp = txt.split('&lt;\\br&gt;');
                    txt = '';
                    for (i = 0; i < temp.length; i++)
                      txt += temp[i];
                    $actionBtn = `<div class="row hideMob">
                                                <div class="col-sm-2">
                                                    <img src="${data['response'][0].image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <a class="nottes">
                                                    ${txt != "null" ? decodeHtml(txt) : ''}
                                                    </a>
                                                </div>
                                            </div>`
                  } else {
                    var txt = decodeURI(data['trans'].s_note);
                    var temp = txt.split('&lt;\\br&gt;');
                    txt = '';
                    for (i = 0; i < temp.length; i++)
                      txt += temp[i];
                    $actionBtn = `<div class="row hideMob">
                                                <div class="col-sm-2">
                                                    <img src="${data['trans'].image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                                </div>
                                                <div class="col-sm-10">
                                                    <a class="nottes">
                                                    ${txt != "null" ? txt.replace(/(<([^>]+)>)/gi, " ") : ''}
                                                    </a>
                                                </div>
                                            </div>`
                  }
                  return $actionBtn;
                },


              },

            ],
            createdRow: function (row, data, index) {
              //
              // if the second column cell is blank apply special formatting
              //
              if (data['trans'].is_seen == 0) {
                $(row).addClass('notseen');
              }
            },
          });


          myTaskTable.on('init.dt', function () {
            if (window.matchMedia('(max-width: 767px)').matches) {
              $(".setWidth").each(function () {
                $(this).css("width", "50%")
                $(this).css("padding-left", "2%!important")
              });
            }
            $(".odd").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".even").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".nottes").each(function () {
              $(this).html($(this).text());
            });

          })
        });
        $(function () {
          watingTaskTable = $('.wtbl2').DataTable({
            processing: true,
            responsive: true,
            serverSide: true,
            fixedHeader: true,
            "ajax": "{{ route('getWatingTaskAjax') }}",
            "language": {
              "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
              "sLoadingRecords": "جارٍ التحميل...",
              "sProcessing": "جارٍ التحميل...",
              "sLengthMenu": "أظهر _MENU_ مدخلات",
              "sZeroRecords": "لم يعثر على أية سجلات",
              "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
              "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
              "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
              "sInfoPostFix": "",
              "sSearch": "ابحث:",
              "sUrl": "",
              "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
              },
              "oAria": {
                "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
              }
            },
            "deferRender": true,
            "columns": [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "noP", orderable: false, searchable: false},
              {
                className: "hideMob",
                data: 'trans',
                render: function (data, row, type) {
                  $actionBtn = `<img src="${data.image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                                            ${data.nick_name}`
                  return $actionBtn;
                },

                name: 'trans.nick_name'
              },
              {
                data: '.0',
                className: "setWidth",
                render: function (data, row, type) {
                  $actionBtn = `<a href="javascript:void(0)" style="text-align: right;; color: #000000; font-weight:bold;font-size: 14px !important;">
                                        ${(data.customer_name ?? '')}`
                  return $actionBtn;
                },
                name: '0.customer_name'
              },
              {
                data: null, className: "setWidth",
                render: function (data, row, type) {
                  rout = '{{ route('admin.dashboard')}}'
                  ticket_name_o = '';
                  if (data['trans'].related == 23) {
                      @foreach($ticketTypeList as $ticketType)
                      if (data[0].task_type ==<?php echo $ticketType->id ?>)
                        ticket_name_o = '<?php echo $ticketType->name ?>'
                      @endforeach
                  }
                  $actionBtn = `<a onclick="$('body').trigger('click');$('.loader').removeClass('hide')" href="${rout}/viewTicket/${data['trans'].ticket_id}/${data['trans'].related}">
                                                                ${data['trans'].related != 23 ? data['config'].ticket_name : ticket_name_o}
                                                                    <span class="hideMob">(${data[0].app_no})</span>
                                                                </a>`
                  return $actionBtn;
                },
                name: 'config.ticket_name'
              },
              {
                data: '.0',
                className: "hideMob",
                render: function (data, row, type) {
                  $actionBtn = `<a href="javascript:void(0)" style="text-align: right;; color: #000000; font-weight:bold;font-size: 14px !important;">
                                        ${data.tname}`
                  return $actionBtn;
                },
                name: '0.tname'
              },
              {
                data: null,
                className: "hideMob",
                render: function (data, row, type) {
                  days = Array();
                  days[0] = 'الأحد';
                  days[1] = 'الإثنين';
                  days[2] = 'الثلاثاء';
                  days[3] = 'الأربعاء';
                  days[4] = 'الخميس';
                  days[5] = 'الجمعة';
                  days[6] = 'السبت';
                  d = new Date(data['trans'].created_at)
                  $actionBtn = `<div class="row">
                                            <div class="col-sm-2">${days[d.getDay()]}</div>
                                            <div class="col-sm-4">${d.getDate()}/${d.getMonth() + 1}/${data['trans'].created_at.substr(0, 4)}</div>
                                            <div class="col-sm-5">
                                                <img src="{{ asset('assets/images/ico/clock.png') }}" width="32" height="32"> ${d.getHours()}:${d.getMinutes()}
                                            </div>
                                        </div>`
                  return $actionBtn;
                },
                name: 'trans.created_at'
              },
              {
                data: null, className: "hideMob",
                render: function (data, row, type) {
                  if (data.response.length > 0) {
                    var txt = decodeURI(data['response'][0].s_text);
                    var temp = txt.split('&lt;\\br&gt;');
                    txt = '';
                    for (i = 0; i < temp.length; i++)
                      txt += temp[i];
                    $actionBtn = `<div class="row">
                                            <div class="col-sm-2">
                                                <img src="${data['response'][0].image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                            </div>
                                            <div class="col-sm-10">
                                                <a class="nottes">
                                                ${txt != "null" ? decodeHtml(txt) : ''}
                                                </a>
                                            </div>
                                        </div>`
                  } else {
                    var txt = decodeURI(data['trans'].s_note);
                    var temp = txt.split('&lt;\\br&gt;');
                    txt = '';
                    for (i = 0; i < temp.length; i++)
                      txt += temp[i];
                    $actionBtn = `<div class="row">
                                            <div class="col-sm-2">
                                                <img src="${data['trans'].image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                            </div>
                                            <div class="col-sm-10">
                                                <a class="nottes">
                                                ${txt != "null" ? txt.replace(/(<([^>]+)>)/gi, " ") : ''}
                                                </a>
                                            </div>
                                        </div>`
                  }
                  return $actionBtn;
                },


              },

            ],
            createdRow: function (row, data, index) {
              //
              // if the second column cell is blank apply special formatting
              //
              if (data['trans'].is_seen == 0) {
                $(row).addClass('notseen');
              }
            },
          });

          watingTaskTable.on('init.dt', function () {
            $(".odd").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".even").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".nottes").each(function () {
              $(this).html($(this).text());
            });
          })

        });
        $(function () {
          tagedTaskTable = $('.wtbl3').DataTable({
            processing: true,
            serverSide: true,
            "ajax": "{{ route('getTaggedTaskAjax') }}",
            "language": {
              "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
              "sLoadingRecords": "جارٍ التحميل...",
              "sProcessing": "جارٍ التحميل...",
              "sLengthMenu": "أظهر _MENU_ مدخلات",
              "sZeroRecords": "لم يعثر على أية سجلات",
              "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
              "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
              "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
              "sInfoPostFix": "",
              "sSearch": "ابحث:",
              "sUrl": "",
              "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
              },
              "oAria": {
                "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
              }
            },
            "deferRender": true,
            "columns": [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "noP", orderable: false, searchable: false},
              {
                className: "hideMob",
                data: 'trans',
                render: function (data, row, type) {
                  $actionBtn = `<img src="${data.image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                                            ${data.nick_name}`
                  return $actionBtn;
                },

                name: 'trans.nick_name'
              },
              {
                data: '.0',
                className: "setWidth",
                render: function (data, row, type) {
                  $actionBtn = `<a href="javascript:void(0)" style="text-align: right;; color: #000000; font-weight:bold;font-size: 14px !important;">
                                        ${(data.customer_name ?? '')}`
                  return $actionBtn;
                },
                name: '0.customer_name'
              },
              {
                data: null,
                className: "setWidth",
                render: function (data, row, type) {
                  rout = '{{ route('admin.dashboard')}}'
                  ticket_name_o = '';
                  if (data['trans'].related == 23) {
                      @foreach($ticketTypeList as $ticketType)
                      if (data[0].task_type ==<?php echo $ticketType->id ?>)
                        ticket_name_o = '<?php echo $ticketType->name ?>'
                      @endforeach
                  }
                  $actionBtn = `<a onclick="$('body').trigger('click');$('.loader').removeClass('hide')" href="${rout}/viewTicket/${data['trans'].ticket_id}/${data['trans'].related}">
                                                                ${data['trans'].related != 23 ? data['config'].ticket_name : ticket_name_o}
                                                                    <span class="hideMob">(${data[0].app_no})</span>
                                                                </a>`
                  return $actionBtn;
                },
                name: 'config.ticket_name'
              },

              {
                data: null,
                className: "hideMob",
                render: function (data, row, type) {
                  days = Array();
                  days[0] = 'الأحد';
                  days[1] = 'الإثنين';
                  days[2] = 'الثلاثاء';
                  days[3] = 'الأربعاء';
                  days[4] = 'الخميس';
                  days[5] = 'الجمعة';
                  days[6] = 'السبت';
                  d = new Date(data['trans'].created_at)
                  $actionBtn = `<div class="row">
                                            <div class="col-sm-2">${days[d.getDay()]}</div>
                                            <div class="col-sm-4">${d.getDate()}/${d.getMonth() + 1}/${data['trans'].created_at.substr(0, 4)}</div>
                                            <div class="col-sm-5">
                                                <img src="{{ asset('assets/images/ico/clock.png') }}" width="32" height="32"> ${d.getHours()}:${d.getMinutes()}
                                            </div>
                                        </div>`
                  return $actionBtn;
                },
                name: 'trans.created_at'
              },
              {
                data: null, className: "hideMob",
                render: function (data, row, type) {
                  if (data.response.length > 0) {
                    var txt = decodeURI(data['response'][0].s_text);
                    var temp = txt.split('&lt;\\br&gt;');
                    txt = '';
                    for (i = 0; i < temp.length; i++)
                      txt += temp[i];
                    $actionBtn = `<div class="row">
                                            <div class="col-sm-2">
                                                <img src="${data['response'][0].image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                            </div>
                                            <div class="col-sm-10">
                                                <a class="nottes">
                                                ${txt != "null" ? decodeHtml(txt) : ''}
                                                </a>
                                            </div>
                                        </div>`
                  } else {
                    var txt = decodeURI(data['trans'].s_note);
                    var temp = txt.split('&lt;\\br&gt;');
                    txt = '';
                    for (i = 0; i < temp.length; i++)
                      txt += temp[i];
                    $actionBtn = `<div class="row">
                                            <div class="col-sm-2">
                                                <img src="${data['trans'].image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                            </div>
                                            <div class="col-sm-10">
                                                <a class="nottes">
                                                ${txt != "null" ? txt.replace(/(<([^>]+)>)/gi, " ") : ''}
                                                </a>
                                            </div>
                                        </div>`
                  }
                  return $actionBtn;
                },


              },

            ],
            createdRow: function (row, data, index) {
              //
              // if the second column cell is blank apply special formatting
              //
              if (data['trans'].is_seen == 0) {
                $(row).addClass('notseen');
              }
            },
          });

          tagedTaskTable.on('init.dt', function () {
            $(".odd").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".even").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".nottes").each(function () {
              $(this).html($(this).text());
            });
          })
        });
        $(function () {
          sentTaskTable = $('.wtbl4').DataTable({
            processing: true,
            serverSide: true,
            "ajax": "{{ route('getSenTTaskAjax') }}",
            "language": {
              "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
              "sLoadingRecords": "جارٍ التحميل...",
              "sProcessing": "جارٍ التحميل...",
              "sLengthMenu": "أظهر _MENU_ مدخلات",
              "sZeroRecords": "لم يعثر على أية سجلات",
              "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
              "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
              "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
              "sInfoPostFix": "",
              "sSearch": "ابحث:",
              "sUrl": "",
              "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
              },
              "oAria": {
                "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
              }
            },
            "deferRender": true,
            "columns": [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "noP", orderable: false, searchable: false},
              {
                className: "hideMob",
                data: 'trans',
                render: function (data, row, type) {
                  $actionBtn = `<img src="${data.image}" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
                                                            ${data.nick_name}`
                  return $actionBtn;
                },

                name: 'trans.nick_name'
              },
              {
                data: '.0',
                className: "setWidth",
                render: function (data, row, type) {
                  $actionBtn = `<a href="javascript:void(0)" style="text-align: right;; color: #000000; font-weight:bold;font-size: 14px !important;">
                                        ${(data.customer_name ?? '')}`
                  return $actionBtn;
                },
                name: '0.customer_name'
              },
              {
                data: null,
                className: "setWidth",
                render: function (data, row, type) {
                  rout = '{{ route('admin.dashboard')}}'
                  ticket_name_o = '';
                  if (data['trans'].related == 23) {
                      @foreach($ticketTypeList as $ticketType)
                      if (data[0].task_type ==<?php echo $ticketType->id ?>)
                        ticket_name_o = '<?php echo $ticketType->name ?>'
                      @endforeach
                  }
                  $actionBtn = `<a onclick="$('body').trigger('click');$('.loader').removeClass('hide')" href="${rout}/viewTicket/${data['trans'].ticket_id}/${data['trans'].related}">
                                                                ${data['trans'].related != 23 ? data['config'].ticket_name : ticket_name_o}
                                                                    <span class="hideMob">(${data[0].app_no})</span>
                                                                </a>`
                  return $actionBtn;
                },
                name: 'config.ticket_name'
              },

              {
                data: null,
                className: "hideMob",
                render: function (data, row, type) {
                  days = Array();
                  days[0] = 'الأحد';
                  days[1] = 'الإثنين';
                  days[2] = 'الثلاثاء';
                  days[3] = 'الأربعاء';
                  days[4] = 'الخميس';
                  days[5] = 'الجمعة';
                  days[6] = 'السبت';
                  d = new Date(data['trans'].created_at)
                  $actionBtn = `<div class="row">
                                            <div class="col-sm-2">${days[d.getDay()]}</div>
                                            <div class="col-sm-4">${d.getDate()}/${d.getMonth() + 1}/${data['trans'].created_at.substr(0, 4)}</div>
                                            <div class="col-sm-5">
                                                <img src="{{ asset('assets/images/ico/clock.png') }}" width="32" height="32"> ${d.getHours()}:${d.getMinutes()}
                                            </div>
                                        </div>`
                  return $actionBtn;
                },
                name: 'trans.created_at'
              },
              // {data:null,
              //     render:function(data,row,type){
              //         if(data.response.length>0){
              //             var txt=decodeURI(data['response'][0].s_text);

              //             $actionBtn = `<div class="row">
              //                             <div class="col-sm-2">
              //                                 <img src="${data['response'][0].image }" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
              //                             </div>
              //                             <div class="col-sm-10">
              //                                 <a class="nottes">
              //                                 ${ txt!="null"? decodeHtml(txt):'' }
              //                                 </a>
              //                             </div>
              //                         </div>`
              //         }else{
              //             var txt=decodeURI(data['trans'].s_note);
              //             $actionBtn = `<div class="row">
              //                             <div class="col-sm-2">
              //                                 <img src="${data['trans'].image }" class="avatar avatar-online" style="height:30px;margin-left: 15px;">
              //                             </div>
              //                             <div class="col-sm-10">
              //                                 <a class="nottes">
              //                                 ${ txt!="null"? txt.replace(/(<([^>]+)>)/gi, " "):'' }
              //                                 </a>
              //                             </div>
              //                         </div>`
              //                         }
              //             return $actionBtn;
              //     },


              // },

            ],
            createdRow: function (row, data, index) {
              //
              // if the second column cell is blank apply special formatting
              //
              if (data['trans'].is_seen == 0) {
                $(row).addClass('notseen');
              }
            },
          });

          sentTaskTable.on('init.dt', function () {
            $(".odd").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".even").each(function () {
              $(this).children().first().next().next().next().next().next().children().first().children().first().next().html($(this).children().first().next().next().next().next().next().children().first().children().first().next().text());
            });
            $(".nottes").each(function () {
              $(this).html($(this).text());
            });
          })
        });
        $(".list1").on("click", function () {
          if (window.matchMedia('(max-width: 767px)').matches) {
            $(".setWidth").each(function () {
              $(this).css({
                'width': '50%',
                'padding-left': '!important'
              });
            });
          } else {
            //...
          }
        });
        $(".list2").on("click", function () {
          if (window.matchMedia('(max-width: 767px)').matches) {
            $(".setWidth").each(function () {
              $(this).css({
                'width': '50%',
                'padding-left': '!important'
              });
            });
          } else {
            //...
          }
        });
        $(".list3").on("click", function () {
          if (window.matchMedia('(max-width: 767px)').matches) {
            $(".setWidth").each(function () {
              $(this).css({
                'width': '50%',
                'padding-left': '!important'
              });
            });
          } else {
            //...
          }
        });
        $(".list4").on("click", function () {
          if (window.matchMedia('(max-width: 767px)').matches) {
            $(".setWidth").each(function () {
              $(this).css({
                'width': '50%',
                'padding-left': '!important'
              });
            });
          } else {
            //...
          }
        });
        @endcanany
    </script>
@endcanany