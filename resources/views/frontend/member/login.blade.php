@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-8 col-sm-offset-1">
    <div class="login-form"><!--login form-->
        <h2>Login to your account</h2>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>

        @endif
        <form action="#" method="post">
            @csrf
            <input type="email" placeholder="Email Address" name="email" />
            <input type="password" placeholder="Password" name="password" />
            <span>
                <input type="checkbox" class="checkbox" name="remember_me">
                Keep me signed in
            </span>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
    </div><!--/login form-->
</div>
@endsection