@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create') ? route('class.save') : route('class.update', 
    $class->id);
@endphp
{{-- thông báo khi thêm người dùng --}}
<form action="{{$url}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p> - Nhập thông tin của lớp học</p>
                        <p> - Lưu ý: Những trường có đánh dấu <span class="text-danger">(*)</span> là không được để trống. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-4">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Tên lớp học
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            name="name" 
                                            class="form-control" 
                                            value="{{old('name',($class->name) ?? '')}}" 
                                            placeholder=""
                                            autocomplete="off"
                                            >
                                        </div>
                                    </div>
                                <div class="col-lg-4">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">số lượng học viên 
                                        </label>
                                        <input 
                                        type="text" 
                                        name="quantity_member" 
                                        class="form-control" 
                                        value="{{old('quantity_member',($class->quantity_member) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        >
                                    </div>
                                </div>    
                                <div class="col-lg-3">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">giá 
                                        </label>
                                        <input 
                                        type="text" 
                                        name="price" 
                                        class="form-control" 
                                        value="{{old('price',($class->price) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        >
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send"> <i class="fa fa-save mr1"> Lưu </i> </button>
        </div>
    </div>
</form>