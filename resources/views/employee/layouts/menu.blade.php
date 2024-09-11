<div class="page-sidebar">
    <a class="logo-box" href="{{ route('organizations.index') }}">
        <span><img src="{{ asset('assets/images/logo-white.png')}}" alt=""></span>
        <i class="ion-aperture" id="fixed-sidebar-toggle-button"></i>
        <i class="ion-ios-close-empty" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">

                <li @if(request()->routeIs('employee.exams.*')) class="active" @endif >
                    <a href="{{ route('employee.exams.index') }}"><i class="fa fa-bank"></i>
                        <span>{{__('quiz.quiz')}}</span><span></span></a>
                </li>

                <li class="@if(request()->routeIs('employee.medical.*')) active open @endif">
                    <a href="{{ route('employee.medical.index') }}"><i class="fa fa-book"></i>
                        <span>{{__('form.medical.medical')}}</span><i class=" fa "></i></a>
                </li>

                <li class="@if(request()->routeIs('employee.warehouse.*')) active open @endif">
                    <a href="{{ route('employee.warehouse.index') }}"><i class="fa fa-book"></i>
                        <span>{{__('form.warehouse.warehouse')}}</span><i class=" fa "></i></a>
                </li>
                <li class="@if(request()->routeIs('employee.accident.*')) active open @endif">
                    <a href="{{ route('employee.accident.index') }}"><i class="fa fa-book"></i>
                        <span>{{__('form.accident.accident')}}</span><i class=" fa "></i></a>
                </li>



            </ul>
        </div>
        <!--================================-->
        <!-- Sidebar Information Summary -->
        <!--================================-->

    </div>
    <!--================================-->
    <!-- Sidebar Footer Start -->
    <!--================================-->
    <div class="sidebar-footer">
        <a class="pull-left" href="page-profile.html" data-toggle="tooltip" data-placement="top"
           data-original-title="Profile">
            <i class="icon-user"></i></a>
        <a class="pull-left" href="page-singin.html" data-toggle="tooltip" data-placement="top"
           data-original-title="{{__('auth.logOut')}}">
            <i class="icon-power"></i></a>
    </div>
    <!--/ Sidebar Footer End -->
</div>
