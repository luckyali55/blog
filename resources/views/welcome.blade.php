@extends('layouts.app')

@section('content')
        <div class="position-ref full-height">


            <div class="content">
                <div class="title m-b-md">
                    {{ Config::get('app.name') }}
                </div>

                <div class="links">
                    <a href="{{route('news')}}">News</a>
                    <a href="{{route('articles')}}">Articles</a>
                    <a href="{{route('recipes')}}">Recipes</a>
                </div>
            </div>
        </div>
@endsection