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
        <a id="customer_location" href="https://www.google.com/maps/place/%D8%A8%D9%8A%D8%AA%D8%A7+%D8%A7%D9%84%D9%81%D9%88%D9%82%D8%A7%E2%80%AD/@32.1413383,35.2890394,14z/data=!3m1!4b1!4m5!3m4!1s0x151cde8e09aea509:0x5f1f34e632ceeef1!8m2!3d32.14134!4d35.286399" target="_blank">
            <img src="https://db.expand.ps/images/google35.png" style="    margin-left: -5px;;width:32px;height:32px;border-radius: 5px;"></a>
    </div>
</div>