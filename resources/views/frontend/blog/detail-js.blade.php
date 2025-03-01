@extends ('frontend.layouts.app')
<link type="text/css" rel="stylesheet" href="{{asset('/frontend/css/rate.css')}}">



@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Latest From our Blog</h2>
        <div class="single-blog-post">
            <h3>{{$data->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> Mac Doe</li>
                    <li><i class="fa fa-clock-o"></i> {{date_format($data->created_at, 'H:ia')}}</li>
                    <li><i class="fa fa-calendar"></i>{{date_format($data->created_at, 'M d, Y')}}</li>
                </ul>
            </div>
            <a href="">
                <img width="848px" height="400px" src="{{asset('/upload/blog/' . $data->image)}}" alt="">
            </a>
            {!! $data->content !!}
            <div class="pager-area">
                <ul class="pager pull-right">
                    <li><a href="#">Pre</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
    </div><!--/blog-post-area-->

    <div class="rate rating-area">
        <div class="vote">
            <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
            <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
            <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
            <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
            <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
            <span class="rate-np">4.5</span>
        </div>
        <ul class="tag">
            <li>TAG:</li>
            <li><a class="color" href="">Pink <span>/</span></a></li>
            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
            <li><a class="color" href="">Girls</a></li>
        </ul>
    </div><!--/rating-area-->

    <div class="socials-share">
        <a href=""><img src="{{asset('/frontend/images/blog/socials.png')}}" alt=""></a>
    </div><!--/socials-share-->


    <script>
        function replyCmt() {
            $('input.level').val($(this).attr('id'))
        }
        $(document).ready(function () {
            $('a.replyBtn').on('click', replyCmt)
        })
    </script>

    <div class="response-area">
        <h2>3 RESPONSES</h2>
        <ul class="media-list">
            @foreach ($commentData as $value)
                @if ($value->level == 0)
                    <li class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" width="121px" height="90px"
                                src="{{asset('/upload/user/avatar/' . $value->user_avatar)}}" alt="">
                        </a>
                        <div class="media-body">
                            <ul class="sinlge-post-meta">
                                <li><i class="fa fa-user"></i>{{$value->username}}</li>
                                <li><i class="fa fa-clock-o"></i> {{date_format($value->created_at, 'H:i')}}</li>
                                <li><i class="fa fa-calendar"></i> {{date_format($value->created_at, 'M d,Y')}}</li>
                            </ul>
                            <p>{{$value->cmt}}</p>
                            <a class="btn btn-primary replyBtn" id="{{$value->id}}"><i class="fa fa-reply"
                                    onclick="replyCmt()"></i>&ensp;Reply</a>
                        </div>
                    </li>
                    @foreach ($commentData as $valueChild)
                        @if ($valueChild->level == $value->id)
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" width="121px" height="90px"
                                        src="{{asset('/upload/user/avatar/' . $valueChild->user_avatar)}}" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>{{$valueChild->username}}</li>
                                        <li><i class="fa fa-clock-o"></i> {{date_format($valueChild->created_at, 'H:i')}}</li>
                                        <li><i class="fa fa-calendar"></i> {{date_format($valueChild->created_at, 'M d,Y')}}</li>
                                    </ul>
                                    <p>{{$valueChild->cmt}}</p>
                                    <a class="btn btn-primary replyBtn" href=""><i class="fa fa-reply"
                                            onclick="replyCmt()"></i>&ensp;Reply</a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

        </ul>
    </div><!--/Response-area-->



    <div class="replay-box">
        <div class="row">
            <div class="col-sm-12">
                <h2>Leave a reply</h2>
                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Comment</label>
                    </div>
                    <span>*</span>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <br />
                            <br />
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form id="comment_form" method="post">
                        @csrf
                        <input name="id_blog" value="{{$data->id}}" hidden />
                        <textarea name="cmt" rows="11"></textarea>
                        @if(Auth::check())
                            <input name="id_user" value="{{Auth::user()->id}}" hidden />
                            <input name="username" value="{{Auth::user()->name}}" hidden />
                            <input name="user_avatar" value="{{Auth::user()->avatar}}" hidden />
                            <input name="level" class="level" value="0" hidden />
                        @endif
                        <button class="btn btn-primary" type="submit">post comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/Reply Box-->
</div>
@endsection

@section('js')

<script>

    $(document).ready(function () {
        // setrating(5)
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function () {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function () {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratings_stars').click(function () {
            var loginCk = "{{Auth::check()}}"
            if (loginCk == "") {
                alert('Please login to rate this blog.')
            }
            else {
                var Values = $(this).find("input").val();
                // alert(Values);
                if ($(this).hasClass('ratings_over')) {
                    $('.ratings_stars').removeClass('ratings_over');
                    $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                }
            }

        });
    });
</script>

<script>
    $(document).ready(function () {
        $('form#comment_form').submit(function (e) {
            e.preventDefault();
            // alert($('input.loginCheck').val())
            var loginCk = "{{Auth::check()}}"

            if (loginCk == "") {
                alert('Please login to leave a comment.')
            }
            else {
                $('form#comment_form').unbind('submit').submit()
                
            }
        })

    })
</script>

@endsection