@extends('layouts.admin')
@section('search')
    <!--<li class="dropdown dropdown-language nav-item hideMob">
            <input id="searchContent" name="searchContent" class="form-control SubPagea round home_search" placeholder="بحث" style="text-align: center;width: 350px; margin-top: 15px !important;">
          </li>-->
@endsection
@section('content')
    <style>
        @media (max-width: 802px) {
            .hidemob {
                display: none !important;
            }

            .showmob {
                display: inline-block !important;
            }

            .dataTables_length {
                float: left !important;
                margin-left: 15px;
            }

            .dataTables_filter > label {
                float: right !important;
                margin-top: 0 !important;
            }

            .noP {
                padding-right: 5px !important;
                color: rgb(0, 115, 170) !important;
            }
        }

        .waterMenu,.elecMenue {
            /*position: inherit !important;*/
            /*max-height : 100px;*/
            transform: translate3d(5px, -216px, 0px) !important;
        }

        .task-title {
            display: block;
        }

        @media (max-width: 767.98px) {
            .dropdown-menu.menumob.elecmenu.show {
                /*transform: translate3d(-105px, -360px, 0px) !important;*/
            }

            .top-0 {
                top: 0 !important;
            }

            .task-title {
                /*display: inline;*/
            }

            .water-right {
                right: 5px !important;
            }

            .water-top {
                top: 0px !important;
            }

            .elec-left {
                left: 109px !important;
            }

            .elec-top {
                top: 65px !important;
            }
        }
    </style>
    <div class="app-content container center-layout mt-2" style="overflow: auto;margin-top: 0px !important;">
        <div class="content-wrapper " style=" padding-top: 0px;">
            <div class="row ">

                <div class="col-md-4">
                </div>

                <div class="col-md-4" style="text-align: center;padding-top: 10px;">
                    <img src="https://db.expand.ps/images/intro.png">
                </div>

                <div class="col-md-4">
                    <div class="d-flex align-items-end flex-column">
                        {{-- <div class="mb-1" style="font-weight: bold;">المساحة الاجمالية المستخدمة</div> --}}
                        {{-- <div>
                        <div class="mb-1" style="display: inline; font-weight: bold;">المساحة المستخدمة : </div>
                        <div class="mb-1 d-inline attachmentSize" style="direction: ltr; font-weight: bold;"></div>
                    </div>
                    <div class="font-small">
                        <div class="mb-1" style="display: inline; font-weight: bold;">المساحة المسموحة : </div>
                        <div class="mb-1 d-inline max_upload" style="direction: ltr; font-weight: bold;"></div>
                    </div> --}}
                        <div class="hidemob">
                            <div class="mb-1 d-inline used"
                                 style="font-weight: bold; direction: ltr; display: inline; unicode-bidi: embed;"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row hidemob">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    &nbsp;<input id="searchContent" name="searchContent"
                                 class="form-control round ac1 hideMob home_search ui-autocomplete-input"
                                 placeholder="بحث" style="text-align: center;" autocomplete="off">
                </div>
                <div class="col-md-4">
                </div>
            </div>

            <div class="row hidemob">
                <div class="col-sm-12">
                    &nbsp;
                </div>
            </div>

        </div>
    </div>

    <div class="row" style="text-align: center;padding-top: 0px;">

        <div class="col-md-12">

            <form id="menuFavorit">
                <div class="row " style="display: flex;justify-content: center;">
                    @canany(['taskicon', 'taskiconmob'])
                        <div class="col-md-1
    					@can('taskicon')
					    @else
					    hidedesc
					    @endcan
					    @can('taskiconmob')
					    @else
					    hidemob
					    @endcan
    					" style="text-align: center; padding: 5px;">
                            <li class="dropdown nav-item " data-menu="dropdown" style="list-style: none;" title="مهامى">
                                <a class="dropdown-toggle nav-link" onclick="showTasks(); ">
                					<span style="display: inline;">
                					    <img src="{{asset('assets/images/ico/done.png')}}"
                                             style="padding:5px; ;height: 64px;">
                					    <div style="color: #000000;">مهامى </div>
            					    </span>
                                </a>
                            </li>
                        </div>
                    @endcanany
                    @canany(['taskiconmob'])
                        @include('dashboard.indexComponent.myTaskTable',['class'=>'TaskMobile'])
                    @endcanany
                    @include('dashboard.indexComponent.waterReadIcon')
                    <input type="hidden" name="showTask" id="showTask" value="0">
                    @include('dashboard.indexComponent.waterTasks')
                    @include('dashboard.indexComponent.elecTasks')
                    @include('dashboard.indexComponent.engTasks')
                    @include('dashboard.indexComponent.complaintTasks')
                    @include('dashboard.indexComponent.certTasks')
                    @include('dashboard.indexComponent.centralArchive')
                    @include('dashboard.indexComponent.internalTasks')
                </div>
                <div style="position:fixed; top:15%;right:0px;padding:20px;display:none;">
                    <div>
    				        <span style="">
        					    <img src="https://db.expand.ps/images/complains.png"
                                     style="padding:5px; ;height: 64px;">
        					    <div style="color: #000000;">الشكاوى</div>
        					</span>
                    </div>
                    <div>
    				        <span style="display: inline;">
        					    <img src="https://db.expand.ps/images/Eng64.png" style="padding:5px; ;height: 64px;">
        					    <div style="color: #000000;">التنظيم والبناء</div>
    					    </span>
                    </div>
                    <div>
    				        <span style="display: inline;">
        					    <img src="https://db.expand.ps/images/electric64.png"
                                     style="padding:5px; ;height: 64px;">
        					    <div style="color: #000000;">طلبات الكهرباء</div>
    					    </span>
                    </div>
                    <div>
    				        <span style="display: inline;">
        					    <img src="https://db.expand.ps/images/water-faucet64.png"
                                     style="padding:5px; ;height: 65px;">
        					    <div style="color: #000000;">طلبات المياه</div>
    					    </span>
                    </div>
                    <div>
    				        <span style="display: inline;">
        					    <img src="https://db.expand.ps/images/certificate64.png"
                                     style="padding:5px; ;height: 64px;">
        					    <div style="color: #000000;">الشهادات </div>
    					    </span>
                    </div>
                </div>
            </form>

        </div>

    </div>
    @canany(['taskicon','onlyTaskTable'])
        @include('dashboard.indexComponent.myTaskTable',['class'=>'TaskComputer'])
    @endcanany
    <script>

      var myTaskTable;
      var watingTaskTable;
      var tagedTaskTable;
      var sentTaskTable;

      @canany(['taskicon', 'taskiconmob', 'onlyTaskTable'])
      // $('.TaskModel').removeClass('hide');
      $('.TaskModel').removeClass('hidemob');
      @endcanany
      $(function () {
        $.ajax({
          type: 'get', // the method (could be GET btw)
          url: '{{route('dashboard_info')}}',
          success: function (response) {
            $(".attachmentSize").html(`${response.attachmentSize} MB`)
            $(".max_upload").html(`${response.max_upload} GB`)
            $(".used").html(`${response.used}% of ${response.max_upload}GB used`)
          },
        });
      })

      function showTasks() {

        if ($('#showTask').val() == 0) {
          // $('.TaskModel').removeClass('hide');
          if (screen.width > 767.98) {
            $(".TaskMobile").addClass("hide");
            $(".TaskComputer").removeClass("hide");
          } else {
            $(".TaskMobile").removeClass("hide");
            $(".TaskComputer").addClass("hide");
          }
          $('#showTask').val(1);
        } else {
          // $('.TaskModel').addClass('hide');
          if (screen.width > 767.98) {
            $(".TaskMobile").addClass("hide");
            $(".TaskComputer").addClass("hide");
          } else {
            $(".TaskMobile").addClass("hide");
            $(".TaskComputer").addClass("hide");
          }
          $('#showTask').val(0);
        }
        if (window.matchMedia('(max-width: 767px)').matches) {
          $('.list1Title').html(' مهامي');

          $('.list2Title').html(' مؤجلة');
          $('.list3Title').html(' للاطلاع');
          $('.list4Title').html(' محولة');
          $(".list1").css("width", "min-content")
          $(".list2").css("width", "min-content")
          $(".list3").css("width", "min-content")
          $(".list4").css("width", "min-content")
          let a = $('.dataTables_length>label')
          for (i = 0; i < a.length; i++) {
            b = a[i].childNodes;
            if (b.length == 3) {
              b[2].remove();
              b[0].remove();
            }
          }
        }

      }

      function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
      }

      @canany(['taskicon','onlyTaskTable'])
      $(function () {
        myTaskTable = $('.myTaskTable001').DataTable({
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
        watingTaskTable = $('.wtbl2001').DataTable({
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
        tagedTaskTable = $('.wtbl3001').DataTable({
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
        sentTaskTable = $('.wtbl4001').DataTable({
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
      $(".list1001").on("click", function () {
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
      $(".list2001").on("click", function () {
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
      $(".list3001").on("click", function () {
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
      $(".list001").on("click", function () {
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
      $(document).ready(function () {
        if (screen.width > 767.98) {
          $(".homePage").css("min-height", (window.innerHeight - 140));
        }
      });
      $(window).resize(function () {
        if (screen.width > 767.98) {
          $(".homePage").css("min-height", (window.innerHeight - 140));
        }
      });
      // $(function() {
      //         var table = $('.wtbl3').DataTable({
      //             "language": {
      //                 "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
      //                 "sLoadingRecords": "جارٍ التحميل...",
      //                 "sProcessing": "جارٍ التحميل...",
      //                 "sLengthMenu": "أظهر _MENU_ مدخلات",
      //                 "sZeroRecords": "لم يعثر على أية سجلات",
      //                 "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
      //                 "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
      //                 "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
      //                 "sInfoPostFix": "",
      //                 "sSearch": "ابحث:",
      //                 "sUrl": "",
      //                 "oPaginate": {
      //                     "sFirst": "الأول",
      //                     "sPrevious": "السابق",
      //                     "sNext": "التالي",
      //                     "sLast": "الأخير"
      //                 },
      //                 "oAria": {
      //                     "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
      //                     "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
      //                 }
      //             }
      //         });
      //     });
      // $(function() {
      //         var table = $('.wtbl4').DataTable({
      //             "language": {
      //                 "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
      //                 "sLoadingRecords": "جارٍ التحميل...",
      //                 "sProcessing": "جارٍ التحميل...",
      //                 "sLengthMenu": "أظهر _MENU_ مدخلات",
      //                 "sZeroRecords": "لم يعثر على أية سجلات",
      //                 "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
      //                 "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
      //                 "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
      //                 "sInfoPostFix": "",
      //                 "sSearch": "ابحث:",
      //                 "sUrl": "",
      //                 "oPaginate": {
      //                     "sFirst": "الأول",
      //                     "sPrevious": "السابق",
      //                     "sNext": "التالي",
      //                     "sLast": "الأخير"
      //                 },
      //                 "oAria": {
      //                     "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
      //                     "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
      //                 }
      //             }
      //         });
      //     });
      $(document).ready(function () {
        if (screen.width > 767.98) {
          $(".TaskMobile").addClass("hide");
          $(".TaskComputer").addClass("hide");
        } else {
          $(".TaskMobile").addClass("hide");
          $(".TaskComputer").addClass("hide");
        }
      });
      $(window).resize(function () {
        if (screen.width > 767.98) {
          $(".TaskMobile").addClass("hide");
          $(".TaskComputer").addClass("hide");
        } else {
          $(".TaskMobile").addClass("hide");
          $(".TaskComputer").addClass("hide");
        }
      });
    </script>

@stop
