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
    $url = $config['method'] == 'create' ? route('classSession.save') : route('classSession.update', $classSession->id);
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
                        <p> - Nhập thông tin của ca tập</p>
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
                                    <label for="" class="control-label text-Left">Tên ca tập
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $classSession->name ?? '') }}" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ngày trong tuần
                                    </label>
                                    <input type="text" name="day_of_week" class="form-control"
                                        value="{{ old('day_of_week', $classSession->day_of_week ?? '') }}"
                                        placeholder="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Giờ bắt đầu
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input type="text" name="start_time" class="form-control"
                                        value="{{ old('start_time', $classSession->start_time ?? '') }}" placeholder=""
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Giờ kết thúc
                                    </label>
                                    <input type="text" name="end_time" class="form-control"
                                        value="{{ old('end_time', $classSession->end_time ?? '') }}"
                                        placeholder="" autocomplete="off">
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
