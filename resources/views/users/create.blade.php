@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add User</h1>
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
                    <form class="form-horizontal" action="{{route('usersave')}}" method="post">

                        <div class="col-sm-6">

                            {{csrf_field()}}

                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label for="title" class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <label for="title" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('role')) has-error @endif">
                                <label for="title" class="col-sm-4 control-label">Role</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="role">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @if ($errors->has('role')) <p class="help-block">{{ $errors->first('role') }}</p> @endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <label for="title" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                                </div>
                            </div>



                            <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                                <label for="title" class="col-sm-4 control-label">Confirm Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="">
                                    @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>

                        </div>


                    </form>
            </div>
        </div>

    </div>
@endsection