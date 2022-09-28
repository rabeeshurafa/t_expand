<div class="modal fade text-left" id="joblicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel1">{{trans('admin.jobLic')}}  (<span id="joblicModalname"></span>)</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <div class="form-body">
                    <div class="row ">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <table width="100%" class="detailsTB table jobLic_table">
                                    <thead>
                                    <tr>
                                    <th width="30px">#</th>
                                    <th width="50px">{{trans('archive.lic_num')}}</th>
                                    <th width="200px">{{trans('admin.business_name')}}</th>
                                    <th width="60px"> {{trans('admin.craft_type')}} </th>
                                    <th width="80px">{{trans('admin.start_date')}} </th>
                                    <th width="80px">{{trans('admin.end_date')}} </th>
                                    <th width="80px">
                                        حالة الرخصة
                                    </th>
                                    <th width="80px">
                                        عدد السنوات 
                                    </th>
                                    <th width="80px">
                                        المبلغ المطلوب
                                    </th>
                                    <th width="80px">
                                        تجديد
                                    </th>
                                    <th width="80px">
                                       اغلاق
                                    </th>
                                    
                                </thead>
                                <tbody id="jobLic_list">
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
<script>

function drawTableJoblic($joblic,$canUpdate=1)
{   
     if ( $.fn.DataTable.isDataTable( '.jobLic_table' ) ) {
            $(".jobLic_table").dataTable().fnDestroy();
            $('#jobLic_list').empty();
        }
        var p=1;
    
        $joblic.forEach(archive => {
            console.log(archive);
            statuse='منتهية';
            if(archive.statuse){
                statuse='فعال';
            }
            if(archive.is_stoped){
                statuse='مغلقة';
            }
            link="/admin/jobLic_add?id="+archive.id+'/renew/1';
            stopLink="/admin/jobLic_stop/id/"+archive.id;
            $row=`<tr>
                <td>${p}</td>
                <td>${(archive.licNo??'')}</td>
                <td>${(archive.business_name??'')}</td>
                <td>${(archive.lic_type??'')}</td>
                <td>${(archive.start_date??'')}</td>
                <td>${(archive.end_date??'')}</td>
                <td>${statuse}</td>
                <td>${(archive.years>0?archive.years:'_')}</td>
                <td>${(archive.years>0?archive.cost:'_')}</td>
                <td>`;
                if($canUpdate==1)
                    $row  += `<a href="{{asset(app()->getLocale())}}${link}" target="_blank"><img src="https://t.expand.ps/expand_repov1/public/assets/images/ico/renewLic2.png" width="20" height="20"> </a>`
                else
                    $row  +='_'
                $row  +=`</td><td>`
                if($canUpdate==1)
                    $row  +=`<a href="{{asset(app()->getLocale())}}${stopLink}" target="_blank"><img src="https://t.expand.ps/expand_repov1/public/assets/images/ico/stopLic.png" width="20" height="20"> </a>`
                else
                    $row  +='_'
                $row  +=`</td>`
                
                $row += "</tr>";
            $('#jobLic_list').append($row)
            p++;
           
        });
        $('.jobLic_table').DataTable({
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
}
</script>

