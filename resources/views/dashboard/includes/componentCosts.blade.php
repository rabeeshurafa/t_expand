
<div class="modal fade text-left" id="componentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">

    <div class="modal-dialog partWidth" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel1">قطع الغيار 
                ({{ $config[0]->ticket_name }})
                </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

            </div>

            <div class="modal-body" style="background: #f4f5fa">

                <form method="post" id="sparePartModal" enctype="multipart/form-data">
                    <div class="form-body">
                            
                        @csrf
                        <div class="row">                                       
                            <div class="col-md-12 tablescroll">
                                <input type="hidden" name="ticketID" id="ticketID" value="{{$ticket->id}}"/>
                                <input type="hidden" name="related" id="related"  value="{{$config[0]->ticket_no}}"/>
                                <table id="spare_myTable" class="detailsTB responsive table order-list" style="padding: 0.75rem 2rem;">
                                    <colgroup>
                                       <col span="1" style="width: 1%;">
                                       <col span="1" style="width: 50%;">
                                       <col span="1" style="width: 10%;">
                                       <col span="1" style="width: 10%;">
                                       <col span="1" style="width: 10%;">
                                       <col span="1" style="width: 1%;">
                                    </colgroup>
                        
                                    <thead>
                                        <tr>
                                            
                                            <th class="" scope="col">
                                                {{ 'رقم' }}
                                            </th>
                                            <th style="padding: 0.75rem 5rem;" scope="col" class="" style="text-align: -webkit-center;color: white;">
                                                {{ 'البيان' }}
                                            </th>
                                            <th style="padding: 0.75rem 1.5rem;" scope="col" class="" style="text-align: -webkit-center;color: white;">
                                                {{ 'الكمية' }}
                                            </th>
                                            <th style="padding: 0.75rem 1.5rem;" scope="col" class="showcosts hide" style="text-align: -webkit-center;color: white;">
                                                {{ 'السعر' }}
                                            </th>
                                            <th style="padding: 0.75rem 1.5rem;" scope="col" class="showcosts hide " style="text-align: -webkit-center;color: white;">
                                                {{ 'المجموع' }}
                                            </th>
                                            <th style="padding: 0.75rem 1.5rem;" class="hidemob" scope="col" class="hidemob"></th>
                                
                                        </tr>
                                    </thead>
                                    <tbody id="spare_mytbody">
                                        <?php $count = 1;?>
                                        @foreach($helpers['sparePartes'] as $order)
                                        
                                        <tr>
                                            <td class="col-sm-4 " style="width: 1%; border: none;">
                                                <input type="hidden" id="spare_order_id"  name="spare_order_id[]" value="{{($order->id)}}">
                                                {{$count++}}
                                            </td>
                                            <td class="col-sm-4" style="width: 50%;  border: none;">
                                                <input type="text" name="spare_itemname[]" id="spare_itemname" value="{{($order->itemname??'')}}" class="form-control acSpare " />
                                            </td>
                                            <td class="col-sm-4" style="width: 10%; border: none;">
                                                <input type="text" name="spare_quantity[]"  class="form-control" value="{{($order->quantity??'')}}" oninput="CalculateColumns('spare_myTable','spare_price[]','spare_quantity[]','spare_total[]','spare_totalamount')"/>
                                            </td>
                                            <td class="col-sm-4 showcosts hide" style="width: 10%; border: none;">
                                                <input type="mail" name="spare_price[]"  class="form-control spare_price" value="{{($order->price??'')}}" id="spare_price" oninput="CalculateColumns('spare_myTable','spare_price[]','spare_quantity[]','spare_total[]','spare_totalamount')"/>
                                            </td>
                                            <td class="col-sm-4 showcosts hide" style="width: 10%; border: none;">
                                                <input type="text" name="spare_total[]" value="{{($order->total??'')}}"  class="form-control"/>
                                            </td>
                                            <td class="col-sm-2" style="width: 1%; border: none;">
                                                @if($count != 2)
                                                <i id="spare_delete" class="fa fa-trash"  style="color:#1E9FF2;padding-top: 9px;"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            
                                            <td class="col-sm-4 " style="width: 1%; border: none;">
                                                <input type="hidden" id="spare_order_id"  name="spare_order_id[]" value="0">
                                                {{$count++}}
                                            </td>
                                            <td class="col-sm-4" style="width: 50%;  border: none;">
                                                <input type="text" name="spare_itemname[]" id="spare_itemname"  class="form-control acSpare " />
                                            </td>
                                            <td class="col-sm-4" style="width: 10%; border: none;">
                                                <input type="text" name="spare_quantity[]"  class="form-control"  oninput="CalculateColumns('spare_myTable','spare_price[]','spare_quantity[]','spare_total[]','spare_totalamount')"/>
                                            </td>
                                            <td class="col-sm-4 showcosts hide" style="width: 10%; border: none;">
                                                <input type="mail" name="spare_price[]"  class="form-control spare_price"  id="spare_price" oninput="CalculateColumns('spare_myTable','spare_price[]','spare_quantity[]','spare_total[]','spare_totalamount')"/>
                                            </td>
                                            <td class="col-sm-4 showcosts hide" style="width: 10%; border: none;">
                                                <input type="text" name="spare_total[]"   class="form-control"/>
                                            </td>
                                            <td class="col-sm-2" style="width: 1%; border: none;">
                                                @if($count != 2)
                                                <i id="spare_delete" class="fa fa-trash"   style="color:#1E9FF2;padding-top: 9px;"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="showcosts hide">
                                        <tr>
                                            <td class="col-sm-4" colspan="4" style="text-align: left; height: 100%; border: none;">
                                                <span class="input-group-text" id="basic-addon1" style="background-color:whitesmoke; display: grid; height:35px; width: 100%; color: orangered;text-align: center; font-size: large">المجموع الكلي</span>
                                            </td>
                                            <td class="col-sm-4" style="width: 15%; border: none;">
                                                <input type="text" id="spare_totalamount" name="spare_totalamount"  class="form-control"/>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                        
                            </div>
                        </div>
                        <div class="form-actions" style="border-top:0px; padding:0px !important; margin:0 !important">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" id="saveBtn">
                                    <i class="la la-check-square-o"></i>
                                    حفظ
                                </button>
                            </div>
                        </div>
                    </div>
                        
                </form>
                    
            </div>

        </div>

    </div>

