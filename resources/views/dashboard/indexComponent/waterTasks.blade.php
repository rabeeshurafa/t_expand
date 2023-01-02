@canany(['waterTasks', 'waterTasksmob'])
    <div class="col-md-1 w-iconmob
    					@can('waterTasks')
					    @else
					    hidedesc
					    @endcan
					    @can('waterTasksmob')
					    @else
					    hidemob
					    @endcan
					    " style="text-align: center; padding: 5px;">
        <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
           aria-expanded="true">
            <span style="display: inline;">
                <img src="https://db.expand.ps/images/water-faucet64.png"
                     style="padding:5px; ;height: 65px;">
                <div style="color: #000000;">طلبات المياه</div>
            </span>
        </a>
        <ul class="water-top water-right dropdown-menu menumob waterMenu" style="width: 200px;list-style: none">

            @can('waterSubscription')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterSubscription')}}">طلب اشتراك
                        مياه</a>
                </li>
            @endcan
            @can('waterMalfunction')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterMalfunction')}}">عطل مياه
                        لمشترك</a>
                </li>
            @endcan
            @can('waterPermission')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterPermission')}}">اذن اشغال عقار
                        مياه</a>
                </li>
            @endcan
            @can('globalWaterMalfunction')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('globalWaterMalfunction')}}">عطل مياه
                        عام</a>
                </li>
            @endcan
            @can('waterMeterCheck')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterMeterCheck')}}">فحص عداد مياه</a>
                </li>
            @endcan
            @can('waterLineDisconnect')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterLineDisconnect')}}">فصل خط مياه</a>
                </li>
            @endcan
            @can('waterLineReconnect')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterLineReconnect')}}">إعادة وصل خط
                        مياه</a>
                </li>
            @endcan
            @can('waiveWaterSubscription')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waiveWaterSubscription')}}">تنازل عن
                        اشتراك مياه</a>
                </li>
            @endcan
            @can('waterMeterRead')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterMeterRead')}}">تغيير عداد مياه</a>
                </li>
            @endcan
            @can('waterMeterTransfer')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterMeterTransfer')}}">نقل عداد
                        مياه</a>
                </li>
            @endcan
            @can('waterFinancialTransfer')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('waterFinancialTransfer')}}">نقل ذمة
                        مالية/مياه</a>
                </li>
            @endcan
        </ul>
    </div>
@endcanany