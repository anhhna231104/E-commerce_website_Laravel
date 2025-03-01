@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-8">
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="Name" name="name" />
            <input type="email" placeholder="Email Address" name="email" />
            <input type="password" placeholder="Password" name="password" />
            <input type="text" placeholder="Phone" name="phone" />
            <input type="file" name="avatar" />
            <input type="text" placeholder="Address" name="address" />
            <input type="text" placeholder="Level" value="0" readonly name="level" />
            <select name="id_country">
                @foreach ($data as $value)
                    <option value="{{ $value->id_country }}">
                        {{ $value->name_country }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div><!--/sign up form-->
</div>

@endsection