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
                    {{-- <li><a href="{{route('dashboard.index')}}">Quản Lí Nhóm Người Dùng</a></li>  --}}
                    <li><a href="{{route('employee.index')}}">Quản Lí Nhân Viên</a></li>
                    <li><a href="{{route('customer.index')}}">Quản Lí Khách Hàng</a></li>
                    <li><a href="{{route('member.index')}}">Quản Lí Học Viên</a></li>
                    <li><a href="{{route('trainer.index')}}">QL Huấn Luyện Viên</a></li>
                    <li><a href="{{route('attendance.index')}}">QL Điểm Danh</a></li>
                </ul>
            </li>
            <li class="active2">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí CSHT</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('calendar.index')}}">Quản Lí lịch Tập</a></li>
                    <li><a href="{{route('major.index')}}">Quản Lí Chuyên Môn</a></li>
                    <li><a href="{{route('class.index')}}">Quản Lí Lớp</a></li>
                    <li><a href="{{route('room.index')}}">Quản Lí Phòng</a></li>
                    <li><a href="{{route('equipment.index')}}">Quản Lí Thiết Bị</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
