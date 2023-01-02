@canany(['ComplaintTasks', 'ComplaintTasksmob'])
<div class="col-md-1 w-iconmob
    					@can('ComplaintTasks')
					    @else
					    hidedesc
					    @endcan
					    @can('ComplaintTasksmob')
					    @else
					    hidemob
					    @endcan
					    " style="text-align: center; padding: 5px;">
    <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
       aria-expanded="true">
        <span style="display: inline;">
            <img src="https://db.expand.ps/bs/complain.png"
                 style="padding:5px; ;height: 64px;">
            <div class="task-title" style="color: #000000;">الشكاوى</div>
        </span>
    </a>
    <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">

        @can('outspreadTasks')
        <li data-menu="">
            <a class="dropdown-item" href="{{route('outspreadTasks')}}">مهام متفرقة</a>
        </li>
        @endcan
        @can('publicComplaint')
        <li data-menu="">
            <a class="dropdown-item" href="{{route('publicComplaint')}}">شكوى عامة</a>
        </li>
        @endcan
        @can('citizenComplaint')
        <li data-menu="">
            <a class="dropdown-item" href="{{route('citizenComplaint')}}">شكوى ضد مواطن</a>
        </li>
        @endcan
        @can('quittance')
        <li data-menu="">
            <a class="dropdown-item" href="{{route('quittance')}}">طلب براءة ذمة</a>
        </li>
        @endcan
    </ul>
</div>
@endcanany