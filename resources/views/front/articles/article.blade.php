@extends('front.layouts.app')

@section('content')
    <section class="blog-list-wraper">
        <div class="container">


            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="inner-title">
                    <span>{{ $article->title }}</span>
                </h1>
                <div class="blog-detail-main-slider">
                    <img src="http://demo.lavalite.org/image/blog.lg/blogs/D00rIqhKhRPqla/images/blog4.jpg" class="img-responsive" alt="">
                </div>
                <div class="blog-detail-desc">
                    <p class="detail-tags m-b-20"><i class="ion ion-android-person"></i> <a>{{ $article->user->name }} </a> , {{ $article->created_at->format('M d, Y') }}</p>

                    <p class="blog-detail-para">
                        {{ $article->description }}
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="comments">
            <div class="container">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <h4>Comments</h4>

                    @if(Auth::check())
                        <form method="post" action="{{route('commentssave')}}" role="form" class="">
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control" name="comment" id="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </form>
                    @else
                        <p>Please <a href="{{route('login')}}">Login</a> to comment</p>
                    @endif

                    @if(!is_null($article->comments))
                        <ul id="comments">
                            @foreach($article->comments as  $comment)
                                <li class="cmmnt">
                                    <div class="avatar">
                                        <a href="javascript:void(0);">
                                            <img src="{{asset('front/images/default.png')}}" width="55" height="55" alt="">
                                        </a>
                                    </div>
                                    <div class="cmmnt-content">
                                        <header>
                                            <a href="javascript:void(0);" class="userlink">
                                                {{$comment->user->name}}
                                            </a> - <span class="pubdate">
                                                {{ $comment->created_at->format('M d, Y') }}
                                            </span>
                                        </header>
                                        <p>
                                            {{ $comment->comment }}
                                        </p>
                                    </div>

                                    {{--<ul class="replies">
                                        <li class="cmmnt">
                                            <div class="avatar"><a href="javascript:void(0);"><img src="images/pig.png" width="55" height="55" alt="Sir_Pig photo avatar"></a></div>
                                            <div class="cmmnt-content">
                                                <header><a href="javascript:void(0);" class="userlink">Sir_Pig</a> - <span class="pubdate">posted 1 day ago</span></header>
                                                <p>Sed felis lorem, venenatis sed malesuada vitae, tempor vel turpis. Mauris in dui velit, vitae mollis risus.</p>
                                                <p>Morbi id neque nisl, nec fringilla lorem. Duis molestie sodales leo a blandit. Mauris sit amet ultricies libero. Etiam quis diam in lacus molestie fermentum non vel quam.</p>
                                            </div>
                                        </li>
                                    </ul>--}}
                                </li>
                            @endforeach
                        </ul>

                    @endif

                </div>
            </div>
    </section>
@endsection