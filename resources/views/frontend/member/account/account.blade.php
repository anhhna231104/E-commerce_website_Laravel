@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Update user</h2>
        <div class="signup-form"><!--sign up form-->
            <h2>Edit User Information!</h2>
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
                <input type="text" placeholder="Name" name="name" value="{{Auth::user()->name}}" />
                <input type="email" placeholder="Email Address" name="email" value="{{Auth::user()->email}}" />
                <input type="password" placeholder="Password" name="password" />
                <input type="password" placeholder="Confirm Password" name="password-c">
                <input type="text" placeholder="Phone" name="phone" value="{{Auth::user()->phone}}" />
                <input type="file" name="avatar" />
                <input type="text" placeholder="Address" name="address" value="{{Auth::user()->address}}" />
                <input type="text" placeholder="Level" value="0" readonly name="level" hidden />
                <select name="id_country">
                    @foreach ($data as $value)
                        <option value="{{ $value->id_country }}" {{ $value->id_country == $country ? 'selected' : '' }}>
                            {{ $value->name_country }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-default">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection