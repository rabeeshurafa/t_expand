@if($ticketInfo->has_attach==1)
<div class="row">
    <div class="col-md attachs-section" style="margin-left: 25px; margin-right: 25px;">
        <img src="https://db.expand.ps/images/upload.png" width="40" height="40">
        <span class="attach-header">{{ 'المرفقات' }}
            <span id="attach-required" class="attach-required" style="display: none;">*</span>

        </span>
        <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"  style="cursor:pointer;    float: left;" onclick="scanToJpg();">

        <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;    float: left;" onclick="scanTopdf();">
    </div>
    
</div>
<div class="row attachs-body">
    <div class="form-group col-12 mb-2">

        <ol class="vasType 1vas addAttatch olmob">
            <li style="font-size: 17px !important;color:#000000">
                <div class="row">
                    <div class="col-sm-5 attmob">
                        <input type="text" id="attachName[]" name="attachName[]" class="form-control attachName" placeholder="أخل اسم المرفق"
                         {{$ticketInfo->force_attach==1?"reuired":"" }}   value="">
                    </div>
                    <div class="attdocmob col-sm-5 attach_row_1 ">
                        
                    </div>
                    <div>
                        <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                            height="40" style="cursor:pointer"
                            onclick="$('#currFile').val(($('#currFile').val()==null || $('#currFile').val()=='' ? 1 : $('#currFile').val()));$('#attachfile').trigger('click');">
                    </div>
                    <div class="attdelmob">
                        <i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$('.attach_row_1').children().remove();"></i>
                    </div>
                </div>
                
            </li>
        </ol>
        <input type="hidden" id="currFile" name="currFile">
        <input type="file" style="display:none" id="attachfile" name="attachfile" onchange="startUpload('ticketFrm')">
    </div>
</div>


<script>

    function scanToJpg() {
        scanner.scan(displayImagesOnPage,
            {
                "output_settings" :
                    [
                        {
                            "type" : "return-base64",
                            "format" : "png"
                        }
                    ]
            }
        );
    }

    /** Processes the scan result */
    function displayImagesOnPage(successful, mesg, response) {
        if(!successful) { // On error
            console.error('Failed: ' + mesg);
            return;
        }

        if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
            console.info('User canceled');
            return;
        }
        var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
        for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
            var scannedImage = scannedImages[i];
            uploadScannedfile(scannedImage);
            // processScannedImage(scannedImage);
        }
    }
    
    function scanTopdf() {
        scanner.scan(displayPdfOnPage,
            {
                "output_settings" :
                    [
                        {
                            "type" : "return-base64",
                            "format" : "pdf",
                        }
                    ]
            }
        );
    }
    
    function displayPdfOnPage(successful, mesg, response) {
        
        if(!successful) { // On error
            console.error('Failed: ' + mesg);
            return;
        }

        if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User canceled.
            console.info('User canceled');
            return;
        }
        var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
        for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
            var scannedImage = scannedImages[i];
            uploadScannedfile(scannedImage);
        }
    }
    
    function uploadScannedfile(scannedImage){
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
                'ContentType': 'application/json'
            }
        });
        
        $.ajax({
                type:'post',
                url:'{{route('saveScanedFile')}}',
                data: {
                    scannedData: scannedImage.src,
                    type: scannedImage.mimeType,
                    
                },
                dataType:"json",
                async: true,
                success: (response) => {
                    $(".form-actions").removeClass('hide');
                    $(".loader").addClass('hide');
                    $( ".archive_type" ).removeClass( "error" );
                    
                        shortCutName=response.file.real_name;
                        
                        shortCutID=response.file.id;
                        
                        urlfile='{{ asset('') }}';
                        
                        urlfile+=response.file.url;
                        
                        shortCutName=shortCutName.substring(0, 40)
                        if(response.file.extension=="jpg"||response.file.extension=="png")
                            fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/image.png';
                            else if(response.file.extension=="pdf")
                            fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/pdf.png';
                            else if(response.file.extension=="doc")
                            fileimage='https://template.expand.ps/public/assets/images/ico/word.png';
                            else if(response.file.extension=="excel"||response.file.extension=="xsc")
                            fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/excellogo.png';
                            else
                            fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/file.png';
                            var row = '<li style="font-size: 17px !important;color:#000000">' +
                                '<div class="row">' +
                                '<div class="col-sm-5 attmob">' +
                                '<input type="text" {{$ticketInfo->force_attach==1?"reuired":"" }} id="attachName[]" name="attachName[]" class="form-control attachName">' +
                                '</div>' +
                                '<div class="attdocmob col-sm-5 attach_row_'+attach_index+'">' +
                                '<div id="attach" class=" col-sm-12 ">'+
                                '<div class="attach">' +                                       
                                '<a class="attach-close1" href="'+urlfile+'" style="color: #74798D; float:left;" target="_blank">'+
                                '<span class="attach-text hidemob">'+shortCutName+'</span>' +
                                '<img style="width: 20px;"src="'+fileimage+'">'+
                                '</a>'+
                                '<input type="hidden" id="attach_ids[]" name="attach_ids[]" value="'+response.file.id+'">'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div class="attdelmob">' +
                                '<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile\').val('+attach_index+');$(\'#attachfile\').trigger(\'click\'); return false">' +
                                '</div>' +
                                '<div class="attdelmob">' +
                                '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'+
                                '</div>' +
                                ' </div>' +
                               
                                ' </li>'
                                attach_index++
                            $(".addAttatch").append(row)
                            
        //                     row='<div id="attach" class=" col-lg-6 ">' +
        //                         '   <div class="attach" onmouseover="$(this).children().first().next().show()">'
        //                         +'    <a class="attach-close1" href="'+urlfile+'" style="color: #74798D;" target="_blank">'
        //                         +'    <span class="attach-text">'+shortCutName+'</span> </a>'
        //                         +'    <a class="attach-close1" style="color: #74798D; float:left;" onclick="$(this).parent().parent().remove()">×</a>'
        //                         +'      <input type="hidden" id="formDataaaimgUploads[]" name="formDataaaimgUploads[]" value="'+shortCutName+'">'
        //                         +'             <input type="hidden" id="formDataaaorgNameList[]" name="formDataaaorgNameList[]" value="'+shortCutName+'">'
								// +'             <input type="hidden" id="formDataaaorgIdList[]" name="formDataaaorgIdList[]" value="'+shortCutID+'">'
							 //   +'    </div>'
        //                         +'  </div>'
        //                 $(".formDataaaFilesArea").append(row)
                },

                error: function(response){
                    $(".form-actions").removeClass('hide');
                    $(".loader").addClass('hide');
                    
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: '{{trans('admin.error_save')}}',
                        showConfirmButton: false,
                        timer: 1500
                        })

                        // $(".formDataaaFilesArea").html('');

                    if(response.responseJSON.errors.customerName){

                        $( "#customerName" ).addClass( "error" );

                    }

                }

            });
            return true;
    }


