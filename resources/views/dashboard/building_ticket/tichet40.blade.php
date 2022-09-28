@extends('layouts.admin')

@section('search')
<li class="dropdown dropdown-language nav-item hideMob">
            <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث" style="text-align: center;width: 350px; margin-top: 15px !important;">
          </li>
@endsection
@section('content')

    <style>
        /* The Modal (background) */
        .modal1 {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content1 {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            /*   float: right; */
            font-size: 28px;
            font-weight: bold;
            margin-left: auto;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .rate:not(:checked)>label {
            font-size: 30px !important;
        }

        .rate {
            width: auto;
            position: relative;
            float: left;
            height: 40px;
            margin-top: -3px;
        }

        .Priority {
            padding: 0;
            position: relative;
            left: 0;
            line-height: 39px;
            float: left;
        }

        .fa-2x {
            font-size: 24px !important;
        }
        .phoneDiv {
            padding-left: 0px !important;
        }
 
        .engOfficeDiv {
            padding-left: 51px;
        }
        .swal2-html-container{
            font-size: 18px !important;
            
        }
    </style>


    <link rel="stylesheet" type="text/css"
        href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css" />

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>

    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="ticketFrm" enctype="multipart/form-data">
            @csrf
            <div class="row white-row">

                <div class="col-sm-12 col-md-6">
                    <div class="card leftSide">
                        @include('dashboard.component.ticketHeader',['ticketInfo'=>$ticketInfo])
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    @include('dashboard.includes.wasel')
                                    <div class="row">
                                        <div class="col-md-4" style=" ">
                                            <div class="form-group paddmob">
                                                <div class="input-group" style=" ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            استعمال البناء 
                                                        </span>
                                                    </div>
                                                    <select id="buildingUse" name="buildingUse" type="text"
                                                        class="form-control valid buildingUse" aria-invalid="false">
                                                        <option > {{ '-- اختر --' }} </option>
                                                        <option value="1"> {{ 'شقق' }} </option>
                                                        <option value="2"> {{ 'ارض' }} </option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <input type="hidden" name="subscriptionID" id="subscriptionID">
                                    <input type="hidden" id="dept_id"  name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <input type="hidden" id="app_type"  name="app_type" value="3">
                                    <input type="hidden" id="is_lic_defined"  name="is_lic_defined" value="0">
                                    
                                    <input type="hidden" id="buildingStatus"  name="buildingStatus" value="0">
                                    @include('dashboard.includes.subscriber') 
                                    
                                    <div class="row" style="position: relative; "> 
                                        @if($ticketInfo->show_nationalID == 1)
                                        <div class="col-lg-4 col-md-12 pr-s-12">
                                            <div class="form-group paddmob">
                                                <div class="input-group subscribermob">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الهوية' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="national_id" maxlength="9" minlength="9"
                                                        class="form-control numFeild" placeholder="{{ 'رقم الهوية' }}"
                                                        @if(isset($ticket))
                                                        value="{{ $ticket->national_id }}"
                                                        readonly
                                                        @endif
                                                        name="national_id">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 23px;padding-right: 0px;">
                                            <div class="form-group">
                                                <div class="input-group licNoGroup" id="licGroup">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ 'رقم الرخصة' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="licNo" name="licNo"
                                                        class="form-control" placeholder="0000"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'الاستعمال التنظيمي' }}
                                                        </span>
                                                    </div>
                                                    <select id="systemUse" name="systemUse" type="text"
                                                        class="form-control valid systemUse" aria-invalid="false">
                                                        <option > {{ '-- اختر --' }} </option>
                                                        @foreach($useList as $use)
                                                        <option value="{{ $use->id }}">{{ $use->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hidemob"onclick="ShowConstantModal(6278,'systemUse','الاستعمال التنظيمي')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row" >
                                        <div class="col-lg-4 col-md-12 pr-s-12">
                                            <div class="form-group paddmob">
                                                <div class="input-group subscribermob" >
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'رقم الحوض' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="hodNo" name="hodNo"
                                                        class="form-control" placeholder="0000"
                                                        aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 pr-s-12" style="padding-left: 20px;padding-right: 0px;">
                                            <div class="form-group">
                                                <div class="input-group" style="width: 100% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            {{ 'رقم القطعة' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="pieceNo" name="pieceNo[]"
                                                        class="form-control" placeholder="0000"
                                                        aria-describedby="basic-addon1">
                                                    <a class="add-btn" onclick="addPieceNo();" style="margin-left: 0px;padding-top: 9px;padding-right: 9px;">
                                                        <i class="fa fa-plus" style="color:#1E9FF2;"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 pr-s-12 PieceRow1 " >
                                        </div>
                                    </div>
                                    <div class="row PieceRow2" >
                                    </div>
                                     
                                    @include('dashboard.includes.regionsTemplate')
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="form-group paddmob">
                                                <div class="input-group" style="width: 94.6% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            مكتب مساحة 
                                                        </span>
                                                    </div>
                                                    <select id="areaOffice" name="areaOffice" type="text"
                                                        class="form-control valid areaOffice" aria-invalid="false">
                                                        <option > {{ '-- اختر --' }} </option>
                                                        @foreach($officeAreaList as $officeArea)
                                                        <option value="{{ $officeArea->id }}">{{ $officeArea->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hidemob"onclick="ShowConstantModal(6084,'areaOffice','مكتب مساحة')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" >
                                            <div class="form-group paddmob">
                                                <div class="input-group" style="width: 94.6% !important;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text " id="basic-addon1">
                                                            المكتب الهندسي/ الشركة
                                                        </span>
                                                    </div>
                                                    <select id="engOffice" name="engOffice" type="text"
                                                        class="form-control valid engOffice" aria-invalid="false">
                                                        <option > {{ '-- اختر --' }} </option>
                                                        @foreach($officeEngList as $officeEng)
                                                        <option value="{{ $officeEng->id }}">{{ $officeEng->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append hidemob"onclick="ShowConstantModal(6272,'engOffice','مكتب هندسي')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.includes.costs',['ticketInfo'=>$ticketInfo,'department'=>$department])
                                                <div class="row">
                            <div class="col-md attachs-section"
                                style="margin-left: 25px !important; margin-right: 25px !important;">
                                <img src="https://db.expand.ps/images/upload.png" width="40" height="40">
                                <span class="attach-header">{{ 'مرفقات' }}
                                    <span id="attach-required">{{ '*' }}</span>

                                    <span style="position:absolute; left: 0; font-size: 0.76em;">
                                        {{ 'يرجى التأكد من إستلام التالي' }}
                                    </span>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <table width="100%" class="detailsTB table archTbl" name="Education"
                                id="Education">
                               
                                <tbody id="requieredAttatch" style="border: hidden">
                                    @for($i=0 ; $i<$attachesCount; $i++)
                                    <tr>
                                        <td class="col-md-1">
                                            <input type="checkbox" value="{{$i}}" name="attachReceive[]" class="condition">
                                        </td>
                                        <td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >
                                            <input class="form-control attatchName"  type="text" name="attatchName[]"  value="{{$attatches[$i]}}">
                                        </td>
                                        <td @if($i>0) onclick="$(this).parent().remove()" @endif >
                                            @if($i>0)
                                                <i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endfor
                                    @if($attachesCount==0)
                                    <?php $attachesCount =3; ?>
                                    <tr>
                                        <td class="col-md-1">
                                            <input type="checkbox" value="0" name="attachReceive[]" class="condition">
                                        </td>
                                        <td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >
                                            <input class="form-control attatchName"  type="text" name="attatchName[]"  value="{{ 'تقرير معاملة' }}">
                                        </td>
                                        <td  >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-1">
                                            <input type="checkbox" value="1" name="attachReceive[]" class="condition">
                                        </td>
                                        <td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >
                                            <input class="form-control attatchName"  type="text" name="attatchName[]"  value="{{'بيان'}}">
                                        </td>
                                        <td onclick="$(this).parent().remove()" >
                                            <i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-1">
                                            <input type="checkbox" value="2" name="attachReceive[]" class="condition">
                                        </td>
                                        <td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >
                                            <input class="form-control attatchName"  type="text" name="attatchName[]">
                                        </td>
                                        <td onclick="$(this).parent().remove()" >
                                            <i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor: pointer;  color:#1E9FF2;font-size: 15pt; "></i>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                                <input type="hidden" value="{{$attachesCount}}" name="attachReceive1N" id="attachReceive1N">
                            </table>

                        </div>

                        @include('dashboard.includes.attachment')
                        
                    </div>
                </div>
                @include('dashboard.includes.forward')
            </div>
            </div>




        </form>
    </section>

    @include('dashboard.component.ticket_config',['ticketInfo'=>$ticketInfo,'department'=>$department])
    @include('dashboard.component.tasks_table')
    @include('dashboard.component.fetch_Task_table')


<script>
firstpiece=0;
function addPieceNo(){
    if(firstpiece==0){
        $('.PieceRow1').append(`<div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text " id="basic-addon1">
                            {{ 'رقم القطعة' }}
                        </span>
                    </div>
                    <input type="text" id="pieceNo[]" name="pieceNo[]"
                        class="form-control" placeholder="0000"
                        aria-describedby="basic-addon1">
                </div>
            </div>`)
        firstpiece=1;
    }else{
        $('.PieceRow2').append(`<div class="col-lg-3 col-md-12 pr-s-12">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text " id="basic-addon1">
                            {{ 'رقم القطعة' }}
                        </span>
                    </div>
                    <input type="text" id="pieceNo[]" name="pieceNo[]"
                        class="form-control" placeholder="0000"
                        aria-describedby="basic-addon1">
                </div>
            </div>
        </div>`)
    }
}
var lics = new Array();
    function setLicenceData(){
        $('#hodNo').val('');
        $('#pieceNo').val('');
        for(i=0 ; i<lics.length ; i++){
            if($('#licNo').val()==lics[i]['id']){
                $('#hodNo').val(lics[i]['hodNo']);
                $('#pieceNo').val(lics[i]['pieceNo']);
            }
            
        }
    }
    $(document).ready(function() {
        
        $("#requieredAttatch").on("blur keypress", "#plusRequieredAttach",function() {
            if($(".attatchName").last().val().length>0){
                lastC1=$("#attachReceive1N").val();
                $("#requieredAttatch").append('' 
                +'<tr>'
                +    '<td class="col-md-1">'
                +        '<input type="checkbox" value="'+lastC1+'" name="attachReceive[]"  class="condition">'
                +    '</td>'
                +    '<td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >'
                +        '<input class="form-control attatchName"  type="text" name="attatchName[]"  >'
                +    '</td>'
                +    '<td onclick="$(this).parent().remove()" >'
                +        '<i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor:pointer;  color:#1E9FF2;font-size: 15pt; "></i>'
                +    '</td>'
                +'</tr>'
                );
                $("#attachReceive1N").val(++lastC1);
            }
        });

    });
    $(document).ready(function () {

        $( "#subscriber_name" ).autocomplete({
    		source:'subscribe_auto_complete',
    		minLength: 1,
            select: function( event, ui ) {
                $("#subscriber_id").val(ui.item.id)
                $('#is_lic_defined').val(0);
                $('#hodNo').val('');
                $('#pieceNo').val('');
                getFullData(ui.item.id)
                
                subscriber_id=ui.item.id;
            
            $.ajax({

            type: 'get', // the method (could be GET btw)
            
            url: "{{route('license_info_byUser')}}",
                data: {
            
                    subscriber_id: subscriber_id,
            
                },
                success:function(response){
            
                    template=""
            
                    count = 0;
            
                    $('#licNo').remove('');
            
                    if(response.info.length>0){
                        lics = new Array();
                        template += '<select onchange="setLicenceData(); '+"$('#is_lic_defined').val(1);"+'" class="form-control" name="licNo" id="licNo">'
            
                        template +='<option value="">-- اختر --</option>'
            
                        response.info.forEach(licence => {
                            lic={
                                'hodNo':(licence.hodNo??''),
                                'pieceNo':(licence.peiceNo??''),
                                'id':(licence.id??''),
                            }
                            lics.push(lic);
                            count++;
            
                               template +='<option value="'+licence.id+'"> '+(licence.licNo??'بدون')+'</option>'
            
            
                        });
                        template +='</select>'
            
                    }
            
                    else {
            
                        template += '<input type="text" id="licNo" name="licNo" class="form-control eng-sm  valid" value="" placeholder="" autocomplete="off">'
            
                    }
            
                $('#licGroup').append(template);
            
            
            
                },
            
            });
                if( {{$ticketInfo->apps_btn}}==1)
                    getSubscriberTasks(ui.item.id)
    		}
    	});
        

                
        $('#ticketFrm').submit(function(e) {
            $( "#licNo" ).removeClass( "error" );
            $( ".attatchName" ).removeClass( "error" );
            error=0;
            if($('#buildingUse').val()==1 && ($('#licNo').val()==null || $('#licNo').val()=='')){
                $( "#licNo" ).addClass( "error" );
                error=1;
            }
            
            var attachReceive   = document.getElementsByName('attachReceive[]');
            var attatchName     = document.getElementsByName('attatchName[]');
            
            for(i = 0 ; i < attachReceive.length; i++){
                
                if(($(attachReceive[i])[0].checked == false) && ($(attatchName[i]).val() !=null && $(attatchName[i]).val() !='')){
                    console.log($(attachReceive[i]))
                    $(attatchName[i]).addClass( "error" );
                    error=1;
                }
            }
            if(error==1){
                return false
            }
            
            $(".loader").removeClass('hide');
            $(".form-actions").addClass('hide');
            e.preventDefault();
            $( "#subscriber_name" ).removeClass( "error" );
            $( "#subscriber_id" ).removeClass( "error" );
            $( "#MobileNo" ).removeClass( "error" );
            $( "#AreaID" ).removeClass( "error" );
            $( "#hodNo" ).removeClass( "error" );
            $( "#pieceNo" ).removeClass( "error" );
            let formData = new FormData(this);
            $.ajax({
              type:'POST',
              url: "{{ route('saveTicket40') }}",
               data: formData,
               contentType: false,
               processData: false,
            success: (response) => {
                $(".form-actions").removeClass('hide');
            $('.wtbl').DataTable().ajax.reload();  
            // console.log('response');
             if (response.success!=null) {
                $(".loader").addClass('hide');
			    Swal.fire({
				position: 'top-center',
				icon: 'success',
				title: '{{trans('admin.data_added')}}',
				showConfirmButton: false,
				timer: 1500
				})
				
				writeUserData('viewTicket/'+response.app_id+'/'+response.app_type)
                if(print==true){
                let url=`{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
                window.open(url, '_blank');
                print=false;
				}
				setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
               this.reset();
				
//             if(print==true){
//                 self.location=`{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
//                 print=false;
// 				}
// writeUserData('viewTicket/'+response.app_id+'/'+response.app_type)
//         				setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
//               this.reset();
             }else{
                 if(response.error=='no_nationalID'){
                     
                    $("#national_id").addClass('error');
                    Swal.fire({
    				position: 'top-center',
    				icon: 'error',
    				title: 'أدخل رقم الهوية',
    				showConfirmButton: true,
    				timer: 2000
    				})
                    $(".loader").addClass('hide');
    				return false;
                 }
                 if(response.error=='no_attatch'){
                     
                     $(".attachName").addClass('error');
                     Swal.fire({
    				position: 'top-center',
    				icon: 'error',
    				title: 'أدخل المرفقات',
    				showConfirmButton: true,
    				timer: 2000
    				})
                    $(".loader").addClass('hide');
    				return false;
                 }
                 $(".loader").addClass('hide');

    			Swal.fire({
    				position: 'top-center',
    				icon: 'error',
    				title: '{{trans('admin.error_save')}}',
    				showConfirmButton: false,
    				timer: 1500
    				})
                 }
             //location.reload();

           },
            error: function(response){
            $(".loader").addClass('hide');
            $(".form-actions").removeClass('hide');
			if(response.responseJSON.errors.subscriber_name){
                $( "#subscriber_name" ).addClass( "error" );
                $( "#subscriber_name" ).get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $( "#subscriber_name" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.subscriber_id){
                $( "#subscriber_name" ).addClass( "error" );
                $( "#subscriber_name" ).get(0).setCustomValidity('أدخل اسم معرف مسبقا ');
                $( "#subscriber_name" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.MobileNo){
                $( "#MobileNo" ).addClass( "error" );
                $( "#MobileNo" ).get(0).setCustomValidity('أدخل رقم جوال ');
                $( "#MobileNo" ).on('blur',function(){
                    this.setCustomValidity('')
                })
            }
            // if(response.responseJSON.errors.hodNo){
            //     $( "#hodNo" ).addClass( "error" );
            //     $( "#hodNo" ).get(0).setCustomValidity('يرجى ادخال رقم الحوض ');
            //     $( "#hodNo" ).on('input',function(){
            //         this.setCustomValidity('')
            //     })
            // }
            // if(response.responseJSON.errors.pieceNo){
            //     $( "#pieceNo" ).addClass( "error" );
            //     $( "#pieceNo" ).get(0).setCustomValidity('يرجى ادخال رقم القطعة ');
            //     $( "#pieceNo" ).on('input',function(){
            //         this.setCustomValidity('')
            //     })
            // }
            if(response.responseJSON.errors.systemUse){
                $( "#systemUse" ).addClass( "error" );
                $( "#systemUse" ).get(0).setCustomValidity('يرجى اختيار الستعمال التنظيمي ');
                $( "#systemUse" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.buildingUse){
                $( "#buildingUse" ).addClass( "error" );
                $( "#buildingUse" ).get(0).setCustomValidity('يرجى اختيار استعمال البناء ');
                $( "#buildingUse" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            // if(response.responseJSON.errors.licNo){
            //     $( "#licNo" ).addClass( "error" );
            //     $( "#licNo" ).get(0).setCustomValidity('يرجى ادخال رقم الرخصة');
            //     $( "#licNo" ).on('input',function(){
            //         this.setCustomValidity('')
            //     })
            // }
            if(response.responseJSON.errors.AreaID){
                $( "#AreaID" ).addClass( "error" );
                $( "#AreaID" ).get(0).setCustomValidity('يرجى ادخال المنطقة');
                $( "#AreaID" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: 'يرجى تعبئة الحقول الاجبارية',
				showConfirmButton: false,
				timer: 1500
				})
           }
           });
      });
    });

    function getFullData(id){
    
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')

            }

        });
    formData={'id':id}
       $.ajax({
          type:'POST',
          url: "appCustomer",
           data: formData,
           /*contentType: false,
           processData: false,*/
           success: (response) => {
             if (response) {
                 srch=response.phone_one==null?(response.phone_two==null?'':response.phone_two):response.phone_one
                if(srch.search("056")>=0)
                    $('#mobImg').attr('src','{{asset('assets/images/w35.png')}}');
                else
                    $('#mobImg').attr('src','{{asset('assets/images/jawwal35.png')}}');
                $('#MobileNo').val(response.phone_one==null?(response.phone_two==null?'':response.phone_two):response.phone_one)
                $('#national_id').val((response.national_id??''))
                $(".loader").addClass('hide');
                if(response.warning.length!=0){
                    $(".btnArea").addClass("hide");
                    warningText='  المواطن لديه اخطار';
                    for(i=0 ; i< response.warning.length ; i++){
                        warningOpj=response.warning[i];
                        if(response.warning.length!=1 && i>=1){
                            warningText+=' - ';
                        }
                        warningText+=warningOpj.type.name;
                        warningText+=' بسبب ';
                        warningText+=warningOpj.warning_reason;
                        warningText+=' يرجى مراجعة قسم ';
                        warningText+=warningOpj.dept.name;
                    }
                    
                    Swal.fire({
                        title: 'لايمكن تقديم الطلب',
                        text: warningText,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'متابعة الطلب',
                        cancelButtonText: 'الغاء الطلب',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(".btnArea").removeClass("hide");
                        }else{
                            setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
                        }
                    })
                }
                getCert(response.id,response.archive.certCount);
                @can('subscriberContractArchive')    
                getContractArchive(response.id,response.archive.contractArchiveCount);
                @endcan
                
                @can('subscriberLicArchive')    
                getLicArchive(response.id,response.archive.licArchiveCount);
                @endcan
                
                @can('subscriberOutArchive')
                getOutArchive(response.id,response.archive.outArchiveCount);
                @endcan
                
                @can('subscriberInArchive')
                getInArchive(response.id,response.archive.inArchiveCount);
                @endcan
                
                @can('subscriberOtherArchive')
                getOtherArchive(response.id,response.archive.otherArchiveCount);
                @endcan
                
                @can('subscriberCopyArchive')
                getCopyArchive(response.id,response.archive.copyToCount);
                @endcan
                
                @can('subscriberJalArchive') 
                getJalArchive(response.id,response.archive.linkToCount);
                @endcan
             }

           },
           error: function(response){
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
}

    $(document).ready(function() {

        $("#requieredAttatch").on("blur keypress", "#plusRequieredAttach",function() {
            if($(".attatchName").last().val().length>0){
                lastC1=$("#attachReceive1N").val();
                $("#requieredAttatch").append('' 
                +'<tr>'
                +    '<td class="col-md-1">'
                +        '<input type="checkbox" value="'+lastC1+'" name="attachReceive[]"  class="condition">'
                +    '</td>'
                +    '<td class="col-md-10" id="plusRequieredAttach" style="text-align: center!important;" >'
                +        '<input class="form-control attatchName"  type="text" name="attatchName[]"  >'
                +    '</td>'
                +    '<td onclick="$(this).parent().remove()" >'
                +        '<i class="fa fa-trash" id="delete" style="padding-top:10px;position: relative;left: 3%;cursor:pointer;  color:#1E9FF2;font-size: 15pt; "></i>'
                +    '</td>'
                +'</tr>'
                );
                $("#attachReceive1N").val(++lastC1);
            }
        });
    });

function getSubscriberTasks(id){
    
        let subscribe_id = id;

            $.ajax({

                type: 'get',

                url: "subscriber_tasks",

                data: {

                    subscribe_id: subscribe_id,

                },

                success: function(response) {
                   
                    if (response.status!=false) {  
                        
                        drawtasks(response.tikets);
                        
                    }else{
                        Swal.fire({

            				position: 'top-center',
            
            				icon: 'error',
            
            				title: 'لايوجد طلبات لهاذا المواطن',
            
            				showConfirmButton: false,
            
            				timer: 1500
        
        				})
                    }
                },

            });
    
}

        $(function() {
            var table = $('.tasktbl1').DataTable({
                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
        });
        $(function() {
            var table = $('.tasktbl2').DataTable({
                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
        });
        $(function() {
            var table = $('.tasktbl3').DataTable({
                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
        });
        $(function() {
            var table = $('.tasktbl4').DataTable({
                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
        });

        function drawtasks($tickets){
            
            if ( $.fn.DataTable.isDataTable( '.tasktbl1' ) ) {
        
                $(".tasktbl1").dataTable().fnDestroy();
        
                $('#cMyTask1').empty();
        
            }
            if ( $.fn.DataTable.isDataTable( '.tasktbl2' ) ) {
        
                $(".tasktbl2").dataTable().fnDestroy();
        
                $('#cMyTask2').empty();
        
            }
            if ( $.fn.DataTable.isDataTable( '.tasktbl3' ) ) {
        
                $(".tasktbl3").dataTable().fnDestroy();
        
                $('#cMyTask3').empty();
        
            }
            if ( $.fn.DataTable.isDataTable( '.tasktbl4' ) ) {
        
                $(".tasktbl4").dataTable().fnDestroy();
        
                $('#cMyTask4').empty();
        
            }
            
            engCount=0;
            waterCount=0;
            elecCount=0;
            otherCount=0;
            
            for(i=0 ; i<$tickets.length ; i++){
                taskRow='';
                link= '/admin/viewTicket/'+$tickets[i]['trans']['ticket_id']+'/'+$tickets[i]['trans']['related'];
                if($tickets[i]['0']['app_type']==1){
                    elecCount++;
                    taskRow+= '<tr style="text-align:center">'
                
    					+'<td >'+elecCount+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['nick_name']        
    					+'</td>'
    					
    					+'<td>'
    					+'<a target="_blank" href="{{asset(app()->getLocale())}}'+link+'">'
                            +'<span class="hideMob" >'+ $tickets[i]['config']['ticket_name'] +' ('+$tickets[i]['0']['app_no'] +')' +'</span>'
                        +'</a>'
    					+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['created_at'].substring(0,10) +'&nbsp;&nbsp;&nbsp;'+$tickets[i]['0']['created_at'].substring(11,16)
    					+'</td>'
    
    					+'<td>'
                        +($tickets[i]['trans']['s_note'] ??'')
    					+'</td>'
    
    		            +'</tr>'
    		        $('#cMyTask2').append(taskRow);
		        }
                if($tickets[i]['0']['app_type']==2){
                    waterCount++;
                    taskRow+= '<tr style="text-align:center">'
                
    					+'<td >'+waterCount+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['nick_name']        
    					+'</td>'
    					
    					+'<td>'
                        +'<a target="_blank" href="{{asset(app()->getLocale())}}'+link+'">'
                            +'<span class="hideMob" >'+ $tickets[i]['config']['ticket_name'] +' ('+$tickets[i]['0']['app_no'] +')' +'</span>'
                        +'</a>'  
    					+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['created_at'].substring(0,10) +'&nbsp;&nbsp;&nbsp;'+$tickets[i]['0']['created_at'].substring(11,16)
    					+'</td>'
    
    					+'<td>'
                        +($tickets[i]['trans']['s_note'] ??'')
    					+'</td>'
    
    		            +'</tr>'
    		        $('#cMyTask3').append(taskRow);
		        }
                if($tickets[i]['0']['app_type']==3){
                    engCount++;
                    taskRow+= '<tr style="text-align:center">'
                
    					+'<td >'+engCount+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['nick_name']        
    					+'</td>'
    					
    					+'<td>'
                        +'<a target="_blank" href="{{asset(app()->getLocale())}}'+link+'">'
                            +'<span class="hideMob" >'+ $tickets[i]['config']['ticket_name'] +' ('+$tickets[i]['0']['app_no'] +')' +'</span>'
                        +'</a>' 
    					+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['created_at'].substring(0,10) +'&nbsp;&nbsp;&nbsp;'+$tickets[i]['0']['created_at'].substring(11,16)
    					+'</td>'
    
    					+'<td>'
                        +($tickets[i]['trans']['s_note'] ??'')
    					+'</td>'
    
    		            +'</tr>'
    		        $('#cMyTask1').append(taskRow);
		        }
                if($tickets[i]['0']['app_type']==4 || $tickets[i]['0']['app_type']==5){
                    otherCount++;
                    taskRow+= '<tr style="text-align:center">'
                
    					+'<td >'+otherCount+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['nick_name']        
    					+'</td>'
    					
    					+'<td>'
                        +'<a target="_blank" href="{{asset(app()->getLocale())}}'+link+'">'
                            +'<span class="hideMob" >'+ $tickets[i]['config']['ticket_name'] +' ('+$tickets[i]['0']['app_no'] +')' +'</span>'
                        +'</a>' 
    					+'</td>'
    
    					+'<td>'
                        +$tickets[i]['0']['created_at'].substring(0,10) +'&nbsp;&nbsp;&nbsp;'+$tickets[i]['0']['created_at'].substring(11,16)
    					+'</td>'
    
    					+'<td>'
                        +($tickets[i]['trans']['s_note'] ??'')
    					+'</td>'
    
    		            +'</tr>'
    		        $('#cMyTask4').append(taskRow);
		        }
            }
            
            $('#ctabCnt1').html(engCount);
            $('#ctabCnt2').html(elecCount);
            $('#ctabCnt3').html(waterCount);
            $('#ctabCnt4').html(otherCount);
            
            $('.tasktbl1').DataTable({
                dom: 'Bfltip',
                buttons: [{
                        extend: 'excel',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'excel',
                            src: '{{ asset('assets/images/ico/excel.png') }}',
                            style: 'cursor:pointer;height: 32px;',
                        },

                    },
                    {
                        extend: 'print',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'print',
                            src: '{{ asset('assets/images/ico/Printer.png') }} ',
                            style: 'cursor:pointer;height: 32px;',
                            class: "fa fa-print"
                        },
                        customize: function(win) {


                            $(win.document.body).find('table').find('tbody')
                                .css('font-size', '20pt');
                        }
                    },
                ],

                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
            $('.tasktbl2').DataTable({
                dom: 'Bfltip',
                buttons: [{
                        extend: 'excel',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'excel',
                            src: '{{ asset('assets/images/ico/excel.png') }}',
                            style: 'cursor:pointer;height: 32px;',
                        },

                    },
                    {
                        extend: 'print',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'print',
                            src: '{{ asset('assets/images/ico/Printer.png') }} ',
                            style: 'cursor:pointer;height: 32px;',
                            class: "fa fa-print"
                        },
                        customize: function(win) {


                            $(win.document.body).find('table').find('tbody')
                                .css('font-size', '20pt');
                        }
                    },
                ],

                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
            $('.tasktbl3').DataTable({
                dom: 'Bfltip',
                buttons: [{
                        extend: 'excel',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'excel',
                            src: '{{ asset('assets/images/ico/excel.png') }}',
                            style: 'cursor:pointer;height: 32px;',
                        },

                    },
                    {
                        extend: 'print',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'print',
                            src: '{{ asset('assets/images/ico/Printer.png') }} ',
                            style: 'cursor:pointer;height: 32px;',
                            class: "fa fa-print"
                        },
                        customize: function(win) {


                            $(win.document.body).find('table').find('tbody')
                                .css('font-size', '20pt');
                        }
                    },
                ],

                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
            $('.tasktbl4').DataTable({
                dom: 'Bfltip',
                buttons: [{
                        extend: 'excel',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'excel',
                            src: '{{ asset('assets/images/ico/excel.png') }}',
                            style: 'cursor:pointer;height: 32px;',
                        },

                    },
                    {
                        extend: 'print',
                        tag: 'img',
                        title: '',
                        attr: {
                            title: 'print',
                            src: '{{ asset('assets/images/ico/Printer.png') }} ',
                            style: 'cursor:pointer;height: 32px;',
                            class: "fa fa-print"
                        },
                        customize: function(win) {


                            $(win.document.body).find('table').find('tbody')
                                .css('font-size', '20pt');
                        }
                    },
                ],

                "language": {
                    "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
                    "sLoadingRecords": "جارٍ التحميل...",
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    },
                    "oAria": {
                        "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    }
                }
            });
            
        }
</script>
@stop

