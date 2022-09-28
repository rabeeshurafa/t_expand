<div class="row">
                                        
    <div class="col-md-12">
    <table id="myTable" class="detailsTB table order-list"  style="" >
        <thead>
            <tr style="text-align:center !important;background: #0073AA;">
                <td style="color: white">رقم</td>
                <td style="color: white">البيان</t>
                <td style="color: white">المبلغ / شيكل</td>
            </tr>
        </thead>
        <tbody id="mytbody">
            <tr class="">
                <td class="col-sm-4 " style="width: 2%; border: none;">
                    1
                </td>
                <td class="col-sm-4" style="width: 80%;  border: none;">
                    <input type="text" name="itemname[]" id="itemname" class="form-control ac itemname "/>
                </td>
                <td class="col-sm-4" style="width: 16%; border: none;">
                    <input type="text" name="total[]"  class="form-control" oninput="CalculateColumns('myTable','total[]','totalamount')"/>
                </td>
                <td class="col-sm-2" style="width: 2%; border: none;">
                </td>
                
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="col-sm-4" colspan="2"  style="text-align: left; height: 100%; border: none;">
                    <span class="input-group-text" id="basic-addon1" style="background-color:whitesmoke; display: grid; height:35px; width: 100%; color: orangered;text-align:right; font-size: large">المجموع الكلي</span>
                </td>
                <td class="col-sm-4" style="width: 10%; border: none;">
                    <input type="text" id="totalamount" name="totalamount"  class="form-control"/>
                </td>
            </tr>
        </tfoot>
    </table>

</div>
</div>