</div>

<script>
    function ShowComponentModal(bindTo) {

        // $("#CitizenName").html($("#formDataNameAR").val())
        
        $("#componentModal").modal('show')
    
    }
    showcosts=0;
    $( function() {
        $('#sparePartModal').submit(function(e) {
            $(".loader").removeClass('hide');
            
           let formData = new FormData(this);
           e.preventDefault();
           $.ajax({
              type:'POST',
              url: "{{route('saveSparPart')}}",
               data: formData,
               contentType: false,
               processData:false ,
               //dataType:json ,
               success: (response) => {
                 if (response) {
                    $(".loader").addClass('hide');
    			    Swal.fire({
        				position: 'top-center',
        				icon: 'success',
        				title: 'تم حفظ قطع الغيار بنجاح',
        				showConfirmButton: false,
        				timer: 1500
        				})
                     }
                     
                    // $("#AppModal").modal('show')
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
      });
    	
    } );
    
    $(document).ready(function () {
        
        @can('showSpareCosts')
            showcosts=1;
            $('.showcosts').removeClass('hide');
        @endcan
        
        
        CalculateColumns('spare_myTable','spare_price[]','spare_quantity[]','spare_total[]','spare_totalamount');
        $( ".acSpare" ).autocomplete({
    		source:'{{route('sparePart_auto_complete')}}',
    		minLength: 1,
            select: function( event, ui ) {
    		}
	    });
    
    });
    
    window.globalCounter = '{{$count}}';
    $(document).ready(function () {
        $("#spare_mytbody").on("input","#spare_itemname", function () {
            if($(".acSpare").last().val().length>0){
                var data = '<tr><td class="col-sm-4 " style="width: 1%; border: none;">' 
                +'<input type="hidden" id="spare_order_id"  name="spare_order_id[]" value="0">'
                + window.globalCounter 
                + '</td><td class="col-sm-4" style="width: 50%; border: none;">'
                +'<input type="text" class="form-control acSpare" id="spare_itemname" name="spare_itemname[]"/>'
                +'</td><td class="col-sm-4" style="width: 10%; border: none;">'
                +'<input type="text" class="form-control" name="spare_quantity[]" oninput="CalculateColumns(\'spare_myTable\',\'spare_price[]\',\'spare_quantity[]\',\'spare_total[]\',\'spare_totalamount\')"/>'
                +'</td>'
                +'<td class="col-sm-4 showcosts  '+(showcosts==0?' hide':'')+' " style="width: 10%; border: none;">'
                +'<input type="text" class="form-control spare_price" id="spare_price" name="spare_price[]" oninput="CalculateColumns(\'spare_myTable\',\'spare_price[]\',\'spare_quantity[]\',\'spare_total[]\',\'spare_totalamount\')"/>'
                +'</td><td class="col-sm-4 showcosts '+(showcosts==0?' hide':'')+'" style="width: 10%; border: none;">'
                +'<input type="text" class="form-control " name="spare_total[]"/>'
                +'</td><td style=" border: none;"><i id="spare_delete" class="fa fa-trash" style="color:#1E9FF2;padding-top: 9px;"></i></td></tr>';
                $("#spare_mytbody").append(data);
                window.globalCounter++;
                console.log(data);
                $( ".acSpare" ).autocomplete({
            		source:'{{route('sparePart_auto_complete')}}',
            		minLength: 1,
                    select: function( event, ui ) {
            		}
        	    });
    	        
                if(window.globalCounter>=7){
                    $(".leftSide").removeAttr("style");
                }
            }
        });

        $("#spare_mytbody").on("click", "#spare_delete", function (ev) {
            var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
            $currentTableRow.remove();
            CalculateColumns('spare_myTable','spare_price[]','spare_quantity[]','spare_total[]','spare_totalamount');
            window.globalCounter--;

            $("#spare_mytbody").find('tr').each(function (index) {
                var firstTDDomEl = $(this).find('td')[0];
                var $firstTDJQObject = $(firstTDDomEl);
                $firstTDJQObject.text(index + 1);
            });
        });


    });    

    function CalculateColumns(ContainerID, Col1, Col2, Col3, GrandTotalID) {
        if( typeof ContainerID == 'string' ) var ContainerID = document.getElementById( ContainerID );

        var arrCol1 = new Array();
        var arrCol2 = new Array();
        var arrCol3 = new Array();
        var GrandTotal = 0;
        var ContainerIDElements = new Array( 'input');
        //var ContainerIDElements = new Array('input', 'textarea', 'select');

        for( var i = 0; i < ContainerIDElements.length; i++ ){
            els = ContainerID.getElementsByTagName( ContainerIDElements[i] );
            for( var j = 0; j < els.length; j++ ){
                if(els[j].name == Col1) arrCol1.push(els[j]);
                if(els[j].name == Col2) arrCol2.push(els[j]);
                if(els[j].name == Col3) arrCol3.push(els[j]);
            }
        }

        for( var j = 0; j < arrCol1.length; j++ ) {
           if((Number(arrCol1[j].value)>0) && (Number(arrCol2[j].value)>0)) {
               arrCol3[j].value = Number(arrCol1[j].value) * Number(arrCol2[j].value);
               GrandTotal += Number(arrCol3[j].value);
           }
        }

        document.getElementById(GrandTotalID).value = GrandTotal;
    } // CalculateColumns
</script>
