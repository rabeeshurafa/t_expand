<div class="row">
    <div class="col-md-1">
        <a class="input-group-append " onclick="addConnectedTo()"
           style="cursor:pointer">
            <span class="input-group-text input-group-text2 ml-0" style="font-size: 16px !important;font-weight: 500;">
                <i class="fa fa-plus" style="padding-left: 5px;"></i>
                اضافة ارتباط
            </span>
        </a>
    </div>
</div>
<div class="row cop">
    <div class="col-md-8 connected-to">
        <!--        <div class="form-group paddmob">
            <div class="input-group w-91">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{trans('archive.copy_to')}}
        </span>
    </div>
    <input type="text" id="connectedToName1" key="1" oninput="deleteHiddenInputs(1);"
           class="form-control connected-auto-complete" name="connectedToName[]">
                <input type="hidden" class="connectedToID" id="connectedToID[]"
                       name="connectedToID[]" key="1" value="0">
                <input type="hidden" class="connectedToType" id="connectedToType1"
                       name="connectedToType[]" key="1" value="0">
                <div class="input-group-append" onclick="addRec()"
                     style="cursor:pointer">
                        <span class="input-group-text input-group-text2">
                            <i class="fa fa-plus"></i>
                        </span>
                </div>
            </div>
        </div>-->
    </div>
</div>
<script>
  let connectedToCount = 0

  function deleteHiddenInputs(key) {
    $(`#connectedToID${key}`).val('');
    $(`#connectedToType${key}`).val('');
  }

  function addConnectedTo() {
    connectedToCount++;
    const connectedTo = `
    <div class="form-group paddmob">
        <div class="input-group w-91">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                    {{trans('archive.copy_to')}}
                </span>
            </div>
            <input type="text" id="connectedToName${connectedToCount}" key="${connectedToCount}" oninput="deleteHiddenInputs(${connectedToCount});"
                   class="form-control connected-auto-complete" name="connectedToName[]">
            <input type="hidden" class="connectedToID" key="${connectedToCount}" id="connectedToID${connectedToCount}"
                   name="connectedToID[]" value="0">
            <input type="hidden" class="connectedToType" id="connectedToType${connectedToCount}"
                   name="connectedToType[]" key="${connectedToCount}" value="0">
            <div class="input-group-append" onclick="$(this).parent().parent().remove()"
                 style="cursor:pointer">
                <span class="input-group-text input-group-text2">
                    <i class="fa fa-trash"></i>
                </span>
            </div>
        </div>
    </div>
    `
    $('.connected-to').append(connectedTo);
    $(".connected-auto-complete").autocomplete({
      source: 'get_archive',
      minLength: 1,
      select: function (event, ui) {
        const key=event.target?.attributes?.key?.value;
        $(`#connectedToID${key}`).val(ui.item.id);
        $(`#connectedToType${key}`).val(ui.item.type);
      }
    });
  }

  $(function () {
    $(".connected-auto-complete").autocomplete({
      source: 'get_archive',
      minLength: 1,
      select: function (event, ui) {
        const key=event.target?.attributes?.key?.value;
        $(`#connectedToID${key}`).val(ui.item.id);
        $(`#connectedToType${key}`).val(ui.item.type);
      }
    });
  });
</script>