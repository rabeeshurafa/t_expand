@canany(['centralArchive', 'centralArchivemob'])
    <div class="col-md-1 w-iconmob
    					@can('centralArchive')
					    @else
					    hidedesc
					    @endcan
					    @can('centralArchivemob')
					    @else
					    hidemob
					    @endcan
					    " style="text-align: center; padding: 5px;">
        <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
           aria-expanded="true">
            <span style="display: inline;">
                <img src="{{asset('assets/images/archive_ico.png')}}"
                     style="padding:5px; ;height: 64px;">

                <div class="task-title" style="color: #000000;">الأرشيف المركزى </div>
            </span>
        </a>
        <ul class="dropdown-menu menumob top-0" style="width: 221px;">
            @can('out_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('out_archieve')}}">أرشيف المراسلات
                        الصادرة</a>
                </li>
            @endcan
            @can('in_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('in_archieve')}}">أرشيف المراسلات
                        الواردة</a>
                </li>
            @endcan
            @can('mun_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('mun_archieve')}}">أرشيف المؤسسة
                        الداخلى</a>
                </li>
            @endcan
            @can('proj_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('proj_archieve')}}">أرشيف المشاريع</a>
                </li>
            @endcan
            @can('assets_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('assets_archieve')}}">أرشيف الأصول</a>
                </li>
            @endcan
            @can('emp_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('emp_archieve')}}">أرشيف الموظفين</a>
                </li>
            @endcan
            @can('dep_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('dep_archieve')}}">أرشيف الإتفاقيات
                        والعقود</a>
                </li>
            @endcan
            @can('lic_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('lic_archieve')}}">أرشيف رخص البناء /ملف
                        الترخيص</a>
                </li>
            @endcan
            @can('financeArchive')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('financeArchive')}}">أرشيف قسم
                        المالية</a>
                </li>
            @endcan
            @can('cit_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('cit_archieve')}}">أرشيف المواطنين</a>
                </li>
            @endcan
            @can('law_archieve')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('law_archieve')}}">أرشيف القوانين
                        والإجراءات</a>
                </li>
            @endcan
        </ul>
    </div>
@endcanany