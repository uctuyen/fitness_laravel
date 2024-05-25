@include('backend.dashboard.component.breadcumb', ['title' => $config['seo']['create']['title'] ?? ''])
{{-- thông báo khi thêm người dùng --}}
<form action="{{route('customer.destroy', $customer->id)}}" method="post" class="box">   
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p> - Bạn có muốn xóa chuyên môn có tên là: <span class="text-danger">{{$customer->name}}</span></p>
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
                                    <label for="" class="control-label text-Left">Tên khách hàng
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        class="form-control" 
                                        value="{{old('name',($customer->name) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        readonly
                                        >
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Số điện thoại 
                                    </label>
                                    <input 
                                    type="text" 
                                    name="phone" 
                                    class="form-control" 
                                    value="{{old('phone',($customer->phone_number) ?? '')}}" 
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
                                    <label for="" class="control-label text-Left">Email
                                        <span class="text-danger">(*)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="emai" 
                                        class="form-control" 
                                        value="{{old('emai',($customer->email) ?? '')}}" 
                                        placeholder=""
                                        autocomplete="off"
                                        readonly
                                        >
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-Left">Địa chỉ
                                    </label>
                                    <input 
                                    type="text" 
                                    name="address" 
                                    class="form-control" 
                                    value="{{old('address',($customer->address) ?? '')}}" 
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
