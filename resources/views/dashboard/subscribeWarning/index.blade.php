@extends('layouts.admin')
@section('search')
<li class="dropdown dropdown-language nav-item hideMob">
            <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث" style="text-align: center;width: 350px; margin-top: 15px !important;">
          </li>
@endsection

@section('content')
<style>
    .detailsTB th{
        color:#ffffff;
    }
      .detailsTB th,.detailsTB td{
        text-align:right !important;
        
    }
    .recList>tr>td{
        font-size:12px;
    }
    table.dataTable tbody th, table.dataTable tbody td {
    padding-bottom: 5px !important;
}
.dataTables_filter{
    margin-top:-15px;
}
.even{
    background-color:#D7EDF9 !important;
}
.dt-buttons
{
    text-align: left;
    display: inline;
    float: left;
    position: relative;
    bottom: 10px;
    margin-right: 10px;
}

</style>

<div class="content-body">
    <section id="hidden-label-form-layouts">
    <form method="post" id="formData" enctype="multipart/form-data">
        @csrf

        <section class="horizontal-grid" id="horizontal-grid"   >
                    <div class="row white-row" >
                        <div class="col-sm-12">
                            <div class="card leftSide">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <img src="https://db.expand.ps/images/personal-information.png" width="32" height="32">
                                         اخطارات المواطنين
                                    </h4>
                                    <div class="heading-elements1" style="display: none;left: 87px; top: 10px;">
                                        الحالة
                                    </div>
                                    <div class="heading-elements1 onOffArea form-group mt-1" style="display: none;    top: -5px;">
                                        <input type="checkbox" id="myonoffswitchHeader" class="switchery" data-size="xs" checked/>
                                    </div>
                                </div>
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <div class="card-content collapse show" >
                                    <div class="card-body" style="padding-bottom: 0px;">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 pr-0 pr-s-12"  >
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                     اسم الواطن
                                                                </span>
                                                            </div>
                                                            <input type="text" id="subscriberName" class="form-control alphaFeild cust" placeholder="اسم المواطن" name="subscriberName">
                                                            <input type="hidden" id="subscriberID" name="subscriberID">
                                                            <input type="hidden" id="warningId" name="warningId">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12" style="padding-right: 0px;">

                                                    <div class="form-group">
                                            
                                                        <div class="input-group">
                                            
                                                            <div class="input-group-prepend">
                                            
                                                              <span class="input-group-text " id="basic-addon1">
                                            
                                                                التاريخ
                                            
                                                              </span>
                                            
                                                            </div>
                                            
                                                            <input id="date" name="date" data-mask="00/00/0000" maxlength="10" class="form-control eng-sm singledate valid selectFullCorner" placeholder="dd/mm/yyyy" autocomplete="off">
                                                           
                                                        </div>
                                            
                                                    </div>
                                            
                                                </div>
                                                
                                                <div class="col-lg-2 col-md-12" style="">

                                                    <div class="form-group">
                                            
                                                        <div class="input-group"  style="width: 80% !important;">
                                            
                                                            <div class="input-group-prepend">
                                            
                                                              <span class="input-group-text " id="basic-addon1" style="height: 33px !important;">
                                            
                                                                نوع الاخطار 
                                            
                                                              </span>
                                            
                                                            </div>
                                                            <select id="warningType" name="warningType" type="text" class="form-control valid warningType" style="height: 33px !important;" aria-invalid="false">
                                            
                                                                <option value="0"> اختر </option>
                                                                @foreach($warningTypes as $worningType)
                                                                <option value="{{$worningType->id}}"> {{$worningType->name}} </option>
                                                                @endforeach
                                            
                                                            </select>
                                            
                                                            <div class="input-group-append hidden-xs hidden-sm">
                                            
                                                                <div class="input-group-append" onclick="ShowConstantModal(6228,'warningType','نوع الاخطار')">
                                            
                                                                    <span class="input-group-text input-group-text2">
                                            
                                                                        <i class="fa fa-external-link"></i>
                                            
                                                                    </span>
                                            
                                                                </div>
                                            
                                                            </div>
                                            
                                                        </div>
                                            
                                                    </div>
                                            
                                                </div>
                                                <div class="col-lg-1 col-md-6" style="padding-right: 0px;padding-left: 0px;">
                                                    <div class="form-group">
                                                        <div class="input-group" style="width: 100% !important;">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                     رقم الحوض 
                                                                </span>
                                                            </div>
                                                            <input type="text" id="hodNo" class="form-control alphaFeild"  name="hodNo" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 col-md-6" style="padding-left: 0px;" >
                                                    <div class="form-group">
                                                        <div class="input-group" style="width: 100% !important;">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                     رقم القطعة 
                                                                </span>
                                                            </div>
                                                            <input type="text" id="peiceNo" class="form-control alphaFeild"  name="peiceNo" placeholder=" ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12" style="">

                                                    <div class="form-group">
                                            
                                                        <div class="input-group" style="width: 80% !important;">
                                            
                                                            <div class="input-group-prepend">
                                            
                                                              <span class="input-group-text " id="basic-addon1" style="height: 33px !important;">
                                            
                                                                الاستلام  
                                            
                                                              </span>
                                            
                                                            </div>
                                                            <select id="receive" name="receive" type="text" class="form-control valid receive" style="height: 33px !important;" aria-invalid="false">
                                            
                                                                <option value="0"> اختر </option>
                                                                @foreach($warningReceives as $warningReceive)
                                                                <option value="{{$warningReceive->id}}"> {{$warningReceive->name}} </option>
                                                                @endforeach
                                            
                                                            </select>
                                            
                                                            <div class="input-group-append hidden-xs hidden-sm">
                                            
                                                                <div class="input-group-append" onclick="ShowConstantModal(6265,'receive','نوع الاخطار')">
                                            
                                                                    <span class="input-group-text input-group-text2">
                                            
                                                                        <i class="fa fa-external-link"></i>
                                            
                                                                    </span>
                                            
                                                                </div>
                                            
                                                            </div>
                                            
                                                        </div>
                                            
                                                    </div>
                                            
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <table style="width:100%; margin-top: -10px;" class="detailsTB table ">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="col">
                                                                        سبب الاخطار
                                                                    </th>
                                                                    <th scope="col"> 
                                                                        حالة الاخطار
                                                                    </th>
                                                                    <th scope="col">
                                                                        سبب ازالة لاخطار
                                                                    </th>
                                                                    <th scope="col">
                                                                        تاريخ ازالة الاخطار
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%;">
                                                                        <input id="warningReason" name="warningReason"  class="form-control eng-sm singledate valid selectFullCorner" placeholder="سبب الاخطار" autocomplete="off">
                                                                    </td>
                                                                    <td width="10%;">
                                                                        <div class="form-group form-group1" style="margin-bottom: 0px;">
                                                                            <div class="input-group" style="width: 100% !important;">
                                                                                
                                                                                <select id="warningStatuse" name="warningStatuse" class="form-control selectFullCorner warningStatuse">
                                                                                    <option value="0">اختر</option>
                                                                                    <option value="6240">قائم</option>
                                                                                    <option value="6242">ملغي</option>
                                                                                </select>
                                                                                        
                                                                                {{--<div class="input-group-append" onclick="ShowConstantModal(6284,'warningStatuse','حالة الاخطار')" style="cursor:pointer;margin-left: 0px !important;">
                                                                                    <span class="input-group-text input-group-text2">
                                                                                        <i class="fa fa-external-link"></i>
                                                                                    </span>
                                                                                </div>--}}
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td width="25%;">
                                                                        <input id="deleteReason" name="deleteReason"  class="form-control eng-sm singledate valid selectFullCorner" placeholder="سبب ازالة الاخطار" autocomplete="off">
                                                                    </td>
                                                                    <td width="10%;">
                                                                        
                                                                        <input id="deleteDate" name="deleteDate" data-mask="00/00/0000" maxlength="10" class="form-control eng-sm singledate valid selectFullCorner" placeholder="dd/mm/yyyy" autocomplete="off">
                                                                          
                                                                    </td>
                                                                    
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0px;">
                                                <img src="https://t.palexpand.ps/assets/images/ico/scanner.png"  style="cursor:pointer;    float: left;" onclick="scanToJpg();">

                                                <img src="https://t.palexpand.ps/assets/images/ico/scannerpdf.png"  style="cursor:pointer;    float: left;" onclick="scanTopdf();">
                                                 <div class="row attachs-body repAttach" style="margin-left: 25px;">
                                                    <div class="form-group col-12 mb-2" style="padding-right: 0px;">
                                                
                                                        <ol class="vasType 1vas addAttatch1">
                                                            <li style="font-size: 17px !important;color:#000000">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <input type="text" id="attachName1[]" name="attachName1[]" class="form-control attachName1" placeholder="أدخل اسم المرفق"
                                                                          value="">
                                                                    </div>
                                                                    <div class="col-sm-5 attach_row1_1">
                                                                        
                                                                    </div>
                                                                    <div>
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
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 pr-0 pr-s-12" style="text-align: center;">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-info" id="savebtn">
                                                        اضافة الاخطار  
                                                        </button>
                                                        <button id="editBtn" type="submit" class="btn btn-info hide">

                                                           تعديل الاخطار
                    
                                                        </button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

      </form>
    </section>
