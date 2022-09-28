<div class="row">
   <div class="card-body">
       <div class="form-group col-sm-12 tablescroll">
            <table id="myTable" class="detailsTB table responsive order-list"  style="padding: 0.75rem 2rem;" >
            <!--<thead>-->
            <!--    <tr style="text-align:center !important;background: #0073AA;">-->
            <!--        <td style="color: white">رقم</td>-->
            <!--        <td style="color: white">البيان</td>-->
            <!--        <td style="color: white">الكمية</td>-->
            <!--        <td style="color: white">الوحدة</td>-->
            <!--        <td style="color: white"> السعر</td>-->
            <!--        <td style="color: white">المجموع</td>-->
            <!--    </tr>-->
            <!--</thead>-->
            <colgroup>
               <col span="1" style="width: 3%;">
               <col span="1" style="width: 25%;">
               <col span="1" style="width: 10%;">
               <col span="1" style="width: 3%;">
            </colgroup>
            <thead>
                <tr>
                    <th class="" scope="col">
                        {{ 'رقم' }}
                    </th>
                    <th style="padding: 0.75rem 5rem;" scope="col" class="" style="text-align: -webkit-center;color: white;">
                        {{ 'البيان' }}
                    </th>
                    <th style="padding: 0.75rem 2rem;" scope="col" class="  " style="text-align: -webkit-center;color: white;">
                        {{ 'المجموع' }}
                    </th>
                    <th style="padding: 0.75rem 1.5rem;" class="hidemob" scope="col" class="hidemob"></th>
        
                </tr>
            </thead>
            <tbody id="mytbody">
                <?php $count = 1;?>
                @foreach($helpers['orders'] as $order)
                    <tr>
                        <input type="hidden" id="order_id"  name="order_id[]" value="{{($order->id)}}">
                        <td  class="text-center" style="border: none;color:#1E9FF2;" >
                            {{$count++}}
                        </td>
                        <td  style=" border: none;width: 80%;">
                            <input type="text" name="itemname[]" id="itemname" {{ $readonly?"readonly":"" }} value="{{($order->itemname??'')}}" class=" form-control ac text-center itemname" />
                        </td>
                        <td  style="border: none;width: 16%;">
                            <input type="text" name="total[]" {{ $readonly?"readonly":"" }} value="{{($order->total??'')}}"  class="text-center form-control" oninput="CalculateColumns('myTable','total[]','totalamount')"/>
                        </td>
                        <td class=" hidemob" style="border: none; ">
                            @if($count != 2)
                            <i id="delete" class="fa fa-trash {{ $readonly?"hide":"" }}"  style="color:#1E9FF2;padding-top: 9px;"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                   <tr>
                        <input type="hidden" id="order_id"  name="order_id[]" value="0">
                        <td class="col-sm-4 " style="width: 2%; border: none;">
                            {{$count++}}
                        </td>
                        <td class="col-sm-4" style="width: 80%;  border: none;">
                            <input type="text" name="itemname[]" id="itemname" {{ $readonly?"readonly":"" }}  class="text-center form-control ac itemname" />
                        </td>
                        <td class="col-sm-4" style="width: 16%; border: none;">
                            <input type="text" name="total[]" {{ $readonly?"readonly":"" }}   class="text-center form-control" oninput="CalculateColumns('myTable','total[]','totalamount')"/>
                        </td>
                        <td class="col-sm-2" style="width: 2%; border: none;">
                            <i id="delete" class="hidemob fa fa-trash {{ $readonly?"hide":"" }}"  style="color:#1E9FF2;padding-top: 9px;"></i>
                        </td>
                    </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center col-sm-4" colspan="2" style="text-align: left; height: 100%; border: none;">
                        <span class="input-group-text" id="basic-addon1" style="background-color:whitesmoke; display: grid; height:35px; width: 100%; color: orangered;text-align: left; font-size: large">المجموع الكلي</span>
                    </td>
                    <td class="text-center col-sm-4" style="width: 10%; border: none;">
                        <input type="text" id="totalamount" name="totalamount" {{ $readonly?"readonly":"" }} value="{{ $ticket->totalamount }}"  class="text-center form-control"/>
                    </td>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>
<script>
      CalculateColumns('myTable','total[]','totalamount');  
    $(document).ready(function () {
        
        $( ".ac" ).autocomplete({
    		source:'{{route('sparePart_auto_complete')}}',
    		minLength: 1,
            select: function( event, ui ) {
    		}
	    });
    
    });
    
    
    window.globalCounter =  {{($count)}};
    $(document).ready(function () {
        
        $("#mytbody").on("input","#itemname", function () {
            if($(".itemname").last().val().length>0){
                var data = '<tr><td class="col-sm-4 " style="width: 5%; border: none;">' 
                + window.globalCounter 
                + '</td><td class="col-sm-4" style="width: 80%; border: none;">'
                +'<input type="text" class="form-control ac itemname" name="itemname[]"/>'
                +'</td><td class="col-sm-4" style="width: 16%; border: none;" oninput="CalculateColumns(\'myTable\',\'total[]\',\'totalamount\')">'
                +'<input type="text" class="form-control" name="total[]"/>'
                +'</td><td style=" border: none;"><i id="delete" class="fa fa-trash" style="color:#1E9FF2;padding-top: 9px;"></i></td></tr>';
                $("#mytbody").append(data);
                window.globalCounter++;
                
                $( ".ac" ).autocomplete({
            		source:'sparePart_info',
            		minLength: 1,
                    select: function( event, ui ) {
            		}
    	        });
    	        
                if(window.globalCounter>=7){
                    $(".leftSide").removeAttr("style");
                }
            }
        });

        $("#mytbody").on("click", "#delete", function (ev) {
            var $currentTableRow = $(ev.currentTarget).parents('tr')[0];
            $currentTableRow.remove();
            CalculateColumns('myTable','total[]','totalamount');
            window.globalCounter--;

            $("#mytbody").find('tr').each(function (index) {
                var firstTDDomEl = $(this).find('td')[0];
                var $firstTDJQObject = $(firstTDDomEl);
                $firstTDJQObject.text(index + 1);
            });
        });


    });    

    function CalculateColumns(ContainerID, Col3, GrandTotalID) {
        if( typeof ContainerID == 'string' ) var ContainerID = document.getElementById( ContainerID );

        var arrCol3 = new Array();
        var GrandTotal = 0;
        var ContainerIDElements = new Array( 'input');
        //var ContainerIDElements = new Array('input', 'textarea', 'select');

        for( var i = 0; i < ContainerIDElements.length; i++ ){
            els = ContainerID.getElementsByTagName( ContainerIDElements[i] );
            for( var j = 0; j < els.length; j++ ){
                if(els[j].name == Col3) arrCol3.push(els[j]);
            }
        }

        for( var j = 0; j < arrCol3.length; j++ ) {
           GrandTotal += Number(arrCol3[j].value);
        }

        document.getElementById(GrandTotalID).value = GrandTotal;
    } // CalculateColumns
</script>