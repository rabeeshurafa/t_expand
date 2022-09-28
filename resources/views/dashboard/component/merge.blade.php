<div class="modal fade text-left" id="mergeModal" tabindex="-1" role="dialog" aria-labelledby="mergeModal"aria-hidden="true">
    <div class="modal-dialog" style="width: 30%;"  role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="mergeModal">
                  دمج المواطنين مع
                    (<span id="mergeModalname"></span>)
                </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="row ">
                        <div class="col-sm-12">
                            <div class="form-group">
                                @csrf
                                <form method="post" id="mergeForm" enctype="multipart/form-data">
                                    <input type="hidden" id="superMergerID" name="superMergerID" value="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group width99 width98rtl widthsub" style="">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">{{ trans('admin.subscriber_name') }}</span>
                                                    </div>
                                                    <input type="text" id="mergerName" class="form-control alphaFeild mergeac ui-autocomplete-input"
                                                        placeholder="{{ trans('admin.subscriber_name') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div id="newMerge">
                                        
                                    </div>
                                    <div class="form-actions" style="border-top:0px;">
                                        <div class="text-right">
                                            <button id="mergeSaveBtn" type="button" onclick="confirme();" class="btn btn-primary">
                                                دمج المواطنين
                                                <i class="ft-thumbs-up position-right"></i>
                                            </button>  
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {

    $(".mergeac").autocomplete({

        source: 'subscribe_auto_complete',

        minLength: 1,

        select: function(event, ui) {
            $('#mergerName').val('');
            addnewMerge(ui.item.name,ui.item.id);
        }

    });

});

function addnewMerge(name,id){
    
    row=`<div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <div class="input-group width99 width98rtl widthsub" style="">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">{{ trans('admin.subscriber_name') }}</span>
                    </div>
                    <input type="text" readonly="readonly" class="form-control alphaFeild mergeac ui-autocomplete-input"
                        placeholder="{{ trans('admin.subscriber_name') }}"
                        name="mergerName[]" value="${name}" autocomplete="off">
                </div>
            </div>
        </div>
        <input type="hidden" name="mergerID[]" value="${id}">
        <div class="attdelmob">
            <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().remove()"></i>
        </div>
    </div>`
    $('#newMerge').append(row);
    
    setTimeout(function(){$('#mergerName').val('')},300)
}


function confirme() {

    text=" يرجي العلم انه سيتم حذف جميع المواطنين المراد دمجهم مع ";
    text+=$('#mergeModalname').html();
    text+=' ونقل جميع المعاملا والاشتراكات والرخص إلى ';
    text+=$('#mergeModalname').html();
    text+=" ولايمكن ارجاع العملية ";
    Swal.fire({
      title: 'هل انت متأكد من عملية الدمج؟',
      text: text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'نعم',
      cancelButtonText: 'لا',
    }).then((result) => {
        if (result.isConfirmed) {
            doMerge()
        }else if (result.dismiss === Swal.DismissReason.cancel) {
            return false;
        }
    })
    
    
   
}


function doMerge(){
    $(".loader").removeClass('hide');
    $(".form-actions").addClass('hide');
    
    var formData = new FormData($("#mergeForm")[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
          type:'POST',
          url: "{{route('mergeSubscribers')}}",
           data: formData,
           contentType: false,
           processData:false ,
           //dataType:json ,
           success: (response) => {
                if (response) {
                    $(".loader").addClass('hide');
                    $(".form-actions").removeClass('hide');
                    if(response.success !=null){
        			    Swal.fire({
            				position: 'top-center',
            				icon: 'success',
            				title: 'تمت عملية الدمج بنجاح',
            				showConfirmButton: false,
            				timer: 1500
        				})
    				setTimeout(function(){self.location='{{route("subscribers")}}?id='+(response.super??0)},100)
                    }else if(response.error =='No Super'){
                        Swal.fire({
            				position: 'top-center',
            				icon: 'error',
            				title: 'يرجي اختيار المواطن الرئيسي لعملية الدمج',
            				showConfirmButton: false,
            				timer: 1500
        				})
                    }else if(response.error =='No subsriber'){
                        Swal.fire({
            				position: 'top-center',
            				icon: 'error',
            				title: 'يرجي اختيار المواطنين المراد دمجهم ',
            				showConfirmButton: false,
            				timer: 1500
        				})
                    }
                     
                }
            },
           error: function(response){
            $(".loader").addClass('hide');
            $(".form-actions").removeClass('hide');
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'خطاء في عملية الدمج',
				showConfirmButton: false,
				timer: 1500
				})
           }
       });
}

</script>