</div>
<input type="hidden" id="type" name="type" value="">
<div class="content-body resultTblaa">
    <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header" style="direction: rtl;">
                        <h4 class="card-title"><img src="{{asset('assets/images/ico/report32.png')}}" /> 
                              الاخطارات  
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group" style="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text " id="basic-addon1">
                                                    {{ 'نوع الاخطار' }}
                                                </span>
                                            </div>
                                            <select id="search_warningType" name="search_warningType" type="text"
                                                class="form-control valid warningType" aria-invalid="false" onchange="reload();">
                                                <option value="0" selected=""> {{ 'نوع الاخطار' }} </option>
                                                @foreach($warningTypes as $worningType1)
                                                <option value="{{$worningType1->id}}"> {{$worningType1->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="input-group" style="">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text " id="basic-addon1">
                                                    {{ 'حالة الاخطار' }}
                                                </span>
                                            </div>
                                            <select id="search_warningStatuse" name="search_warningStatuse" class="form-control" onchange="reload();">
                                                <option value="0">اختر</option>
                                                <option value="6240">قائم</option>
                                                <option value="6242">ملغي</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group paddmob">
                                        <div class="input-group subscribermob">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{ 'من تاريخ' }}
                                                </span>
                                            </div>
                                            <input type="text" id="search_from" 
                                                class="form-control singledate" maxlength="10" data-mask="00/00/0000" placeholder="{{date('d/m/Y')}}"
                                                name="search_from">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group paddmob">
                                        <div class="input-group subscribermob">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    {{ 'الي تاريخ' }}
                                                </span>
                                            </div>
                                            <input type="search_to" id="search_to" 
                                                class="form-control singledate" maxlength="10" data-mask="00/00/0000" placeholder="{{date('d/m/Y')}}"
                                                name="search_from">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="resultTblaa">
                                <div class="col-xl-12 col-lg-12">
                                    <table style="width:100%; margin-top: -10px;direction: rtl;text-align: right" class="detailsTB table wtbl">
                                        <thead>
                                            <tr>
                                                <th width="1%;">
                                                   #
                                                </th>
                                                <th   width="10%;">
                                                    اسم المواطن
                                                </th>
                                                <th   width="8%;">
                                                    التاريخ
                                                </th>
                                                <th  width="8%;">
                                                     نوع الاخطار 
                                                </th>
                                                <th  width="15%;">
                                                    سبب الاخطار 
                                                </th>
                                                <th  width="8%;">
                                                    حالة الاخطار 
                                                </th>
                                                <th  width="15%;">
                                                    سبب ازالة الاخطار
                                                </th>
                                                <th  width="8%;">
                                                    تاريخ ازالة الاخطار
                                                </th>
                                                <th  width="15%;">
                                                    المرفقات 
                                                </th>
                                                <th width="8%;">
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="recListaa">
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>  
@section('script')
<script>

    var typingTimer;                //timer identifier
    var doneTypingInterval = 300;  //time in ms
    var $search_from = $('#search_from');
    var $search_to = $('#search_to');
    
    //on keyup, start the countdown
    $search_from.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(reload, doneTypingInterval);
    });
    
    //on keydown, clear the countdown 
    $search_from.on('keydown', function () {
      clearTimeout(typingTimer);
    });
    
    $search_to.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(reload, doneTypingInterval);
    });
    
    //on keydown, clear the countdown 
    $search_to.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    function reload(){
        $('.wtbl').DataTable().ajax.reload();  
    }

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
                                '<div class="col-sm-6 attmob">' +
                                '<input type="text" id="attachName1[]" name="attachName1[]" class="form-control attachName1">' +
                                '</div>' +
                                '<div class="attdocmob col-sm-5 attach_row_'+attach_index1+'">' +
                                '<div id="attach" class=" col-sm-12 ">'+
                                '<div class="attach">' +                                       
                                '<a class="attach-close1" href="'+urlfile+'" style="color: #74798D; float:left;" target="_blank">'+
                                '<span class="attach-text hidemob">'+shortCutName+'</span>' +
                                '<img style="width: 20px;"src="'+fileimage+'">'+
                                '</a>'+
                                '<input type="hidden" id="attach_ids[]" name="attach_ids[]" value="'+response.file.id+'">'+
                                '<input type="hidden" id="notArchived[]" name="notArchived[]" value="'+response.file.id+'">'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div class="attdelmob">' +
                                '<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile\').val('+attach_index1+');$(\'#attachfile\').trigger(\'click\'); return false">' +
                                '</div>' +
                                '<div class="attdelmob">' +
                                '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'+
                                '</div>' +
                                ' </div>' +
                               
                                ' </li>'
                                attach_index1++
                            $(".addAttatch1").append(row)
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
                }

            });
            return true;
    }

