<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span>
                        @if(Auth::guard('trainer')->check())
                            <img style="width: 50px; height: 50px;"  alt="image" class="img-circle" src="{{ Auth::guard('trainer')->user()->avatar }}" />
                        @endif                        
                    </span>
                    <span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            @if(Auth::guard('trainer')->check())
                            <strong class="font-bold">{{ Auth::guard('trainer')->user()->first_name }} {{ Auth::guard('trainer')->user()->last_name }}</strong>
                        @endif                         
                    </span> 
                         <span class="text-muted text-xs block"><b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('trainer.logout')}}">logout</a></li>                    
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Huấn Luyện Viên</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('trainer.attendance')}}">Điểm Danh</a></li>
                    <li><a href="{{route('trainer.calendar.index')}}">Lịch Dạy</a></li> 
                </ul>
            </li>
        </ul>
    </div>
</nav>