@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">{{ $article->title   }}</h3>
            </div>
        </div>
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-body">
                     <p>
                        {{ $article->description }}
                     </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Comments</h4>
            </div>
            <div class="col-sm-6">
                @if(Auth::check())
                    <form class="form" action="{{route('save-comment', ['aid' => $article->id])}}">
                        <div class="form-group">
                            <textarea name="comment" id="comment" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary pull-right">Submit</button>
                        </div>
                    </form>
                @else
                    <p>Login first to commnet <a href="{{route('login')}}">Login</a> </p>
                @endif
            </div>

        </div>
    </div>
@endsection