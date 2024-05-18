<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <span>
                        @if(Auth::guard('member')->check())
                            <img style="width: 50px; height: 50px;"  alt="image" class="img-circle" src="{{ Auth::guard('member')->user()->avatar }}" />
                        @endif
                    </span>
                    <span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            @if(Auth::guard('member')->check())
                            <strong class="font-bold">{{ Auth::guard('member')->user()->first_name }} {{ Auth::guard('member')->user()->last_name }}</strong>
                        @endif
                    </span>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('member.logout')}}">logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Học Viên</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('attendances.index') }}">Đăng kí ca học</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
