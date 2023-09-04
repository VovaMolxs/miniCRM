@extends('layouts.app')
@section('title', 'Users')
@section('content')
<h1>User List</h1>
<a href="users/create" class="btn btn-primary">Create User</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Admin</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $k => $v)
            <tr>

                <th scope="row">{{$v['id']}}</th>
                <td>{{$v['login']}}</td>
                <td>{{$v['is_admin']}}</td>
                <td>{{$v['created_at']}}</td>

                <td>
                    <a href="" class="btn btn-primary">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
@endsection