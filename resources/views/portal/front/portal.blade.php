@extends('portal.portal')
@section('content')
    <style>
        body {
            background-color: white !important;
        }

        .top-0 {
            top: 60px !important;
        }

        .show-mobile {
            display: none;
        }

        .show-comp {
            display: block;
        }

        @media (max-width: 767.98px) {
            .show-mobile {
                display: inline;
            }

            .show-comp {
                display: none;
            }

            .top-0 {
                top: 0 !important;
            }
        }
    </style>
    <div class="row">
        <div class="col-sm-12 "
             style="font-family:arial!important;text-align: center;">
            <!-- <img src="https://db.expand.ps/images/intro.png" style="100%"> -->
            <div style="text-align: center; margin-top:20px;color:#000000">
                <h1 style="font-size:24px!important">
                    <b>
                        أهلا بكم في البلدية الإلكترونية
                    </b>
                </h1>
                <b>
                    الرجاء اختيار نوع الطلب
                </b>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-sm-center" style="">
        <div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
            <a class="dropdown-item" href="{{route('portal')}}/outspreadTasks" style="padding-top: 0.5rem">
			<span style="display: inline;" class="float-left">
				<img src="{{asset('assets/images/TaskIcons8.png')}}" style="padding:5px; ;height: 64px;">
				<span class="show-mobile" style="color: #000000;">خدمات متفرقة</span>
				<div class="show-comp" style="color: #000000;">خدمات متفرقة</div>
			</span>
            </a>
        </div>
        <div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
            <a class="dropdown-item" href="{{route('portal')}}/trashTasks" style="padding-top: 0.5rem">
			<span style="display: inline;" class="float-left">
				<img src="https://db.expand.ps/bs/trashicon.png" style="padding:5px; ;height: 64px;">
                <span class="show-mobile" style="color: #000000;">خدمة النفايات</span>
				<div class="show-comp" style="color: #000000;">خدمة النفايات</div>
			</span>
            </a>
        </div>
        <div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
            <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
               aria-expanded="true">
			<span style="display: inline;" class="float-left">
			    <img src="https://db.expand.ps/images/water-faucet64.png" style="padding:5px; ;height: 65px;">
                <span class="show-mobile" style="color: #000000;">طلبات المياه</span>
				<div class="show-comp" style="color: #000000;">طلبات المياه</div>
		    </span>
            </a>
            <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">
                @for($i=0;$i<11;$i++)
                    @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                    @endif
                @endfor
            </ul>
        </div>
        {{--<div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
            <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
               aria-expanded="false">
			<span style="display: inline;">
			    <img src="https://db.expand.ps/images/Eng64.png"
                     style="padding:5px; ;height: 64px;">
			    <div style="color: #000000;">طلبات الهندسة</div>
		    </span>
            </a>
            <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">
                @for($i=22;$i<26;$i++)
                    @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                    @endif
                @endfor
                @if($ticket_config[43]->public_app==1)
                    <li data-menu="">
                        <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                            {{$ticket_config[$i]->ticket_name}}
                        </a>
                    </li>
                @endif
                @for($i=49;$i<51;$i++)
                    @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                    @endif
                @endfor
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('portal')}}/buildingComplaint">شكوى البناء</a>
                </li>
                <li data-menu="">
                    <a class="dropdown-item" href="{{route('portal')}}/piece_description">طلب وصف تنظيمى</a>
                </li>
            </ul>
        </div>--}}
        <div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
            <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
               aria-expanded="false">
			<span style="display: inline;" class="float-left">
			    <img src="https://template.expand.ps/public/assets/images/ico/elecicon1.jpg"
                     style="padding:5px; ;height: 64px;">
                <span class="show-mobile" style="color: #000000;">طلبات الكهرباء</span>
				<div class="show-comp" style="color: #000000;">طلبات الكهرباء</div>
		    </span>
            </a>
            <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">
                @for($i=11;$i<22;$i++)
                    @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                    @endif
                @endfor
                @for($i=33;$i<39;$i++)
                    @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                    @endif
                @endfor
            </ul>
        </div>
        <div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
            <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown"
               aria-expanded="true">
				<span style="display: inline;" class="float-left">
				    <img src="https://db.expand.ps/bs/complain.png" style="padding:5px; ;height: 64px;">
                    <span class="show-mobile" style="color: #000000;">الشكاوى</span>
				    <div class="show-comp" style="color: #000000;">الشكاوى</div>
				</span>
            </a>
            <ul class="dropdown-menu menumob top-0" style="width: 200px;list-style: none">
                @for($i=40;$i<43;$i++)
                    @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                    @endif
                @endfor
                @if($ticket_config[44]->public_app==1)
                    <li data-menu="">
                        <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[44]->route}}">
                            {{$ticket_config[44]->ticket_name}}
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        {{--<div class="col-md-1 w-iconmob" style="text-align: center; padding: 5px;">
                <a class="dropdown-toggle nav-link" style="color: #ffffff;" href="/" data-toggle="dropdown" aria-expanded="true">
                    <span style="display: inline;">
                        <img src="https://template.expand.ps/public/assets/images/ico/internalApp.jpg" style="padding:5px; ;height: 64px;">
                        <div style="color: #000000;">الطلبات الداخلية</div>
                    </span>
                </a>
                <ul class="dropdown-menu menumob" style="width: 200px;list-style: none">
                    @for($i=27;$i<33;$i++)
                        @if($ticket_config[$i]->public_app==1)
                        <li data-menu="">
                            <a class="dropdown-item" href="{{route('portal')}}/{{$ticket_config[$i]->route}}">
                                {{$ticket_config[$i]->ticket_name}}
                            </a>
                        </li>
                        @endif
                    @endfor
                </ul>
        </div>--}}
    </div>
@endsection