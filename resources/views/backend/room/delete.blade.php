@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])

{{-- thông báo khi thêm người dùng --}}
<form action="{{route('room.destroy', $room->id)}}" method="post" class="box">   
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p> - Bạn có muốn xóa Thiết bị là: {{$room->name}}</p>
                        <p> - Lưu ý: Không thể khôi phục Thiết bị này sau khi xóa <span class="text-danger">(*)</span> là không được để trống. </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên Phòng
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        class="form-control" 
                                        value="{{old('name',($room->name) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        readonly

                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Tên Lớp
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="class_name" 
                                        class="form-control" 
                                        value="{{old('class_name',($room->class->name) ?? '')}}" 
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
