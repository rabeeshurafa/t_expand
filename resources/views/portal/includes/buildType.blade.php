<div class="row ">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text " id="basic-addon1">
                        {{ 'نوع البناء' }}
                    </span>
                </div>
                <select id="buildingType" name="buildingType" type="text"
                    class="form-control valid" aria-invalid="false">
                    @foreach($buildingTypeList as $buildingType)
                    <option value="{{ $buildingType->id }}">{{ $buildingType->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>