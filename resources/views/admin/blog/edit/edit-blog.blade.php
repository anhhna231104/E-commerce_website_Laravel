@extends ('admin.layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create new blog</h4>
                </div>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{session('success')}}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12">Title<span style="color: red">(*)</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control form-control-line" name="title"
                                value="{{$data->title}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Image</label>
                        <div class="col-md-12">
                            <input type="file" class="form-control form-control-line" name="image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Description</label>
                        <div class="col-md-12">
                            <textarea class="form-control form-control-line" name="description"
                                style="height: 100px">{{$data->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Content</label>
                        <div class="col-md-12">
                            <textarea class="form-control form-control-line" name="content" id="ckeditor"
                                style="height: 350px">{{$data->content}}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section("js")
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('ckeditor', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
</script>
@endsection