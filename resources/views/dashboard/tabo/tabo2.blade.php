
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
    
    div{
        padding:10px;
    }
    @media print{
        input,textarea{
            border:0px solid #ffffff;
        }
        textarea{
            width:100%;
        }
        input {
                border:0!important;
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

    <hr style="border: 2px solid #000000" />
    <img src="{{asset('assets/header.png')}}" width="100%" style="max-width:100%">
    <div style="min-height: 1080px;direction: rtl;width: 100%;">
        
            <h2 style="text-align:center;">مشروع تسوية الأراضي</h2>
            
            <h2 style="text-align:center;">شهادة براءة ذمة لغرض الحصول على سندات التسجيل (كواشين الأرض)  </h2>

            <table cellpadding="3" cellspacing="0" width="100%" style="height:400px;" class="table table-bordered my-3">
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
                    <td width="50%"> رقم القطعة الدائم </td>
                    <td width="50%"> 
                    {{$tabo->final_no}}
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
            <h3 style="text-align:center;"> تم استيفاء رسوم مخططات المساحة لاغراض التسوية </h3>
            <table cellpadding="3" cellspacing="0" width="100%" style="height:450px;" class="table table-bordered my-3">
                <tr>
                    <td width="50%"> المبلغ رقما </td>
                    <td width="50%"> 
    <input type="text" value="{{$tabo->price}}" readonly id="price" maxlength="10" class="form-control" " name="price">

                    </td>
                </tr>
                <tr>
                    <td width="50%"> المبلغ كتابتا </td>
                    <td width="50%"> 
                         <input type="text" readonly id="amountStr" value="{{$tabo->price}}" maxlength="10" class="form-control"  name="amountStr">
                    </td>
                </tr>
                <tr>
                    <td width="50%"> سددت بايصال رقم  </td>
                    <td width="50%"> 
                         <input type="text" value="{{$tabo->wasel}}" readonly id="wasel" maxlength="10" class="form-control "  name="wasel">
                    </td>
                </tr>
                <tr>
                    <td width="50%"> التاريخ </td>
                    <td width="50%"> 
                        <input type="text" id="timespay" value="{{$tabo->timespay}}" readonly name="timespay" data-mask="00/00/0000" maxlength="10" class="form-control" placeholder="" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td width="50%" style="vertical-align: top!important;"> توقيع الجابي </td>
                    <td width="50%" style="vertical-align: top!important;"> توقيع المدير المالي </td>
                </tr>
            </table>
        <input type="hidden" name="pk_i_id" id="pk_i_id" value="" />
        <input type="hidden" name="related_ticket" id="related_ticket" value="" />
        
        
    </div>
    
        <button type="button" class="btn btn-primary hidePrint" onclick="window.print();" style="width: 80px;cursor: pointer;position: fixed;bottom: 40px;left: 50%;" >
                 طباعة
        </button>
<hr style="border: 2px solid #000000;" />

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>

</script>