attach_index=2;
    function addNewAttatch() {

        // if($(".attachName").last().val().length>0){
            var row = '<li style="font-size: 17px !important;color:#000000">' +
                '<div class="row">' +
                '<div class="col-sm-5 attmob">' +
                '<input type="text" {{$ticketInfo->force_attach==1?"reuired":"" }} id="attachName[]" name="attachName[]" class="form-control attachName">' +
                '</div>' +
                '<div class="attdocmob col-sm-5 attach_row_'+attach_index+'">' +
                //'<input type="text" name="feesValue2" class="form-control" disabled="disabled">' +
                '</div>' +
                '<div class="attdelmob">' +
                '<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile\').val('+attach_index+');$(\'#attachfile\').trigger(\'click\'); return false">' +
                '</div>' +
                '<div class="attdelmob">' +
                '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'+
                '</div>' +
                ' </div>' +
               
                ' </li>'
                attach_index++
            $(".addAttatch").append(row)
        // }
    }
    
function startUpload(formDataStr)
    {
        
        id=$("#currFile").val()
        
        // $('#feesText'+id).val($('#attachfile').val().split('\\').pop())
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".loader").removeClass('hide');
        $(".form-actions").addClass('hide');
        var formData = new FormData($("#"+formDataStr)[0]); 
        $.ajax({
            url: "{{route('uploadTicketAttach')}}",
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
                row='';
                console.log(data.all_files);
                if(data.all_files){
                    addNewAttatch()
                    var j=0;
                    $actionBtn='';
                    for(j=0;j<data.all_files.length;j++){
                        $(".attach_row_"+id).html('')
                        file=data.all_files[j]
                        shortCutName=data.all_files[j].real_name;
                        shortCutID=data.all_files[j].id;
                        urlfile='{{asset("")}}/';
                        console.log(urlfile);
                        urlfile+=data.all_files[j].url;
                        console.log(urlfile);
                         shortCutName=file.real_name;
                                shortCutName=shortCutName.substring(0, 20);
                                urlfile='{{asset("")}}/';
                                urlfile+=file.url;
                                if(file.extension=="jpg"||file.extension=="png")
                                fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/image.png';
                                else if(file.extension=="pdf")
                                fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/pdf.png';
                                else if(file.extension=="doc")
                                fileimage='https://template.expand.ps/public/assets/images/ico/word.png';
                                else if(file.extension=="excel"||file.extension=="xsc")
                                fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/excellogo.png';
                                else
                                fileimage='https://t.expand.ps/expand_repov1/public/assets/images/ico/file.png';
                                $actionBtn += '<div id="attach" class=" col-sm-12 ">'
                                    +'<div class="attach">'                                        
                                      +' <a class="attach-close1" href="'+urlfile+'" style="color: #74798D; float:left;" target="_blank">'
                                        +'  <span class="attach-text hidemob">'+shortCutName+'</span>'
                                        +'    <img style="width: 20px;"src="'+fileimage+'">'
                                        +'</a>'
                                        +'<input type="hidden" id="attach_ids[]" name="attach_ids[]" value="'+file.id+'">'
                                    +'</div>'
                                    +'</div>'; 
                            $actionBtn += '</div>';
                            shortCutName=shortCutName.substring(0, 40)
                    }
                    $('#attachfile').val('');
                    $(".alert-danger").addClass("hide");
                    $(".alert-success").removeClass('hide');
                    $(".attach_row_"+id).append($actionBtn)
                    $(".loader").addClass('hide');
                    
                    $(".group1").colorbox({rel:'group1'});
                    setTimeout(function(){
                        $(".alert-danger").addClass("hide");
                        $(".alert-success").addClass("hide");
                    },2000)
                }
                else {
                    $(".alert-success").addClass("hide");
                    $(".alert-danger").removeClass('hide');
                }
                $(".loader").addClass('hide');
                $(".form-actions").removeClass('hide');
            },
            error:function(){
                $(".alert-success").addClass("hide");
                $(".alert-danger").removeClass('hide');
                $(".loader").addClass('hide');
                $(".form-actions").removeClass('hide');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
</script>
@endif
