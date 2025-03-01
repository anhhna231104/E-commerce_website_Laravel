@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Edit product!</h2>
        <div class="signup-form"><!--sign up form-->
            <h2>Fill In Your Product Information!</h2>
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
            <form action="#" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" placeholder="Name" name="name" value="{{$data->name}}" />
                <input type="text" placeholder="Price" name="price" value="{{$data->price}}" />
                <select name="id_category">
                    <option value="" disabled selected>Please choose category</option>
                    @foreach ($category as $value)
                        <option value="{{$value->id}}" {{ $value->id == $data->id_category ? 'selected' : '' }}>
                            {{$value->category_name}}
                        </option>
                    @endforeach
                </select>
                <select name="id_brand">
                    <option value="" disabled selected>Please choose brand</option>
                    @foreach ($brand as $value)
                        <option value="{{$value->id}}" {{ $value->id == $data->id_brand ? 'selected' : '' }}>
                            {{$value->brand_name}}
                        </option>
                    @endforeach
                </select>
                <select name="status" class="status" onchange="ifRenderSsale()" value="{{$data->status}}">
                    <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>New</option>
                    <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Sale</option>
                </select>

                <div id="sale-input-container"></div>

                <input type="text" placeholder="Company profile" name="company_profile"
                    value="{{$data->company_profile}}" />
                <input type="hidden" name="id_user" value="{{Auth::user()->id}}" />
                <input type="file" name="image[]" multiple />
                @foreach (json_decode($data->image) as $value)
                    <label>
                        <div style="margin-right: 15px;">
                            <img src="{{asset('upload/product/' . Auth::user()->id . '/hinh85_' . $value)}}" alt="" />
                            <input type="checkbox" value="{{$value}}" name="delImg[]" />
                        </div>
                    </label>
                @endforeach

                <textarea name="detail" placeholder="Detail">{{$data->detail}}</textarea>
                <button type="submit" class="btn btn-default" style="margin-bottom: 10px">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        ifRenderSsale()
    })
    function ifRenderSsale() {
        $('#sale-input-container').empty();

        if ($('select.status').val() == 0) {
            var saleInput = $('<input>', {
                type: 'text',
                name: 'sale',
                placeholder: '0',
                style: 'width: 100px; display: inline-block',
                value: '{{$data->sale}}'
            });
            var saleLabel = $('<label>', {
                text: '%',
                style: 'display: inline-block'
            });

            $('#sale-input-container').append(saleInput).append(saleLabel);
        }
    }
</script>
@endsection