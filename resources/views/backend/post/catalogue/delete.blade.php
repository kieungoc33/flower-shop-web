@include('backend.dashboard.component.breadcrumb' ,['title' => $config['seo']['create']['title']])

<form action="{{route('post.catalogue.destroy',$postCatalogue ->id)}}" method="post" class="box">

@csrf
@method('DELETE')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung </div>
                    <div class="panel-description">
                        <p>Bạn đang muốn xóa ngôn ngữ là : {{$postCatalogue-> name}}</p>
                        <p class="text-danger">-Lưu ý : Không thể khôi phục nhóm thành viên sau khi xóa </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <d class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên nhóm <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{old('name', ($postCatalogue -> name) ?? '')}}"
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
