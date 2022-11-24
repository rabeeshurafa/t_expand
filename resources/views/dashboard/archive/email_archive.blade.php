<script src="https://template.expand.ps/public1/ckeditor/ckeditor.js"></script>

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
<div class="modal fade text-left" id="EmailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">

    <div class="modal-dialog" role="document" style="width: 800px;">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel1">
                    رسالة جديدة
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>
            <!--background-color: #1E9FF2!important;-->
            <div class="modal-body" style="background: #f4f5fa">

                <form method="post" id="archiveEmailModal" enctype="multipart/form-data">
                    <div class="form-body">
                        @csrf
                        <div class="row white-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card ">
                                    <div class="card-content collapse show">
                                        <div class="card-body" style="padding-bottom: 0px;">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <div class="input-group" style="width:100%!important">
                                                        <div class="input-group-prepend" style="">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                style=" width: 100%;">
                                                                {{ 'الى ' }}
                                                            </span>
                                                        </div>
                                                        <input type="text" id="email"
                                                            class="form-control email_auto" name="email"
                                                            style="width: 30%;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group" style="width:100%!important">
                                                        <div class="input-group-prepend" style="">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                style=" width: 100%;">
                                                                {{ 'الموضوع ' }}
                                                            </span>
                                                        </div>
                                                        <input type="text" id="email-subject" class="form-control"
                                                            name="email-subject" style="width: 30%;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group w-s-87">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                style="width: 85px;">
                                                                نص الرسالة
                                                            </span>
                                                        </div>
                                                        <textarea id="cercontent" class="form-control" placeholder="" name="cercontent"></textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="archive_id" name="archive_id" />
                                                <div class="form-group">
                                                    <div class="formDataaaFilesArea">

                                                    </div>
                                                </div>
                                                <div class="form-actions" style="border-top:0px; padding-bottom:44px;">
                                                    <div class="text-right">
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="sendEmail()" id="saveBtn">
                                                            <i class="la la-check-square-o"></i>
                                                            ارسال
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
{{-- @section('script') --}}
<div class="modal fade text-left" id="emailDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">

    <div class="modal-dialog" role="document" style="width: 800px;">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel1">
                    الايميلات المرسلة
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>
            <!--background-color: #1E9FF2!important;-->
            <div class="modal-body" style="background: #f4f5fa">
                <div class="form-body">
                    <div class="row" id="resultTblaa">
                        <div class="col-xl-12 col-lg-12">
                            <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right"
                                class="detailsTB table wtbllog">
                                <thead>
                                    <tr style="text-align:center !important;background: #00A3E8;">
                                        <th width="30px">
                                            #
                                        </th>
                                        <th class="col2">
                                            {{ trans('admin.date_con') }}
                                        </th>
                                        <th class="col7">
                                            المرسل
                                        </th>
                                        <th class="col3">
                                            المستقبل
                                        </th>
                                        <th class="col4">
                                            نص الرسالة
                                        </th>
                                        <th class="col6">
                                            {{ trans('archive.copy_to') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="recListaa_log">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
    var cerIn = CKEDITOR.replace('cercontent', {
        // Define the toolbar groups as it is a more accessible solution.
        defaultLanguage: 'ar',
        font_defaultLabel: 'Arial',
        fontSize_defaultLabel: '16px',
        language: 'ar',
        height: 200,
        allowedContent: true,
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,

        toolbarGroups: [{
                name: 'editing',
                groups: ['find', 'selection', 'spellchecker', 'editing']
            },
            {
                name: 'document',
                groups: ['mode', 'document', 'doctools']
            },
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo']
            },
            {
                name: 'forms',
                groups: ['forms']
            },
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
            },
            {
                name: 'links',
                groups: ['links']
            },
            {
                name: 'insert',
                groups: ['insert']
            },
            '/',
            {
                name: 'styles',
                groups: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                groups: ['colors']
            },
            {
                name: 'tools',
                groups: ['tools']
            },
            {
                name: 'others',
                groups: ['others']
            },
            {
                name: 'about',
                groups: ['about']
            }
        ],

        //   removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
        removeButtons: 'Source,Save,Templates,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,CreateDiv,Language,Link,Unlink,Anchor,Image,Flash,Smiley,SpecialChar,PageBreak,Iframe,ShowBlocks,About,ExportPdf,NewPage,Preview,Print'

    });

    function send_email_archive(archive, typeModal = 'send', type = '') {
        console.log(type, typeModal);
        if (typeModal == 'send')
            EmailModal(archive)
        else
            emailDetails(archive, type)
    }

    function addLeadingZeros(num, totalLength) {
        return String(num).padStart(totalLength, '0')
    }
    const format = (date) => {
        return `${date.getHours()}:${date.getMinutes()} ${date.getFullYear()}-${addLeadingZeros(date.getMonth() + 1, 2)}-${date.getDate()}`
    }

    function emailDetails(archive, type) {
        if ($.fn.DataTable.isDataTable('.wtbllog')) {
            $(".wtbllog").dataTable().fnDestroy();
            $('#recListaa_log').empty();
        }
        $("#emailDetails").modal('show');
        $.ajax({
            type: 'get', // the method (could be GET btw)
            url: `{{ url('') }}/ar/admin/getLogsEmail/${archive}/${type}`,
            success: function(response) {
                $row = ''
                response.forEach(function(item, index) {
                    $row = `<tr>
                                <td> ${index+1} </td>
                                <td> ${format(new Date(item?.created_at))} </td>
                                <td> ${item?.user?.nick_name} </td>
                                <td> ${item?.data_email?.to} </td>
                                <td> ${item?.data_email?.message ??''} </td>
                                <td> ${item?.data_email?.copyToNames} </td>
                                `
                    $('#recListaa_log').append($row)
                })
                $('.wtbllog').DataTable({
                    dom: 'Bfltip',
                    buttons: [{
                            extend: 'excel',
                            tag: 'img',
                            title: '',
                            attr: {
                                title: 'excel',
                                src: '{{ asset('assets/images/ico/excel.png') }}',
                                style: 'cursor:pointer;height:40px;',
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
                $('.loader').addClass('hide');
            },

        });
    }

    function EmailModal(archive) {
        $("#EmailModal").modal('show');
        $.ajax({
            type: 'get', // the method (could be GET btw)
            url: "{{ route('archieve_info') }}",
            data: {
                archive_id: archive
            },
            success: function(response) {
                const emailData = response.info
                let subject
                if (emailData?.type) {
                    if (emailData?.type === 'licArchive') {
                        subject = `رخصة بناء رقم ${emailData?.licNo}`
                    } else subject = emailData?.title
                } else subject = emailData?.archive_type?.name
                let email = ''
                if (emailData?.model_id) {
                    const _token = '{{ csrf_token() }}';
                    const modelData = {
                        model_id: [emailData?.model_id ? emailData?.model_id : 0],
                        model: [emailData?.model_name],
                        _token: _token
                    }
                    let data = null;
                    $.ajax({
                        type: 'post', // the method (could be GET btw)
                        async: false,
                        url: "{{ route('getEmail') }}",
                        data: modelData,
                        success: function(response) {
                            data = response;
                        }
                    })
                    const to = data[0]
                    email = to?.value ? to.value : ''
                }
                // let ccData = ['']
                // if (emailData?.copy_to) {
                //     const model_id = []
                //     const model = []
                //     emailData?.copy_to.forEach(element => {
                //         if (element?.model_id) {
                //             model_id.push(element?.model_id ? element?.model_id : 0)
                //             model.push(element?.model_name ? element?.model_name : '')
                //         }
                //     })
                //     const modelData = {
                //         model_id,
                //         model
                //     }
                //     const {
                //         data
                //     } = [] //await api().post(`getEmail`, modelData)
                //     ccData = data.filter(email => email?.label).map(email => email?.label)
                //     // ccData = to?.value ? to.value : ''
                // }
                $('#archive_id').val(emailData?.id);
                $('#email').val(email);
                // $('#ccData').val(JSON.stringify(ccData));
                $('#email-subject').val(subject);
                row = '';
                if (response.files) {
                    for (j = 0; j < response.files.length; j++) {
                        row += attacheView(response.files[j], "formDataaa");
                    }
                    $(".formDataaaFilesArea").html(row)
                }
                row = '';
                if (response.CopyTo) {
                    var j = 0;
                    for (j = 0; j < response.CopyTo.length; j++) {
                        if (j == 0) {
                            $('.name').val(response.CopyTo[j].name);
                            $('.copyToID').val(response.CopyTo[j].model_id);
                            $('.copyToCustomer').val(response.CopyTo[j].name);
                            $('.copyToType').val(response.CopyTo[j].model_name);
                        } else {
                            addRec()
                            $('input[name="copyToText[]"]').eq(j).val(response.CopyTo[j].name);
                            // $('input[name="copyToText[]"]').eq(j).css('background-color','#FFF!important');
                            $('input[name="copyToText[]"]').eq(j).removeAttr('style');
                            $('input[name="copyToID[]"]').eq(j).val(response.CopyTo[j].model_id);
                            $('input[name="copyToCustomer[]"]').eq(j).val(response.CopyTo[j].name);
                            $('input[name="copyToType[]"]').eq(j).val(response.CopyTo[j].model_name);
                        }
                    }
                    if (response.CopyTo.length > 0)
                        $('.copyto').css('display', 'block');
                }
            },

        });
    }

    function sendEmail() {
        const _token = '{{ csrf_token() }}';
        const to = $('#email').val();
        if (!to) {
            alert('الرجاء ادخال ايميل صالح للارسال');
            return
        }
        $(".loader").removeClass('hide');
        let obj = {
            archive_id: $('#archive_id').val(),
            title: $('#email-subject').val(),
            to: to,
            text: cerIn.getData(),
            _token: _token
        };
        $.ajax({
            type: 'POST',
            url: "{{ route('sendEmail') }}",
            data: obj,
            // contentType: false,
            // processData: false,
            dataType: 'json',
            success: (response) => {
                $(".loader").addClass('hide');
                if (response && response.status) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'تم ارسال الايميل',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#EmailModal").modal('hide')
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'لم يتم الارسال ',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                $("#EmailModal").modal('show')
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
    }
    $(function() {
        $(".email_auto").autocomplete({
            source: 'full_search_email',
            minLength: 1,
            select: function(event, ui) {
                $('#email_auto').val(ui.item.email);
            }
        });
    });
</script>
{{-- @endsection --}}
