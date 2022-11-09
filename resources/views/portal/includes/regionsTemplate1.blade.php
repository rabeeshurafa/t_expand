<div class="row">
    <div class="col-md-4">
        <div class="form-group">

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                    المنطقة
                    </span>
                </div>
                <select id="AreaID1" name="AreaID1" type="text" style="height: 36px !important" class="form-control">
                    <option value=""> -- اختر --</option>
                    @foreach($region as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-7" style="padding-left: 7px">
        <div class="form-group">
            <div class="input-group" style="width:100% !important;">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'العنوان بالتفصيل' }}
                    </span>
                </div>
                <textarea type="text" id="Address1" class="form-control"
                    placeholder="العنوان بالتفصيل" name="A1ddress"
                    style="height: 35px;"></textarea>

            </div>
        </div>
    </div>
    <div class="col-md-1 " style="padding-right: 18px;" >
        <a id="customer_location" href="https://www.google.com/maps/place/%D9%82%D8%B7%D9%86%D8%A9%E2%80%AD/@31.826923,35.1102,15z/data=!4m5!3m4!1s0x1502d13f350757bf:0xfe87f6d80cc3de8f!8m2!3d31.826923!4d35.1102" target="_blank">
            <img src="https://db.expand.ps/images/google35.png" style="    margin-left: -5px;;width:32px;height:32px;border-radius: 5px;"></a>
    </div>
</div>
