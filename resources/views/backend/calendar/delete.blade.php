@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title']])

{{-- thông báo khi thêm người dùng --}}
<form action="{{route('major.destroy', $major->id)}}" method="post" class="box">   
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p> - Bạn có muốn xóa chuyên môn có tên là: <span class="text-danger">{{$major->major_name}}</span></p>
                        <p> - Lưu ý: Không thể khôi phục chuyên môn này sau khi xóa</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Họ
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="major_name" 
                                        class="form-control" 
                                        value="{{old('major_name',($major->major_name) ?? '')}}" 
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
