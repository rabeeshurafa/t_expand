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

        .detailsTB th,
        .detailsTB td {
            text-align: right !important;

        }

        .recList>tr>td {
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
                                {{ 'تقرير الحركات على النظام' }}
                            </h4>
                        </div>
                        <div class="form-body">
                            <div class="row" style="padding-right: 20px">
                                <div class="col-lg-2 col-md-12 pr-s-12 pr-0">
                                    <div class="form-group">
                                        <div class="input-group w-s-87">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{ 'من تاريخ' }}
                                                </span>
                                            </div>
                                            <input type="text" id="from" maxlength="10" data-mask="00/00/0000"
                                                name="from" class="form-control singledate " placeholder="dd/mm/yyyy"
                                                aria-describedby="basic-addon1" aria-invalid="false"
                                                value="<?php echo date('d/m/Y'); ?>" autocomplete="off" onblur="calcDuration()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 pr-s-12 pr-0">
                                    <div class="form-group">
                                        <div class="input-group w-s-87">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{ 'الى تاريخ' }}
                                                </span>
                                            </div>
                                            <input type="text" id="to" maxlength="10" data-mask="00/00/0000"
                                                name="to" class="form-control singledate " placeholder="dd/mm/yyyy"
                                                aria-describedby="basic-addon1" aria-invalid="false"
                                                value="<?php echo date('d/m/Y'); ?>" autocomplete="off" onblur="calcDuration()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-12 pr-s-12 pr-0">
                                    <div class="form-group">
                                        <div class="input-group w-s-87">
                                            <button type="submit" class="btn btn-primary" name="rep"
                                                onclick="search();">
                                                {{ 'بحث' }}
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

        .detailsTB th,
        .detailsTB td {
            text-align: right !important;

        }

        .recList>tr>td {
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
            margin-bottom: 20px;
            text-align: left;

        }
    </style>

    <input type="hidden" id="type" name="type" value="{{ $type }}">
    <div class="content-body resultTblaa">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header" style="direction: rtl;">
                        <h4 class="card-title"><img src="{{ asset('assets/images/ico/report32.png') }}" />
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
                                                <th width="10px">
                                                    #
                                                </th>
                                                <th width="120px">
                                                    {{ 'الموظف' }}
                                                </th>
                                                <th width="120px">
                                                    {{ 'الوقت والتاريخ' }}
                                                </th>
                                                <th width="300px">
                                                    {{ 'الحركة' }}
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
        calcDuration();
        // function ShowTypes(){
        //         $(".lblNo").text('رقم الأرشيف')
        //         $(".lblName").text('مرتبط بـ')
        //         $(".divType").hide()
        //         $(".divBuildType").hide()
        //         $(".col1").text('العنوان')
        //         $(".col2").text('النوع')
        //         $(".col3").text('الرقم')
        //         $(".col4").text('مرتبط بــ')
        //         $(".col5").text('تاريخ الإرسال')
        //     if($('#OrgType').find(":selected").val()=="munArchive")
        //         $(".ShowTypes").show()

        //     else if($('#OrgType').find(":selected").val()=="licArchive"||($('#OrgType').find(":selected").val()=="licFileArchive")){
        //         $(".ShowTypes").hide()
        //         $(".lblNo").text('رقم الرخصة')
        //         $(".lblName").text('اختر المشترك')
        //         $(".divType").show()
        //         $(".divBuildType").show()
        //         $(".col1").text('نوع الترخيص')
        //         $(".col2").text('نوع البناء')
        //         $(".col3").text('رقم الرخصة')
        //         $(".col4").text('اسم صاحب الرخصة')
        //         $(".col5").text('تاريخ الإدخال')
        //     }
        //     else
        //         $(".ShowTypes").hide()

        // }

        $(function() {
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

        // function getAction(elem) {
        //     return 'لقد قام ب'
        // }
        const getDescription = (description) => {
            if (description === 'updated') return 'التحديث على معلومات'
            else if (description === 'created') return 'اضافة'
            else if (description === 'deleted') return 'حذف'
            else if (description === 'restore') return 'استعادة'
            else if (description === 'seen') return 'فتح صفحة'
            else if (description === 'email-archive') return 'ارسال ايميل في'
            else if (description === 'seen-print') return 'فتح صفحة طباعة'
            else if (description === 'log-report') return 'اصدار تقرير الحركات'
            else if (description === 'sms-report') return 'اصدار تقرير الرسائل'
            else if (description === 'deleted-definition-report') return 'اصدار تقرير حذف التعريفات'
            else if (description === 'daily-report') return 'اصدار تقرير الارشيف اليومي'
            else if (description === 'deleted-archive-report') return 'اصدار تقرير حذف الارشيف'
            else if (description === 'central-archive-report') return 'اصدار تقرير الارشيف المركزي'
            else if (description === 'daily-work-report') return 'اصدار تقرير المهام اليومي'
            else if (description === 'system-ticket-report') return 'اصدار تقرير الطلبات على النظام'
            else if (description === 'details-ticket-report') return 'اصدار تقرير الطلبات التفصيلي'
            else if (description === 'vacations-report') return 'اصدار تقرير الاجازات والمغادرات'
            else if (description === 'subscriber-report') return 'اصدار تقرير المشتركين'
            else if (description === 'tasks-archive-report') return 'اصدار تقرير ارشيف الطلبات'
            else if (description === 'storage-report') return 'اصدار تقرير المساحة التخزينية'
            else if (description === 'open-archive-info') return 'فتح'
            else return 'حركة'
        }
        const getName = (row) => {
            const name = row?.subject_type
            if (name === 'App\\Models\\Admin') return 'موظف'
            else if (name === 'App\\Models\\User') return 'مواطن'
            else if (name === 'App\\Models\\Department' || name === 'App\\Models\\Definition\\Department') return 'قسم'
            else if (name === 'App\\Models\\Archive' || name === 'App\\Models\\Archive\\Archive') return 'أرشيف'
            else if (name === 'App\\Models\\Project' || name === 'App\\Models\\Definition\\Project') return 'مشروع'
            else if (name === 'App\\Models\\Customer' || name === 'App\\Models\\Definition\\Customer') return 'زبون'
            else if (name === 'App\\Models\\Definition\\subscriber') return 'مواطن'
            else if (name === 'App\\Models\\Orgnization' || name === 'App\\Models\\Definition\\Orgnization') {
                if (row.subject?.org_type === 'suppliers') return 'مورد'
                if (row.subject?.org_type === 'orginzation') return 'مؤسسة'
                if (row.subject?.org_type === 'banks') return 'بنك'
                if (row.subject?.org_type === 'enginering' || row.subject?.org_type === 'space') return 'مكتب'
                return 'مؤسسات ومكاتب'
            } else if (name === 'App\\Models\\Equpment' || name === 'App\\Models\\Definition\\Equpment')
                return 'اجهزة ومعدات'
            else if (name === 'App\\Models\\Vehicle' || name === 'App\\Models\\Definition\\Vehicle') return 'مركبات'
            else if (name === 'App\\Models\\SpecialAsset' || name === 'App\\Models\\Definition\\SpecialAsset')
                return 'مباني وحدائق'
            else if (name === 'App\\Models\\Definition\\Setting') return 'بيانات المؤسسة'
            else if (name === 'App\\Models\\Archive\\ArchiveLicense') return 'أرشيف رخص البناء'
            else if (name === 'App\\Models\\Definition\\License') return 'رخصة بناء'
            else if (name === 'App\\Models\\Certificates\\Cert') return 'شهادة'
            else if (name === 'App\\Models\\Certificates\\CertExtention') return 'نموذج شهادة'
            else if (name === 'App\\Models\\Ticket\\AppTicket46') return 'متابعة'
            else if (name === 'App\\Models\\Ticket\\AppTicket1') return 'طلب اشتراك الكهرباء'
            else if (row.description === 'created' && name === 'App\\Models\\Archive\\AgendaDetail')
                return 'جلسة في اجتماع'
            else if (name === 'App\\Models\\Archive\\AgendaDetail') return 'جلسة'
            else if (name === 'App\\Models\\Archive\\AgendaExtention') return 'اجتماع'
            else return 'تعريف'
        }
        const getTypeAr = (type) => {
            if (type === 'outArchive' || type === 'out_archieve') {
                return 'أرشيف الصادر'
            } else if (type === 'inArchive' || type === 'in_archieve') {
                return 'أرشيف الوارد'
            } else if (type === 'citArchive' || type === 'cit_archieve') {
                return 'أرشيف المواطنين'
            } else if (type === 'customerArchive' || type === 'customer_archieve') {
                return 'أرشيف الزبائن'
            } else if (type === 'munArchive' || type === 'mun_archieve') {
                return 'أرشيف المؤسسة'
            } else if (type === 'financeArchive' || type === 'finance_archive') {
                return 'أرشيف المالية'
            } else if (type === 'projArchive' || type === 'proj_archieve') {
                return 'أرشيف المشاريع'
            } else if (type === 'assetsArchive' || type === 'assets_archieve') {
                return 'أرشيف الاصول'
            } else if (type === 'empArchive' || type === 'emp_archieve') {
                return 'أرشيف الموظفين'
            } else if (type === 'contractArchive' || type === 'dep_archieve') {
                return 'أرشيف الاتفاقيات والعقود'
            } else if (type === 'lawArchieve' || type === 'law_archieve') {
                return 'أرشيف القوانين والاجرائات'
            } else if (type === 'tradeArchive' || type === 'trade_archive') {
                return 'أرشيف المعاملات'
            } else if (type === 'certArchive') {
                return 'شهادات / مراسات خارجية'
            } else if (type === 'taskArchive') {
                return 'أرشيف الطلبات'
            } else if (type === 'WarningArchive') {
                return 'أرشيف الاخطارات'
            } else if (type === 'licArchive') {
                return 'أرشيف رخص البناء'
            } else if (type === 'agArchive' || type === 'jal_archive') {
                return 'أرشيف الجلسات'
            }
            return type
        }
        const getAction = row => {
            if (row.subject_type) {
                if (row.subject_type === 'App\\Models\\Archive' || row.subject_type ===
                    'App\\Models\\Archive\\Archive') {
                    return `قام ب ${getDescription(row.description)} ${getTypeAr(row?.subject?.type)} - ${row?.subject?.title} ${row?.subject?.name ? `- ${row?.subject?.name}` : ''}`
                } else if (row.subject_type === 'App\\Models\\Archive\\TradeArchive') {
                    return `قام ب ${getDescription(row.description)} أرشيف المعاملات ${row?.subject?.document_place} ${row?.subject?.name ? `- ${row?.subject?.name}` : ''}`
                } else if (row.subject_type === 'App\\Models\\Certificates\\Cert') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} - ${row?.subject?.citizen_name}`
                } else if (row.subject_type === 'App\\Models\\Certificates\\CertExtention') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} - ${row?.subject?.s_name_ar}`
                } else if (row.subject_type === 'App\\Models\\Definition\\Setting') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)}`
                } else if (row.subject_type === 'App\\Models\\Ticket\\AppTicket46') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} ${getTypeAr(row?.subject?.archive_type)} - ${row?.subject?.archive_title} ${row?.subject?.customer_name ? `- ${row?.subject?.customer_name}` : ''}`
                } else if (row.subject_type === 'App\\Models\\Ticket\\AppTicket1') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} ${row?.subject?.customer_name ? `- ${row?.subject?.customer_name}` : ''}`
                } else if (row.subject_type === 'App\\Models\\Archive\\AgendaDetail') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} - ${row?.subject?.agenda_number}`
                } else if (row.subject_type === 'App\\Models\\Archive\\AgendaExtention') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} - ${row?.subject?.name}`
                } else if (row.subject_type === 'App\\Models\\Definition\\License') {
                    return `قام ب ${getDescription(row.description)} ${getName(row)} - ${row?.subject?.licNo}`
                }
                return `قام ب ${getDescription(row.description)} ${getName(row)} - ${row?.subject?.name}`
            } else {
                return `قام ب ${getDescription(row.description)}`
            }
        }

        function search() {
            if ($.fn.DataTable.isDataTable('.wtbl')) {
                $(".wtbl").dataTable().fnDestroy();
                $('#recListaa').empty();
            }
            let from = $("#from").val();
            let to = $("#to").val();
            $(".loader").removeClass('hide');
            $.ajax({
                type: 'get', // the method (could be GET btw)
                url: "report_logs",
                data: {
                    from: from,
                    to: to,
                },
                success: function(response) {
                    $(".loader").addClass('hide');
                    var c = 1;
                    // console.log(response.data);
                    response.forEach(elem => {
                        $date = '';
                        // elem.created_at.substring(11,19)+' - '+
                        $date = elem.updated_at.substring(8, 10) + '/' + elem.updated_at.substring(7,
                            5) + '/' + elem.updated_at.substring(4, 0);

                        $row = "<tr>" +
                            "<td>" + c + "</td>" +
                            "<td>" + (elem.causer.nick_name ?? '') + "</td>" +

                            "<td>" + $date + "</td>" +
                            "<td>" + getAction(elem) + "</td>";
                        $row += "</tr>";
                        $('#recListaa').append($row)
                        c++;
                    });

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
                                customize: function(win) {


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
            });

        }

        function admin_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreAdmin",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function dept_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreDepartment",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function user_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreUser",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function equpment_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreEqupment",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function vehicle_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreVehicle",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function specialAsset_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreSpecialAsset",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function sparepart_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreSparepart",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function project_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreProject",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }

        function orgnization_recovery($id) {
            $(".loader").removeClass('hide');
            let id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "restoreOrgnization",

                data: {

                    id: id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');
                    search();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: 'تم استرجاع البيانات بنجاح',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    // $("#ajaxform")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                }

            });
            // return true;
        }
    </script>
@endsection
