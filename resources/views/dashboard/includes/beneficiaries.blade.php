
<div class="Beneficiaries">
    @if(isset($ticket))
        @for($i=0; $i<sizeof($ticket->beneficiaries); $i++)
        <?php
        $beneficiary=$ticket->beneficiaries[$i];
        ?>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <div class="input-group" style="width: 94.5% !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                            مقدم الطلب
                            </span>
                        </div>
                        <input type="text" id="beneficiaryName[]"
                               class="form-control alphaFeild ui-autocomplete-input beneficiaryName beneficiaryName1"
                               placeholder="مقدم الطلب"
                               name="beneficiaryName[]" autocomplete="off" itemIndex="{{$i}}" {{ $readonly?"readonly":"" }} value="{{$beneficiary->beneficiaryName}}">
                        <input type="hidden" name="beneficiaryID[]" id="beneficiaryID[]" class="{{'beneficiaryID'.$i}}" value="{{$beneficiary->beneficiaryID}}">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-group-text1"
                                id="basic-addon1">
                                <img src="https://c.palexpand.ps/assets/images/ico/new_phone1.png">
                            </span>
                        </div>
                        <input type="text" id="beneficiaryPhone[]"
                               class="form-control alphaFeild noleft ui-autocomplete-input {{'beneficiaryPhone'.$i}} " {{ $readonly?"readonly":"" }}
                               placeholder="رقم الهاتف"  maxlength="10"
                               name="beneficiaryPhone[]" autocomplete="off" value="{{$beneficiary->beneficiaryNationalId}}">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <div class="input-group" style="width: 93% !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                            رقم الهوية
                            </span>
                        </div>
                        <input type="text" id="beneficiaryNationalId[]"
                               class="form-control alphaFeild ui-autocomplete-input {{'beneficiaryNationalId'.$i}}" {{ $readonly?"readonly":"" }}
                               placeholder="رقم الهوية" maxlength="9"
                               name="beneficiaryNationalId[]" autocomplete="off" value="{{$beneficiary->beneficiaryNationalId}}">
                        <div class="input-group-append" onclick="$(this).parent().parent().parent().parent().parent().remove()" style="cursor:pointer">
                            <span class="input-group-text input-group-text2">
                                <i class="fa fa-trash"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    @else
    {{--<div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <div class="input-group" style="width: 94.5% !important;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                        مقدم الطلب
                        </span>
                    </div>
                    <input type="text" id="beneficiaryName[]"
                           class="form-control alphaFeild ui-autocomplete-input beneficiaryName beneficiaryName1"
                           placeholder="مقدم الطلب"
                           name="beneficiaryName[]" autocomplete="off" itemIndex="1" >
                    <input type="hidden" name="beneficiaryID[]" id="beneficiaryID[]" class="beneficiaryID1">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text input-group-text1"
                            id="basic-addon1">
                            <img src="https://c.palexpand.ps/assets/images/ico/new_phone1.png">
                        </span>
                    </div>
                    <input type="text" id="beneficiaryPhone[]"
                           class="form-control alphaFeild noleft ui-autocomplete-input beneficiaryPhone1"
                           placeholder="رقم الهاتف"  maxlength="10"
                           name="beneficiaryPhone[]" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <div class="input-group" style="width: 93% !important;">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                        رقم الهوية
                        </span>
                    </div>
                    <input type="text" id="beneficiaryNationalId[]"
                           class="form-control alphaFeild ui-autocomplete-input beneficiaryNationalId1"
                           placeholder="رقم الهوية" maxlength="9"
                           name="beneficiaryNationalId[]" autocomplete="off">
                    <div class="input-group-append" onclick="$(this).parent().parent().parent().parent().parent().remove()" style="cursor:pointer">
                        <span class="input-group-text input-group-text2">
                            <i class="fa fa-trash"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    @endif
</div>
<script>
$(document).ready(function () {
    $( ".beneficiaryName" ).autocomplete({
    	source:'{{ route('subscribe_auto_complete') }}',
    	minLength: 1,
        select: function( event, ui ) {
            // console.log(event.target.attributes.itemindex.value);
            itemindex=event.target.attributes.itemindex.value;
            $(`.beneficiaryID${itemindex}`).val(ui.item.id)
            $(`.beneficiaryNationalId${itemindex}`).val(ui.item.national_id)
            $(`.beneficiaryPhone${itemindex}`).val((ui.item.phone_one??ui.item.phone_two))
    	}
    });
});
beneficiariesCount =0;
<?php if(isset($ticket)){ ?>
beneficiariesCount ='{{sizeof($ticket->beneficiaries)+1}}';
<?php } ?>
function addNewBeneficiary() {

        beneficiariesCount++;
        newBeneficiary = `
        <div>
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div class="input-group" style="width: 94.5% !important;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                مقدم الطلب
                                </span>
                            </div>
                            <input type="text" id="beneficiaryName[]" itemIndex="${beneficiariesCount}" class="form-control alphaFeild ui-autocomplete-input beneficiaryName beneficiaryName${beneficiariesCount}"
                                    placeholder="مقدم الطلب"
                                    name="beneficiaryName[]" autocomplete="off">
                            <input type="hidden" name="beneficiaryID[]" id="beneficiaryID[]" class="beneficiaryID${beneficiariesCount}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-group-text1"
                                    id="basic-addon1">
                                    <img src="https://c.palexpand.ps/assets/images/ico/new_phone1.png">
                                </span>
                            </div>
                            <input type="text" id="beneficiaryPhone[]" class="form-control alphaFeild noleft ui-autocomplete-input beneficiaryPhone${beneficiariesCount}"
                                    placeholder="رقم الهاتف"
                                    maxlength="10"
                                    name="beneficiaryPhone[]" autocomplete="off">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <div class="input-group" style="width: 93% !important;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                رقم الهوية
                                </span>
                            </div>
                            <input type="text" id="beneficiaryNationalId[]" class="form-control alphaFeild ui-autocomplete-input beneficiaryNationalId${beneficiariesCount}"
                                    placeholder="رقم الهوية"
                                    name="beneficiaryNationalId[]"
                                    maxlength="9"
                                    autocomplete="off">
                            <div class="input-group-append" onclick="$(this).parent().parent().parent().parent().parent().remove()" style="cursor:pointer">
                                <span class="input-group-text input-group-text2">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `
        $('.Beneficiaries').append(newBeneficiary)
        $( ".beneficiaryName" ).autocomplete({
    	    source:'{{ route('subscribe_auto_complete') }}',
        	minLength: 1,
            select: function( event, ui ) {
            itemindex=event.target.attributes.itemindex.value;
            $(`.beneficiaryID${itemindex}`).val(ui.item.id)
            $(`.beneficiaryNationalId${itemindex}`).val(ui.item.national_id)
            $(`.beneficiaryPhone${itemindex}`).val((ui.item.phone_one??ui.item.phone_two))
        	}
        });
}
</script>