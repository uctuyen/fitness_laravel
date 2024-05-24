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
                <form action="{{route('equipment.index')}}">
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
                                <a href="{{route('equipment.create')}}" class="btn btn-danger"><i class="fa fa-plus"></i> Thêm mới</a>
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
                                <th style="width:90px">Hình</th>
                                <th>Tên</th>
                                <th>Tên phòng</th>
                                <th>Số lượng</th>
                                <th>Mô tả</th>
                                <th>Tình trạng</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($equipments) && is_object($equipments))
                                @foreach ($equipments as $equipment)
                                <tr>
                                    <td><input type="checkbox" name="" class="input-checkbox checkBoxItem"></td>
                                    <td><img class="image image-cover" style="width: 150px; height: 150px;" src="{{ $equipment->image }}" alt=""></td>
                                    <td>
                                        {{$equipment->name}}
                                    </td>
                                    <td>
                                        {{$equipment->room->name}}
                                    </td>
                                    <td>
                                        {{$equipment->quantity}}
                                    </td>
                                    <td>
                                        {{$equipment->description}}
                                    </td>
                                    <td> 
                                        @switch($equipment->status)
                                            @case(1)
                                                <span class="text-success">{{config('apps.status.status')[$equipment->status]}}</span>
                                                @break
                                    
                                            @case(2)
                                                <span class="text-warning">{{config('apps.status.status')[$equipment->status]}}</span>
                                                @break
                                    
                                            @case(3)
                                                <span class="text-danger">{{config('apps.status.status')[$equipment->status]}}</span>
                                                @break
                                    
                                            @default
                                                <span>{{config('apps.status.status')[$equipment->status]}}</span>
                                        @endswitch
                                    </td>
                                    <td class="text-center" style="width: 100px">
                                        <a href="{{ route('equipment.edit', $equipment->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('equipment.delete', $equipment->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                        {{ $equipments->links('pagination::bootstrap-4') }}
                </div>
            </div>
            
        </div>
    </div>
</div>