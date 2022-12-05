@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection

@section('content')
    <style>
        .detailsTB th {
            color: #ffffff;
        }

        .detailsTB th, .detailsTB td {
            text-align: right !important;

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
    <div class="content-body">
        <section id="hidden-label-form-layouts">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                {{'تقرير عمل بتاريخ'}}
                            </h4>
                        </div>
                        <div class="form-body">
                            <div class="row" style="padding-right: 20px">
                                <div class="col-lg-2 col-md-12 pr-s-12 pr-0">
                                    <div class="form-group">
                                        <div class="input-group w-s-87">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{"من تاريخ"}}
                                                </span>
                                            </div>
                                            <input type="text" id="from" maxlength="10" data-mask="00/00/0000"
                                                   name="from" class="form-control singledate " placeholder="dd/mm/yyyy"
                                                   aria-describedby="basic-addon1" aria-invalid="false"
                                                   value="<?php echo date('d/m/Y')?>" autocomplete="off"
                                                   onblur="calcDuration()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 pr-s-12 pr-0">
                                    <div class="form-group">
                                        <div class="input-group w-s-87">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{"الى تاريخ"}}
                                                </span>
                                            </div>
                                            <input type="text" id="to" maxlength="10" data-mask="00/00/0000" name="to"
                                                   class="form-control singledate " placeholder="dd/mm/yyyy"
                                                   aria-describedby="basic-addon1" aria-invalid="false"
                                                   value="<?php echo date('d/m/Y')?>" autocomplete="off"
                                                   onblur="calcDuration()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 pr-s-12 pr-0">
                                    <div class="form-group">
                                        <div class="input-group w-s-87">
                                            <button type="submit" class="btn btn-primary" name="rep"
                                                    onclick="search();">
                                                {{"بحث"}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <div class="form-group res">
                                    </div>
                                </div>
                            </div>
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

        .detailsTB th, .detailsTB td {
            text-align: right !important;

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
            /*margin-bottom: 20px;*/
            text-align: left;

        }

    </style>

    <input type="hidden" id="type" name="type" value="{{ $type }}">
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
                                <div class="col-xl-12 col-lg-12 details">
                                    <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right"
                                           class="detailsTB table wtbl">
                                        <thead>
                                        <tr style="text-align:center !important;background: #00A3E8;">
                                            <th width="10px">
                                                #
                                            </th>
                                            <th class="col1" width="150px">
                                                {{ 'المستفيد' }}
                                            </th>
                                            <th class="col2" width="150px">
                                                {{ 'نوع الطلب' }}
                                            </th>
                                            <th class="col3" width="150px">
                                                {{ 'نوع الحركة' }}
                                            </th>
                                            <th class="col4" width="200px">
                                                {{ 'الوقت والتاريخ' }}
                                            </th>
                                            <th class="col5" width="200px">
                                                {{ 'الموظف' }}
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
        search();
      });
      //
      calcDuration();

      /*


      $(function() {
          if($('#arcType').find(":selected").val()=="2")
          var table = $('.totaltbl').DataTable({
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
      */
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

        $(".loader").removeClass('hide');

        if ($.fn.DataTable.isDataTable('.wtbl')) {
          $(".wtbl").dataTable().fnDestroy();
          $('#recListaa').empty();
        }
        let from = $("#from").val();
        let to = $("#to").val();

        $.ajax({
          type: 'get', // the method (could be GET btw)
          url: "searchDailyTask",

          data: {
            from: from,
            to: to,
            taskState: 1,
          },
          success: function (response) {
            $(".loader").addClass('hide');
            let row = "";
            for (let i = 0; i < response?.length; i++) {
              let link = ''
              let customer_name = ''
              let taskname = ''
              if (response[i]?.ticket) {
                link = `{{asset(app()->getLocale())}}/admin/viewTicket/${response[i]?.ticket_id}/${response[i]?.ticket?.ticket_config?.ticket_no}`;
                customer_name = response[i]?.ticket?.customer_name;
                taskname = `${response[i]?.ticket?.ticket_config?.ticket_name} (${response[i]?.ticket?.app_no})`;
              } else {
                customer_name = response[i]?.citizen_name
                taskname = `شهادات ومراسلات`
                if (+response[i]?.e_type === 1) {
                  link = `{{asset(app()->getLocale())}}/admin/cert?id=${response[i].pk_i_id}`;
                } else if (+response[i]?.e_type === 2) {
                  link = `{{asset(app()->getLocale())}}/admin/sendOut?id=${response[i].pk_i_id}`;
                } else if (+response[i]?.e_type === 3) {
                  link = `{{asset(app()->getLocale())}}/admin/assurance?id=${response[i].pk_i_id}`;
                } else if (+response[i]?.e_type === 4) {
                  link = `{{asset(app()->getLocale())}}/admin/warningCert?id=${response[i].pk_i_id}`;
                } else if (+response[i]?.e_type === 5) {
                  link = `{{asset(app()->getLocale())}}/admin/modelCert?id=${response[i].pk_i_id}`;
                } else if (+response[i]?.e_type === 6) {
                  link = `{{asset(app()->getLocale())}}/admin/generalCert?id=${response[i].pk_i_id}`;
                }
              }
              const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone
              let dateTime = new Date(response[i].created_at).toLocaleString("en-US", { timeZone })
              // console.log(dateTime);
              dateTime = dateTime.split(',')
              const splinted = dateTime[0].split('/')
              const date = `${splinted[1]}/${splinted[0]}/${splinted[2]}`
              const time = dateTime[1]

              const rowDateTime = response[i].created_at.split('T');
              const rowDate = rowDateTime[0].split('-');
              // const date = rowDate[0] + '/' + rowDate[1] + '/' + rowDate[2];
              // const time = rowDateTime[1].substring(0, 5);
              const empName = response[i]?.admin?.nick_name;
              row += `<tr style="text-align:center">
                        <td width="50px">
                        ${i + 1}
                        </td>
                        <td >
                        ${customer_name}
                        </td>
                        <td >
                        <a target="_blank" href="${link}">
                        <span class="hideMob" >${taskname}</span>
                        </a>
                        </td>
                        <td >
                        ${response[i].transaction_type}
                        </td>
                        <td >
                        ${date}  &nbsp; ${time}
                        </td>
                        <td >
                        ${empName}
                        </td>
                        </tr>`
            }

            $('#recListaa').append(row);
            $('.wtbl').DataTable({
              dom: 'Bfltip',
              buttons: [{
                extend: 'excel',
                tag: 'img',
                title: '',
                attr: {
                  title: 'excel',
                  src: '{{ asset('assets/images/ico/excel.png') }}',
                  style: 'cursor:pointer;height: 32px;',
                },

              },
                {
                  extend: 'print',
                  tag: 'img',
                  title: '',
                  attr: {
                    title: 'print',
                    src: '{{ asset('assets/images/ico/Printer.png') }} ',
                    style: 'cursor:pointer;height: 32px;',
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
          },
          error: function (response) {
            $(".loader").addClass('hide');

            Swal.fire({
              position: 'top-center',
              icon: 'error',
              title: 'خطاء فى عملية البحث',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });

      }
    </script>
@endsection
