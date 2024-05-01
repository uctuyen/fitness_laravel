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
    $url = $config['method'] == 'create' ? route('attendance.save') : route('attendance.update', $attendance->id);
@endphp
{{-- thông báo khi thêm người dùng --}}
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <div class="col-4">
                                        <label for="" class="control-label text-Left">Tên huấn luyện viên
                                            <span class="text-danger">(*)</span>
                                        </label>
                                    </div>
                                    <div class="col-8">
                                        <select name="trainer_id" class="form-control">
                                            @foreach($trainers as $trainer)
                                                <option value="{{ $trainer->id }}" {{ (old('trainer_id', $class->trainer_id ?? '') == $trainer->id ? 'selected':'') }}>
                                                    {{ $trainer->first_name . ' ' . $trainer->last_name }} <!-- Nối chuỗi tên đầu và tên cuối -->
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Họ Tên Huấn Luyện Viên
                                    </label>
                                    <input type="text" name="quantity_member" class="form-control"
                                        value="{{ old('quantity_member', $class->quantity_member ?? '') }}"
                                        placeholder="" autocomplete="off">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Lớp
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <select name="trainer_id" class="form-control">
                                        @foreach($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" {{ (old('trainer_id', $class->trainer_id ?? '') == $trainer->id ? 'selected':'') }}>
                                                {{ $trainer->first_name . ' ' . $trainer->last_name }} <!-- Nối chuỗi tên đầu và tên cuối -->
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ngày điểm danh
                                    </label>
                                    <input type="text" name="price" class="form-control"
                                        value="{{ old('price', $class->price ?? '') }}" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">giờ vào lớp
                                    </label>
                                    <input type="text" name="price" class="form-control"
                                        value="{{ old('price', $class->price ?? '') }}" placeholder=""
                                        autocomplete="off">
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
