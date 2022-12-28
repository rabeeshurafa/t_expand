@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection
@section('content')
    <div class="content-body">
        <section id="hidden-label-form-layouts">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <img src="{{ asset('assets/images/ico/report32.png') }}"/>
                                {{ 'تقرير طلبات البورتال' }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <form id="formDataaa" onsubmit="return false">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 pr-0 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group w-s-87">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'اسم المستفيد' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="customerName"
                                                           class="form-control cust ui-autocomplete-input"
                                                           placeholder="ابدأ بالكتابة لعرض محاور البحث"
                                                           name="customerName"
                                                           autocomplete="off" oninput="$('#customerid').val(0)">
                                                    <input type="hidden" id="customerid" name="customerid" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'حالة المهمة.' }}
                                                        </span>
                                                    </div>
                                                    <select id="TaskState" class="form-control" name="TaskState">
                                                        <option value="0">{{ 'الكل' }}</option>
                                                        <option value="1">{{ 'تم تحويلها' }}</option>
                                                        <option value="2">{{ 'قيد الانتظار' }}</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ ' من تاريخ.' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="from" maxlength="10" data-mask="00/00/0000"
                                                           name="from" class="form-control singledate "
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1"
                                                           aria-invalid="false"
                                                           value="<?php echo date('d/m/Y', strtotime(date('Y-m-d') . " -30 days"))?>"
                                                           autocomplete="off" onblur="calcDuration()">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'حتى تاريخ.' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="to" maxlength="10" data-mask="00/00/0000"
                                                           name="to" class="form-control singledate "
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1"
                                                           aria-invalid="false" value="<?php echo date('d/m/Y')?>"
                                                           autocomplete="off" onblur="calcDuration()">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-12">
                                            <div class="form-group res">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 pr-0 pr-s-12" style="text-align: center;">
                                            <div class="form-group">
                                                <button type="button" onclick="search()" class="btn btn-primary addBtn"
                                                        id="save">
                                                    {{ 'بحث' }}
                                                    <i class="ft-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <style>
        .detailsTB th {
            color: #ffffff;
        }

        .detailsTB th,
        .detailsTB td {
            text-align: right !important;

        }

        .recList > tr > td {
            font-size: 12px;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding-bottom: 5px !important;
        }

        .dataTables_filter {
            margin-top: -15px;
        }

        .even {
            background-color: #D7EDF9 !important;
        }

        .dt-buttons {
            /*margin-bottom: 20px;*/
            text-align: left;

        }

        .recList > tr > td {
            font-size: 12px;
        }

        table.dataTable tbody th, table.dataTable tbody td {
            padding-bottom: 5px !important;
        }

        .dataTables_filter {
            margin-top: -15px;
        }

        .even {
            background-color: #D7EDF9 !important;
        }

        .dt-buttons {
            text-align: left;
            display: inline;
            float: left;
            position: relative;
            bottom: 10px;
            margin-right: 10px;
        }

    </style>

    {{-- <input type="hidden" id="type" name="type" value="{{ $type }}"> --}}
    <div class="content-body resultTblaa">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header" style="direction: rtl;">
                        <h4 class="card-title"><img src="{{ asset('assets/images/ico/report32.png') }}"/>
                            {{ trans('archive.search_result') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row" id="resultTblaa">
                                <div class="col-xl-12 col-lg-12">
                                    <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right"
                                           class="detailsTB table wtbl">
                                        <thead>

                                        <tr style="text-align:center !important;background: #00A3E8;">
                                            <th width="20px">
                                                #
                                            </th>
                                            <th class="col1" style="width:170px !important">
                                                {{ 'المستفيد' }}
                                            </th>
                                            <th class="col2" style="width:120px !important">
                                                {{ 'نوع الطلب' }}
                                            </th>
                                            <th class="col2" style="width:120px !important">
                                                {{ 'تاريخ الطلب' }}
                                            </th>
                                            <th class="col3" style="width:50px !important">
                                                {{ 'حالة الطلب' }}
                                            </th>
                                            <th class="col4" style="width:150px !important">
                                                {{ 'الموظف المسؤول' }}
                                            </th>
                                            <th class="col5" style="width:180px !important">
                                                {{ 'تحويل الطلب' }}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="recListaa">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
      function emptyId() {
        if ($('#customerName').val().length < 1)
          $('#customerid').val('0');
      }

      calcDuration();

      $(function () {
        var table = $('.wtbl').DataTable({
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
          }
        });
      });

      $(document).ready(function () {
        $(".cust").autocomplete({
          source: 'subscribe_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#customerid").val(ui.item.id)
          }
        });
      });

      function calcDuration(str) {
        twoDatesArr = new Array();
        twoDatesArr[0] = $('#from').val();
        twoDatesArr[1] = $('#to').val();


        d1Arr = twoDatesArr[0].split('/')
        d2Arr = twoDatesArr[1].split('/')
        d1Date = new Date(d1Arr[1] + '/' + d1Arr[0] + '/' + d1Arr[2])
        d2Date = new Date(d2Arr[1] + '/' + d2Arr[0] + '/' + d2Arr[2])
        if (d1Date > d2Date) {
          alert('تاريخ النهاية اقل من البداية')
          //$('#from').val()=$('#to').val();
          return;
        }
        var diff = Math.abs(d2Date - d1Date);
        diffinyear = diff / (24 * 60 * 60 * 1000 * 30 * 12);
        diffinmonth = diff / (24 * 60 * 60 * 1000 * 30);
        diffinday = diff / (24 * 60 * 60 * 1000);
        month1 = Math.floor(diffinmonth) - (Math.floor(diffinyear) * 12)
        day = Math.floor(diffinday) - (Math.floor(diffinmonth) * 30)
        txt = '';
        txt1 = '';
        strr = '';
        if (Math.floor(diffinyear) > 0)
          txt = Math.floor(diffinyear) + ' سنة'

        if (Math.floor(month1) > 0)
          txt1 = Math.floor(month1) + ' شهر, '
        if (txt.length > 0) {
          strr = txt
          if (txt1.length > 0)
            strr += ', ' + txt1
          else
            strr += ', 0 شهر, '
        } else {
          if (txt1.length > 0)
            strr += txt1

        }
        $(".res").text(strr + Math.floor(day) + 'يوم');
        //console.log(d2Date-d1Date);
        // console.log(diffinyear,diffinmonth,diffinday);
      }

      function search() {
        $('#product')?.removeClass('error')
        if (+$('#product_id')?.val() === 0) {
          $('#product')?.addClass('error')
          return false;
        }
        $('.loader').removeClass('hide');
        if ($.fn.DataTable.isDataTable('.wtbl')) {
          $(".wtbl").dataTable().fnDestroy();
          $('#recListaa').empty();
        }

        let customerid = $("#customerid").val();
        let taskState = $("#TaskState").val();
        let from = $("#from").val();
        let to = $("#to").val();
        table = $('.wtbl').DataTable({
          processing: true,
          serverSide: true,
          info: true,

          ajax: {
            url: '{{ route('getPortalReport') }}',
            data: function (d) {
              d.customerid = customerid;
              d.taskState = taskState;
              d.from = from;
              d.to = to;
            }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'customer_name'},
            {
              data: null,
              render: function (data, row, type) {
                if (+data?.forwerd_by !== 0) {
                  link = `{{asset(app()->getLocale())}}/admin/viewTicket/${data.app_id}/${data.app_no}`;
                  $actionbtn = `<a target="_blank" href="${link}">
                                ${data?.task_type?.name ? data?.task_type?.name : data?.config?.ticket_name}
                              </a>`;
                  return $actionbtn;
                }
                return data?.config?.ticket_name ?? ''
              },
              searchable: false,
            },
            {
              data: null,
              render: function (data, row, type) {
                date = new Date(data.created_at);
                $date = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                $time = `${date.getHours()}:${date.getMinutes()}`;
                $actionbtn = '<span class="hideMob" >' + $date
                  + '<img src="{{ asset('assets/images/ico/clock.png') }}" style="margin-right: 29px;margin-left: 8px;" width="32" height="32">'
                  + $time + '</span>'
                  + '</a>';
                return $actionbtn;
              },
              name: 'created_at',
            },
            {
              data: null,
              render: function (data, row, type) {
                if (+data?.forwerd_by === 0) {
                  return 'قيد الانتظار'
                }
                return 'محول'
              },
              searchable: false,
            },
            {data: 'admin_name', name: 'admins.nick_name'},
            {
              data: null,
              render: function (data, row, type) {
                if (+data?.forwerd_by === 0) {
                  link = `{{asset(app()->getLocale())}}/admin/viewTicketPortal/${data.id}`;
                  $actionbtn = `<a target="_blank" href="${link}">
                                <img src="https://tf.palexpand.ps/assets/images/arrow.png" style="margin-right: 29px;margin-left: 8px;" width="32" height="32">
                              </a>`;
                  return $actionbtn;
                } else {
                  return '';
                }
              },
              name: 'created_at',
            },
          ],
          dom: 'Bflrtip',
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
          ],
          buttons: [
            {
              extend: 'excel',
              tag: 'img',
              title: '',
              attr: {
                title: 'excel',
                src: '{{asset('assets/images/ico/excel.png')}}',
                style: 'cursor:pointer;display:inline;height: 40px; padding-top: 4px;',
              },

            },
            {
              extend: 'print',
              tag: 'img',
              title: '',
              attr: {
                title: 'print',
                src: '{{asset('assets/images/ico/Printer.png')}} ',
                style: 'cursor:pointer;height: 32px;display:inline',
                class: "fa fa-print"
              },
              customize: function (win) {


                $(win.document.body).find('table').find('tbody')
                  .css('font-size', '20pt');
              }
            },
          ],
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
          }
        });
        table.on('init.dt', function () {
          $('.loader').addClass('hide');
        })
      }
    </script>
@endsection
