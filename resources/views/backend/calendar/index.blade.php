@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['index']['title']])
<div class="row mt20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>{{$config['seo']['index']['table'];}}</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form action="{{route('calendar.index')}}">
                    <div class="filter uk-flex uk-flex-space-between">
                        <div class="uk-flex uk-flex-middle">
                        </div>
                        <div class="action">
                            <div  class="uk-search uk-flex uk-flex-middle mr10">
                                <div  class="input-group">
                                    <input 
                                            type="text"
                                            name="keyword"
                                            value="{{ request()->get('keyword') ?: old('keyword')}}"
                                            placeholder="Nhập từ khóa để tìm kiếm"
                                            class="form-control">
                                    <span  class="input-group-btn">
                                        <button style="margin-right: 10px"
                                                type="submit"
                                                name="search"
                                                value="search"
                                                class="btn btn-primary mb0 btn-sm"> <i class="fa fa-search"></i> Tìm kiếm
                                        </button>  
                                    </span>      
                                </div>
                                <a href="{{route('calendar.create')}}" class="btn btn-danger"><i class="fa fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="" id="checkAll" class="input-checkbox">
                                </th>
                                <th>Lớp</th>
                                <th>Huấn luyện viên</th>
                                <th>Ngày</th>
                                <th>Thời gian</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(isset($calendars) && is_object($calendars))
                               <!-- Hiển thị dữ liệu -->
                                    @foreach ($calendars as $calendar)
                                        <tr>
                                            <td><input type="checkbox" name="" class="input-checkbox checkBoxItem"></td>
                                            <td>{{ $calendar->class->name }}</td>
                                            <td>{{ optional($calendar->class)->trainer->name ?? 'Không có huấn luyện viên' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($calendar->day)->format('Y-m-d') }}</td>                                            
                                            <td>{{ $calendar->time }}</td>
                                            <td class="text-center" style="width: 100px">
                                                <a href="{{ route('calendar.edit', $calendar->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('calendar.delete', $calendar->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('calendar.index', ['week' => max($week - 1, 1)]) }}" class="btn btn-primary">Previous</a>
                    <a href="{{ route('calendar.index', ['week' => $week + 1]) }}" class="btn btn-primary">Next</a>
                </div>
        </div>
    </div>
</div>