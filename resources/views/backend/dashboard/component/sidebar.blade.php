<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="backend/img/profile_small.jpg" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                         </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
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
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí Người Dùng</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{route('dashboard.index')}}">Quản Lí Nhóm Người Dùng</a></li> 
                    <li><a href="{{route('employee.index')}}">Quản Lí Nhân Viên</a></li> 
                    <li><a href="{{route('trainer.index')}}">Quản Lí Huấn Luyện Viên</a></li> 
                    <li><a href="{{route('member.index')}}">Quản Lí Học Viên</a></li> 
                </ul>
            </li>
            {{-- <li class="active2">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí Chức Năng</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Quản Lí Dạy</a></li> 
                    <li><a href="#">Quản Lí Học</a></li> 
                    <li><a href="#">Điểm Danh</a></li> 
                </ul>
            </li>
            <li class="active3">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí CSHT</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Quản Lí Lớp</a></li> 
                    <li><a href="#">Quản Lí Phòng</a></li> 
                    <li><a href="#">Ca Tập</a></li> 
                    <li><a href="#">Thiết Bị</a></li> 
                </ul>
            </li>
            <li class="active4">
                <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Quản Lí Hiển Thị</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Quản Lí Menus</a></li> 
                    <li><a href="#">Quản Lí Banner & Slide</a></li> 
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>