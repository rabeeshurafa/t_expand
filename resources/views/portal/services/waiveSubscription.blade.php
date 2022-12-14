@extends('portal.portal')
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

        .detailsTB th {
            color: #ffffff !important;
        }

        .attachs-section {
            color: #2C303B;
            line-height: 2.5rem;
            margin-bottom: 20px;
            margin-left: 25px;
            margin-right: 25px;
            border-bottom: 1px solid #2C303B;
        }

    </style>


    <link rel="stylesheet" type="text/css"
        href="https://template.expand.ps/app-assets/global/plugins/jquery-multi-select/css/multi-select-rtl.css" />

    <script src="https://db.expand.ps/assets/jquery.min.js" type="text/javascript"></script>

    <section class="horizontal-grid " id="horizontal-grid">

        <form method="post" id="ticketFrm" enctype="multipart/form-data">
            @csrf
            <div class="row white-row">

                <div class="col-sm-12 col-md-12">
                    <div class="card leftSide">
                        @include('portal.includes.ticketHeader')
                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    @include('portal.includes.subscriber')
                                    <input type="hidden" id="app_type"  name="app_type" value="1">
                                    <input type="hidden" id="dept_id"  name="dept_id" value="{{$ticketInfo->dept_id}}">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label class="form-label"
                                                        style="color: #ff9149;"><b>{{ '???????? ??????????' }}</b>:</label>
                                                    <div class="col-sm-12 col-md-8">
                                                        <label for="radio-3">{{"????????????"}} </label>
                                                        <input
                                                            type="radio" name="Applicanttype" checked="" id="radio-3"
                                                            class="jui-radio-buttons" value="1"
                                                            onclick="$('.Acting').hide();">
                                                        <label for="radio-4">{{"???????? ??????"}} </label>
                                                        <input
                                                            type="radio" name="Applicanttype" id="radio-4"
                                                            class="jui-radio-buttons" value="2"
                                                            onclick="$('.Acting').show();">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row Acting" style="position: relative; display: none;" id="Acting">
                                        <div class="col-md-7">
                                            <div class="form-group paddmob">
                                                <div class="input-group subscribermob">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ '???????? ??????????' }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="subscriber_name2"
                                                        class="form-control numFeild" placeholder="{{ '???????? ??????????' }}"
                                                        name="subscriber_name2">
                                                        <input type="hidden" id="subscriber_id2" name="subscriber_id2" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" >
                                            <div class="form-group paddmob">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text input-group-text1" id="basic-addon1">
                                                            <img id="mobImg2" src="https://db.expand.ps/images/jawwal35.png">
                                                        </span>
                                                    </div>
                                                    <input type="text" id="MobileNo2" maxlength="10" name="MobileNo2"
                                                        class="form-control noleft numFeild" placeholder="0590000000"
                                                        aria-describedby="basic-addon1"
                                                        onblur="$('#username').val($(this).val())">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('portal.includes.regionsTemplate')

                                    <div class="row mobRow">
                                        <div class="col-md-12">
                                            <h5 class="sub-head" style="color:#ff9149">
                                                <b>
                                                    {{ '???????????? ????????????????' }}
                                                </b>
                                            </h5>

                                            <table class="detailsTB table" style="margin-left: 15px;">
                                                <tbody>
                                                    <tr>
                                                        <th scope="col">
                                                            {{ '#' }}
                                                        </th>
                                                        <th scope="col">
                                                            {{ '?????? ????????????????' }}
                                                        </th>
                                                        <th scope="col" class="hideMob"
                                                            style="text-align: -webkit-center;">
                                                            {{ '????????????' }}
                                                        </th>
                                                        <th scope="col" style="text-align: -webkit-center;">
                                                            {{ '?????? ???????? ????????????' }}
                                                        </th>
                                                        <th scope="col"></th>

                                                    </tr>
                                                </tbody>
                                                <tbody id="recList">

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md attachs-section">
                                <img src="https://db.expand.ps/images/personal-information.png" width="40" height="40">
                                <span class="attach-header">{{ '???????????? ????????????' }}</span>
                            </div>
                        </div>
                        <div class="form-group" style="padding-right: 25px;">
                            @include('portal.includes.subscriber1')
                            @include('portal.includes.regionsTemplate1')

                        </div>

                    </div>
                </div>
            </div>
            </div>




        </form>
    </section>

