@canany(['engTasks', 'engTasksmob'])
    <div class="col-md-1 w-iconmob
    					@can('engTasks')
					    @else
					    hidedesc
					    @endcan
					    @can('engTasksmob')
					    @else
					    hidemob
					    @endcan
					    " style="text-align: center; padding: 5px;">
        <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
           aria-expanded="true">
            <span style="display: inline;">
                <img src="https://db.expand.ps/images/Eng64.png"
                     style="padding:5px; ;height: 64px;">

                <div class="task-title" style="color: #000000;">التنظيم والبناء</div>
            </span>
        </a>
        <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">

            @can('straightening')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('straightening')}}">طلب استقامة</a>
                </li>
            @endcan
            @can('licenseFile')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('licenseFile')}}">فتح ملف ترخيص</a>
                </li>
            @endcan
            @can('buildingLicense')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('buildingLicense')}}">ترخيص بناء </a>
                </li>
            @endcan
            @can('sitePlan')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('sitePlan')}}">مخطط موقع</a>
                </li>
            @endcan
            @can('engineeringValidation')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('engineeringValidation')}}">مصادقة مخططات
                        هندسية</a>
                </li>
            @endcan
            @can('retrieveLic')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('retrieveLic')}}">طلب استرداد تأمين رخصة
                        بناء</a>
                </li>
            @endcan
        </ul>
    </div>
@endcanany