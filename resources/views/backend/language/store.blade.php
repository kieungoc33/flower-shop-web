@include('backend.dashboard.component.breadcrumb' ,['title' => $config['seo']['create']['title']])
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = ($config['method'] == 'create') ? route('language.store') : route('language.update', $language -> id);
@endphp

<form action="{{$url}}" method="post" class="box">
@csrf

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung </div>
                    <div class="panel-description">
                        <p>- Nhập thông tin chung của ngôn ngữ</p>
                        <p class="text-danger">- (*) Thông tin bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên Nhóm <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{old('name', ($language -> name) ?? '')}}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                            
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Canonical<span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="canonical"
                                        value="{{old('canonical', ($language-> canonical) ?? '')}}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                            
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ảnh đại diện</label>
                                    <input 
                                        type="text"
                                        name="image"
                                        value="{{old('image', ($language -> image) ?? '')}}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                            
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú</span></label>
                                    <input 
                                        type="text"
                                        name="description"
                                        value="{{old('description', ($language-> description) ?? '')}}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                            
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu Lại</button>
        </div>
    </div>
</form>