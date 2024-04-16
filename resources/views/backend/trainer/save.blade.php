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
    $url = $config['method'] == 'create' ? route('trainer.save') : route('trainer.update', $trainer->id);
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
                                    <label for="" class="control-label text-Left">Họ
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name', $trainer->first_name ?? '') }}" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name', $trainer->last_name ?? '') }}" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @if ($config['method'] == 'create')
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Mật Khẩu
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="password" name="password" class="form-control" value=""
                                            placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Nhập lại mật khẩu
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="password" name="re_password" class="form-control" value=""
                                            placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row mb15">
                            <div class="col-lg-5">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Email
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $trainer->email ?? '') }}" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ngày sinh
                                    </label>
                                    <input type="date" name="day_of_birth" class="form-control"
                                        value="{{ old('day_of_birth', $trainer->day_of_birth ?? null ? date('Y-m-d', strtotime($trainer->day_of_birth)) : '') }}"
                                        placeholder="" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Giới tính</label>
                                    <select name="gender" class="form-control setupSelect2">
                                        @foreach ($genderLabels as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == old('gender', $trainer->gender ?? '') ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ảnh đại điện
                                    </label>
                                    <input type="text" name="avatar" class="form-control"
                                    value="{{ old('avatar', isset($trainer) ? $trainer->avatar : '') }}" 
                                    placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                            @php
                                $majorList = (isset($trainer)) ? $trainer->majors->pluck('id')->toArray() : [];
                            @endphp
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">chuyên môn
                                    </label>
                                    <Select name="major_id[]" class="form-control setupSelect2 major_name" multiple>
                                        @foreach($majors as $major)
                                            <option value="{{ $major->id }}"  {{ (in_array($major->id, $majorList)) ? 'selected' : '' ;}} >
                                                {{ $major->major_name }}
                                            </option>
                                        @endforeach
                                    </Select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-5">
                    <div class="panel-head">
                        <div class="panel-title">Thông tin liên hệ</div>
                        <div class="panel-description">Nhập thông tin liên hệ của người sử dụng</div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Tỉnh/Thành phố
                                        </label>
                                        <Select name="province_id" class="form-control setupSelect2 province location"
                                            data-target="districts">
                                            <option value="0">[Chọn Tỉnh/Thành phố]</option>
                                            @if (isset($provinces))
                                                @foreach ($provinces as $province)
                                                    <option @if (old('province_id') == $province->code) selected @endif
                                                        value="{{ $province->code }}">{{ $province->name }}</option>
                                                @endforeach
                                            @endif
                                        </Select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Quận/Huyện
                                        </label>
                                        <Select name="district_id"
                                            class="form-control districts setupSelect2 location" data-target="wards">
                                            <option value="0">[Chọn Quận/Huyện]</option>
                                        </Select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Phường/Xã
                                        </label>
                                        <Select name="ward_id" class="form-control setupSelect2 wards">
                                            <option value="0">[Chọn Phường/Xã]</option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Địa chỉ
                                        </label>
                                        <input type="text" name="address"
                                            value="{{ old('address', $trainer->address ?? '') }}"
                                            class="form-control" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="form-row d-inline-block">
                                        <div style="display: flex; justify-content: center; align-items: flex-start;">
                                            <label for="" class="control-label text-Left"
                                                style="margin-bottom: 5px;">Số điện thoại
                                            </label>
                                        </div>
                                        <input type="text" name="phone_number"
                                            value="{{ old('phone_number', $trainer->phone_number ?? '') }}"
                                            class="form-control" placeholder="" autocomplete="off"
                                            style="width: 50%; display: inline-block;">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mb15">
                <button class="btn btn-primary" type="submit" name="send" value="send"> <i
                        class="fa fa-save mr1"> Lưu </i> </button>
            </div>
        </div>
</form>
<script>
    var province_id = '{{ isset($trainer->province_id) ? $trainer->province_id : old('province_id') }}'
    var district_id = '{{ isset($trainer->district_id) ? $trainer->district_id : old('district_id') }}'
    var ward_id = '{{ isset($trainer->ward_id) ? $trainer->ward_id : old('ward_id') }}'
</script>
