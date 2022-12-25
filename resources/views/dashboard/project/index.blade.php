@extends('layouts.admin')
@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"
               style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection
@section('content')
    <style>
        .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice {
            padding: 2px 6px !important;
            margin-top: 0 !important;
            background-color: #1E9FF2 !important;
            border-color: #1E9FF2 !important;
            color: #FFFFFF;
            margin-left: 8px !important;
            margin-bottom: 2px;
        }

        .preW {
            width: 25% !important;
        }

        .select2-container--default {
            width: 71.5% !important;
        }
    </style>
    <form id="ajaxform">
        @csrf
        <section class="horizontal-grid" id="horizontal-grid">
            <div class="row white-row">
                <div class="col-sm-12 col-lg-6 col-md-12">
                    <div class="card leftSide">
                        <div class="card-header">
                            <h4 class="card-title">
                                <img src="https://db.expand.ps/images/info.png" width="32" height="32">
                                {{trans('admin.project_name')}}
                            </h4>
                            <div class="heading-elements1" style="display: none;right: 87px; top: 10px;">
                                {{trans('admin.project_status')}}
                            </div>
                            <div class="heading-elements1 onOffArea" style="display: none;    top: 10px;">
                                <div class="onoffswitch" onclick="ShowModal()">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                           id="myonoffswitchHeader">
                                    <label class="onoffswitch-label"  for="myonoffswitchHeader">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-12 pr-0 pr-s-12"
                                             style="padding-left: 15px !important;">
                                            <div class="form-group">
                                                <div class="input-group" style="width:100% !important">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        {{trans('admin.project_name')}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="ProjectName"
                                                           class="form-control ac ui-autocomplete-input"
                                                           placeholder="{{trans('admin.project_name')}}"
                                                           name="ProjectName" autocomplete="off">
                                                </div>
                                                <div id="auto-complete-barcode"
                                                     class="divKayUP barcode-suggestion "></div>
                                                <input type="hidden" id="project_id" name="project_id" value="">

                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        {{trans('admin.project_num')}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="ProjectNo" class="form-control"
                                                           placeholder="{{trans('admin.project_num')}}"
                                                           name="ProjectNo">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="input-group" style=" width: 100% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        {{trans('admin.project_start_date')}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="dateStart" name="dateStart"
                                                           data-mask="00/00/0000" maxlength="10"
                                                           class="form-control eng-sm singledate valid "
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1"
                                                           autocomplete="off">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        {{trans('admin.project_end_date')}}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="dateEnd" name="dateEnd"
                                                           class="form-control eng-sm singledate valid"
                                                           data-mask="00/00/0000" autocomplete="off" maxlength="10"
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 pr-0">
                                            <div class="form-group">
                                                <div class="input-group" style="width: 100% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        تاريخ توقيع العقد
                                                        </span>
                                                    </div>
                                                    <input type="text" id="contractDate" name="contractDate"
                                                           class="form-control eng-sm singledate valid"
                                                           data-mask="00/00/0000" autocomplete="off" maxlength="10"
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group" style="width: 100% !important;">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                قيمة العقد
                                                </span>
                                                    </div>
                                                    <input id="contractValue" name="contractValue"
                                                           class="form-control numFeild " placeholder="00.00"
                                                           style="    border-radius: 0rem !important;">

                                                    <select id="contractCurrencyID" name="contractCurrencyID"
                                                            type="text"
                                                            class="form-control width30" style="max-width: 25%">
                                                        <option> -</option>
                                                        <option value="shekel"
                                                                selected=""> {{trans('admin.shekel')}} </option>
                                                        <option value="dollar"> {{trans('admin.dollar')}} </option>
                                                        <option value="dinar">{{trans('admin.dinar')}}  </option>
                                                        <option value="euro">{{trans('admin.euro')}}  </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group" style="">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                {{trans('admin.project_cost')}}
                                                </span>
                                                    </div>
                                                    <input id="Projectcost" name="Projectcost"
                                                           class="form-control numFeild " placeholder="00.00"
                                                           style="    border-radius: 0rem !important;">

                                                    <select id="CurrencyID" name="CurrencyID" type="text"
                                                            class="form-control width30" style="max-width: 25%">
                                                        <option> -</option>
                                                        <option value="shekel"
                                                                selected=""> {{trans('admin.shekel')}} </option>
                                                        <option value="dollar"> {{trans('admin.dollar')}} </option>
                                                        <option value="dinar">{{trans('admin.dinar')}}  </option>
                                                        <option value="euro">{{trans('admin.euro')}}  </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 pr-0">
                                            <div class="form-group">
                                                <div class="input-group" style="width: 100% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                        تاريخ امر المباشرة
                                                        </span>
                                                    </div>
                                                    <input type="text" id="orderDate" name="orderDate"
                                                           class="form-control eng-sm singledate valid"
                                                           data-mask="00/00/0000" autocomplete="off" maxlength="10"
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group" style="width: 100% !important;">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                تاريخ الاستلام الأولي
                                                </span>
                                                    </div>
                                                    <input type="text" id="receiveDate" name="receiveDate"
                                                           class="form-control eng-sm singledate valid"
                                                           data-mask="00/00/0000" autocomplete="off" maxlength="10"
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group" style="">
                                                    <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                تاريخ الاستلام النهائي
                                                </span>
                                                    </div>
                                                    <input type="text" id="finishDate" name="finishDate"
                                                           class="form-control eng-sm singledate valid"
                                                           data-mask="00/00/0000" autocomplete="off" maxlength="10"
                                                           placeholder="dd/mm/yyyy" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group" style="width:100% !important">
                                                    <div class="input-group-prepend preW" style="width:40%">
                                                <span class="input-group-text" id="basic-addon1" style=" width: 100%;">
                                                    {{trans('admin.permission_proj_archive')}}
                                                </span>
                                                    </div>
                                                    <select id="allowed_emp" name="allowed_emp[]"
                                                            class="select2 form-control" multiple="multiple"
                                                            data-toggle="select" style="width:70%;">
                                                        <?php
                                                        if (isset($admins) && !empty($admins) && count($admins) > 0){ ?>
                                                            <?php foreach ($admins as $key => $value){ ?>
                                                        <option
                                                            value="<?php echo $value->id; ?>"> <?php echo $value->nick_name; ?></option>
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @can('project_archives')
                                        <div class="card-header" style="padding-top:0px;">
                                            <h4 class="card-title">
                                                <img src="{{asset('assets/images/ico/msg.png')}}" width="32"
                                                     height="32">
                                                {{trans('admin.archieve')}}
                                            </h4>
                                        </div>

                                        <div class="card-content collapse show">
                                            <div class="card-body" style="padding-bottom: 0px;">
                                                <div class="row" style="text-align: center">
                                                    <div class="col-md-2 w-s-50" style="padding: 0px;">
                                                        <div class="form-group">
                                                            <img src="{{asset('assets/images/ico/msg.png')}}"
                                                                 onclick="ShowCertModal('formData')"
                                                                 style="cursor:pointer">
                                                            <div class="form-group">
                                                                <a onclick="ShowCertModal('formData')"
                                                                   style="color:#000000">{{trans('admin.archieve')}}
                                                                    <span id="msgStatic"
                                                                          style="color:#1E9FF2"><b>(0)</b></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-12">
                    <div class="card rightSide" style="min-height:646px">
                        <div class="card-header">
                            <h4 class="card-title"><img src="https://db.expand.ps/images/maps-icon.png" width="32"
                                                        height="32"> {{trans('admin.address')}}</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @include('dashboard.component.address')
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="Financiers">
                                            <table style="width:100%; margin-top: 0;" class="detailsTB table">
                                                <tbody>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col"
                                                        style="text-align: center !important;">{{trans('admin.select_financier')}} </th>
                                                    <th scope="col" style="text-align: center !important;">
                                                        قيمة المنحة
                                                    </th>
                                                    <th scope="col">
                                                        <i class="fa fa-plus-circle" id="plusElement2"
                                                           style="padding-top:10px;position: relative;left: 3%;cursor: pointer;color:aliceblue;font-size: 15pt; "></i>
                                                    </th>
                                                </tr>

                                                </tbody>
                                                <tbody id="Financier">

                                                </tbody>
                                            </table>

                                        </div>
                                        <div id="Supplieres">
                                            <table style="width:100%; margin-top: 0;" class="detailsTB table">
                                                <tbody>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col"
                                                        style="text-align: center !important;">{{trans('admin.supplier_company')}} </th>
                                                    <th scope="col"
                                                        style="text-align: center !important;">{{trans('admin.responsible_for')}}</th>
                                                    <th scope="col">
                                                        <i class="fa fa-plus-circle" id="plusElement4"
                                                           style="padding-top:10px;position: relative;left: 3%;cursor: pointer;color:aliceblue;font-size: 15pt; "></i>
                                                    </th>
                                                </tr>
                                                </tbody>
                                                <tbody id="Supplier">

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header" style="padding-top:0px;">
                            <h4 class="card-title" style="    height: 36px;">
                            </h4>
                            <!--  <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a> -->
                            <div class="heading-elements" style="display: none">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>

                        </div>

                        <div class="form-actions" style="border-top:0px;">
                            <div class="text-right">
                                @can('edit_model')
                                    <button id="editBtn" style="display:none" class="btn btn-primary save-data">تعديل<i
                                            class="ft-thumbs-up position-right"></i></button>
                                @endcan
                                <button id="saveBtn" class="btn btn-primary save-data">{{trans('admin.save')}} <i
                                        class="ft-thumbs-up position-right"></i></button>

                                <button type="reset" onclick="$('#userList').html('');"
                                        class="btn btn-warning"> {{trans('assets.reset')}} <i
                                        class="ft-refresh-cw position-right reset-data"></i></button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </form>
    @include('dashboard.component.project_archive')
    @include('dashboard.component.fetch_table')

@stop
@section('script')
    <script>
        $('.reset-data').click(function (event) {
            $("#msgStatic").html("(0)");
        });
        $(function () {

            // $( ".cust" ).autocomplete({
            // 	source: 'Linence_auto_complete',
            // 	minLength: 1,

            //     select: function( event, ui ) {
            //         console.log(ui.item);
            //         $('#customerid').val(ui.item.id);
            //         $('#customerName').val(ui.item.name);
            //         $('#customername').val(ui.item.name);
            //         $('#customerType').val(ui.item.model);
            //        }
            // });


            $(".ac").autocomplete({
                source: 'project_auto_complete',
                minLength: 1,

                select: function (event, ui) {
                    update(ui.item.id);
                }
            });
        });

        function update($id) {

            let project_id = $id
            $('#saveBtn').css('display', 'none');
            $('#editBtn').css('display', 'inline-block');
            $.ajax({
                type: 'get', // the method (could be GET btw)
                url: "project_info",
                data: {
                    project_id: project_id,
                },
                success: function (response) {
                    if (response.status != false) {
                        console.log(response);
                        $('#allowed_emp').val('');
                        $archiveCount = 0;
                        @can('projContractArchive')
                        getContractArchive(response.info.id, response.contractArchiveCount);
                        $archiveCount += response.contractArchiveCount;
                        @endcan

                        @can('projArchive')
                        getArchive(response.info.id, response.archiveCount);
                        $archiveCount += response.archiveCount;
                        @endcan

                        @can('projCopyArchive')
                        getCopyArchive(response.info.id, response.copyToCount);
                        $archiveCount += response.copyToCount;
                        @endcan

                        @can('projJalArchive')
                        getJalArchive(response.info.id, response.linkToCount);
                        $archiveCount += response.linkToCount;
                        @endcan
                        $("#msgStatic").html("(" + $archiveCount + ")");
                        $('#project_id').val(response.info.id);
                        $('#ProjectNo').val(response.info.ProjectNo);
                        $('#ProjectName').val(response.info.name);
                        $('#dateStart').val(response.info.dateStart);
                        $('#dateEnd').val(response.info.dateEnd);
                        $('#Projectcost').val(response.info.Projectcost);
                        $("#contractDate").val(response.info.contractDate);
                        $("#contractValue").val(response.info.contractValue);
                        $("#contractCurrencyID").val(response.info.contractCurrencyID);
                        $("#orderDate").val(response.info.orderDate);
                        $("#receiveDate").val(response.info.receiveDate);
                        $("#finishDate").val(response.info.finishDate);

                        $('.select2-selection__rendered').html('');


                        if (response.allowedEmp != null) {
                            $("#allowed_emp").html('');
                            for ($i = 0; $i < response.allAdmin.length; $i++) {
                                $selected = 0;
                                for ($c = 0; $c < response.allowedEmp.length; $c++) {

                                    if (response.allowedEmp[$c] == response.allAdmin[$i].id) {
                                        $selected = 1;
                                        $("#allowed_emp").append('<option value="' + response.allAdmin[$i].id + '" selected >' + response.allAdmin[$i].nick_name + '</option>');
                                        //   console.log(response.allAdmin[$i].id+'selected');
                                        break;
                                    }

                                }
                                if ($selected == 0) {
                                    $("#allowed_emp").append('<option value="' + response.allAdmin[$i].id + '">' + response.allAdmin[$i].nick_name + '</option>');
                                }

                            }
                        }

                        // $('.select2-selection__rendered').append('<li class="select2-selection__choice" title=" Expand"><span class="select2-selection__choice__remove" role="presentation">×</span>'+ response.allowedEmp[$i].nick_name+'</li>')


                        $("select#CurrencyID option")
                            .each(function () {
                                this.selected = (this.text == response.Currency);
                            });

                        $("select#pinc6 option")
                            .each(function () {
                                this.selected = (this.text == response.admin);
                            });
                        $("select#Department option")
                            .each(function () {
                                this.selected = (this.text == response.department);
                            });

                        // $("select#sponsor option")
                        //      .each(function() { this.selected = (this.text == response.sponsers);
                        // });
                        $('#cost1').val(response.info.cost1);
                        $('#pinc8').val(response.info.pinc8);

                        // $("select#Contractor option")
                        //      .each(function() { this.selected = (this.text == response.contract);
                        // });
                        $('#AddressDetails').val(response.info.details);
                        $('#Note').val(response.info.notes);
                        drawAddress(response.info.city_id, response.info.town_id, response.info.region_id);
                        //////manualy reset table/////
                        $('#userList').html('');
                        $('#Financier').html('');
                        $('#Supplier').html('');
                        //////////////////////////////
                        var len = response.users.length;
                        for (var i = 0; i < len; i++) {
                            var index = i + 1;
                            var name = response.users[i].name;
                            var phone = response.users[i].phone_one;
                            var national_id = response.users[i].national_id;

                            var userList =
                                '<tr>'
                                + '<td>'
                                + index
                                + '</td>'
                                + '<td class="col-md-3">'
                                + ' <input  class="form-control cust"  id="sub_name[]" name="sub_name[]" value="' + name + '">'
                                + ' </td>'
                                + '<td class="col-md-3" >'
                                + '<input class="form-control" id="sub_phone[]" name="sub_phone[]" disabled="disabled" value="' + phone + '">'
                                + '</td>'
                                + '<td class="col-md-3" >'
                                + ' <input  class="form-control" id="sub_id[]" name="sub_id[]" disabled="disabled" value="' + national_id + '">'
                                + '</td>'
                                + '<input type="hidden" id="subscribers[]" name="subscribers[]" value="' + response.users[i].id + '">'
                                + '<td onclick="$(this).parent().remove()" >'
                                + '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>'
                                + '</td>'
                                + ' </tr>';
                            $("#userList").append(userList);
                        }

                        var len = response.sponsers.length;
                        financierCount=(response.sponsers.length+1);
                        for (var i = 0; i < len; i++) {
                            var index = i + 1;
                            var name = response.sponsers[i].name;
                            var pinc8 = response.pinc8[i];
                            var sponser =`
                                <tr>
                                    <td class="num1">
                                        ${index}
                                    </td>
                                    <td class="col-md-6">
                                        <input  class="form-control sponser"  id="orgnize_name" index="${index}" name="orgnize_name[]" value="${name}">
                                        <input type="hidden" class="orgnizeID${index}" id="orgnizeID" name="orgnizeID[]" value="${response.sponsers[i].id}">
                                     </td>
                                    <td class="col-md-6" >
                                        <input  class="form-control" id="fund" name="fund[]" value="${pinc8}">
                                    </td>
                                    <td onclick="$(this).parent().remove()" >
                                        <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                                    </td>
                                 </tr>`;
                            $("#Financier").append(sponser);
                        }

                        var len = response.contract.length;
                        executorCount=(response.contract.length+1)
                        for (var i = 0; i < len; i++) {
                            var index = i + 1;
                            var name = response.contract[i].name;
                            var contact = response.cost1[i];
                            var supplier =
                                `<tr>
                                    <td class="num2">
                                        ${index}
                                    </td>
                                    <td class="col-md-6">
                                        <input  class="form-control supplier" id="supplier_name" index="${index}" name="supplier_name[]" value="${name}">
                                        <input type="hidden" id="supplierID" class="supplierID${index}" name="supplierID[]" value="${response.contract[i].id}">
                                    </td>
                                    <td class="col-md-6" >
                                        <input  class="form-control" id="contact" name="contact[]" value="${contact}">
                                    </td>
                                    <td onclick="$(this).parent().remove()" >
                                        <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                                    </td>
                                 </tr>`;
                            $("#Supplier").append(supplier);

                        }
                        window.scrollTo(0, 0);
                    } else {
                        window.location = "{{route('projNotAllowed')}}";
                    }
                },
            });

        }

        $("#pinc6").change(function () {
            var val = $(this).val();
            $.ajax({
                type: 'post', // the method (could be GET btw)
                url: "depart_manger_project",
                data: {
                    val: val,
                    _token: '{{csrf_token()}}',
                },
                success: function (response) {
                    if (response == "empty") {
                        $("select#Department option")
                            .each(function () {
                                this.selected = (this.text == "0");
                            });
                    } else {
                        $("select#Department option")
                            .each(function () {
                                this.selected = (this.text == response);
                            });
                    }
                },
            });
        });


        ///////////
        $("#CityID").change(function () {
            $("#area_data").empty();
            var val = $(this).val();

            $.ajax({
                type: 'post', // the method (could be GET btw)
                url: "state",
                data: {
                    val: val,
                    _token: '{{csrf_token()}}',
                },
                success: function (response) {
                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var name = response[i].name;
                        var id = response[i].id;
                        var state_details = '<option value="' + id + '">'
                            + name + ' </option>'
                        $("#area_data").append(state_details);
                    }
                },
            });
        });

        $("#area_data").change(function () {
            $("#region_data").empty();
            var val = $(this).val();

            $.ajax({
                type: 'post', // the method (could be GET btw)
                url: "area",
                data: {
                    val: val,
                    _token: '{{csrf_token()}}',
                },
                success: function (response) {
                    var len = response.length;
                    for (var i = 0; i < len; i++) {
                        var name = response[i].name;
                        var id = response[i].id;
                        var region_details = '<option value="' + id + '">'
                            + name + ' </option>'
                        $("#region_data").append(region_details);
                    }
                },
            });
        });


        $(".save-data").click(function (event) {
            $(".loader").removeClass('hide');
            $("#ProjectName").removeClass("error");
            $("#dateStart").removeClass("error");
            $("#dateEnd").removeClass("error");

            event.preventDefault();
            form=$('#ajaxform')[0]
            let formData = new FormData(form);

            $.ajax({
                url: "store_project",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function (response) {
                    $('.success_alert').css('visibility', 'visible');
                    $('.wtbl').DataTable().ajax.reload();

                    setTimeout(function () {

                        $('.success_alert').fadeOut();

                    }, 3000);

                    $(".loader").addClass('hide');

                    $('#allowed_emp').val('');

                    $('.select2-selection__rendered').html('');

                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: '{{trans('admin.data_added')}}',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#ajaxform")[0].reset();
                    $("#region_data").val([]);
                    $("#area_data").val([]);
                    $("#project_id").val('');
                    //////manualy reset table/////
                    $('#userList').html('');
                    $('#Financier').html('');
                    $('#Supplier').html('');
                    //////////////////////////////
                },
                error: function (response) {
                    $(".loader").addClass('hide');
                    if (response.responseJSON?.errors?.ProjectName) {
                        $("#ProjectName").addClass("error");
                    }
                    if (response.responseJSON?.errors?.dateStart) {
                        $("#dateStart").addClass("error");
                    }
                    if (response.responseJSON?.errors?.dateEnd) {
                        $("#dateEnd").addClass("error");
                    }

                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: '{{trans('admin.error_save')}}',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }


            });
        });

        $(document).ready(function () {
            $(".cust").autocomplete({
                source: 'Linence_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                    console.log(ui.item);
                    // $('#subscribers').val(ui.item.id);
                    // $('#sub_name').val(ui.item.name);
                    // $('#sub_phone').val(ui.item.phone_one);
                    // $('#sub_id').val(ui.item.national_id);
                    var currentIndex = $("input[name^=sub_name]").length - 1;
                    $('input[name="subscribers[]"]').eq(currentIndex).val(ui.item.id);
                    $('input[name="sub_name[]"]').eq(currentIndex).val(ui.item.name);
                    $('input[name="sub_phone[]"]').eq(currentIndex).val(ui.item.phone_one);
                    $('input[name="sub_id[]"]').eq(currentIndex).val(ui.item.national_id);
                }
            });
            $('#plusElement1').click(function () {
                $("#userList").append(''
                    + '<tr>'
                    + '<td class="num">'
                    + '</td>'
                    + '<td class="col-md-3">'
                    + ' <input  class="form-control cust"  id="sub_name[]" name="sub_name[]" >'
                    + ' </td>'
                    + '<td class="col-md-3" >'
                    + '<input class="form-control" id="sub_phone[]" name="sub_phone[]" disabled="disabled" >'
                    + '</td>'
                    + '<td class="col-md-3" >'
                    + ' <input  class="form-control" id="sub_id[]" name="sub_id[]" disabled="disabled">'
                    + '</td>'
                    + '<input type="hidden" id="subscribers[]" name="subscribers[]" value="">'
                    + '<td onclick="$(this).parent().remove();resetIndex(\'num\')" >'
                    + '  <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>'
                    + '</td>'
                    + ' </tr>');
                $(".cust").autocomplete({
                    source: 'Linence_auto_complete',
                    minLength: 1,
                    select: function (event, ui) {
                        console.log(ui.item);
                        // $('#subscribers').val(ui.item.id);
                        // $('#sub_name').val(ui.item.name);
                        // $('#sub_phone').val(ui.item.phone_one);
                        // $('#sub_id').val(ui.item.national_id);
                        var currentIndex = $("input[name^=sub_name]").length - 1;
                        $('input[name="subscribers[]"]').eq(currentIndex).val(ui.item.id);
                        $('input[name="sub_name[]"]').eq(currentIndex).val(ui.item.name);
                        $('input[name="sub_phone[]"]').eq(currentIndex).val(ui.item.phone_one);
                        $('input[name="sub_id[]"]').eq(currentIndex).val(ui.item.national_id);
                    }
                });
                resetIndex('num');
            });
        });


        function resetIndex(Class) {
            citizenCnt = 1;
            $("." + Class).each(function () {
                $(this).html(citizenCnt)
                citizenCnt++
            })
        }
        financierCount=1;
        $(document).ready(function () {
            $('#plusElement2').click(function () {
                $("#Financier").append(
                    `<tr>
                         <td class="num1">
                         </td>
                         <td class="col-md-6 ">
                            <input  class="form-control sponser"  id="orgnize_name" index="${financierCount}" name="orgnize_name[]" >
                            <input type="hidden" class="orgnizeID${financierCount}" id="orgnizeID" name="orgnizeID[]" value="">
                            <input type="hidden" class="orgnizeModel${financierCount}" id="orgnizeModel" name="orgnizeModel[]" value="">
                         </td>
                         <td class="col-md-6" >
                            <input  class="form-control" id="fund" name="fund[]">
                         </td>
                         <td onclick="$(this).parent().remove();resetIndex('num1')" >
                            <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                         </td>
                      </tr>`
                );
                financierCount++;
                resetIndex('num1');
                $(".sponser").autocomplete({
                    source: 'orginzation_auto_complete',
                    minLength: 1,
                    select: function (event, ui) {
                        $(this).val(ui.item.name);
                        $(`.orgnizeID${$(this)[0].attributes.index.value}`).val(ui.item.id);
                        $(`.orgnizeModel${$(this)[0].attributes.index.value}`).val(ui.item.model);
                    }
                });
            });
        });
        $(function () {
            $("#searchOrganization").autocomplete({
                source: 'orginzation_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                    $(this).val(ui.item.name);
                    $(`#searchOrganizationId`).val(ui.item.id);
                    reload();
                }
            });
            $("#searchSupp").autocomplete({
                source: 'supplier_auto_complete',
                minLength: 1,
                select: function (event, ui) {
                    $(this).val(ui.item.name);
                    $(`#searchSuppId`).val(ui.item.id);
                    reload();
                }
            });
        });


        executorCount=1;
        $(document).ready(function () {
            $('#plusElement4').click(function () {
                $("#Supplier").append(
                    `<tr>
                        <td class="num2">
                        </td>
                        <td class="col-md-6">
                            <input  class="form-control supplier" id="supplier_name" index="${executorCount}" name="supplier_name[]">
                            <input type="hidden" class="supplierID${executorCount}" id="supplierID" name="supplierID[]" value="">
                            <input type="hidden" class="supplierModel${executorCount}" id="supplierModel" name="supplierModel[]" value="">
                         </td>
                        <td class="col-md-6" >
                            <input  class="form-control" id="contact" name="contact[]">
                        </td>
                        <td onclick="$(this).parent().remove();resetIndex('num2');" >
                            <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                        </td>
                     </tr>`
                );
                executorCount++;
                resetIndex('num2');
                $(".supplier").autocomplete({
                    source: 'supplier_auto_complete',
                    minLength: 1,
                    select: function (event, ui) {
                        $(this).val(ui.item.name);
                        $(`.supplierID${$(this)[0].attributes.index.value}`).val(ui.item.id);
                        $(`.supplierModel${$(this)[0].attributes.index.value}`).val(ui.item.model);

                    }
                });

            });
        });

        function delete_proj($id) {
            if (confirm('هل انت متاكد من حذف المشروع؟ لن يمكنك استرجاعه فيما بعد')) {
                let proj_id = $id;
                var _token = '{{ csrf_token() }}';
                $.ajax({

                    type: 'post',

                    // the method (could be GET btw)

                    url: "proj_delete",

                    data: {

                        proj_id: proj_id,
                        _token: _token,
                    },

                    success: function (response) {

                        $(".loader").addClass('hide');

                        $('.wtbl').DataTable().ajax.reload();

                        // setTimeout(function(){

                        //     $(".alert-success").addClass("hide");

                        // },2000)

                        Swal.fire({

                            position: 'top-center',

                            icon: 'success',

                            title: 'تم الحذف بنجاح',

                            showConfirmButton: false,

                            timer: 1500

                        })

                        //$("#ajaxform")[0].reset();

                    },

                    error: function (response) {

                        $(".loader").addClass('hide');

                        Swal.fire({

                            position: 'top-center',

                            icon: 'error',

                            title: 'خطأ فى عملية الحذف',

                            showConfirmButton: false,

                            timer: 1500

                        })

                        $("#formDataNameAR").on('keyup', function (e) {

                            if ($(this).val().length > 0) {

                                $("#formDataNameAR").removeClass("error");

                            }

                        });

                        if (response.responseJSON.errors.formDataNameAR) {

                            $("#formDataNameAR").addClass("error");

                        }

                    }

                });
                return true;
            }
            return false;
        }

        function ShowCertModal(bindTo) {
            $("#ArchModalName").html($("#ProjectName").val())
            // $("#CitizenName").html($("#ProjectName").val())

            $("#msgModal").modal('show')

        }
    </script>
@endsection
