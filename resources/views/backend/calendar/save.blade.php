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
    $url = $config['method'] == 'create' ? route('calendar.save') : route('calendar.update', $calendar->id);
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
                        <p> - Nhập thông tin của chuyên môn</p>
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
                                    <label for="" class="control-label text-Left">Lớp
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <select name="class_id" class="form-control">
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ old('class_id', $calendar->class_id ?? '') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Huấn luyện viên
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <select name="trainer_id" class="form-control">
                                        @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}"
                                                {{ old('trainer_id', $calendar->class->trainer_id ?? '') == $trainer->id ? 'selected' : '' }}>
                                                {{ $trainer->first_name . ' ' . $trainer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ngày dạy
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="date" name="day" class="form-control"
                                        value="{{ old('day', $calendar->day ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Giờ dạy
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="time" name="time" class="form-control"
                                        value="{{ old('time', $calendar->time ?? '') }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send"> <i class="fa fa-save mr1"> Lưu
                </i> </button>
        </div>
    </div>
</form>
