
<div class="row attachs-body repAttach attcol" style=" display:none;">
    <div class="col-md-12" style="padding-top: 10px;">
        <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"  style="cursor:pointer;    float: left;" onclick="scanToJpg1();">

        <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;    float: left;" onclick="scanTopdf1();">
    </div>
    <div class="form-group col-12 mb-2">

        <ol class="vasType 1vas addAttatch1" id="replayAttatch" style="padding-right:0px!important;">
            <li style="font-size: 17px !important;color:#000000">
                <div class="row">
                    <div class="col-sm-6 attmob">
                        <input type="text" id="attachName1[]" name="attachName1[]" class="form-control attachName1" placeholder="أخل اسم المرفق"
                          value="">
                    </div>
                    <div class=" attdocmob col-sm-5 attach_row1_1">
                        
                    </div>
                    <div class="attdelmob">
                        <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                            height="40" style="cursor:pointer"
                            onclick="$('#currFile1').val(1);$('#attachfile1').trigger('click');">
                    </div>
                </div>
            </li>
        </ol>
        <input type="hidden" id="currFile1" name="currFile1">
        <input type="hidden" id="attachfileName" name="attachfileName" value="attachfile1">
        <input type="file" style="display:none" id="attachfile1" name="attachfile1" onchange="startUpload1('formData')">
    </div>
</div>


<script>
    function scanToJpg1() {
        scanner.scan(displayImagesOnPage1,
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
    function displayImagesOnPage1(successful, mesg, response) {
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
            uploadScannedfile1(scannedImage);
            // processScannedImage(scannedImage);
        }
    }
    
    function scanTopdf1() {
        scanner.scan(displayPdfOnPage1,
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
    
    function displayPdfOnPage1(successful, mesg, response) {
        
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
            uploadScannedfile1(scannedImage);
        }
    }
    
    function uploadScannedfile1(scannedImage){
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
                        if(response.file.type==2){
                            urlfile=response.file.url;
                        }else{
                            urlfile+=response.file.url;
                        }
                        
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
                                    '<div class="col-sm-6 attmob">' +
                                    '<input type="text" {{$config[0]->force_attach==1?"reuired":"" }} id="attachName1[]" name="attachName1[]" class="form-control attachName1">' +
                                    '</div>' +
                                    '<div class="attdocmob col-sm-5 attach_row_'+attach_index+'">' +
                                    '<div id="attach" class=" col-sm-12 ">'+
                                    '<div class="attach">' +                                       
                                    '<a class="attach-close1" href="'+urlfile+'" style="color: #74798D; float:left;" target="_blank">'+
                                    '<span class="attach-text hidemob">'+shortCutName+'</span>' +
                                    '<img style="width: 20px;"src="'+fileimage+'">'+
                                    '</a>'+
                                    '<input type="hidden" id="attach_ids[]" name="attach_ids[]" value="'+response.file.id+'">'+
                                    '<input type="hidden" id="notArchived1[]" name="notArchived1[]" value="'+response.file.id+'">'+
                                    '</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="attdelmob">' +
                                    '<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile\').val('+attach_index+');$(\'#attachfile\').trigger(\'click\'); return false">' +
                                    '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'+
                                    '</div>' +
                                    ' </div>' +
                                    ' </li>';
                                    attach_index++
                                
                                const list = document.getElementById("replayAttatch");
                                list.children[(list.children.length-1)].insertAdjacentHTML('beforeBegin',row);

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


var attach_index1=2;
    function addNewAttatch1() {

        // if($(".attachName1").last().val().length>0){
            var row = '<li style="font-size: 17px !important;color:#000000">' +
                '<div class="row">' +
                '<div class="col-sm-6 attmob ">' +
                '<input type="text" id="attachName1[]" name="attachName1[]" class="form-control attachName1">' +
                '</div>' +
                '<div class=" attdocmob col-sm-5 attach_row1_'+attach_index1+'">' +
                //'<input type="text" name="feesValue2" class="form-control" disabled="disabled">' +
                '</div>' +
                '<div class="attdelmob">' +
                '<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile1\').val('+attach_index1+');$(\'#attachfile1\').trigger(\'click\');  return false">' +
                
                '</div>' +
                '<div class="attdelmob">' +
                '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'+
                '</div>' +
                ' </div>' +
               
                ' </li>'
                attach_index1++
            $(".addAttatch1").append(row)
        // }
        
    }
    function resetAttach(){ 
        
        $(".addAttatch1").html(' ');
        attach_index1 =2;
        let firstRow=`<li style="font-size: 17px !important;color:#000000">
            <div class="row">
                <div class="col-sm-6 attmob">
                    <input type="text" id="attachName1[]" name="attachName1[]" class="form-control attachName1" placeholder="أخل اسم المرفق"
                      value="">
                </div>
                <div class=" attdocmob col-sm-5 attach_row1_1">
                    
                </div>
                <div class="attdelmob">
                    <img src="{{ asset('assets/images/ico/upload.png') }}" width="40"
                        height="40" style="cursor:pointer"
                        onclick="$('#currFile1').val(1);$('#attachfile1').trigger('click');">
                </div>
            </div>
        </li>`;
        $(".addAttatch1").append(firstRow)
    }
function startUpload1(formDataStr)
    {
        id=$("#currFile1").val()
        // $('#feesText'+id).val($('#attachfile').val().split('\\').pop())
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".loader").removeClass('hide');
        // $(".form-actions").addClass('hide');
        var formData = new FormData($("#"+formDataStr)[0]);
        $.ajax({
            url: '{{url('ar/admin/uploadTicketAttach')}}',
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
                row='';
                console.log(data.all_files);
                if(data.all_files){
                    addNewAttatch1()
                    var j=0;
                    $actionBtn='';
                    for(j=0;j<data.all_files.length;j++){
                        $(".attach_row1_"+id).html('')
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
                                if(file.type==2){
                                    urlfile=file.url; 
                                }else{
                                    urlfile+=file.url; 
                                }
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
                    $(".alert-danger").addClass("hide");
                    $(".alert-success").removeClass('hide');
                    $(".attach_row1_"+id).append($actionBtn)
                    $(".loader").addClass('hide');
                    $("#attachfile").val('');
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
                // $(".form-actions").removeClass('hide');
            },
            error:function(){
                $(".alert-success").addClass("hide");
                $(".alert-danger").removeClass('hide');
                $(".loader").addClass('hide');
                // $(".form-actions").removeClass('hide');
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
</script>