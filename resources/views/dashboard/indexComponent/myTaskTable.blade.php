<div class="row hidemob hide TaskModel {{$class}}">
    <div class="col-sm-12">
        <div class="form-group">
            <?php $days = array(
                    'Mon' => 'الإثنين',
                    'Tue' => 'الثلاثاء',
                    'Wed' => 'الأربعاء',
                    'Thu' => 'الخميس',
                    'Fri' => 'الجمعة',
                    'Sat' => 'السبت',
                    'Sun' => 'الأحد',
            ); ?>
            <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
                <li class="nav-item">
                    <a class="nav-link active list1001" style="color: #0073AA;" id="base-tab1001"
                       data-toggle="tab" aria-controls="ctab1001" href="#ctab1001" aria-expanded="true">
                        <b>
                            <span class="list1Title">مهامى</span>
                            (<span id="ctabCnt1">{{sizeof($myTask)}}</span>)
                        </b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link list2001" style="color: #0073AA;" id="base-tab2001" data-toggle="tab"
                       aria-controls="ctab2001" href="#ctab2001" aria-expanded="false">
                        <b>
                            <span class="list2Title">مهام مؤجله</span>
                            (<span id="ctabCnt2">{{sizeof($waittingTask)}}</span>)
                        </b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link list3001" style="color: #0073AA;" id="base-tab3001" data-toggle="tab"
                       aria-controls="ctab3001" href="#ctab3001" aria-expanded="false">
                        <b>
                            <span class="list3Title">مهام للاطلاع</span>
                            (<span id="ctabCnt3">{{sizeof($taggedTask)}}</span>)

                        </b>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link list4001" style="color: #0073AA;" id="base-tab4001" data-toggle="tab"
                       aria-controls="ctab4001" href="#ctab4001" aria-expanded="false">
                        <b>
                            <span class="list4Title">مهام قمت بتحويلها</span>
                            (<span id="ctabCnt4">{{sizeof($sentTask)}}</span>)

                        </b>
                    </a>
                </li>
            </ul>
            <div class="tab-content px-1 pt-1" style="direction: rtl;max-height: 400px;overflow: auto;">
                <div role="tabpanel" class="tab-pane active" id="ctab1001" aria-expanded="true"
                     aria-labelledby="base-tab1">
                    <p>
                    <table style="width:100%; margin-top: 10px;direction: rtl;"
                           class="detailsTB table hdrTbl1 myTaskTable001">
                        <thead width='100%'>
                        <tr>
                            <th class="" scope="col" style="text-align: right; color:#ffffff">#</th>
                            <th class="col-md-2 hideMob" scope="col"
                                style="text-align:  right; direction:rtl;   color:#ffffff">
                                {{"المرسل"}}  </th>
                            <th class="col-md-2" scope="col" style="text-align: right; color:#ffffff">
                                {{"اسم المستفيد"}}</th>
                            <th class="col-md-2" scope="col" style="text-align: right; color:#ffffff">
                                {{trans('admin.task_title')}}</th>
                            <th class="col-md-3 hideMob" scope="col" style="text-align: center; color:#ffffff">
                                {{trans('admin.opening_date')}}</th>
                            <th class="col-md-3 hideMob" scope="col" style="text-align: center; color:#ffffff">
                                {{'الإجراءات'}}</th>
                        </tr>
                        </thead>
                        <tbody id="cMyTask1">
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="ctab2001" aria-labelledby="base-tab2">
                    <p>
                    <table style="width:100%; margin-top: 10px;direction: rtl;"
                           class=" detailsTB table hdrTbl1 wtbl2001">
                        <thead width='100%' id="wtbl2Header">
                        <tr>
                            <th class="" style="text-align: right; color:#ffffff">#</th>
                            <th class="col-md-2 hideMob" style="text-align:  right; color:#ffffff;">
                                {{"المرسل"}}
                            </th>
                            <th class="col-md-2" style="text-align: right;  color:#ffffff;">
                                {{"اسم المستفيد"}}
                            </th>
                            <th class="col-md-2" style="text-align: right; color:#ffffff;">
                                {{trans('admin.task_title')}}
                            </th>
                            <th class="col-md-1 hideMob" style="text-align: right;  color:#ffffff;">
                                {{'الحالة'}}
                            </th>
                            <th class="col-md-2 hideMob" style="text-align: center; color:#ffffff;">
                                {{trans('admin.opening_date')}}
                            </th>

                            <th class="col-md-3 hideMob"
                                style="text-align: center; color:#ffffff; width:100% !important;" colspan="1">
                                {{'الإجراءات'}}
                            </th>
                        </tr>
                        </thead>
                        <tbody id="cMyTask2">
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="ctab3001" aria-labelledby="base-tab3">
                    <p>
                    <table style="width:100%; margin-top: 10px;direction: rtl;"
                           class="detailsTB table hdrTbl1 wtbl3001">
                        <thead width='100%'>

                        <tr>
                            <th class="" scope="col" style="text-align: right; color:#ffffff">#</th>
                            <th class="col-md-2 hideMob"
                                style="text-align:  right; direction:rtl;   color:#ffffff">
                                {{"المرسل"}}
                            </th>

                            <th class="col-md-2" style="text-align: right;   color:#ffffff">
                                {{"اسم المستفيد"}}
                            </th>

                            <th class="col-md-2" style="text-align: right;   color:#ffffff">
                                {{trans('admin.task_title')}}
                            </th>

                            <th class="col-md-3 hideMob" style="text-align: center;   color:#ffffff">
                                {{trans('admin.opening_date')}}
                            </th>

                            <th class="col-md-3 hideMob" style="text-align: center;   color:#ffffff">
                                {{'الإجراءات'}}
                            </th>

                        </tr>

                        </thead>
                        <tbody id="cMyTask3">
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="ctab4001" aria-labelledby="base-tab4">

                    <p>

                    <table style="width:100%; margin-top: 10px;direction: rtl;"
                           class="detailsTB table hdrTbl1 wtbl4001">
                        <thead width='100%'>

                        <tr>

                            <th class="" scope="col" style="text-align: right; color:#ffffff">#</th>
                            <th class="col-md-2 hideMob"
                                style="text-align:  right; direction:rtl;   color:#ffffff">
                                {{"تم تحويلها إلى"}}
                            </th>

                            <th class="col-md-2" style="text-align: right;   color:#ffffff">
                                {{"اسم المستفيد"}}
                            </th>

                            <th class="col-md-2" style="text-align: right;   color:#ffffff">
                                {{trans('admin.task_title')}}
                            </th>

                            <th class="col-md-3 hideMob" style="text-align: center;   color:#ffffff">
                                {{trans('admin.opening_date')}}
                            </th>
                            <!-- <th class="col-md-3" scope="col" style="text-align: center;   color:#ffffff">

									{{'الإجراءات'}}</th> -->
                        </tr>
                        </thead>
                        <tbody id="cMyTask4">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
