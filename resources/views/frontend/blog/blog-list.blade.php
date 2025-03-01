@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>

        @foreach ($data as $value)
            <div class="single-blog-post">
                <h3>{{$value->title}}</h3>
                <div class="post-meta">
                    <ul>
                        <li><i class="fa fa-user"></i> Mac Doe</li>
                        <li><i class="fa fa-clock-o"></i> {{date_format($value->created_at, 'H:ia')}}</li>
                        <li><i class="fa fa-calendar"></i>{{date_format($value->created_at, 'M d, Y')}}</li>
                    </ul>
                    <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </span>
                </div>
                <a href="">
                    <img width="848px" height="400px" src="{{asset('/upload/blog/' . $value->image)}}" alt="">
                </a>
                <p>{{$value->description}}</p>
                <a class="btn btn-primary" href="{{url('/blog/detail/' . $value->id)}}" id>Read More</a>
            </div>
        @endforeach
        <!-- <div class="pagination-area">
            <ul class="pagination">
                <li><a href="" class="active">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
        </div> -->

        <br /> <br />
        {!!$data->links('pagination::bootstrap-4')!!}

    </div>
</div>
@endsection