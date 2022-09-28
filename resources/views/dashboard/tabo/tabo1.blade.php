
<link rel="stylesheet" type="text/css" href="{{asset('assets/css-rtl/custom-rtl.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    body,td,th,span{
        font-family:"Times New Roman";
        color:#000000;
        text-align:center;
            vertical-align: middle!important;
                        font:18px bold;

    }
    h1,h2,h3,h4,h5,h6{
        font-family:"Times New Roman";
        color:#000000;
        text-align:center;
            vertical-align: middle!important;
        font-size: 1.74rem!important;
    }
    input {
            text-align: center!important;
    }
    div{
        padding:10px;
    }
    @media print{
        input,textarea{
            border:0px solid #ffffff;
        }
        input {
                border:0!important;
                text-align: center!important;
            }
        textarea{
            width:100%;
        }
        body{
            margin:0px;
        }
        .hidePrint{
            display: none;
        }
    .form-check-input{
        position:relative;
        margin-right:-0.25rem;!important
        }
        .
            .input-group {
                width: 99% !important;
            }
            .marginrightminus30 {
                margin-right: 0px;
            }
        
    }
    
    .footerLine{
        width:100%;
        text-align:center;
        margin-top:50%;
    }
    
</style>
    <img src="{{$setting->header_img}}" width="100%" style="max-width:100%">
    <hr style="border: 2px solid #000000" />
    
    <div style="min-height: 1080px;direction: rtl;width: 100%;">
        
            <h2 style="text-align:center;">مشروع تسوية الأراضي</h2>
            
            <h2 style="text-align:center;">نموذج تحصيل الرسوم</h2>

            <table cellpadding="3" cellspacing="0" width="100%" style="height:450px;" class="table table-bordered my-3">
                <tr>
                    <td width="50%"> اسم المالك </td>
                    <td width="50%"> 
                    {{$tabo->owner_name}}
                    </td>
                </tr>
                <tr>
                    <td width="50%"> اسم الحوض ورقمه </td>
                    <td width="50%"> 
                    {{$tabo->hod->hod_name}} ({{$tabo->hod->hod_no}})
                    </td>
                </tr>
                <tr>
                    <td width="50%"> رقم القطعة المؤقت </td>
                    <td width="50%"> 
                    {{$tabo->temp_no}}
                    </td>
                </tr>
                <tr>
                    <td width="50%"> المساحة بالمتر المربع </td>
                    <td width="50%"> 
                    {{$tabo->area}}
                    </td>
                </tr>
                <tr>
                    <td width="50%"> التوقيع </td>
                    <td width="50%">  </td>
                </tr>
            </table>
            
            <h2 style="text-align:center;"> الدائرة المالية</h2>
        <form id="addNewForm" method="post" >
                        
            <table cellpadding="3" cellspacing="0" width="100%" style="height:450px;" class="table table-bordered my-3">
                <tr>
                    <td width="50%"> المبلغ المطلوب </td>
                    <td width="50%"> 
                         <input type="text" value="{{$tabo->price}}" id="price" maxlength="10" class="form-control numFeild"  name="price">

                    </td>
                </tr>
                <tr>
                    <td width="50%"> رقم الوصل </td>
                    <td width="50%"> 
                         <input type="text"  value="{{$tabo->wasel}}" id="wasel" maxlength="10" class="form-control numFeild"  name="wasel">

                    </td>
                </tr>
                <tr>
                    <td width="50%"> التاريخ </td>
                    <td width="50%"> 
                    <input type="text" id="timespay"   value="{{$tabo->timespay}}" name="timespay" data-mask="00/00/0000" maxlength="10" class="form-control eng-sm  valid" placeholder="" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td width="50%"> ملاحظات </td>
                    <td width="50%"> 
                    <input type="text" id="notes" name="notes" value="{{$tabo->notes}}" class="form-control" placeholder="" autocomplete="off">
                    
                    </td>
                </tr>
                <tr>
                    <td width="50%" style="vertical-align: top!important;"> توقيع الجابي </td>
                    <td width="50%" style="vertical-align: top!important;"> توقيع المدير المالي </td>
                </tr>
            </table>
                    <input type="hidden" name="id" id="id" value="{{$tabo->id}}" />

		</form>


        <button type="button" class="btn btn-primary hidePrint" onclick="addNewInfo();window.print();" style="width: 120px;cursor: pointer;position: fixed;bottom: 40px;left: 50%;" >
                    حفظ وطباعة
        </button>
        
    </div>
    
<hr style="border: 2px solid #000000;" />

<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script>
    function addNewInfo() {
	        
    var formData = new FormData($("#addNewForm")[0]);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',//$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('admin.dashboard')}}/addNewInfo',
            type: 'POST',
            data: formData,
            dataType:"json",
            async: true,
            success: function (data) {
                alert('تمت عملية الحفظ')
                self.location=document.URL
                window.print();
            },
            error:function(){
                alert('تمت عملية الحفظ')
            },
                cache: false,
                contentType: false,
                processData: false
        });
    }
    
$(document).ready(function(){
    @if($tabo->wasel=='')
        $("#timespay").val('<?php echo date('d/m/Y')?>');
    
    @else
               var tt="{{$tabo->timespay}}";
              tt=tt.replaceAll('-', '/');
        $("#timespay").val(tt);
    @endif
       var paid = "{{$tabo->isPaid}}"
       if(paid=="1")
        {
            $("body").css("background-color","#c5dbff");
        }
        // console.log(paid);
    // var area = parseFloat(<?php echo $tabo->pice_no?>);
        var area ="{{$tabo->area}}";
        var priceNo;
            var ar = parseInt(area);
            if(ar<=500)
            {
                priceNo= "75"
                $("#price").val(priceNo+" شيقل");
            }
            else if(ar>500&&ar<600)
            {
                priceNo= "150"
                $("#price").val(priceNo+" شيقل");
            }
            else
            {
                priceNo=(ar/1000);
                console.log(priceNo);
                var c = priceNo.toString();
                console.log(priceNo);
                var f=0;
                for(var i=0;i<c.length;i++)
                {
                    if(c[i]=='.')
                    {
                        if(c[i+1]>5)
                        {
                            f=f+1;
                        }
                        else
                        {
                            f=f+0.5;
                        }
                    }
                }
                priceNo=parseInt(priceNo)+f;
                console.log(priceNo);
                priceNo=priceNo*150;
                console.log(priceNo);
                
                $("#price").val(priceNo+" شيقل");
            }
            
    console.log(parseFloat(area)/1000);
        console.log(priceNo);

});
</script>