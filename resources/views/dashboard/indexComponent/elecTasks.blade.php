@canany(['elecTasks', 'elecTasksmob'])
    <div class="col-md-1 w-iconmob
    					@can('elecTasks')
					    @else
					    hidedesc
					    @endcan
					    @can('elecTasksmob')
					    @else
					    hidemob
					    @endcan
					    " style="text-align: center; padding: 5px;">
        <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
           aria-expanded="false">
            <span style="display: inline;">
                <img src="https://template.expand.ps/public/assets/images/ico/elecicon1.jpg"
                     style="padding:5px; ;height: 64px;">
                <div class="task-title" style="color: #000000;">طلبات الكهرباء</div>
            </span>
        </a>
        <ul class="elec-left elec-top dropdown-menu menumob elecMenue" style="width: 200px;list-style: none">
            @can('elecSubscription')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecSubscription')}}">طلب اشتراك
                        كهرباء</a>
                </li>
            @endcan
            @can('elecMalfunction')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecMalfunction')}}">عطل كهرباء
                        لمشترك</a>
                </li>
            @endcan
            @can('elecPermission')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecPermission')}}">إذن اشغال عقار
                        كهرباء</a>
                </li>
            @endcan
            @can('globalelecMalfunction')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('globalelecMalfunction')}}">عطل كهرباء
                        عام</a>
                </li>
            @endcan
            @can('elecMeterCheck')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecMeterCheck')}}">فحص عداد كهرباء</a>
                </li>
            @endcan
            @can('elecLineDisconnect')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecLineDisconnect')}}">فصل خط
                        كهرباء</a>
                </li>
            @endcan
            @can('elecLineReconnect')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecLineReconnect')}}">إعادة وصل خط
                        كهرباء</a>
                </li>
            @endcan
            @can('waiveelecSubscription')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waiveelecSubscription')}}">تنازل عن
                        اشتراك كهرباء</a>
                </li>
            @endcan
            @can('elecMeterRead')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecMeterRead')}}">قراءة عداد طاقة
                        شمسية</a>
                </li>
            @endcan
            @can('elecMeterTransfer')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecMeterTransfer')}}">نقل عداد
                        كهرباء</a>
                </li>
            @endcan
            @can('elecFinancialTransfer')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('elecFinancialTransfer')}}">نقل ذمة
                        مالية/كهرباء</a>
                </li>
            @endcan
            @can('newTicket37')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('newTicket37')}}">نقل عامود
                        كهرباء/كابل</a>
                </li>
            @endcan
            @can('newTicket16')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('newTicket16')}}">رفع قدرة العداد (زيادة
                        أمبيرات)</a>
                </li>
            @endcan
            @can('newTicket27')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('newTicket27')}}">اصلاح/تركيب وحدات انارة
                        تالفة</a>
                </li>
            @endcan
            @can('newTicket29')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('newTicket29')}}">ربط خلايا شمسية</a>
                </li>
            @endcan
            @can('newTicket36')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('newTicket36')}}">لوحة عرس (اشتراك
                        مؤقت)</a>
                </li>
            @endcan
            @can('newTicket39')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('newTicket39')}}">طلب تحويل من 1 إلى 3
                        فاز</a>
                </li>
            @endcan

        </ul>

    </div>
@endcanany