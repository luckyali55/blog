@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Recipe</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

    <div class="panel-group">
        <div class="panel panel-default">

            <div class="panel-body">
                @if(session()->has('db_error'))
                    <div class="row">
                        <div class="col-sm-12 has-error text-center">
                            <p class="help-block">
                                {{ session('db_error') }}
                            </p>
                        </div>
                    </div>
                @endif
                    <form class="form-horizontal" action="{{route('recipessave')}}" method="post">

                        <div class="col-sm-6">

                            {{csrf_field()}}

                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="title" class="form-control" id="title" name="title" placeholder="Recipe Title" value="{{ old('title') }}">
                                    @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4 col-sm-offset-2 ">
                    <h3>Categories</h3>
                            @if ($errors->has('cats'))
                                <div class="has-error "> <p class="help-block error">You must select at lest one category</p></div>
                            @endif
                            <ul>
                                @foreach($categories as $category)
                                    <li><input type="checkbox" name="cats[]" value="{{$category->id}}"> {{$category->name}}</li>
                                @endforeach
                            </ul>


                </div>
                    </form>
            </div>
        </div>

    </div>
@endsection