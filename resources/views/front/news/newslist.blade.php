@extends('front.layouts.app')

@section('content')

    <section class="blog-list-wraper">
        <div class="container">
            @if($news->isEmpty())
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Articles not found</h3>
                    </div>
                </div>
            @endif


            <div class="row m-t-40">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

                    @foreach($news as $newsItem)
                        <div class="news-list-item">
                            <div class="blog-list-inner-desc">
                                <h1 class="inner-title">
                                <span>
                                  <a  href="{{url('news/'.$newsItem->id)}}">  {{ @$newsItem->title }}</a>
                                </span>
                                </h1>
                                <div class="blog-detail-desc">
                                    <p class="detail-tags m-b-20">
                                        <i class="ion ion-android-person">
                                        </i>
                                        By <strong>{{ @$newsItem->user->name }}</strong> on {{ @$newsItem->created_at->format('M d, Y') }}
                                    </p>
                                    <p class="blog-detail-para">
                                        {{ $newsItem->title }}
                                    </p>
                                    <p>
                                        <a class="btn btn-danger waves-effect w-md waves-light" href="{{ route('front.news', ['id'=> $newsItem->id]) }}">
                                            Read More
                                        </a>
                                    </p>
                                </div>
                            </div>
                            </img>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>


@endsection