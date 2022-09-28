<div class="row" style="position: relative; "> 
    <div class="col-md-7">
        <div class="form-group paddmob">
            <div class="input-group subscribermob">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'مقدم الطلب' }}
                    </span>
                </div>
                <input type="text" id="subscriber_name" 
                    class="form-control numFeild" placeholder="{{ 'مقدم الطلب' }}"
                    @if(isset($ticket))
                    value="{{ $ticket->customer_name }}"
                    readonly
                    @endif
                    name="subscriber_name">
                <input type="hidden" id="subscriber_id"
                @if(isset($ticket))
                value="{{ $ticket->customer_id }}"
                @endif
                name="subscriber_id" value="0" 
                    @if(isset($ticket))
                    value="{{ $ticket->customer_id }}"
                    @endif>
            </div>
        </div>
    </div>
    <div class="col-md-4 paddleft">
        <div class="form-group paddmob">
            <div class="input-group width100" >
                <div class="input-group-prepend">
                    <span class="input-group-text input-group-text1" id="basic-addon1">
                        <img id="mobImg" src="https://db.expand.ps/images/jawwal35.png">
                    </span>
                </div>
                <input type="text" id="MobileNo"  maxlength="10" name="MobileNo"
                    class="form-control noleft numFeild" placeholder="0590000000"
                    @if(isset($ticket))
                    value="{{ $ticket->customer_mobile }}"
                    @endif
                    aria-describedby="basic-addon1"
                    onblur="$('#username').val($(this).val())">
            </div>
        </div>
    </div>
</div>
{{-- ticket 39 & 40 has its owne national id --}}
@if($ticketInfo->show_nationalID == 1 && $ticketInfo->ticket_no != 39 && $ticketInfo->ticket_no != 40)
<div class="row" style="position: relative; ">
    <div class="col-md-7">
        <div class="form-group paddmob">
            <div class="input-group" style="width: 93% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'رقم الهوية' }}
                    </span>
                </div>
                <input type="text" id="national_id" maxlength="9" minlength="9"
                    class="form-control numFeild" placeholder="{{ 'رقم الهوية' }}"
                    @if(isset($ticket))
                    value="{{ $ticket->national_id }}"
                    readonly
                    @endif
                    name="national_id">
                @if($ticketInfo->ticket_no == 19)   
                <div class="input-group-append" onclick="addNewBeneficiary()" style="cursor:pointer">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif