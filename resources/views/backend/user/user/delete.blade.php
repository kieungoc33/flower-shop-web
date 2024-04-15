@include('backend.dashboard.component.breadcrumb' ,['title' => $config['seo']['create']['title']])

<form action="{{route('user.destroy',$user ->id)}}" method="post" class="box">

@csrf
@method('DELETE')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung </div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa người dùng có email là : {{$user-> email}}</p>
                        <p class="text-danger">-Lưu ý : Không thể khôi phục người dùng sau khi xóa </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <d class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Email <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="email"
                                        value="{{old('email', ($user -> email) ?? '')}}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                        readonly
                                            
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Họ tên <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{old('name', ($user -> name) ?? '')}}"
                                        class="form-control"
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
        <Hr>
        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send">Xóa dữ liệu </button>
        </div>
    </div>
</form>
