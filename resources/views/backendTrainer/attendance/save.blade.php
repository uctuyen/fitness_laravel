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
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin điểm danh</div>
                    <div class="panel-description">
                        <p> - Thông tin chung của người điểm danh </p>
                        <p> - Lưu ý: Những trường có đánh dấu <span class="text-danger">(*)</span> là không được để trống. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Mã Huấn Luyện Viên
                                    </label>
                                    <input type="text"
                                            class="form-control"
                                            value="{{ $loggedInTrainer->id }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Họ Tên Huấn Luyện Viên
                                    </label>
                                    <input type="text" 
                                            class="form-control"
                                            value="{{ $loggedInTrainer->first_name . ' ' . $loggedInTrainer->last_name}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                                <div class="col-lg-4">
                                    <div class="form-row">
                                        <label for="" class="control-label text-Left">Ngày Tập
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            name="date_attendance" 
                                            class="form-control" 
                                            value="{{old('date_attendance',($attendance->date_attendance) ?? '')}}" 
                                            placeholder=""
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Giờ Bắt Đầu
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="time" 
                                        name="time" 
                                        class="form-control" 
                                        value="{{old('time',($attendance->time) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Lớp
                                    </label>
                                    <select class="form-control" name="class_id">
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
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
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin điểm danh học viên</div>
                    <div class="panel-description">Nhập mã học viên</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15" style="padding-left: 40px ">
                            <button type="button" class="btn btn-danger remove_member">-</button>
                            <button type="button" class="btn btn-primary" id="add_member">+</button>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-5">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Mã Học Viên
                                    </label>
                                    <input  type="text" 
                                            name="member_id" 
                                            class="form-control" 
                                            value="{{old('member_id',($attendance->member_id) ?? '')}}" 
                                            placeholder=""
                                            autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên Học Viên</label>
                                    <input type="text" 
                                            name="member_name" 
                                            class="form-control" 
                                            readonly>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-row" style="padding-top: 23px;">
                                    <button type="submit" class="btn btn-success" id="save_attendance">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</form>
<script>
    $(document).ready(function() {
        // Khi giá trị của trường member_id thay đổi, gọi API để lấy tên học viên
        $(document).on('change', '.member_id', function() {
            var memberId = $(this).val();
            var memberNameField = $(this).siblings('.member_name');
            if (memberId) {
                $.ajax({
                    url: '/api/members/' + memberId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        memberNameField.val(data.name);
                    }
                });
            } else {
                memberNameField.val('');
            }
        });
    
        // Khi nhấn nút "+", thêm một dòng mới
        $('#add_member').click(function() {
            var newField = '<div class="member_field">' +
                '<input type="text" name="member_id[]" class="form-control member_id" placeholder="Mã học viên" autocomplete="off">' +
                '<input type="text" name="member_name[]" class="form-control member_name" placeholder="Tên học viên" readonly>' +
                '<button type="button" class="btn btn-danger remove_member">-</button>' +
                '</div>';
            $('#member_fields').append(newField);
        });
    
        // Khi nhấn nút "-", xóa dòng hiện tại
        $(document).on('click', '.remove_member', function() {
            $(this).parent('.member_field').remove();
        });
    
        // Khi nhấn nút "Lưu", lưu thông tin hiện tại
        $('#save_attendance').click(function() {
            var memberData = [];
            $('.member_field').each(function() {
                var memberId = $(this).find('.member_id').val();
                var memberName = $(this).find('.member_name').val();
                memberData.push({id: memberId, name: memberName});
            });

            $.ajax({
                url: '/api/save_attendance',
                type: 'POST',
                data: JSON.stringify(memberData),
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    // Xử lý phản hồi từ máy chủ tại đây
                },
                error: function(error) {
                    // Xử lý lỗi tại đây
                }
            });
        });
    });
</script>