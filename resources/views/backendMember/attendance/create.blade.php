@extends('backendMember.layout')

@section('content')
@include('backend.dashboard.component.breadcumb', ['title' => 'Đăng ký học'])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('attendances.store') }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Lớp học
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <select name="class_id" class="form-control" onchange="getCalendarList()">
                                        <option value="">Chọn lớp học</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" {{ (old('class_id') == $class->id ? 'selected':'') }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ca học
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <select name="calendar_id" class="form-control">
                                        <option value="">Chọn ca học</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit"> <i class="fa fa-save mr1"> Lưu
                </i> </button>
        </div>
    </div>
</form>
@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getCalendarList() {
            var classId = $(`select[name="class_id"]`).val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (classId) {
                // gọi api
                $.ajax({
                    url: "/member/member/attendance/get-calendar-list",
                    type: "POST",
                    data: {
                        class_id: classId,
                        _token: csrfToken,
                    },
                    success: function (respon) {
                        if (respon.data) {
                            $('select[name="calendar_id"]').empty();
                            if (respon.data.length > 0) {
                                $(`select[name="calendar_id"]`).prop('disabled', false);
                                $('select[name="calendar_id"]').append('<option value="">Chọn ca học</option>');
                                $.each(respon.data, function(index, item) {
                                    $('select[name="calendar_id"]').append('<option value="' + item.id + '">' + item.time_calendar + '</option>');
                                });
                            }
                            else {
                                $(`select[name="calendar_id"]`).prop('disabled', true);
                                $('select[name="calendar_id"]').append('<option value="">Không có ca học nào</option>');
                            }
                            $(`select[name="sub_calendar_id"]`).prop('disabled', true);
                        }
                    },
                    errors: function () {
                        alert('Lỗi hệ thống!!!');
                    }
                });
            }
            else {
                $(`select[name="calendar_id"]`).prop('disabled', true);
            }
        }
    </script>
@endsection
