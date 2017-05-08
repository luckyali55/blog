@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users <a href="{{route('usercreate')}}" class="btn btn-sm btn-primary pull-right">Add User</a></h1>
            </div>
        </div>

    <div class="panel-group">
        <div class="panel panel-default">


            <div class="panel-body">

                @if($users->isEmpty())
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Users not found</h3>
                        </div>
                    </div>
                @else
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th width="25%">Name</th>
                                <th width="30%">email</th>
                                <th width="20%">Register Date</th>
                                <th width="10%">Role</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $usersItem)
                            <tr>
                                <td>{{$usersItem->name}}</td>
                                <td>{{$usersItem->email}}</td>
                                <td>{{$usersItem->created_at->format('M d, Y')}}</td>
                                <td>{{$usersItem->isAn('admin')? 'Admin' : 'User'}} </td>

                                <td>
                                    <a href="{{route('useredit', ['id' => $usersItem->id])}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
@endsection