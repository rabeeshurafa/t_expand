@canany(['internal_icon', 'internal_iconmob'])
    <div class="col-md-1 w-iconmob
    					@can('internal_icon')
					    @else
					    hidedesc
					    @endcan
					    @can('internal_iconmob')
					    @else
					    hidemob
					    @endcan
    					" style="text-align: center; padding: 5px;">
        <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
           aria-expanded="true">
            <span style="display: inline;">
                <img src="https://template.expand.ps/public/assets/images/ico/internalApp.jpg"
                     style="padding:5px; ;height: 64px;">
                <div class="task-title" style="color: #000000;">الطلبات الداخلية</div>
            </span>
        </a>
        <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">
            @can('vacationRequest')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('vacationRequest')}}">طلب اجازة</a>
                </li>
            @endcan
            @can('leavePermission')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('leavePermission')}}">اذن خروج</a>
                </li>
            @endcan
            @can('collecting')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('collecting')}}">طلب تحصيل</a>
                </li>
            @endcan
            @can('requestSpareParts')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('requestSpareParts')}}">اذن اخراج
                        مواد</a>
                </li>
            @endcan
            @can('PurchaseOrder')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('PurchaseOrder')}}">اذن شراء</a>
                </li>
            @endcan
            @can('networkDevelopment')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('networkDevelopment')}}">صيانة وتطوير
                        شبكة</a>
                </li>
            @endcan
            @can('internalMemo')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('internalMemo')}}">مذكرة داخلية</a>
                </li>
            @endcan
        </ul>
    </div>
@endcanany