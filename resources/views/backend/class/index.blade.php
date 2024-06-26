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
                <form action="{{route('class.index')}}">
                    <div class="filter uk-flex uk-flex-space-between">
                        <div class="uk-flex uk-flex-middle">
                            <div class="perpage">
                                @php
                                    $perpage = request('perpage') ?: old('perpage');
                                @endphp
                                <div class="uk-flex uk-flex-middle">
                                    <select name="perpage" class="form-control input sm perpage filter mr10">
                                        @for($i = 20; $i <= 200; $i+=20)
                                        <option {{($perpage == $i) ? 'selected' : ''}} value="{{$i}}">{{$i}} bảng ghi</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
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
                                <a href="{{route('class.create')}}" class="btn btn-danger"><i class="fa fa-plus"></i> Thêm mới</a>
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
                                <th>Tên lớp học</th>
                                <th>Huấn luyện viên</th>
                                <th>chuyên môn</th>
                                <th>Số lượng học viên tối đa</th>
                                <th>Giá </th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($classes) && is_object($classes))
                                @foreach ($classes as $class)
                                <tr>
                                    <td><input type="checkbox" name="" class="input-checkbox checkBoxItem"></td>
                                    <td>
                                        {{$class->name}}
                                    </td>
                                    <td>
                                        {{ $class->trainer->first_name . ' ' . $class->trainer->last_name }} <!-- Nối chuỗi tên đầu và tên cuối -->
                                    </td>
                                    <td>
                                        {{$class->major->major_name}}
                                    </td>
                                    <td>
                                        {{$class->quantity_member}}
                                    </td>
                                    <td>
                                        {{$class->price}}
                                    </td>
                                    <td style="width: 100px">
                                        <a href="{{ route('class.edit', $class->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('class.delete', $class->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                        {{ $classes->links('pagination::bootstrap-4') }}
                </div>
            </div>
            
        </div>
    </div>
</div>