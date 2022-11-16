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
       {{--<div class="form-group paddmob">
            <div class="input-group w-91">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        {{trans('archive.copy_to')}}
                    </span>
                </div>
                <input type="text" id="connectedToName1" key="1" oninput="deleteHiddenInputs(1);"
                   class="form-control connected-auto-complete" name="connectedToName[]">
                <input type="hidden" class="connectedToID" id="connectedToID1"
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
        </div>--}}
    </div>
</div>
<script>
  let connectedToCount = 0

  function deleteHiddenInputs(key) {
    $(`#connectedToID${key}`).val('');
    $(`#connectedToType${key}`).val('');
  }

  function setConnected(ConnectedTo){
    $('.connected-to').html('')
    connectedToCount=0
    for(let i=0; i<ConnectedTo?.length; i++){
      const connectedTo = `
        <div class="form-group paddmob">
            <div class="input-group group${(i+1)} w-91">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        ارشيف
                    </span>
                </div>
                <input type="text" id="connectedToName${(i+1)}" key="${(i+1)}" oninput="deleteHiddenInputs(${(i+1)});"
                       class="form-control connected-auto-complete" name="connectedToName[]" value="${(ConnectedTo[i]?.title??'')}">
                <input type="hidden" class="connectedToID" key="${(i+1)}" id="connectedToID${(i+1)}"
                       name="connectedToID[]" value="${(ConnectedTo[i]?.id??'')}">
                <input type="hidden" class="connectedToType" id="connectedToType${(i+1)}"
                       name="connectedToType[]" key="${(i+1)}" value="${(ConnectedTo[i]?.type??'')}">
                <a class="input-group-append" onclick="$(this).parent().parent().remove()"
                     style="cursor:pointer">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-trash"></i>
                    </span>
                </a>
                <a class="input-group-append forward${(i+1)} ml-3" onclick="goToArchive('${(ConnectedTo[i]?.url)}',${(ConnectedTo[i]?.id)})"
                     style="cursor:pointer">
                    <span class="input-group-text input-group-text2">
                        <i class="fa fa-share"></i>
                    </span>
                </a>
            </div>
        </div>
        `
      $('.connected-to').append(connectedTo);
    }
    setAutoComplete()
    connectedToCount=(ConnectedTo?.length??0)
  }

  function addConnectedTo() {
    connectedToCount++;
    const connectedTo = `
    <div class="form-group paddmob">
        <div class="input-group group${(connectedToCount)} w-91">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">
                    ارشيف
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
    setAutoComplete()
  }

  function setAutoComplete(){
    $(".connected-auto-complete").autocomplete({
      source: 'get_archive',
      minLength: 1,
      select: function (event, ui) {
        const key=event.target?.attributes?.key?.value;
        $(`#connectedToID${key}`).val(ui.item.id);
        $(`#connectedToType${key}`).val(ui.item.type);
        $(`.forward${key}`)?.remove();
        $(`.group${key}`).append(`
            <a class="input-group-append forward${key} ml-3" onclick="goToArchive('${(ui.item.url)}',${(ui.item.id)})"
                 style="cursor:pointer">
                <span class="input-group-text input-group-text2">
                    <i class="fa fa-share"></i>
                </span>
            </a>
        `);
      }
    });
  }

  function goToArchive(url,id){
    if(url==='contract_archieve'){
      url='dep_archieve';
    }
    const completeUrl=`{{ route('admin.dashboard') }}/${url}?id=${id}`
    window.open(completeUrl, '_blank');
  }

  $(function () {
    setAutoComplete()
  });
</script>