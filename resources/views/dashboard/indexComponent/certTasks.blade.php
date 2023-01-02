@canany(['certTasks', 'certTasksmob'])
    <div class="col-md-1 w-iconmob
    					@can('certTasks')
					    @else
					    hidedesc
					    @endcan
					    @can('certTasksmob')
					    @else
					    hidemob
					    @endcan
					    " style="text-align: center; padding: 5px;">
        <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
           aria-expanded="true">
            <span style="display: inline;">
                <img src="https://db.expand.ps/images/certificate64.png"
                     style="padding:5px; ;height: 64px;">
                <div class="task-title" style="color: #000000;">الشهادات</div>
            </span>
        </a>
        <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">
            @can('cert')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('cert')}}">طباعة شهادة لمواطن</a>
                </li>
            @endcan
            @can('sendOut')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('sendOut')}}">مراسلات خارجية</a>
                </li>
            @endcan
            @can('assurance')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('assurance')}}">تعهد والتزام </a>
                </li>
            @endcan
            @can('warningCert')
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('warningCert')}}">اخطار</a>
                </li>
            @endcan
        </ul>
    </div>
@endcanany