<script>

$(document).ready(function () {

    $( "#subscriber_name" ).autocomplete({
		source:'subscribe_auto_complete',
		minLength: 1,
        select: function( event, ui ) {
            $("#subscriber_id").val(ui.item.id)
            getFullData(ui.item.id)
            if( {{$ticketInfo->apps_btn}}==1)
                getSubscriberTasks(ui.item.id)
		}
	});
	
    $( "#subscriber_name1" ).autocomplete({
		source:'subscribe_auto_complete',
		minLength: 1,
        select: function( event, ui ) {
            $("#subscriber_id1").val(ui.item.id)
            getFullData1(ui.item.id)
		}
	});
	
	$( "#subscriber_name2" ).autocomplete({
		source:'subscribe_auto_complete',
		minLength: 1,
        select: function( event, ui ) {
            $("#subscriber_id2").val(ui.item.id)
            getFullData2(ui.item.id)
		}
	});
	
    $('#ticketFrm').submit(function(e) {
        $(".loader").removeClass('hide');

       e.preventDefault();
       $( "#subscriber_name" ).removeClass( "error" );
        $( "#subscriber_id" ).removeClass( "error" );
        $( "#MobileNo" ).removeClass( "error" );
        $( "#AreaID" ).removeClass( "error" );
        $( "#subscriber_name1" ).removeClass( "error" );
        $( "#subscriber_id1" ).removeClass( "error" );
        $( "#MobileNo1" ).removeClass( "error" );
        $( "#AreaID1" ).removeClass( "error" );
       let formData = new FormData(this);
       $.ajax({
          type:'POST',
          url: "saveTicket8",
           data: formData,
           contentType: false,
           processData: false,
           success: (response) => {
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
				
// 			if(print==true){
//                 self.location=`{{ route('admin.dashboard') }}/printTicket/${response.app_id}/${response.app_type}`
//                 print=false;
// 				}

// writeUserData('viewTicket/'+response.app_id+'/'+response.app_type)
//         				setTimeout(function(){self.location='{{asset('/ar/admin')}}'},1500)
//               this.reset();
             }else{
                 console.log(response.error);
                 if(response.error=='no_attatch'){
                     
                     $(".attachName").addClass('error');
                     Swal.fire({
    				position: 'top-center',
    				icon: 'error',
    				title: '???????? ????????????????',
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

             if(response.responseJSON.errors.subscriber_name1){
               $( "#subscriber_name1" ).addClass( "error" );
               $( "#subscriber_name1" ).get(0).setCustomValidity('???????? ?????????? ??????????');
               $( "#subscriber_name1" ).on('input',function(){
                 this.setCustomValidity('')
               })
             }
             if(response.responseJSON.errors.subscriber_name2){
               $( "#subscriber_name2" ).addClass( "error" );
               $( "#subscriber_name2" ).get(0).setCustomValidity('???????? ?????????? ????????????');
               $( "#subscriber_name2" ).on('input',function(){
                 this.setCustomValidity('')
               })
             }
             if(response.responseJSON.errors.subscriber_name3){
               $( "#subscriber_name3" ).addClass( "error" );
               $( "#subscriber_name3" ).get(0).setCustomValidity('???????? ?????????? ????????????');
               $( "#subscriber_name3" ).on('input',function(){
                 this.setCustomValidity('')
               })
             }
             if(response.responseJSON.errors.subscriber_name4){
               $( "#subscriber_name4" ).addClass( "error" );
               $( "#subscriber_name4" ).get(0).setCustomValidity('???????? ?????????? ????????????');
               $( "#subscriber_name4" ).on('input',function(){
                 this.setCustomValidity('')
               })
             }
            if(response.responseJSON.errors.subscriber_id){
                $( "#subscriber_id" ).addClass( "error" );
                $( "#subscriber_name" ).get(0).setCustomValidity('???????? ?????? ???????? ?????????? ');
                $( "#subscriber_name" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.MobileNo){
                $( "#MobileNo" ).addClass( "error" );
                $( "#MobileNo" ).get(0).setCustomValidity('???????? ?????? ???????? ');
                $( "#MobileNo" ).on('blur',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.AreaID){
                $( "#AreaID" ).addClass( "error" );
                $( "#AreaID" ).get(0).setCustomValidity('???????? ???????????? ?????????? ');
                $( "#AreaID" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.subscriber_name1){
                $( "#subscriber_name1" ).addClass( "error" );
                $( "#subscriber_name1" ).get(0).setCustomValidity('???????? ?????? ???????? ?????????? ');
                $( "#subscriber_name1" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.subscriber_id1){
                $( "#subscriber_id1" ).addClass( "error" );
                $( "#subscriber_name1" ).get(0).setCustomValidity('???????? ?????? ???????? ?????????? ');
                $( "#subscriber_name1" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.MobileNo1){
                $( "#MobileNo1" ).addClass( "error" );
                $( "#MobileNo1" ).get(0).setCustomValidity('???????? ?????? ???????? ');
                $( "#MobileNo1" ).on('blur',function(){
                    this.setCustomValidity('')
                })
            }
            if(response.responseJSON.errors.AreaID1){
                $( "#AreaID1" ).addClass( "error" );
                $( "#AreaID1" ).get(0).setCustomValidity('???????? ???????????? ?????????? ');
                $( "#AreaID1" ).on('input',function(){
                    this.setCustomValidity('')
                })
            }
            
			Swal.fire({
				position: 'top-center',
				icon: 'error',
				title: '???????? ?????????? ???????????? ??????????????????',
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
                $(".loader").addClass('hide');
                if(response.elec!=null){
                     var len = response.elec.length;
                     $row='';
                    for(var i=0; i<len; i++){
                        // if(response.elec[i].counter==null)
                        // continue;
                       $row+= 
                        '<tr id="memRow1">'+
                        '<td style="color:#1E9FF2">'+(i+1)+'</td> '+
                        '<td>'+
                            (response.elec[i].subscription_no??'')+
                            '<input type="hidden" name="SubscribtionIdList[]" value="'+response.elec[i].id+'"><input type="text" class="form-control form-control1 numFeild hide" name="SubscribtionNumList[]" value="'+(response.elec[i].licNo??'')+'">'+
                        '</td>'+
                        '<td class="hideMob" style="text-align: -webkit-center;">'+
                            (response.elec[i].counter==null?'':response.elec[i].counter.name)+
                            '<input type="text" class="form-control form-control1 alphaFeild hide" name="CounterTypeList[]" value="'+(response.elec[i].counter==null?'':response.elec[i].counter.name)+'">'+
                        '</td>'+
                        '<td style="text-align: -webkit-center;">'+
                            (response.elec[i].placeDesc??'')+
                            '<input type="text" class="form-control form-control1   hide" name="CapacityList[]" value="'+(response.elec[i].placeDesc??'')+'">'+
                        '</td>'+
                        '<td>'+
                            '<a class="remove-btn" onclick="$(this).parent().parent().remove()" >'+
                                '<i class="fa fa-trash" style="color:#1E9FF2;"></i>'+
                            '</a>'+
                        '</td>'+
                        '</tr>';
                    }
                    $("#recList").append($row);
                    
                }
                
                console.log(response.errorList.length)
                
                if(response.elec.length!=0){
                    $("#saveBtn").removeClass("hide");
                    $("#saveBtnSend").removeClass("hide");
                    //$(".errArea").addClass("hide");
                }
                else
                {
                    
                        $("#saveBtn").addClass("hide");
                        $("#saveBtnSend").addClass("hide");
                        $("#recList").html('');
                        //$(".errArea").removeClass("hide");
                        Swal.fire({
            				position: 'top-center',
            				icon: 'error',
            				title: '???? ???????? ?????????? ?????????? ???????? ???????? ???????????? ???????? ???? ????????????',
            				showConfirmButton: true,
            				})
                }
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

function getFullData1(id){
    
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
                    $('#mobImg1').attr('src','{{asset('assets/images/w35.png')}}');
                else
                    $('#mobImg1').attr('src','{{asset('assets/images/jawwal35.png')}}');
                $('#MobileNo1').val(response.phone_one==null?(response.phone_two==null?'':response.phone_two):response.phone_one)
                $(".loader").addClass('hide');
                
                // if(response.elec!=null){
                //      var len = response.elec.length;
                //      $row='';
                //     for(var i=0; i<len; i++){
                //       $row+= 
                //         '<tr id="memRow1">'+
                //         '<td style="color:#1E9FF2">'+(i+1)+'</td> '+
                //         '<td>'+
                //             (response.elec[i].licNo??'')+
                //             '<input type="hidden" name="SubscribtionIdList[]" value="'+response.elec[i].id+'"><input type="text" class="form-control form-control1 numFeild hide" name="SubscribtionNumList[]" value="'+(response.elec[i].licNo??'')+'">'+
                //         '</td>'+
                //         '<td class="hideMob" style="text-align: -webkit-center;">'+
                //             (response.elec[i].counter.name??'')+
                //             '<input type="text" class="form-control form-control1 alphaFeild hide" name="CounterTypeList[]" value="'+(response.elec[i].counter.name??'')+'">'+
                //         '</td>'+
                //         '<td style="text-align: -webkit-center;">'+
                //             (response.elec[i].placeDesc??'')+
                //             '<input type="text" class="form-control form-control1   hide" name="CapacityList[]" value="'+(response.elec[i].placeDesc??'')+'">'+
                //         '</td>'+
                //         '<td>'+
                //             '<a class="remove-btn" onclick="$(this).parent().parent().remove()" >'+
                //                 '<i class="fa fa-trash" style="color:#1E9FF2;"></i>'+
                //             '</a>'+
                //         '</td>'+
                //         '</tr>';
                //     }
                //     $("#recList").append($row);
                    
                // }
                
                // if(response.elec.length!=0){
                //     $("#saveBtn").removeClass("hide");
                //     $("#saveBtnSend").removeClass("hide");
                //     //$(".errArea").addClass("hide");
                // }
                // else
                // {
                    
                //         $("#saveBtn").addClass("hide");
                //         $("#saveBtnSend").addClass("hide");
                //         $("#recList1").html('');
                //         //$(".errArea").removeClass("hide");
                //         Swal.fire({
            				// position: 'top-center',
            				// icon: 'error',
            				// title: '???? ???????? ?????????? ?????????? ???????? ???????? ???????????? ???????? ???? ????????????',
            				// showConfirmButton: true,
            				// })
                // }
                
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

function getFullData2(id){
    
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
                    $('#mobImg2').attr('src','{{asset('assets/images/w35.png')}}');
                else
                    $('#mobImg2').attr('src','{{asset('assets/images/jawwal35.png')}}');
                $('#MobileNo2').val(response.phone_one==null?(response.phone_two==null?'':response.phone_two):response.phone_one)
                $(".loader").addClass('hide');
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
            
            				title: '???????????? ?????????? ?????????? ??????????????',
            
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
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
                    }
                }
            });
        });
        $(function() {
            var table = $('.tasktbl2').DataTable({
                "language": {
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
                    }
                }
            });
        });
        $(function() {
            var table = $('.tasktbl3').DataTable({
                "language": {
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
                    }
                }
            });
        });
        $(function() {
            var table = $('.tasktbl4').DataTable({
                "language": {
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
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
                        +$tickets[i]['trans']['nick_name']        
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
                        +$tickets[i]['trans']['nick_name']        
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
                        +$tickets[i]['trans']['nick_name']        
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
                        +$tickets[i]['trans']['nick_name']        
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
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
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
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
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
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
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
                    "sEmptyTable": "???????? ???????? ???????????? ?????????? ???? ????????????",
                    "sLoadingRecords": "???????? ??????????????...",
                    "sProcessing": "???????? ??????????????...",
                    "sLengthMenu": "???????? _MENU_ ????????????",
                    "sZeroRecords": "???? ???????? ?????? ?????? ??????????",
                    "sInfo": "?????????? _START_ ?????? _END_ ???? ?????? _TOTAL_ ????????",
                    "sInfoEmpty": "???????? 0 ?????? 0 ???? ?????? 0 ??????",
                    "sInfoFiltered": "(???????????? ???? ?????????? _MAX_ ??????????)",
                    "sInfoPostFix": "",
                    "sSearch": "????????:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "??????????",
                        "sPrevious": "????????????",
                        "sNext": "????????????",
                        "sLast": "????????????"
                    },
                    "oAria": {
                        "sSortAscending": ": ?????????? ???????????? ???????????? ????????????????",
                        "sSortDescending": ": ?????????? ???????????? ???????????? ????????????????"
                    }
                }
            });
            
        }
</script>

@stop

