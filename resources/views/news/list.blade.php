@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">News <a href="{{route('newscreate')}}" class="btn btn-sm btn-primary pull-right">Create</a></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

    @if(session()->has('del_success'))
    <div class="row top-actions">
        <div class="col-sm-12">
            <span class="alert alert-success alert-dismissible fade in">
                {{ session('del_success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </span>
        </div>
    </div>
    @endif

    <div class="panel-group">
        <div class="panel panel-default">

            <div class="panel-body">

                @if($news->isEmpty())
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>News not found</h3>
                        </div>
                    </div>
                @else
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th width="25%">title</th>
                                <th width="40%">description</th>
                                <th width="20%">categories</th>
                                @if(Auth::check())
                                    <th width="10%">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($news as $newsItem)
                            <tr>
                                <td>{{$newsItem->title}}</td>
                                <td>{{$newsItem->description}}</td>
                                <td>
                                    <?php $i = 1 ; ?>
                                    @foreach($newsItem->categories as $category)
                                        @if($i++ == count($newsItem->categories))
                                            {{$category->name}}
                                        @else
                                            {{$category->name}},
                                        @endif

                                    @endforeach
                                </td>
                                @if(Auth::check())
                                <td>
                                    <a href="{{route('newsedit', ['id' => $newsItem->id])}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> </a>
                                    <a href="{{route('newsdelete', ['id' => $newsItem->id])}}" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> </a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
    </div>
@endsection