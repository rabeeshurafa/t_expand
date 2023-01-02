<style>
    .select2-container--default {
        width: 70% !important;
    }
</style>

<div class="modal fade text-left" id="ClearanceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
     aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 50%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">
                    إعدادات براءة الذمة
                    ({{ $ticketInfo->ticket_name }})
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: #f4f5fa">
                <form method="post" id="debtConfigModal" enctype="multipart/form-data">
                    <div class="form-body">
                        @csrf
                        <div class="row DisabledItem white-row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card ">
                                    <div class="card-content collapse show">
                                        <div class="card-body" style="padding-bottom: 0px;">
                                            <div class="form-body">
                                                <input type="hidden" id="id" name="id" value="{{$ticketInfo->id}}">
                                                <div class="input-group col-md-12" style="font-size: 15pt !important;">
                                                    {{"ديون مياه"}}
                                                    <input type="hidden" id="debtIndex" name="debtIndex[]" value="1">
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-12 attachs-section"
                                                         style="margin-left: 0px; margin-right: 0px;text-align: right;margin-bottom: 0;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group col-md-4 pr-5 pl-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">
                                                            {{"اجباري"}}
                                                        </span>
                                                        </div>
                                                        <select type="text" id="isDebtMandatory1"
                                                                name="isDebtMandatory[]"
                                                                class="form-control myselect2"
                                                                aria-invalid="false"
                                                                style="height: 34px !important;">
                                                            <option
                                                                    value="1" {{ $debt0Setting->isDebtMandatory==1?'selected':'' }}> {{'نعم'}} </option>
                                                            <option
                                                                    value="2" {{ $debt0Setting->isDebtMandatory==2?'selected':'' }}> {{'لا'}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المطلوب' }}
                                                            </span>
                                                        </div>
                                                        <select id="moneyResponsibleEmp1" name="moneyResponsibleEmp1[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt0Setting->moneyResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المدفوع' }}
                                                            </span>
                                                        </div>
                                                        <select id="payedResponsibleEmp1" name="payedResponsibleEmp1[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt0Setting->payedResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group col-md-12" style="font-size: 15pt !important;">
                                                    {{"صناعات"}}
                                                    <input type="hidden" id="debtIndex" name="debtIndex[]" value="2">
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-12 attachs-section"
                                                         style="margin-left: 0px; margin-right: 0px;text-align: right;margin-bottom: 0;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group col-md-4 pr-5 pl-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">
                                                            {{"اجباري"}}
                                                        </span>
                                                        </div>
                                                        <select type="text" id="isDebtMandatory1"
                                                                name="isDebtMandatory[]"
                                                                class="form-control myselect2"
                                                                aria-invalid="false"
                                                                style="height: 34px !important;">
                                                            <option
                                                                    value="1" {{ $debt1Setting->isDebtMandatory==1?'selected':'' }}> {{'نعم'}} </option>
                                                            <option
                                                                    value="2" {{ $debt1Setting->isDebtMandatory==2?'selected':'' }}> {{'لا'}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المطلوب' }}
                                                            </span>
                                                        </div>
                                                        <select id="moneyResponsibleEmp2" name="moneyResponsibleEmp2[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt1Setting->moneyResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المدفوع' }}
                                                            </span>
                                                        </div>
                                                        <select id="payedResponsibleEmp2" name="payedResponsibleEmp2[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt1Setting->payedResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group col-md-12" style="font-size: 15pt !important;">
                                                    {{"رسوم نفايات"}}
                                                    <input type="hidden" id="debtIndex" name="debtIndex[]" value="3">
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-12 attachs-section"
                                                         style="margin-left: 0px; margin-right: 0px;text-align: right;margin-bottom: 0;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group col-md-4 pr-5 pl-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">
                                                            {{"اجباري"}}
                                                        </span>
                                                        </div>
                                                        <select type="text" id="isDebtMandatory1"
                                                                name="isDebtMandatory[]"
                                                                class="form-control myselect2"
                                                                aria-invalid="false"
                                                                style="height: 34px !important;">
                                                            <option
                                                                    value="1" {{ $debt2Setting->isDebtMandatory==1?'selected':'' }}> {{'نعم'}} </option>
                                                            <option
                                                                    value="2" {{ $debt2Setting->isDebtMandatory==2?'selected':'' }}> {{'لا'}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المطلوب' }}
                                                            </span>
                                                        </div>
                                                        <select id="moneyResponsibleEmp3" name="moneyResponsibleEmp3[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt2Setting->moneyResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المدفوع' }}
                                                            </span>
                                                        </div>
                                                        <select id="payedResponsibleEmp3" name="payedResponsibleEmp3[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt2Setting->payedResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group col-md-12" style="font-size: 15pt !important;">
                                                    {{"اخري"}}
                                                    <input type="hidden" id="debtIndex" name="debtIndex[]" value="4">
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-12 attachs-section"
                                                         style="margin-left: 0px; margin-right: 0px;text-align: right;margin-bottom: 0;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group col-md-4 pr-5 pl-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">
                                                            {{"اجباري"}}
                                                        </span>
                                                        </div>
                                                        <select type="text" id="isDebtMandatory1"
                                                                name="isDebtMandatory[]"
                                                                class="form-control myselect2"
                                                                aria-invalid="false"
                                                                style="height: 34px !important;">
                                                            <option
                                                                    value="1" {{ $debt3Setting->isDebtMandatory==1?'selected':'' }}> {{'نعم'}} </option>
                                                            <option
                                                                    value="2" {{ $debt3Setting->isDebtMandatory==2?'selected':'' }}> {{'لا'}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المطلوب' }}
                                                            </span>
                                                        </div>
                                                        <select id="moneyResponsibleEmp4" name="moneyResponsibleEmp4[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt3Setting->moneyResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المدفوع' }}
                                                            </span>
                                                        </div>
                                                        <select id="payedResponsibleEmp4" name="payedResponsibleEmp4[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt3Setting->payedResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group col-md-12" style="font-size: 15pt !important;">
                                                    {{"رخص ابنية"}}
                                                    <input type="hidden" id="debtIndex" name="debtIndex[]" value="5">
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-12 attachs-section"
                                                         style="margin-left: 0px; margin-right: 0px;text-align: right;margin-bottom: 0;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group col-md-4 pr-5 pl-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">
                                                            {{"اجباري"}}
                                                        </span>
                                                        </div>
                                                        <select type="text" id="isDebtMandatory1"
                                                                name="isDebtMandatory[]"
                                                                class="form-control myselect2"
                                                                aria-invalid="false"
                                                                style="height: 34px !important;">
                                                            <option
                                                                    value="1" {{ $debt4Setting->isDebtMandatory==1?'selected':'' }}> {{'نعم'}} </option>
                                                            <option
                                                                    value="2" {{ $debt4Setting->isDebtMandatory==2?'selected':'' }}> {{'لا'}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المطلوب' }}
                                                            </span>
                                                        </div>
                                                        <select id="moneyResponsibleEmp5" name="moneyResponsibleEmp5[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt4Setting->moneyResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المدفوع' }}
                                                            </span>
                                                        </div>
                                                        <select id="payedResponsibleEmp5" name="payedResponsibleEmp5[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt4Setting->payedResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="input-group col-md-12" style="font-size: 15pt !important;">
                                                    {{"اخري"}}
                                                    <input type="hidden" id="debtIndex" name="debtIndex[]" value="6">
                                                </div>
                                                <div class="row" style="margin-bottom:10px;">
                                                    <div class="col-md-12 attachs-section"
                                                         style="margin-left: 0px; margin-right: 0px;text-align: right;margin-bottom: 0;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group col-md-4 pr-5 pl-0">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text"
                                                              id="basic-addon1">
                                                            {{"اجباري"}}
                                                        </span>
                                                        </div>
                                                        <select type="text" id="isDebtMandatory1"
                                                                name="isDebtMandatory[]"
                                                                class="form-control myselect2"
                                                                aria-invalid="false"
                                                                style="height: 34px !important;">
                                                            <option
                                                                    value="1" {{ $debt5Setting->isDebtMandatory==1?'selected':'' }}> {{'نعم'}} </option>
                                                            <option
                                                                    value="2" {{ $debt5Setting->isDebtMandatory==2?'selected':'' }}> {{'لا'}} </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المطلوب' }}
                                                            </span>
                                                        </div>
                                                        <select id="moneyResponsibleEmp6" name="moneyResponsibleEmp6[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt5Setting->moneyResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend" style="width:30% ;">
                                                            <span class="input-group-text" id="basic-addon1"
                                                                  style=" width: 100%; ">
                                                                {{ 'المسؤول عن المبلغ المدفوع' }}
                                                            </span>
                                                        </div>
                                                        <select id="payedResponsibleEmp6" name="payedResponsibleEmp6[]"
                                                                class="select2 form-control" multiple="multiple"
                                                                data-toggle="select" style="width:75%;">
                                                            @if (isset($employees) && !empty($employees) && count($employees) > 0)
                                                                @foreach ($employees as $key => $value)
                                                                    <option value="{{$value->id}}" {{ in_array($value->id, $debt5Setting->payedResponsibleEmp) ? "selected" : "" }}>
                                                                        {{$value->nick_name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-actions" style="border-top:0px; padding-bottom:44px;">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary"
                                                                id="saveBtn">
                                                            <i class="la la-check-square-o"></i>
                                                            حفظ
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
<script>
    $('#ClearanceModal').on('hidden.bs.modal', function (e)
        {
            location.reload(true);
        }
    )
    $('#debtConfigModal').submit(function (e) {
        $(".loader").removeClass('hide');
        let formData = new FormData(this);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{route('storeDebtSittings')}}",
            data: formData,
            contentType: false,
            processData: false,
            //dataType:json ,
            success: (response) => {
                if (response) {
                    $(".loader").addClass('hide');
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'تم حفظ الإعدادات',
                        showConfirmButton: false,
                        timer: 1500
                    })
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
    });

    function ShowClearanceModal(bindTo) {
        $("#ClearanceModal").modal('show')
    }
</script>