function resetFunction(){

    $(".addAttatch1").html('');
    
    attachments='<li style="font-size: 17px !important;color:#000000">'
                    +'<div class="row">'
                    +    '<div class="col-sm-6" >'
                    +        '<input type="text" reuired="" id="attachName1[]" name="attachName1[]" class="form-control attachName1" >'
                    +    '</div>'
                    +    '<div class="attdocmob col-sm-5 attach_row1_1" >'
                    +'</div>' 
                    +'<div>' 
                    +'<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile1\').val(1);$(\'#attachfile1\').trigger(\'click\');  return false">' 
                    +'</div>'
                    +'</div>' 
                    +'</li>';
      $(".addAttatch1").append(attachments);         
                    
}

attach_index1=2;

    function addNewAttatch1() {

        if($(".attachName1").last().val().length>0){
            var row = '<li style="font-size: 17px !important;color:#000000">' +
                '<div class="row">' +
                '<div class="col-sm-6">' +
                '<input type="text" id="attachName1[]" name="attachName1[]" class="form-control attachName1">' +
                '</div>' +
                '<div class="col-sm-5 attach_row1_'+attach_index1+'">' +
                //'<input type="text" name="feesValue2" class="form-control" disabled="disabled">' +
                '</div>' +
                '<div>' +
                '<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile1\').val('+attach_index1+');$(\'#attachfile1\').trigger(\'click\');  return false">' +
                
                '</div>' +
                '<div>' +
                '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'+
                '</div>' +
                ' </div>' +
               
                ' </li>'
                attach_index1++
            $(".addAttatch1").append(row)
        }
    }

