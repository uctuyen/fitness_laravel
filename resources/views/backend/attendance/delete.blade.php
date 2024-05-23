@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])

{{-- thông báo khi thêm người dùng --}}
<form action="{{route('attendance.destroy', $attendance->id)}}" method="post" class="box">   
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p> - Bạn có muốn xóa dòng điểm danh này?</span></p>
                        <p> - Lưu ý: Không thể khôi phục chuyên môn này sau khi xóa</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên lớp học
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        class="form-control" 
                                        value="{{old('name',($attendance->calendar->class->name) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        readonly
                                        >
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">tên huấn luyện viên 
                                    </label>
                                    <input 
                                    type="text" 
                                    name="fullname" 
                                    class="form-control" 
                                    value="{{old('fullname',($attendance->calendar->class->trainer->first_name) . ' ' . ($attendance->calendar->class->trainer->last_name) ?? '')}}"
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                    >
                                </div>
                            </div> 
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ngày dạy
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="date" 
                                        class="form-control" 
                                        value="{{old('date',(\Carbon\Carbon::parse($attendance->calendar->start_date)->format('d/m/Y')) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        readonly
                                        >
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Ca dạy
                                    </label>
                                    <input 
                                    type="text" 
                                    name="session" 
                                    class="form-control" 
                                    value="{{old('session',(\Carbon\Carbon::parse($attendance->calendar->start_date)->format('H:i') . ' - ' . \Carbon\Carbon::parse($attendance->calendar->end_date)->format('H:i')) ?? '')}}" 
                                    placeholder=""
                                    autocomplete="off"
                                    readonly
                                    >
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send"> <i class="fa fa-trash mr1"> Xóa </i> </button>
        </div>
    </div>
</form>
