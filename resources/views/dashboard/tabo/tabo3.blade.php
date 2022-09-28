
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
        input {
                border:0;
            }
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
            
            <h2 style="text-align:center;"> شهادة براءة ذمة لغايات التسوية / الصفقات</h2>

            <table cellpadding="3" cellspacing="0" width="100%" style="height:400px;" class="table table-bordered my-3">
                <tr>
                    <td width="50%"> اسم المالك </td>
                    <td width="50%"> 
                    {{$tabo->owner_name}}
                    </td>
                </tr>
                 <tr>
                    <td width="50%"> رقم الهاتف :- {{$tabo->phone}} </td>
                    <td width="50%"> رقم الهوية :- {{$tabo->nationality}} </td>
                </tr>
                <tr>
                    <td width="50%"> اسم الحوض ورقمه </td>
                    <td width="50%"> 
                    {{$tabo->hod->hod_name}} ({{$tabo->hod->hod_no}})
                    </td>
                </tr>
                <tr>
                    <td width="50%"> رقم القطعة  </td>
                    <td width="50%"> 
                    مؤقت
                    ( {{$tabo->temp_no}} )
                    دائم
                    ( {{$tabo->final_no}} )
                    </td>
                </tr>
                <tr>
                    <td width="50%"> مساحة القطعة  </td>
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
            <table cellpadding=" 3" cellspacing="0" width="100%" style="height:400px;" class="table table-bordered my-3">
                <tr>
                    <td width="70%"> يرجى استيفاء الضرائب والرسوم ومستحقات المياه والكهرباء وذلك لنهاية السنة المالية </td>
                    <td width="30%"> ....../....../...... </td>
                </tr>
                <tr>
                    <td width="70%"> تسديد من ديون الكهرباء بمبلغ (....................شيقل ) .
                        سند قبض رقم (..........................).</td>
                    <td width="30%"> بتاريخ   ....../....../...... 
                    التوقيع :-...........</td>
                </tr>
                <tr>
                    <td width="70%"> تسديد من ديون المياه بمبلغ (....................شيقل ) .
                        سند قبض رقم (..........................).</td>
                    <td width="30%"> بتاريخ   ....../....../...... 
                    التوقيع :-...............</td>
                </tr>
                <tr>
                    <td width="70%"> رسوم الحرف والصناعات المتحققة على المحل سددت بايصال رقم (...........................) </td>
                     <td width="30%"> بتاريخ   ....../....../...... 
                    التوقيع :-...................</td>
                </tr>
            </table>
           <h3>رسوم مخططات المساحة لأغراض التسوية والطابو عن الموقع</h3>
            <table cellpadding="1" cellspacing="0" width="50%" style="margin:auto;">
               <tr>
                   <td width="50%">مبلغ :-
                     
                   </td>
                   <td width="50%">ايصال رقم :-
                        
                   </td>
               </tr>
               <tr>
                   <td width="50%">بتاريخ :-
                        
                   </td>
                   <td width="50%">التوقيع :-</td>
               </tr>
           </table>

        
    </div>
    
        <button type="button" class="btn btn-primary hidePrint" onclick="window.print();" style="width: 80px; cursor: pointer;position: fixed;bottom: 40px;left: 50%;" >
                 طباعة
        </button>
<hr style="border: 2px solid #000000;" />

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
   $(document).ready(function(){

});
</script>