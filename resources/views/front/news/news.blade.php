@extends('front.layouts.app')

@section('content')
    <section class="blog-list-wraper">
        <div class="container">


            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="inner-title">
                    <span>{{ $news->title }}</span>
                </h1>
                <div class="blog-detail-desc">
                    <p class="detail-tags m-b-20"><i class="ion ion-android-person"></i>  {{ $news->created_at->format('M d, Y') }}</p>

                    <p class="blog-detail-para">
                        {{ $news->description }}
                    </p>
                </div>

            </div>
        </div>
    </section>


@endsection