<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img style="width: 50px; height: 50px;" alt="image" class="img-circle" src="{{ Auth::user()->avatar }}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                            </span>
                            <span class="text-muted text-xs block">
                                {{ Auth::user()->role }} <b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('auth.logout')}}">logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="active">
                <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí Người Dùng</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <ul class="nav nav-second-level">
                        <li><a href="{{route('employee.index')}}"><i class="fa fa-user"></i> Quản Lí Nhân Viên</a></li>
                        <li><a href="{{route('customer.index')}}"><i class="fa fa-users"></i> Quản Lí Khách Hàng</a></li>
                        <li><a href="{{route('member.index')}}"><i class="fa fa-graduation-cap"></i> Quản Lí Học Viên</a></li>
                        <li><a href="{{route('trainer.index')}}"><i class="fas fa-user-friends"></i> QL Huấn Luyện Viên</a></li>
                        <li><a href="{{route('attendance.index')}}"><i class="fa fa-calendar-check"></i> QL Điểm Danh</a></li>
                    </ul>
                </ul>
            </li>
            <li class="active2">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí CSHT</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('calendar.index')}}"><i class="fas fa-calendar-alt"></i> Quản Lí Lịch Dạy</a></li>
                    <li><a href="{{route('major.index')}}"><i class="fas fa-project-diagram"></i></i> Quản Lí Chuyên Môn</a></li>
                    <li><a href="{{route('class.index')}}"><i class="fas fa-chalkboard-teacher"></i> Quản Lí Lớp</a></li>
                    <li><a href="{{route('room.index')}}"><i class="fas fa-door-open"></i> Quản Lí Phòng</a></li>
                    <li><a href="{{route('equipment.index')}}"><i class="fas fa-tools"></i> Quản Lí Thiết Bị</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
