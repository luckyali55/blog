@extends('front.layouts.app')

@section('content')

    <section class="blog-list-wraper">
        <div class="container">
            @if($recipes->isEmpty())
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Recipes not found</h3>
                    </div>
                </div>
            @endif


                <div class="row m-t-40">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">

                @foreach($recipes as $recipesItem)
                    <div class="news-list-item">
                        <div class="blog-list-inner-desc">
                            <h1 class="inner-title">
                                <span>
                                  <a  href="{{url('recipe/'.$recipesItem->id)}}">  {{ $recipesItem->title }}</a>
                                </span>
                            </h1>
                            <div class="blog-detail-desc">
                                <p class="detail-tags m-b-20">
                                    <i class="ion ion-android-person">
                                    </i>
                                    on {{ @$recipesItem->created_at->format('M d, Y') }}
                                </p>
                                <p class="blog-detail-para">
                                    {{ $recipesItem->title }}
                                </p>
                                <p>
                                    <a class="btn btn-danger waves-effect w-md waves-light" href="{{ route('front.article', ['id'=> $recipesItem->id]) }}">
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