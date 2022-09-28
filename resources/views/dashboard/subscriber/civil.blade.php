@extends('layouts.admin')

@section('search')
    <li class="dropdown dropdown-language nav-item hideMob">
        <input id="searchContent" name="searchContent" class="form-control SubPagea round full_search" placeholder="بحث"style="text-align: center;width: 350px; margin-top: 15px !important;">
    </li>
@endsection
@section('content')
<style>
    .select2-container--classic .select2-selection--multiple .select2-selection__choice, .select2-container--default .select2-selection--multiple .select2-selection__choice {
    padding: 2px 6px !important;
    margin-top: 0 !important;
    background-color: #1E9FF2!important;
    border-color: #1E9FF2 !important;
    color: #FFFFFF;
    margin-left: 8px !important;
    margin-bottom: 2px;
    }
    .preW{
    width:35%!important;
    }
    .select2-container--default{
    width:61%!important;
    }
</style>
    <section class="horizontal-grid" id="horizontal-grid">
        <form id="ajaxform">
            <div class="row white-row">
                <div class="col-sm-12 col-md-6">
                    <div class="card leftSide">
                        <div class="card-header">
                            <h4 class="card-title"><img src="https://db.expand.ps/images/personal-information.png" width="32" height="32">
                               {{ trans('admin.subscriber_info') }}
                            </h4>
                            <div class="heading-elements1" style="left: 87px; top: 10px;">
                                {{ trans('admin.status') }}
                            </div>
                            <div class="heading-elements1 onOffArea form-group mt-1" style="top:-5px;" onclick="$('#OnOffItem').modal('show')">
                                <input type="checkbox" id="myonoffswitchHeader" class="switchery" data-size="xs" checked="">
                            </div>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <div class="input-group width99 width98rtl widthsub" style="">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">{{ trans('admin.subscriber_name') }}</span>
                                                    </div>
                                                    <input type="text" id="formDataNameAR" class="form-control alphaFeild ac ui-autocomplete-input"
                                                        placeholder="{{ trans('admin.subscriber_name') }}"
                                                        name="formDataNameAR" autocomplete="off">
                                                </div>
                                                <div id="auto-complete-barcode" class="divKayUP barcode-suggestion ">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="subscriber_id" name="subscriber_id" value="">

                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ trans('admin.emp_id') }}
                                                        </span>
                                                    </div>
                                                    <input type="text" id="formDataNationalID" maxlength="9" class="form-control numFeild"placeholder="{{ trans('admin.emp_id') }}" name="formDataNationalID">
                                                    <div class="input-group-append" style="visibility: hidden;"onclick="QuickAdd(17,'formDataProfessionID','Profession')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-7 col-md-12 pr-s-12" style="">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 pr-s-12 pr-0">
                                                    <div class="form-group">
                                                        <div class="input-group w-s-87">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-group-text1" id="basic-addon1">
                                                                    <img src="https://db.expand.ps/images/jawwal35.png">
                                                                </span>
                                                            </div>
                                                            <input type="text" id="formDataMobileNo1" maxlength="10"name="formDataMobileNo1"class="form-control noleft numFeild" placeholder="0590000000" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 padding_right10" style="padding-left: 14px;">
                                                <div class="form-group">
                                                        <div class="input-group w-s-87" style="">
                                                            <div class="input-group-prepend"> <span class="input-group-text input-group-text1" id="basic-addon1"> <img src="https://db.expand.ps/images/w35.png" style="max-width: 35px;">  </spanclass="input-group-text></div> 
                                                              <input type="text" id="formDataMobileNo2" maxlength="10" name="formDataMobileNo2" class="form-control noleft numFeild" placeholder="0560000000" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            {{ trans('admin.subscriber_num') }}
                                                        </span>
                                                    </div>

                                                    <input type="text" id="formDataCutomerNo" name="formDataCutomerNo"class="form-control" placeholder="{{ trans('admin.subscriber_num') }}"aria-describedby="basic-addon1">
                                                    <div class="input-group-append" style="visibility: hidden;"onclick="QuickAdd(9,'formDataProfessionID','Profession')">
                                                        <span class="input-group-text input-group-text2">
                                                            <i class="fa fa-external-link"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-7 col-md-12 pr-0 pr-s-12">
                                            <div class="form-group">
                                                <div class="input-group widthmail">
                                                    <div class="input-group-prepend">
                                                          <span class="input-group-text input-group-text1" id="basic-addon1"><img src="https://db.expand.ps/images/mailico35.jpg"style="max-width: 35px;"> </span>
                                                    </div> 
                                                    <input type="email" id="formDataEmailAddress" onkeydown="returnCd(event,this)" onkeyup="ClearArabic($(this))" name="formDataEmailAddress" class="form-control noleft" placeholder="Example@domain.com">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text"id="basic-addon1"> {{ trans('admin.job_title') }} </span> </div>
                                                <select type="text" id="formDataProfessionID" name="formDataProfessionID"
                                                    class="form-control formDataProfessionID">
                                                    <option value=""> -- {{trans('admin.select')}} --</option>
                                                    @foreach ($jobTitle as $job)
                                                        <option value="{{ $job->id }}"> {{ $job->name }} </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append"
                                                    onclick="ShowConstantModal(74,'formDataProfessionID','نوع الوظيفة')"> 
                                                    <span
                                                        class="input-group-text input-group-text2"> <i class="fa fa-external-link"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-lg-5 col-md-12 hide">
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"> {{ trans('admin.part') }}</span></div>
                                                <select type="text" id="formDataIndustryID" name="formDataIndustryID" class="form-control formDataIndustryID">
                                                    <option value="0"> -- {{trans('admin.select')}} --</option>
                                                    @foreach ($groups as $group)
                                                        <option value="{{ $group->id }}"> {{ $group->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append" onclick="ShowConstantModal(75,'formDataIndustryID','القطاع')">
                                                    <span class="input-group-text input-group-text2"><i class="fa fa-external-link"></i> </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header hide" style="padding-top:0px;">
                            <h4 class="card-title"><i class="fa fa-key"></i>{{ trans('admin.subscriber_data') }} </h4>
                            <a class="heading-elements-toggle"><i class="ft-align-justify font-medium-3"></i></a>
                            <div class="heading-elements" style="display: none">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>

                            <div class="row hide" id="userlogin">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"> {{ trans('admin.user_name') }} </span>
                                            </div>
                                            <input id="username" name="username" class="form-control"placeholder="{{ trans('admin.user_name') }}">
                                            <div class="input-group-append">
                                            <span class="input-group-text input-group-text2"><i class="fa fa-external-link-alt" style="color: #ffffff"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"> {{ trans('admin.password') }}</span>
                                            </div>
                                            <input id="password" name="password" class="form-control"placeholder="{{ trans('admin.password') }}" value="">
                                            <div class="input-group-append">
                                                <span class="input-group-text input-group-text2"> <i class="fa fa-external-link-alt" style="color: #ffffff"></i> </span>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="card rightSide" style="min-height:598.359px">
                        <div class="card-header">
                            <h4 class="card-title"> <img src="https://db.expand.ps/images/maps-icon.png" width="32"height="32"> {{ trans('admin.address') }}</h4>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                            @include('dashboard.component.address')
                                <div class="form-actions" style="border-top:0px;">
                                    <div class="text-right">  
                                            <button id="saveBtn" class="btn btn-primary save-data">{{ trans('admin.save') }}<i class="ft-thumbs-up position-right"></i></button>  
                                         @can('edit_model')
                                            <button id="editBtn" style="display:none;" class="btn btn-primary save-data">{{trans('admin.modify')}}<i class="ft-thumbs-up position-right"></i></button> 
                                          @endcan                              
                                            <button type="reset" onclick="redirectURL()" class="btn btn-warning reset-dats">{{ trans('assets.reset') }} <i class="ft-refresh-cw position-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    

<div class="modal fade text-left" id="OnOffItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog1" role="document" style="margin-top: 15%;">
        <div class="modal-content">
            <div class="modal-header modal-header2">
                <h4 class="modal-title" id="myModalLabel1" style="color: #ffffff;"><span id="ModalTitle"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-3" style="padding-left: 0px !important;"></div>
                        <div class="col-md-6" style="padding-left: 0px !important;">
                            <div class="form-group validate">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ModalLabelDate" id="basic-addon1">تاريخ التفعيل</span>
                                    </div>
                                    <input id="retireDate" name="retireDate" data-mask="00/00/0000" maxlength="10" class="form-control eng-sm singledate valid" placeholder="dd/mm/yyyy" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-left: 0px !important;"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding-left: 0px !important;">
                            <div class="form-group validate">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text ModalLabelReason" id="basic-addon1">سبب التفعيل</span>
                                    </div>
                                    <input id="retirereason" name="retirereason" class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="pk_i_idReason" name="pk_i_idReason" value="6928">
                        <input type="hidden" id="b_enabled" name="b_enabled" value="1">
                    </div>
                    <div class="form-group" style="text-align:center">
                        <button type="button" class="btn btn-info modalBtn" onclick="UpdateState()">حفظ </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="AppModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel1">{{trans('admin.system_order')}}(<span id="repName"></span>)</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="row DisabledItem">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
									<li class="nav-item">
										<a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="ctab1" href="#ctab1" aria-expanded="true">
                                        <b><img src="https://db.expand.ps/images/Eng64.png" height="32" />{{trans('admin.engineering_requests')}}(<span id="ctabCnt1"></span>) </b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="ctab2" href="#ctab2" aria-expanded="false">
                                        <b><img src="https://db.expand.ps/images/electric64.png" height="32" />{{trans('admin.electricity_requests')}}(<span id="ctabCnt2"></span>)</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="ctab3" href="#ctab3" aria-expanded="false">
                                        <b><img src="https://db.expand.ps/images/water-faucet64.png" height="32" />{{trans('admin.water_requsts')}}(<span id="ctabCnt3"></span>)</b></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="ctab4" href="#ctab4" aria-expanded="false">
                                        <b>
											<img src="https://db.expand.ps/images/icon/TaskIcons8.png" height="32" />
                                                {{trans('admin.miscellaneous_requests')}}
											(<span id="ctabCnt4"></span>)
										</b>
										</a>
									</li>
								</ul>
                				<div class="tab-content px-1 pt-1">
                					<div role="tabpanel" class="tab-pane active" id="ctab1" aria-expanded="true" aria-labelledby="base-tab1">
                						<p><table style="width:100%; margin-top: 10px;direction: rtl;" class="detailsTB table hdrTbl1 tasktbl1">
                                                <thead>
                									<tr>
                										<th scope="col" style="text-align: right;color:#ffffff">#</th>
                										<th scope="col" style="text-align:  right; direction:rtl; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp;{{trans('admin.sender')}}  </th>
                                                        <th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/TaskIcons8.png" height="32" /> &nbsp;{{trans('admin.task_title')}}</th>
                                                        <th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/openDateIcon.png" height="32" /> &nbsp;{{trans('admin.opening_date')}}</th>
                										<th scope="col" style="text-align: center; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp; {{trans('admin.action')}}</th>
                									</tr>
                								</thead>              
                							<tbody id="cMyTask1">              
                							</tbody>          
                						</table>
                						</p>
                					</div>
                
                					<div class="tab-pane" id="ctab2" aria-labelledby="base-tab2">
                						<p><table style="width:100%; margin-top: 10px;direction: rtl;" class="detailsTB table hdrTbl2 tasktbl2"  >
                						    <thead>
                							    <tr>
                									<th scope="col" style="text-align: right;color:#ffffff">#</th>
                									<th scope="col" style="text-align:  right; direction:rtl; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp;{{trans('admin.sender')}}  </th>
                									<th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/TaskIcons8.png" height="32" /> &nbsp;{{trans('admin.task_title')}}</th>     
                									<th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/openDateIcon.png" height="32" /> &nbsp;{{trans('admin.opening_date')}}</th>    
                									<th scope="col" style="text-align: center; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp; {{trans('admin.action')}}</th>
                							    </tr>               
                							</thead>
                							<tbody id="cMyTask2">
                							</tbody>
                						 </table> 
                						</p>
                
                					</div>
                
                					<div class="tab-pane" id="ctab3" aria-labelledby="base-tab3">
                						<p>                
                						<table style="width:100%; margin-top: 10px;direction: rtl;" class="detailsTB table hdrTbl3 tasktbl3" >
                						    <thead>            
                							  <tr>
            									<th scope="col" style="text-align: right;color:#ffffff">#</th>           
            									<th scope="col" style="text-align:  right; direction:rtl; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp;{{trans('admin.sender')}} </th>
            									<th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/TaskIcons8.png" height="32" /> &nbsp;{{trans('admin.task_title')}}</th>
                                                <th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/openDateIcon.png" height="32" /> &nbsp;{{trans('admin.opening_date')}}</th>  
            									<th scope="col" style="text-align: center; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp; {{trans('admin.action')}}</th>
                							  </tr>
                							</thead>
                							<tbody id="cMyTask3">
                							</tbody>
                						    </table>
                						</p>
                
                					</div>
                					<div class="tab-pane" id="ctab4" aria-labelledby="base-tab4">
                						<p>
                						<table style="width:100%; margin-top: 10px;direction: rtl;" class="detailsTB table hdrTbl4 tasktbl4" >
                						    <thead>
                							  <tr>
                								<th scope="col" style="text-align: right;color:#ffffff">#</th>                
                								<th scope="col" style="text-align:  right; direction:rtl; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp;  </th>               
                								<th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/TaskIcons8.png" height="32" /> &nbsp;{{trans('admin.task_title')}}</th>
                								<th scope="col" style="text-align: right; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/openDateIcon.png" height="32" /> &nbsp;{{trans('admin.opening_date')}}</th>
                								<th scope="col" style="text-align: center; font-family: Arial, sans-serif !important;color:#ffffff"><img src="https://db.expand.ps/images/icon/toolsIcon.png" height="32" /> &nbsp; {{trans('admin.action')}}</th>
                							  </tr>               
               							    </thead>
                							<tbody id="cMyTask4">           
                							</tbody>
                						</table>
                						</p>
                					</div>               
                				</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


				

@include('dashboard.component.subscribe_archive')
@include('dashboard.component.archive_joblic')
@include('dashboard.component.fetch_table')
@include('dashboard.component.license_show')
@include('dashboard.component.elec_show')
@include('dashboard.component.water_show')

    <script>
        function redirectURL(){
            setTimeout(function(){self.location='{{route("civil")}}'},100)
        }
        $(function() {
            $(".ac").autocomplete({
                source: 'citizen_auto_complete',
                minLength: 1,
                select: function(event, ui) {
                    let subscribe_id = (ui.item.id)
                     update(subscribe_id);
                }
            });
        });

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
            $('#AppCount').html("(" + $tickets.length + ")");
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
    
        function update($id) {
            let subscribe_id = $id;
            $('#saveBtn').css('display','none');
            $('#editBtn').css('display','inline-block');
            $.ajax({
                type: 'get',
                url: "citizen_info",
                data: {
                    subscribe_id: subscribe_id,
                },
                success: function(data) {
                    if (data.status!=false) {  
                        $('#subscriber_id').val(data.id);
                        $('#formDataNameAR').val(data.name);
                        $('#formDataNationalID').val(data.national_id);
                        $('#formDataMobileNo1').val(data.phone_one);
                        $('#formDataMobileNo2').val(data.phone_two);
                        $('#formDataCutomerNo').val(data.cutomer_num);
                        $('#formDataEmailAddress').val(data.email);
                        $('#formDataBussniessName').val(data.bussniess_name);
                        $('#region_id').val(data.region_id);
                        $('#city_id').val(data.city_id);
                        $('#town_id').val(data.town_id);
                        $('#AddressDetails').val(data.details);
                        $('#Note').val(data.notes);
                        // $("#certListCnt").html("(" + $archiveCount + ")");
                        $("#licListCnt").html("(" + data.ArchiveJobLicCount + ")");
                        $("#licStatic").html("(" + data.licCount + ")");
                        $("#WaterStatic").html("(" + data.waterCount + ")");
                        $("#ElecStatic").html("(" + data.elecCount + ")");
                        $('.select2-selection__rendered').html('');                           
                        // drawTablesArchive(response.Archive, response.copyTo, response.ArchiveLic, response.jalArchive, response.outArchiveCount, response.inArchiveCount, response.otherArchiveCount, response.licFileArchiveCount, response.licArchiveCount, response.copyToCount, response.linkToCount);
                    }else{
                       alert('');
                    }
                },

            });

        }

        $('.reset-dats').click(function(event) {
            $("#certListCnt").html("(0)");
        });

        $(".save-data").click(function(event) {
            $(".loader").removeClass('hide');
            $("#formDataNameAR").removeClass("error");
            event.preventDefault();
            let formDataNameAR = $("input[name=formDataNameAR]").val();
            let formDataNationalID = $("input[name=formDataNationalID]").val();
            let formDataMobileNo1 = $("input[name=formDataMobileNo1]").val();
            let formDataMobileNo2 = $("input[name=formDataMobileNo2]").val();
            let formDataCutomerNo = $("input[name=formDataCutomerNo]").val();
            let formDataEmailAddress = $("input[name=formDataEmailAddress]").val();
            let formDataBussniessName = $("input[name=formDataBussniessName]").val();
            let username = $("input[name=username]").val();
            let password = $("input[name=password]").val();
            var formDataProfessionID = $('#formDataProfessionID').find(":selected").val();
            var formDataIndustryID = $('#formDataIndustryID').find(":selected").val();
            var _token = '{{ csrf_token() }}';
            let subscriber_id = $("input[name=subscriber_id]").val();
            var city_id = $('#city_id').val();
            var town_id = $('#town_id').val();
            var region_id = $('#region_id').val();
            var AddressDetails = $('#AddressDetails').val();
            var Note = $('#Note').val();
            let allowedEmp=$('#allowed_emp').val();
            $.ajax({
                url: "civilStore",
                type: "POST",
                data: {
                    formDataNameAR: formDataNameAR,
                    formDataNationalID: formDataNationalID,
                    formDataMobileNo1: formDataMobileNo1,
                    formDataMobileNo2: formDataMobileNo2,
                    formDataCutomerNo: formDataCutomerNo,
                    formDataEmailAddress: formDataEmailAddress,
                    formDataBussniessName: formDataBussniessName,
                    username: username,
                    password: password,
                    formDataProfessionID: formDataProfessionID,
                    formDataIndustryID: formDataIndustryID,
                    _token: _token,
                    allowedEmp:allowedEmp,
                    subscriber_id: subscriber_id,
                    city_id: city_id,
                    town_id: town_id,
                    region_id: region_id,
                    AddressDetails: AddressDetails,
                    Note: Note,
                },
                success: function(response) {
                    $(".loader").addClass('hide');
                    if(response.status){
                        $('.wtbl').DataTable().ajax.reload();
                        $('#allowed_emp').val('');
                        $('.select2-selection__rendered').html('');
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: '{{ trans('admin.data_added') }}',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#subscriber_id').val('');
                        $("#ajaxform")[0].reset();
                        setTimeout(function(){self.location='{{route("civil")}}'},1500)
                    }else{
                         Swal.fire({
            				position: 'top-center',
            				icon: 'error',
            				title: '{{trans('admin.error_save')}}',
            				showConfirmButton: false,
            				timer: 1500
        				})
                        if(response.errors.national_id){
                            confirm('رقم الهوية مكرر');
                            $( "#formDataNationalID" ).addClass( "error" );
                        } 
                    }
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
        });



        function ShowCertModal(bindTo) {
            $("#ArchModalName").html($("#formDataNameAR").val())
            // $("#CitizenName").html($("#formDataNameAR").val()) 
            $("#msgModal").modal('show')
        }
        function ShowWaterModal(bindTo) {
            $("#waterCustomerName").html($("#formDataNameAR").val()) 
            $("#WaterModal").modal('show')
        }
        function ShowElecModal(bindTo) {
            $("#elecCustomerName").html($("#formDataNameAR").val()) 
            $("#elecModal").modal('show')
        }
        function delete_user($id) {
            if(confirm('هل انت متاكد من حذف المواطن؟ لن يمكنك استرجاعه فيما بعد')){
            let subscribe_id = $id;
            var _token = '{{ csrf_token() }}';
            $.ajax({
                type: 'post',
                url: "citizen_delete",
                data: {
                    subscribe_id: subscribe_id,
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
                    $("#ajaxform")[0].reset();
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

    </script>

@endsection

