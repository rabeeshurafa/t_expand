<div class="row" style="position: relative; "> 
    <div class="col-md-6">
        <div class="form-group ">
            <div class="input-group subscribermob">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'الاسم' }}
                    </span>
                </div>
                <input type="text" id="customer_name"
                    class="form-control numFeild" placeholder=""
                    name="customer_name">
                <input type="hidden" id="subscriber_id"  name="subscriber_id" value="0">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group ">
            <div class="input-group subscribermob">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'رقم الهوية' }}
                    </span>
                </div>
                <input type="text" id="national_id" maxlength="9" minlength="9"
                       class="form-control numFeild" placeholder="{{ 'رقم الهوية' }}"
                       name="national_id">

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group ">
            <div class="input-group" >
                <div class="input-group-prepend">
                    <span class="input-group-text input-group-text1" id="basic-addon1">
                        <img id="mobImg" src="https://db.expand.ps/images/w35.png">
                    </span>
                </div>
                <input type="text" id="MobileNo"  maxlength="10" name="MobileNo"
                    class="form-control noleft numFeild" placeholder="0590000000"
                    aria-describedby="basic-addon1"
                    onblur="$('#username').val($(this).val())">
            </div>
        </div>
    </div>
</div>