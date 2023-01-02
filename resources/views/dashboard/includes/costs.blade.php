<?php
$currentempId = Auth()->user()->id;
?>


@if($ticketInfo->has_debt_list==1)
    <div class="row">
        <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
            <img src="{{ asset('assets/images/ico/cost.png') }}" width="40" height="40">
            <span class="cost-header" style="font-size: 20px;">{{ 'براءة ذمة' }}

            </span>
            @can('storeDebtSittings')
                <div class="heading-elements1 onOffArea form-group mt-1 hidemob "
                     style="height: 20px; margin: 0px !important;" title="اعدادات براءة الذمة">
                    <img src="{{ asset('assets/images/ico/cost.png') }}" height="30px"
                         onclick="ShowClearanceModal('formData')" style="cursor:pointer">
                    <div class="form-group">
                        <a onclick="ShowClearanceModal('formData')" style="color:#000000">
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="card-body">
            <div class="form-group col-md-12">
                <table class="detailsTB table" style="margin-left: 15px;">
                    <tbody>
                    <tr>
                        <th scope="col" class="hideMob">
                            {{ '' }}
                        </th>
                        <th scope="col" class="hideMob col-md-2" style="text-align: -webkit-center;color: white;">
                            {{ 'البند' }}
                        </th>
                        <th scope="col" class="hideMob col-md-2" style="text-align: -webkit-center;color: white;">
                            {{ 'المبلغ المستحق' }}
                        </th>
                        <th scope="col" class="hideMob col-md-2" style="text-align: -webkit-center;color: white;">
                            {{ 'الموظف' }}
                        </th>
                        <th scope="col" class="hideMob col-md-2" style="text-align: -webkit-center;color: white;">
                            {{ 'المبلغ المدفوع' }}
                        </th>
                        <th scope="col" class="hideMob col-md-2" style="text-align: -webkit-center;color: white;">
                            {{ 'رقم الوصل' }}
                        </th>
                        <th scope="col" class="hideMob col-md-2" style="text-align: -webkit-center;color: white;">
                            {{ 'الموظف' }}
                        </th>
                    </tr>
                    </tbody>
                    <tbody id="debtList">
                    <tr>
                        <td style="color:#1E9FF2">1</td>
                        <td>
                            <input type="text" name="debtname[]" class="form-control alphaFeild"
                                   value="{{'ديون مياه'}}">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtValue newDebtValue1"
                                   {{ in_array($currentempId, $debt0Setting->moneyResponsibleEmp) || sizeof($debt0Setting->moneyResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtTotal();defineNewEmp(1);" name="debtValue[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control newDebtEmp newDebtEmp1" readonly name="newDebtEmp[]">
                            <input type="hidden" class="form-control newDebtEmpID1" name="newDebtEmpID[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtPayed payedDebt1"
                                   {{ in_array($currentempId, $debt0Setting->payedResponsibleEmp) || sizeof($debt0Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtPayed(); defineEmp(1);" name="debtPayed[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="text" class="form-control alphaFeild debtVoucher1" onchange="setRequired(1);"
                                   {{ in_array($currentempId, $debt0Setting->payedResponsibleEmp) || sizeof($debt0Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   name="debtVoucher[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control debtEmp debtEmp1" readonly name="debtEmp[]">
                            <input type="hidden" class="form-control debtEmpID1" name="debtEmpID[]" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2">2</td>
                        <td>
                            <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'صناعات'}}">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtValue newDebtValue2"
                                   {{ in_array($currentempId, $debt1Setting->moneyResponsibleEmp) || sizeof($debt1Setting->moneyResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtTotal();defineNewEmp(2);" name="debtValue[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control newDebtEmp newDebtEmp2" readonly name="newDebtEmp[]">
                            <input type="hidden" class="form-control newDebtEmpID2" name="newDebtEmpID[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtPayed payedDebt2"
                                   {{ in_array($currentempId, $debt1Setting->payedResponsibleEmp) || sizeof($debt1Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtPayed();defineEmp(2);" name="debtPayed[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="text" class="form-control alphaFeild debtVoucher2" onchange="setRequired(2);"
                                   {{ in_array($currentempId, $debt1Setting->payedResponsibleEmp) || sizeof($debt1Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   name="debtVoucher[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control debtEmp debtEmp2" readonly name="debtEmp[]">
                            <input type="hidden" class="form-control debtEmpID2" name="debtEmpID[]" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2">3</td>
                        <td>
                            <input type="text" name="debtname[]" class="form-control alphaFeild"
                                   value="{{'رسوم نفايات'}}">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtValue newDebtValue3"
                                   {{ in_array($currentempId, $debt2Setting->moneyResponsibleEmp) || sizeof($debt2Setting->moneyResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtTotal();defineNewEmp(3);" name="debtValue[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control newDebtEmp newDebtEmp3" readonly name="newDebtEmp[]">
                            <input type="hidden" class="form-control newDebtEmpID3" name="newDebtEmpID[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtPayed payedDebt3"
                                   {{ in_array($currentempId, $debt2Setting->payedResponsibleEmp) || sizeof($debt2Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtPayed();defineEmp(3);" name="debtPayed[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="text" class="form-control alphaFeild debtVoucher3" onchange="setRequired(3);"
                                   {{ in_array($currentempId, $debt2Setting->payedResponsibleEmp) || sizeof($debt2Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   name="debtVoucher[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control debtEmp debtEmp3" readonly name="debtEmp[]">
                            <input type="hidden" class="form-control debtEmpID3" name="debtEmpID[]" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2">4</td>
                        <td>
                            <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'اخري'}}">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtValue newDebtValue4"
                                   {{ in_array($currentempId, $debt3Setting->moneyResponsibleEmp) || sizeof($debt3Setting->moneyResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtTotal();defineNewEmp(4);" name="debtValue[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control newDebtEmp newDebtEmp4" readonly name="newDebtEmp[]">
                            <input type="hidden" class="form-control newDebtEmpID4" name="newDebtEmpID[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtPayed payedDebt4"
                                   {{ in_array($currentempId, $debt3Setting->payedResponsibleEmp) || sizeof($debt3Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtPayed();defineEmp(4);" name="debtPayed[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="text" class="form-control alphaFeild debtVoucher4" onchange="setRequired(4);"
                                   {{ in_array($currentempId, $debt3Setting->payedResponsibleEmp) || sizeof($debt3Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   name="debtVoucher[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control debtEmp debtEmp4" readonly name="debtEmp[]">
                            <input type="hidden" class="form-control debtEmpID4" name="debtEmpID[]" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2">5</td>
                        <td>
                            <input type="text" name="debtname[]" class="form-control alphaFeild"
                                   value="{{'رخص ابنية'}}">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtValue2 newDebtValue5"
                                   {{ in_array($currentempId, $debt4Setting->moneyResponsibleEmp) || sizeof($debt4Setting->moneyResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtTotal();defineNewEmp(5);" name="debtValue[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control newDebtEmp newDebtEmp5" readonly name="newDebtEmp[]">
                            <input type="hidden" class="form-control newDebtEmpID5" name="newDebtEmpID[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtPayed2 payedDebt5"
                                   {{ in_array($currentempId, $debt4Setting->payedResponsibleEmp) || sizeof($debt4Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtPayed();defineEmp(5);" name="debtPayed[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="text" class="form-control alphaFeild debtVoucher5" onchange="setRequired(5);"
                                   {{ in_array($currentempId, $debt4Setting->payedResponsibleEmp) || sizeof($debt4Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   name="debtVoucher[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control debtEmp debtEmp5" readonly name="debtEmp[]">
                            <input type="hidden" class="form-control debtEmpID5" name="debtEmpID[]" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2">6</td>
                        <td>
                            <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'اخري'}}">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtValue2 newDebtValue6"
                                   {{ in_array($currentempId, $debt5Setting->moneyResponsibleEmp) || sizeof($debt5Setting->moneyResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtTotal();defineNewEmp(6);" name="debtValue[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control newDebtEmp newDebtEmp6" readonly
                                   onclick="/*addDebt();*/"
                                   name="newDebtEmp[]">
                            <input type="hidden" class="form-control newDebtEmpID6" name="newDebtEmpID[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild debtPayed2 payedDebt6"
                                   {{ in_array($currentempId, $debt5Setting->payedResponsibleEmp) || sizeof($debt5Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   onblur="calcDebtPayed();defineEmp(6);" name="debtPayed[]" value="">
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="text" class="form-control alphaFeild debtVoucher6" onchange="setRequired(6);"
                                   {{ in_array($currentempId, $debt5Setting->payedResponsibleEmp) || sizeof($debt5Setting->payedResponsibleEmp)==0 ? "" : "readonly" }}
                                   name="debtVoucher[]" value="">
                        </td>
                        <td style="text-align: -webkit-center;">
                            <input type="text" class="form-control debtEmp debtEmp6" readonly onclick="/*addDebt();*/"
                                   name="debtEmp[]">
                            <input type="hidden" class="form-control debtEmpID6" name="debtEmpID[]" value="">
                        </td>
                    </tr>
                    <!--                <tr>
                    <td style="color:#1E9FF2">7</td>
                    <td>
                        <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'رخص حرف'}}">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtValue2" onblur="calcDebtTotal();" name="debtValue[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtPayed2 payedDebt7" onblur="calcDebtPayed();defineEmp(7);" name="debtPayed[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="text" class="form-control alphaFeild debtVoucher7" onchange="setRequired(7);"  name="debtVoucher[]" value="">
                    </td>
                    <td style="text-align: -webkit-center;">
                        <input type="text" class="form-control debtEmp debtEmp7" onclick="/*addDebt();*/" name="debtEmp[]">
                        <input type="hidden" class="form-control"  name="debtEmpID[]" value="">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td style="color:#1E9FF2">8</td>
                    <td>
                        <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'رسوم فتح ملف ترخيص'}}">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtValue2" onblur="calcDebtTotal();" name="debtValue[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtPayed2 payedDebt8" onblur="calcDebtPayed();defineEmp(8);" name="debtPayed[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="text" class="form-control alphaFeild debtVoucher8" onchange="setRequired(8);"  name="debtVoucher[]" value="">
                    </td>
                    <td style="text-align: -webkit-center;">
                        <input type="text" class="form-control debtEmp debtEmp8" onclick="/*addDebt();*/" name="debtEmp[]">
                        <input type="hidden" class="form-control"  name="debtEmpID[]" value="">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td style="color:#1E9FF2">9</td>
                    <td>
                        <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'رخص ابنية'}}">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtValue2" onblur="calcDebtTotal();" name="debtValue[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtPayed2 payedDebt10" onblur="calcDebtPayed();defineEmp(9);" name="debtPayed[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="text" class="form-control alphaFeild debtVoucher9" onchange="setRequired(9);"  name="debtVoucher[]" value="">
                    </td>
                    <td style="text-align: -webkit-center;">
                        <input type="text" class="form-control debtEmp debtEmp9" onclick="/*addDebt();*/" name="debtEmp[]">
                        <input type="hidden" class="form-control"  name="debtEmpID[]" value="">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td style="color:#1E9FF2">10</td>
                    <td>
                        <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'غرامات'}}">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtValue2" onblur="calcDebtTotal();" name="debtValue[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtPayed2 payedDebt10" onblur="calcDebtPayed();defineEmp(10);" name="debtPayed[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="text" class="form-control alphaFeild debtVoucher10" onchange="setRequired(10);"  name="debtVoucher[]" value="">
                    </td>
                    <td style="text-align: -webkit-center;">
                        <input type="text" class="form-control debtEmp debtEmp10" onclick="/*addDebt();*/" name="debtEmp[]">
                        <input type="hidden" class="form-control"  name="debtEmpID[]" value="">
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td style="color:#1E9FF2">11</td>
                    <td>
                        <input type="text" name="debtname[]" class="form-control alphaFeild" value="{{'اخرى'}}">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtValue2" onblur="calcDebtTotal();" name="debtValue[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="number" class="form-control alphaFeild debtPayed2 payedDebt11" onblur="calcDebtPayed();defineEmp(11);" name="debtPayed[]" value="">
                    </td>
                    <td class="hideMob" style="text-align: -webkit-center;">
                        <input type="text" class="form-control alphaFeild debtVoucher11" onchange="setRequired(11);"  name="debtVoucher[]" value="">
                    </td>
                    <td style="text-align: -webkit-center;">
                        <input type="text" class="form-control debtEmp debtEmp11" onclick="/*addDebt();*/" name="debtEmp[]">
                        <input type="hidden" class="form-control"  name="debtEmpID[]" value="">
                    </td>
                    <td>
                    </td>
                </tr>-->
                    </tbody>
                    <tbody id="debtTotalList" class="hideMob">
                    <tr>
                        <td style="color:#1E9FF2"></td>
                        <td style="text-align: left;">
                            {{'المجموع الكلى شيقل'}}
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild" onblur="calcDebtrest();" id="debtTotal"
                                   name="debtTotal" value="">
                        </td>
                        <td style="text-align: left !important;">
                            {{'المجموع الكلى دينار'}}
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild" onblur="calcDebtrest();"
                                   id="debtTotal2" name="debtTotal2" value="">
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2"></td>
                        <td style="text-align: left;">
                            {{'المبلغ المدفوع شيقل'}}
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild" onblur="calcDebtrest();" id="payment"
                                   name="payment" value="">
                        </td>
                        <td style="text-align: left !important;">
                            {{'المبلغ المدفوع دينار'}}
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild" onblur="calcDebtrest();" id="payment2"
                                   name="payment2" value="">
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td style="color:#1E9FF2"></td>
                        <td style="text-align: left;">
                            {{'الباقى شيقل'}}
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild rest" id="rest" name="rest" value="">
                        </td>
                        <td style="text-align: left !important;">
                            {{'الباقى دينار'}}
                        </td>
                        <td class="hideMob" style="text-align: -webkit-center;">
                            <input type="number" class="form-control alphaFeild rest2" id="rest2" name="rest2" value="">
                        </td>
                        <td>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endif

@if($ticketInfo->has_price_list==1)
    <div class="row">
        <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
            <img src="{{ asset('assets/images/ico/cost.png') }}" width="40" height="40">
            <span class="cost-header" style="font-size: 20px;">{{ 'التكاليف' }}

        </span>

        </div>
    </div>
    <div class="row attachs-body" style="margin-left: 25px; margin-right: 25px;">

        <div class="form-group col-12 mb-2">
            <div class="row  hidemob">
                <div class="col-sm-8">
                </div>
                <div class="col-sm-2" style="text-align: center;font-size: 16pt !important;">
                    دينار
                </div>
                <div class="col-sm-2" style="text-align: center;font-size: 16pt !important;">
                    شيقل
                </div>
            </div>
            <ol class="vasType 1vas addRec">
                @if($ticketInfo->ticket_no==13)
                    <li style="font-size: 17px !important;color:#000000">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        {{ 'عدد الامبيرات' }}
                                    </span>
                                        </div>
                                        <input type="text" readonly id="ampereCount" name="ampereCount"
                                               class="form-control" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="input-group" style="width: 100% !important;">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text vasTitle" id="basic-addon1">
                                        سعر الامبير 3 فاز
                                    </span>
                                        </div>
                                        <input type="text" name="ampereCost" id="ampereCost"
                                               class="form-control feesText" value="{{$ampereCost3Vas}}"
                                               onblur="calcAmpereCost()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3" style="margin-bottom: 0px;">
                                <input type="number" readonly name="ampereTotalCost" id="ampereTotalCost"
                                       class="form-control FessVals" value="0">
                            </div>
                        </div>
                    </li>
                @endif
                    <?php $sum = 0;$sum2 = 0; ?>
                @if(count($fees)>0)
                        <?php
                        $arr = json_decode($fees[0]->fees_json); ?>
                    @if(is_array($arr) && sizeof($arr)>0)
                        @foreach($arr as $fee)
                                <?php
                                if ($fee->feesValue == '')
                                    $fee->feesValue = 0;
                                if (!isset($fee->feesValue2) || $fee->feesValue2 == '')
                                    $fee->feesValue2 = 0;
                                $sum += intval($fee->feesValue) * 1;
                                $sum2 += intval($fee->feesValue2 ?? "0") * 1;
                                ?>

                            <li style="font-size: 17px !important;color:#000000">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" name="feesText[]" class="form-control feesText"
                                               value="{{ $fee->feesText}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="feesValue[]" class="form-control FessVals"
                                               value="{{ intval($fee->feesValue)*1}}"
                                               onblur="calcTotal();addExtraRow();" onchange="calcTotal()">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="feesValue2[]" class="form-control FessVals2"
                                               value="{{ intval($fee->feesValue2??"0")*1}}"
                                               onblur="calcTotal();addExtraRow();" onchange="calcTotal()">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @endif
                <li style="font-size: 17px !important;color:#000000">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="text" name="feesText[]" class="form-control feesText"
                                   value="">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" name="feesValue[]" class="form-control FessVals" value="0"
                                   onblur="calcTotal();addExtraRow();" onchange="calcTotal()">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" name="feesValue2[]" class="form-control FessVals2" value="0"
                                   onblur="calcTotal();addExtraRow();" onchange="calcTotal()">
                        </div>
                    </div>
                </li>
            </ol>

            <ol class="vasType 1vas " style="list-style-type: none;">
                <li style="font-size: 17px !important;color:#000000">
                    <div class="row">
                        <div class="col-sm-8">
                            {{ 'الإجمالي' }}
                        </div>
                        <div class="col-sm-2">
                            <input type="number" id="total" disabled name="total" class="form-control"
                                   value="{{intval($sum)}}">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" id="total2" disabled name="total2" class="form-control"
                                   value="{{intval($sum2)}}">
                        </div>
                    </div>
                </li>
            </ol>

        </div>
    </div>
@endif


<script>
  function defineEmp($id) {
    if ($(`.payedDebt ${$id}`).val().length > 0) {
      $(`.debtEmp ${$id}`).val("{{Auth()->user()->nick_name}}");
      $(`.debtEmpID ${$id}`).val("{{Auth()->user()->id}}");
    } else {
      $(`.debtEmp ${$id}`).val("");
      $(`.debtEmpID ${$id}`).val("");
    }
    setRequired($id)
  }

  function defineNewEmp($id) {
    if ($(`.newDebtValue ${$id}`).val().length > 0) {
      $(`.newDebtEmp ${$id}`).val("{{Auth()->user()->nick_name}}");
      $(`.newDebtEmpID ${$id}`).val("{{Auth()->user()->id}}");
    } else {
      $(`.newDebtEmp${$id}`).val("");
      $(`.newDebtEmpID${$id}`).val("");
    }
  }

  function setRequired($id) {
    if ($(`.debtVoucher${$id}`).val().length <= 0 && $(`.payedDebt${$id}`).val().length > 0) {
      $(`.debtVoucher${$id}`).get(0).setCustomValidity('يرجي ادخال رقم الوصل');
      $(`.debtVoucher${$id}`).on('input', function () {
        if ($(`.debtVoucher${$id}`).val().length > 0) {
          this.setCustomValidity('')
        } else {
          this.setCustomValidity('يرجي ادخال رقم الوصل');
        }
      })
    } else {
      $(`.debtVoucher${$id}`).get(0).setCustomValidity('');
    }
  }

  $(document).ready(function () {


    $(".debtEmp").autocomplete({
      source: 'emp_auto_complete',
      minLength: 1,
      select: function (event, ui) {
        // var currentIndex=$("input[name^=debtEmpID]").length -1;
        // $('input[name="debtEmpID[]"]').eq(currentIndex).val(ui.item.id);
      }
    });
  });
  var lastCntr = 6;

  function calcTotal() {
    total = 0;
    total2 = 0;
    $(".FessVals").each(function () {
      if ($(this).val().length > 0)
        total += parseInt($(this).val());
    })
    $(".FessVals2").each(function () {
      if ($(this).val().length > 0)
        total2 += parseInt($(this).val());
    })
    $('#total').val(total);
    $('#total2').val(total2);

  }

  function calcDebtTotal() {

    total = 0;
    total2 = 0;
    $(".debtValue").each(function () {
      if ($(this).val().length > 0)
        total += parseInt($(this).val())
    })
    $(".debtValue2").each(function () {
      if ($(this).val().length > 0)
        total2 += parseInt($(this).val())
    })

    $('#debtTotal').val(total)
    $('#debtTotal2').val(total2)

  }

  function calcDebtPayed() {

    total = 0;
    total2 = 0;
    $(".debtPayed").each(function () {
      if ($(this).val().length > 0)
        total += parseInt($(this).val())
    })
    $(".debtPayed2").each(function () {
      if ($(this).val().length > 0)
        total2 += parseInt($(this).val())
    })

    $('#payment').val(total);
    $('#payment2').val(total2);
    $res = 0;
    $res2 = 0;
    $res = parseInt($('#debtTotal').val()) - parseInt($('#payment').val());
    $res2 = parseInt($('#debtTotal2').val()) - parseInt($('#payment2').val());
    $('.rest').val($res);
    $('.rest2').val($res2);

  }

  function calcDebtrest() {

    $res = 0;
    // if($("#payment").val().length>0){
    $res = $('#debtTotal').val() - $("#payment").val();
    // }
    $('.rest').val($res);

  }

  function addExtraRow() {
    if ($(".feesText").last().val().length > 0) {
      var row = '<li style="font-size: 17px !important;color:#000000"><div class="row">' +
        '<div class="col-sm-8">' +
        '<input type="text" onblur="addExtraRow()" class="form-control feesText" name="feesText[]" value=""> ' +
        '</div>' +
        '<div class="col-sm-2">' +
        '<input type="number" name="feesValue[]" id="feesValue[]" class="form-control FessVals"onblur="calcTotal()" onchange="calcTotal()"> ' +
        '</div>' +
        '<div class="col-sm-2">' +
        '<input type="number" name="feesValue2[]" id="feesValue2[]" class="form-control FessVals2"onblur="calcTotal()" onchange="calcTotal()"> ' +
        '</div>' +
        '</div></li>'

      $(".addRec").append(row)
      setTimeout(function () {
        $(".feesText").last().focus
      }, 900)

    }
  }

  function addDebt() {
    row = '';
    row += '<tr>'
      + '<td style="color:#1E9FF2">' + (lastCntr++) + '</td>'
      + '<td>'
      + '<input type="text" class="form-control alphaFeild" name="debtname[]">'
      + '</td>'
      + '<td class="hideMob" style="text-align: -webkit-center;">'
      + '<input type="number" class="form-control alphaFeild debtValue" onblur="calcDebtTotal();" name="debtValue[]" value="">'
      + '</td>'
      + '<td class="hideMob" style="text-align: -webkit-center;">'
      + '<input type="number" class="form-control alphaFeild debtPayed" onblur="calcDebtPayed();" name="debtPayed[]" value="">'
      + '</td>'
      + '<td class="hideMob" style="text-align: -webkit-center;">'
      + '<input type="text" class="form-control alphaFeild"  name="debtVoucher[]" value="">'
      + '</td>'
      + '<td style="text-align: -webkit-center;">'
      + '<input type="text" class="form-control debtEmp" onclick="addDebt();" name="debtEmp[]">'
      + '<input type="hidden" class="form-control"  name="debtEmpID[]" value="">'
      + '</td>'
      + '<td>'
      + '<a class="remove-btn" onclick="$(this).parent().parent().remove(); calcDebtTotal();" >'
      + '<i class="fa fa-trash" style="color:#1E9FF2;"></i>'
      + '</a>'
      + '</td>'
      + '</tr>';
    $("#debtList").append(row);

    $(".debtEmp").autocomplete({
      source: 'emp_auto_complete',
      minLength: 1,
      select: function (event, ui) {
        // var currentIndex=$("input[name^=debtEmpID]").length -1;
        // $('input[name="debtEmpID[]"]').eq(currentIndex).val(ui.item.id);
      }
    });
  }

</script>