$('#formData').submit(function(e) {
    $(".loader").removeClass('hide');
    $("#savebtn").addClass('hide');
    $('#editBtn').addClass('hide');
    // $( "#customerName" ).removeClass( "error" );
    // $( "#licNo" ).removeClass( "error" );
       e.preventDefault();
       let formData = new FormData(this);

       $.ajax({
          type:'POST',
          url: "store_warning",
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
            $(".loader").addClass('hide');
            $("#savebtn").removeClass('hide');
            $('#editBtn').addClass('hide');
             $('.wtbl').DataTable().ajax.reload();
             console.log(response);
             if (response) {
                Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '{{trans('admin.data_added')}}',
				showConfirmButton: false,
				timer: 1500
				})
				
				$('#aged_id').val('');
				$('#paymentId').val('');
				$('#empId').val('');
				$('#orgId').val('');
               resetFunction();
               this.reset();
               
             }
              
           },
           error: function(response){
            $(".loader").addClass('hide');
            $("#savebtn").removeClass('hide');
            $('#editBtn').addClass('hide');
            Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: '{{trans('admin.error_save')}}',
				showConfirmButton: false,
				timer: 1500
				})

           }
       });
  });


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
                        urlfile='https://t.expand.ps/expand_repov1/public/';
                        console.log(urlfile);
                        urlfile+=data.all_files[j].url;
                        console.log(urlfile);
                         shortCutName=file.real_name;
                                shortCutName=shortCutName.substring(0, 20);
                                urlfile='https://t.expand.ps/expand_repov1/public/';
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
                                        +'  <span class="attach-text">'+shortCutName+'</span>'
                                        +'    <img style="width: 20px;"src="'+fileimage+'">'
                                        +'</a>'
                                        +'<input type="hidden" id="attach_ids[]" name="attach_ids[]" value="'+file.id+'">'
                                    +'</div>'
                                    +'</div>'; 
                            shortCutName=shortCutName.substring(0, 40)
                    }
                    $(".alert-danger").addClass("hide");
                    $(".alert-success").removeClass('hide');
                    $(".attach_row1_"+id).append($actionBtn)
                    $(".loader").addClass('hide');
                    $("#attachfile1").val('');
                    
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
    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $( function() {
    $( ".cust" ).autocomplete({
		source: 'subscribe_auto_complete',
		minLength: 1,
		
        select: function( event, ui ) {
            $('#subscriberName').val(ui.item.name);
            $('#subscriberID').val(ui.item.id);
           }
	    });
    });
     function update($id)
    {
        
        let warning_id = $id;
        $.ajax({
        type: 'get', // the method (could be GET btw)
        url: "warning_info",
    
            data: {
                warning_id: warning_id,
            },
            success:function(response){
                $("#savebtn").addClass('hide');
                $('#editBtn').removeClass('hide');
                $('#subscriberName').val(response.info.subscriber_name);
                $('#subscriberID').val(response.info.subscriber_id);
                $('#hodNo').val(response.info.hod_no);
                $('#peiceNo').val(response.info.piece_no);
                $('#receive').val(response.info.receive);
                $('#warningId').val(response.info.id);
                $('#warningType').val(response.info.warning_type);
                $('#warningReason').val(response.info.warning_reason);
                $('#warningStatuse').val(response.info.warning_status);
                $('#deleteReason').val(response.info.remove_reason);
                
                
                let date=(response.info.warning_date)
                
                dates=""
                if(date){
                    dates=date.split("-");
                    dates = dates[2]+'/'+dates[1]+'/'+dates[0];
                    
                }
                $("#date").val(dates);
                
                let date2=(response.info.remove_date)
                dates2=""
                if(date2){
                    date2=date2.split("-");
                    dates2 = date2[2]+'/'+date2[1]+'/'+date2[0];
                    
                }
                $('#deleteDate').val(dates2);
                
                attachments='';
                c=0;
                if(response.info.file_ids!=null){
                    for(c=0;c<response.info.Files.length;c++){
                        attach=response.info.Files[c];
                        // console.log('hiiiiiiiiii');
                        url='{{asset("")}}/'+attach.Files[0].url;
                        attachments+='<li style="font-size: 17px !important;color:#000000">'
                            +'<div class="row">'
                            +    '<div class="col-sm-6" >'
                            +        '<input type="text" reuired="" id="attachName1[]" name="attachName1[]" class="form-control attachName1" value="'+attach.attachName+'">'
                            +    '</div>'
                            +    '<div class="attdocmob col-sm-5 attach_row_'+(c+1)+'" >'
                            +        '<div id="attach" class=" col-sm-12 ">'
                            +            '<div class="attach">'
                            +                '<a class="attach-close1" href="'+url+'" style="color: #74798D; float:left;" target="_blank">'
                            +                    '<span class="attach-text hidemob">'+attach.Files[0].real_name+'</span>'      
                            +                    '<img style="width: 20px;" src="https://t.expand.ps/expand_repov1/public/assets/images/ico/image.png">'
                            +                '</a>'
                            +                '<input type="hidden" id="attach_ids[]" name="attach_ids[]" value="'+attach.attach_ids+'">'
                            +            '</div>'
                            +        '</div>'
                            +    '</div>'
                            +'<div>' 
                            +'<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile1\').val('+attach_index1+');$(\'#attachfile1\').trigger(\'click\');  return false">' 
                    
                            +'</div>' 
                            +    '<div>'
                            +        '<i class="fa fa-trash" id="plusElement1" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; " onclick="$(this).parent().parent().parent().remove()"></i>'
                            +    '</div>' 
                                
                            +'</div>' 
                            +'</li>'
                        
                        
                    }
                }
                if(c==0){
                    c++;
                    attach_index1=c+1;
                }
                attachments+='<li style="font-size: 17px !important;color:#000000">'
                    +'<div class="row">'
                    +    '<div class="col-sm-6" >'
                    +        '<input type="text" reuired="" id="attachName1[]" name="attachName1[]" class="form-control attachName1" >'
                    +    '</div>'
                    +    '<div class="attdocmob col-sm-5 attach_row1_'+(c)+'" >'
                    +'</div>' 
                    +'<div>' 
                    +'<img src="{{ asset('assets/images/ico/upload.png') }}" width="40" height="40" style="cursor:pointer" onclick="$(\'#currFile1\').val('+c+');$(\'#attachfile1\').trigger(\'click\');  return false">' 
                    +'</div>'
                    +'</div>' 
                    +'</li>';
                $(".addAttatch1").html('')
                $(".addAttatch1").append(attachments)
                window.scrollTo(0, 0);
            
            },
        });
    }
    
    function delete_warning($id) {
            if(confirm('هل انت متاكد من حذف الاخطار؟ لن يمكنك استرجاعه فيما بعد')){
            let warning_id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({

                type: 'post',

                // the method (could be GET btw)

                url: "warning_delete",
                
                data: {

                    warning_id: warning_id,
                    _token: _token,
                },

                success: function(response) {

                    $(".loader").addClass('hide');

                    $('.wtbl').DataTable().ajax.reload();

                    Swal.fire({

                        position: 'top-center',

                        icon: 'success',

                        title: '{{ trans('admin.data_added') }}',

                        showConfirmButton: false,

                        timer: 1500

                    })

                    $("#formData")[0].reset();

                },

                error: function(response) {

                    $(".loader").addClass('hide');

                    Swal.fire({

                        position: 'top-center',

                        icon: 'error',

                        title: '{{ trans('admin.error_save') }}',

                        showConfirmButton: false,

                        timer: 1500

                    }) 

                    $("#formDataNameAR").on('keyup', function(e) {

                        if ($(this).val().length > 0) {

                            $("#formDataNameAR").removeClass("error");

                        }

                    });

                    if (response.responseJSON.errors.formDataNameAR) {

                        $("#formDataNameAR").addClass("error");

                    }

                }

            });
            return true;
            }
            return false;
        }
        
     $( function(){

        var table = $('.wtbl').DataTable({

            ajax:{
                url: "{{ route('warning_info_all') }}",
                data: function (d) {
                    d.type = $('#type').val();
                    d.search_warningType = $('#search_warningType').val();
                    d.search_warningStatuse = $('#search_warningStatuse').val();
                    d.search_from = $('#search_from').val();
                    d.search_to = $('#search_to').val();
                }
            },
            columns:[

                    { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},

                    {

                        data: null, 

                        render:function(data,row,type){

                            $actionBtn = '<a target="_blank" href="{{ route('admin.dashboard') }}/subscribers?id='+data.subscriber_id+'">'+data.subscriber_name+'</a>';

                                return $actionBtn;

                        },

                        name:'name',

                    

                    },

                    {data:'warning_date'},

                    {data:'warningType',name:'t.name'},

                    {data:'warning_reason'},

                    {data:'warningStatus',name:'s.name'},

                    {data:'remove_reason'},

                    {data:'remove_date'},

                    {
                        data: null,
                        render:function(data,row,type){
                               
                                $attatchs ='';
                                for(i = 0 ; i < data.Files.length ; i++){
                                    file=data.Files[i];
                                    
                                    if(file.Files[0].extension=="jpg"||file.Files[0].extension=="png"||file.Files[0].extension=="jfif")
                                    fileimage='{{ asset('assets/images/ico/image.png') }}';
                                    else if(file.Files[0].extension=="pdf")
                                    fileimage='{{ asset('assets/images/ico/pdf.png') }}';
                                    else if(file.Files[0].extension=="doc"||file.Files[0].extension=="docx")
                                    fileimage='https://template.expand.ps/public/assets/images/ico/word.png';
                                    else if(file.Files[0].extension=="excel"||file.Files[0].extension=="xsc")
                                    fileimage='{{ asset('assets/images/ico/excellogo.png') }}';
                                    else
                                    fileimage='{{ asset('assets/images/ico/file.png') }}';
                                    
                                    url='{{asset("")}}/'+file.Files[0].url;
                                    
                                    $attatchs +=`<div class="row">
                                        <div id="attach" class=" col-sm-12 ">
                                            <div class="attach"> 
                                                <a class="attach-close1" href="${url}" style="color: #74798D; float:left;" 
                                                target="_blank">  
                                                    <span class="attach-text hidemob">${file.Files[0].real_name}</span>    
                                                    <img style="width: 20px;" src="${fileimage}">
                                                </a>
                                            </div>
                                        </div>
                                    </div> `
                                }
                                return $attatchs;
                        },
                            name:'name',
                    },
                    {
                        data: null,
                        render:function(data,row,type){
                               
                                $actionBtn ='<div style="float: left;">';
                                @can('edit_warning')
                                $actionBtn += '<a  onclick="update('+data.id+')" class="btn btn-info"><i style="color:#ffffff" class="fa fa-edit"></i> </a>';
                                @endcan
                                
                                @can('delete_warning')
                                $actionBtn += '<a  onclick="delete_warning('+data.id+')" style="margin-right:17px;" onclick="" class="btn btn-info"><i style="color:#ffffff;" class="fa fa-trash"></i> </a>';
                                @endcan
                                $actionBtn += '</div>'
                                return $actionBtn;
                        },
                            name:'name',
                    },

                ],

                        dom: 'Bfltip',

                        buttons: [

                            {

                                extend: 'excel',

                                tag: 'img',

                                title:'',

                                attr:  {

                                    title: 'excel',

                                    src:'{{asset('assets/images/ico/excel.png')}}',

                                    style: 'cursor:pointer; height: 32px;',

                                },



                            },

                            {

                                extend: 'print',

                                tag: 'img',

                                title:'',

                                attr:  {

                                    title: 'print',

                                    src:'{{asset('assets/images/ico/Printer.png')}} ',

                                    style: 'cursor:pointer;height: 32px;',

                                    class:"fa fa-print"

                                },

                                customize: function ( win ) {

                            

            

                                $(win.document.body).find( 'table' ).find('tbody')

                                    .css( 'font-size', '20pt' );

                                }

                            },

                            ],

                        

                        "language": {

                                    "sEmptyTable":     "ليست هناك بيانات متاحة في الجدول",

                                    "sLoadingRecords": "جارٍ التحميل...",

                                    "sProcessing":   "جارٍ التحميل...",

                                    "sLengthMenu":   "أظهر _MENU_ مدخلات",

                                    "sZeroRecords":  "لم يعثر على أية سجلات",

                                    "sInfo":         "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",

                                    "sInfoEmpty":    "يعرض 0 إلى 0 من أصل 0 سجل",

                                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",

                                    "sInfoPostFix":  "",

                                    "sSearch":       "ابحث:",

                                    "sUrl":          "",

                                    "oPaginate": {

                                        "sFirst":    "الأول",

                                        "sPrevious": "السابق",

                                        "sNext":     "التالي",

                                        "sLast":     "الأخير"

                                    },

                                    "oAria": {

                                        "sSortAscending":  ": تفعيل لترتيب العمود تصاعدياً",

                                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"

                                    }

                                }

                    });           



    });
</script>
@endsection
@endsection
