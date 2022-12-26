@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection
@section('content')

    <style>
        /* The Modal (background) */
        .modal1 {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content1 {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            /*   float: right; */
            font-size: 28px;
            font-weight: bold;
            margin-left: auto;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .rate:not(:checked) > label {
            font-size: 30px !important;
        }

        .rate {
            width: auto;
            position: relative;
            float: left;
            height: 40px;
            margin-top: -3px;
        }

        .Priority {
            padding: 0;
            position: relative;
            left: 0;
            line-height: 39px;
            float: left;
        }

        .fa-2x {
            font-size: 24px !important;
        }

        .detailsTB th {
            font-family: Arial, sans-serif !important;
            text-align: -webkit-right;
            color: #111d5e;
            vertical-align: middle !important;
            border-top: 0px solid #626E82;
        }

    </style>


    <link rel="stylesheet" type="text/css"
          href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css"/>

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>
    <?php
    $debt0Setting=$ticketInfo->debt_settings[0];
    $debt1Setting=$ticketInfo->debt_settings[1];
    $debt2Setting=$ticketInfo->debt_settings[2];
    $debt3Setting=$ticketInfo->debt_settings[3];
    $debt4Setting=$ticketInfo->debt_settings[4];
    $debt5Setting=$ticketInfo->debt_settings[5];
    ?>
    @include('dashboard.component.dept_config',['ticketInfo'=>$ticketInfo])
    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="ticketFrm" enctype="multipart/form-data">
            @csrf
            <div class="row white-row">

                <div class="col-sm-12 col-md-7">
                    <div class="card leftSide">

                        @include('dashboard.component.ticketHeader',['ticketInfo'=>$ticketInfo])
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <input type="hidden" id="app_type" name="app_type" value="5">
                                    <input type="hidden" id="dept_id" name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'تاريخ الشراء' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="date_buy" name="date_buy"
                                                           data-mask="00/00/0000" maxlength="10" class="form-control"
                                                           value="<?php echo date('d/m/Y')?>" placeholder=""
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'المورد' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="subscriber_name"
                                                           class="form-control numFeild" placeholder="{{ 'المورد' }}"
                                                           name="subscriber_name">
                                                    <input type="hidden" id="subscriber_id" name="subscriber_id"
                                                           value="0">
                                                    <input type="hidden" id="subscriber_model" name="subscriber_model"
                                                           value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text input-group-text1"
                                                              id="basic-addon1">
                                                            <img id="mobImg"
                                                                 src="https://db.expand.ps/images/jawwal35.png">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="MobileNo" maxlength="10" name="MobileNo"
                                                           class="form-control noleft numFeild" placeholder="0590000000"
                                                           aria-describedby="basic-addon1"
                                                           onblur="$('#username').val($(this).val())">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('dashboard.includes.orderTable')
                                </div>

                            </div>

                        </div>

                        @include('dashboard.includes.attachment')

                    </div>
                </div>
                @include('dashboard.includes.forward')
            </div>
        </form>
    </section>

    @include('dashboard.component.ticket_config',['ticketInfo'=>$ticketInfo,'department'=>$department])
    @include('dashboard.component.tasks_table')
    @include('dashboard.component.fetch_Task_table')
    <script>

      $(document).ready(function () {

        $("#subscriber_name").autocomplete({
          source: 'archive_auto_complete',
          minLength: 1,
          select: function (event, ui) {
            $("#subscriber_id").val(ui.item.id)
            $("#subscriber_model").val(ui.item.model)

            if ({{$ticketInfo->apps_btn}} == 1)
              getSubscriberTasks(ui.item.id)

            getFullData(ui.item.id)
          }
        });
        $(".ac").autocomplete({
          source: 'sparePart_auto_complete',
          minLength: 1,
          select: function (event, ui) {
          }
        });


        $('#ticketFrm').submit(function (e) {
          e.preventDefault();
          if ((validateAttachments()??false)) {
            return false;
          }
          $(".loader").removeClass('hide');
          $(".form-actions").addClass('hide');
          // $( "#subscriber_name" ).removeClass( "error" );
          // $( "#subscriber_id" ).removeClass( "error" );
          // $( "#MobileNo" ).removeClass( "error" );
          $("#AreaID").removeClass("error");
          // $( "#Address" ).removeClass( "error" );
          $("#subscriptionType").removeClass("error");
          let formData = new FormData(this);
          $.ajax({
            type: 'POST',
            url: "saveTicket31",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
              $(".form-actions").removeClass('hide');
              $('.wtbl').DataTable().ajax.reload();
              // console.log('response');
              if (response.success != null) {
                $(".loader").addClass('hide');
                Swal.fire({
                  position: 'top-center',
                  icon: 'success',
                  title: '{{trans('admin.data_added')}}',
                  showConfirmButton: false,
                  timer: 1500
                })
                if (print == true) {
                  self.location = `{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
                  print = false;
                }
                if (writeUserData('viewTicket/' + response.app_id + '/' + response.app_type))
                  setTimeout(function () {
                    self.location = '{{asset('/ar/admin')}}'
                  }, 1500)
                this.reset();
              } else {
                console.log(response.error);
                if (response.error == 'no_attatch') {

                  $(".attachName").addClass('error');
                  Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'أدخل المرفقات',
                    showConfirmButton: true,
                    timer: 2000
                  })
                  $(".loader").addClass('hide');
                  return false;
                }
                $(".loader").addClass('hide');

                Swal.fire({
                  position: 'top-center',
                  icon: 'error',
                  title: '{{trans('admin.error_save')}}',
                  showConfirmButton: false,
                  timer: 1500
                })
              }
              //location.reload();

            },
            error: function (response) {
              $(".loader").addClass('hide');
              $(".form-actions").removeClass('hide');
              // 			if(response.responseJSON.errors.subscriber_name){
              //                 $( "#subscriber_name" ).addClass( "error" );
              //                 $( "#subscriber_name" ).get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
              //                 $( "#subscriber_name" ).on('input',function(){
              //                     this.setCustomValidity('')
              //                 })
              //             }
              //             if(response.responseJSON.errors.subscriber_id){
              //                 $( "#subscriber_id" ).addClass( "error" );
              //                 $( "#subscriber_name" ).get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
              //                 $( "#subscriber_name" ).on('input',function(){
              //                     this.setCustomValidity('')
              //                 })
              //             }
              //             if(response.responseJSON.errors.MobileNo){
              //                 $( "#MobileNo" ).addClass( "error" );
              //                 $( "#MobileNo" ).get(0).setCustomValidity('أدخل رقم جوال ');
              //                 $( "#MobileNo" ).on('blur',function(){
              //                     this.setCustomValidity('')
              //                 })
              //             }
              // if(response.responseJSON.errors.AreaID){
              //     $( "#AreaID" ).addClass( "error" );
              //     $( "#AreaID" ).get(0).setCustomValidity('يرجى اختيار منطقة ');
              //     $( "#AreaID" ).on('input',function(){
              //         this.setCustomValidity('')
              //     })
              // }
              // if(response.responseJSON.errors.Address){
              //     $( "#Address" ).addClass( "error" );
              // }


              Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: 'يرجى تعبئة الحقول الاجبارية',
                showConfirmButton: false,
                timer: 1500
              })

            }
          });
        });
      });

      function getSubscriberTasks(id) {

        let subscribe_id = id;

        $.ajax({

          type: 'get',

          url: "subscriber_tasks",

          data: {

            subscribe_id: subscribe_id,

          },

          success: function (response) {

            if (response.status != false) {

              drawtasks(response.tikets);

            } else {
              Swal.fire({

                position: 'top-center',

                icon: 'error',

                title: 'لايوجد طلبات لهاذا المواطن',

                showConfirmButton: false,

                timer: 1500

              })
            }
          },

        });

      }

      function getFullData(id) {

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')

          }

        });
        formData = {'id': id}
        $.ajax({
          type: 'POST',
          url: "appCustomer",
          data: formData,
          /*contentType: false,
          processData: false,*/
          success: (response) => {
            if (response) {
              srch = response.phone_one == null ? (response.phone_two == null ? '' : response.phone_two) : response.phone_one
              if (srch.search("056") >= 0)
                $('#mobImg').attr('src', '{{asset('assets/images/w35.png')}}');
              else
                $('#mobImg').attr('src', '{{asset('assets/images/jawwal35.png')}}');
              $('#MobileNo').val(response.phone_one == null ? (response.phone_two == null ? '' : response.phone_two) : response.phone_one)
              $(".loader").addClass('hide');
              console.log(response.errorList.length)
              if (response.errorList.length == 0) {
                $(".btnArea").removeClass("hide");
                //$(".errArea").addClass("hide");
              } else {

                //     $(".btnArea").addClass("hide");
                //     //$(".errArea").removeClass("hide");
                //     err='هل تريد المتابعة رغم الأخطاء التالية'
                //     +'<ul>'
                // for(i=0;i<response.errorList.length;i++)
                //     err+="<li>"+response.errorList[i]+"</li>";
                //     err+='<ul>'
                //     Swal.fire({
                //       title: err,//'Do you want to save the changes?',
                //       showDenyButton: true,
                //       showCancelButton: true,
                //       confirmButtonText: 'Save',
                //       denyButtonText: `Don't save`,
                //     }).then((result) => {
                //       /* Read more about isConfirmed, isDenied below */
                //       if (result.isConfirmed) {
                //         Swal.fire('Saved!', '', 'success')
                //       } else if (result.isDenied) {
                //         Swal.fire('Changes are not saved', '', 'info')
                //       }
                //     })
              }

            }

          },
          error: function (response) {
            $(".loader").addClass('hide');

            Swal.fire({
              position: 'top-center',
              icon: 'error',
              title: '{{trans('admin.error_save')}}',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });
      }

      window.globalCounter = 2;
      $(document).ready(function () {


        $("#mytbody").on("input", "#price", function () {
          if ($(".price").last().val().length > 0) {
            var data = '<tr><td class="col-sm-4 " style="width: 5%; border: none;">'
              + window.globalCounter
              + '</td><td class="col-sm-4" style="width: 50%; border: none;">'
              + '<input type="text" class="form-control ac" name="itemname[]"/>'
              + '</td><td class="col-sm-4" style="width: 15%; border: none;">'
              + '<input type="text" class="form-control" name="quantity[]" oninput="CalculateColumns(\'myTable\',\'price[]\',\'quantity[]\',\'total[]\',\'totalamount\')"/>'
              + '</td><td class="col-sm-4" style="width: 15%; border: none;">'
              + '<input type="text" class="form-control" name="types[]"/>'
              + '</td><td class="col-sm-4" style="width: 15%; border: none;">'
              + '<input type="text" class="form-control price" id="price" name="price[]" oninput="CalculateColumns(\'myTable\',\'price[]\',\'quantity[]\',\'total[]\',\'totalamount\')"/>'
              + '</td><td class="col-sm-4" style="width: 15%; border: none;">'
              + '<input type="text" class="form-control" name="total[]"/>'
              + '</td><td style=" border: none;"><i id="delete" class="fa fa-trash" style="color:#1E9FF2;padding-top: 9px;"></i></td></tr>';
            $("#mytbody").append(data);
            window.globalCounter++;

            $(".ac").autocomplete({
              source: 'sparePart_auto_complete',
              minLength: 1,
              select: function (event, ui) {
              }
            });

            if (window.globalCounter >= 7) {
              $(".leftSide").removeAttr("style");
            }
          }
        });

        $("#mytbody").on("click", "#delete", function (ev) {
          var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
          $currentTableRow.remove();
          CalculateColumns('myTable', 'price[]', 'quantity[]', 'total[]', 'totalamount');
          window.globalCounter--;

          $("#mytbody").find('tr').each(function (index) {
            var firstTDDomEl = $(this).find('td')[0];
            var $firstTDJQObject = $(firstTDDomEl);
            $firstTDJQObject.text(index + 1);
          });
        });


      });

      function CalculateColumns(ContainerID, Col1, Col2, Col3, GrandTotalID) {
        if (typeof ContainerID == 'string') var ContainerID = document.getElementById(ContainerID);

        var arrCol1 = new Array();
        var arrCol2 = new Array();
        var arrCol3 = new Array();
        var GrandTotal = 0;
        var ContainerIDElements = new Array('input');
        //var ContainerIDElements = new Array('input', 'textarea', 'select');

        for (var i = 0; i < ContainerIDElements.length; i++) {
          els = ContainerID.getElementsByTagName(ContainerIDElements[i]);
          for (var j = 0; j < els.length; j++) {
            if (els[j].name == Col1) arrCol1.push(els[j]);
            if (els[j].name == Col2) arrCol2.push(els[j]);
            if (els[j].name == Col3) arrCol3.push(els[j]);
          }
        }

        for (var j = 0; j < arrCol1.length; j++) {
          if ((Number(arrCol1[j].value) > 0) && (Number(arrCol2[j].value) > 0)) {
            arrCol3[j].value = Number(arrCol1[j].value) * Number(arrCol2[j].value);
            GrandTotal += Number(arrCol3[j].value);
          }
        }

        document.getElementById(GrandTotalID).value = GrandTotal;
      } // CalculateColumns

      $(function () {
        var table = $('.tasktbl1').DataTable({
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
      $(function () {
        var table = $('.tasktbl2').DataTable({
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
      $(function () {
        var table = $('.tasktbl3').DataTable({
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
      $(function () {
        var table = $('.tasktbl4').DataTable({
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

      function drawtasks($tickets) {

        if ($.fn.DataTable.isDataTable('.tasktbl1')) {

          $(".tasktbl1").dataTable().fnDestroy();

          $('#cMyTask1').empty();

        }
        if ($.fn.DataTable.isDataTable('.tasktbl2')) {

          $(".tasktbl2").dataTable().fnDestroy();

          $('#cMyTask2').empty();

        }
        if ($.fn.DataTable.isDataTable('.tasktbl3')) {

          $(".tasktbl3").dataTable().fnDestroy();

          $('#cMyTask3').empty();

        }
        if ($.fn.DataTable.isDataTable('.tasktbl4')) {

          $(".tasktbl4").dataTable().fnDestroy();

          $('#cMyTask4').empty();

        }

        engCount = 0;
        waterCount = 0;
        elecCount = 0;
        otherCount = 0;

        for (i = 0; i < $tickets.length; i++) {
          taskRow = '';
          link = '/admin/viewTicket/' + $tickets[i]['trans']['ticket_id'] + '/' + $tickets[i]['trans']['related'];
          if ($tickets[i]['0']['app_type'] == 1) {
            elecCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + elecCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask2').append(taskRow);
          }
          if ($tickets[i]['0']['app_type'] == 2) {
            waterCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + waterCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask3').append(taskRow);
          }
          if ($tickets[i]['0']['app_type'] == 3) {
            engCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + engCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask1').append(taskRow);
          }
          if ($tickets[i]['0']['app_type'] == 4 || $tickets[i]['0']['app_type'] == 5) {
            otherCount++;
            taskRow += '<tr style="text-align:center">'

              + '<td >' + otherCount + '</td>'

              + '<td>'
              + $tickets[i]['0']['nick_name']
              + '</td>'

              + '<td>'
              + '<a target="_blank" href="{{asset(app()->getLocale())}}' + link + '">'
              + '<span class="hideMob" >' + $tickets[i]['config']['ticket_name'] + ' (' + $tickets[i]['0']['app_no'] + ')' + '</span>'
              + '</a>'
              + '</td>'

              + '<td>'
              + $tickets[i]['0']['created_at'].substring(0, 10) + '&nbsp;&nbsp;&nbsp;' + $tickets[i]['0']['created_at'].substring(11, 16)
              + '</td>'

              + '<td>'
              + ($tickets[i]['trans']['s_note'] ?? '')
              + '</td>'

              + '</tr>'
            $('#cMyTask4').append(taskRow);
          }
        }

        $('#ctabCnt1').html(engCount);
        $('#ctabCnt2').html(elecCount);
        $('#ctabCnt3').html(waterCount);
        $('#ctabCnt4').html(otherCount);

        $('.tasktbl1').DataTable({
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
        $('.tasktbl2').DataTable({
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
        $('.tasktbl3').DataTable({
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
        $('.tasktbl4').DataTable({
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

      }

    </script>
@stop
