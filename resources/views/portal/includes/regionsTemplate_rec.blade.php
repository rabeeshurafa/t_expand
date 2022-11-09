<div class="row">

    <div class="col-md-4 padd0left">
        <div class="form-group paddmob">

            <div class="input-group width100 addressinputmob">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                    المنطقة
                    </span>
                </div>
                <select id="AreaID" {{ $readonly?"readonly":"" }} name="AreaID" type="text" style="height: 36px !important" class="form-control">

                    @foreach($helpers['region'] as $sub)
                    <option value="{{ $sub->id }}" {{ $ticket->region==$sub->id?'selected':"" }}>{{ $sub->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
    </div>

    <div class="col-md-7 des-p-l22">
        <div class="form-group paddmob">
            <div class="input-group width95 addressinputmob">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{ 'العنوان بالتفصيل' }}
                    </span>
                </div>
                <textarea type="text" {{ $readonly?"readonly":"" }} id="Address" class="form-control"
                 value="" name="Address" style="height: 35px;">{{ $ticket->address }}</textarea>

            </div>
        </div>
    </div>
    <div class="col-md-1 hidemob" style="padding-right: 8px;" >
        <a id="customer_location" href="https://www.google.com/maps/place/%D9%82%D8%B7%D9%86%D8%A9%E2%80%AD/@31.826923,35.1102,15z/data=!4m5!3m4!1s0x1502d13f350757bf:0xfe87f6d80cc3de8f!8m2!3d31.826923!4d35.1102" target="_blank">
            <img src="https://db.expand.ps/images/google35.png" style="    margin-left: -5px;;width:32px;height:32px;border-radius: 5px;"></a>
    </div>
</div>
