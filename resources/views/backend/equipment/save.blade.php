@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = $config['method'] == 'create' ? route('equipment.save') : route('equipment.update', $equipment->id);
@endphp
{{-- thông báo khi thêm người dùng --}}
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p> - Nhập thông tin chung của người sử dụng</p>
                        <p> - Lưu ý: Những trường có đánh dấu <span class="text-danger">(*)</span> là không được để
                            trống. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" 
                                            name="name" 
                                            class="form-control" 
                                            value="{{ old('name', $equipment->name ?? '') }}" 
                                            placeholder="" 
                                            autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for=""  class="control-label text-Left">Hình ảnh
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" 
                                            name="image" 
                                            class="form-control upload-image" 
                                            value=""
                                            placeholder="" 
                                            autocomplete="off"
                                            data-type="Images"
                                        >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tình trạng
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" 
                                    name="status" 
                                    class="form-control" 
                                    value="{{ old('status', $equipment->status ?? '')}}"
                                    placeholder="" 
                                    autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Số lượng
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" 
                                        name="quantity" 
                                        class="form-control"
                                        value="{{ old('quantity', $equipment->quantity ?? '') }}" 
                                        placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Mô tả
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" 
                                        name="description" 
                                        class="form-control"
                                        value="{{ old('description', $equipment->description ?? '') }}" 
                                        placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên phòng
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <select name="room_id" class="form-control">
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{ (old('room_id', $class->room_id ?? '') == $room->id ? 'selected':'') }}>
                                                {{ $room->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send"> <i class="fa fa-save mr1"> Lưu
                </i> </button>
        </div>
    </div>
</form>
