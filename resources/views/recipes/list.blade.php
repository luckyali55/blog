@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Recipes <a href="{{route('recipescreate')}}" class="btn btn-sm btn-primary pull-right">Add New</a></h1>
            </div>
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

                @if($recipes->isEmpty())
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Recipes not found</h3>
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

                        @foreach($recipes as $recipesItem)
                            <tr>
                                <td>{{$recipesItem->title}}</td>
                                <td>{{$recipesItem->description}}</td>
                                <td>
                                    <?php $i = 1 ; ?>
                                    @foreach($recipesItem->categories as $category)
                                        @if($i++ == count($recipesItem->categories))
                                            {{$category->name}}
                                        @else
                                            {{$category->name}},
                                        @endif

                                    @endforeach
                                </td>
                                @if(Auth::check())
                                <td>
                                    <a href="{{route('recipesedit', ['id' => $recipesItem->id])}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> </a>
                                    <a href="{{route('recipesdelete', ['id' => $recipesItem->id])}}" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> </a>
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
@endsection