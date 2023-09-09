@extends('layouts.app')
@section('title', 'Users')
@section('content')
<h1>User List</h1>
<a href="users/create" class="btn btn-primary">Create User</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Email verification</th>
            <th scope="col">Is Admin</th>
            <th scope="col">Role</th>
            <th scope="col">Is active</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $k => $v)
            <tr>

                <th scope="row">{{$v['id']}}</th>
                <td>{{$v['username']}}</td>
                <td>{{$v['email']}}</td>
                <td>
                    @if($v['email_verification'] == 1)
                        Yes
                    @else
                        NO
                    @endif
                </td>
                <td>
                    @if($v['is_admin'] == 1)
                    Admin
                    @else
                    NO
                    @endif
                </td>
                <td>{{$v['role']}}</td>
                <td>
                    @if($v['is_active'] == 1)
                    YES
                    @else
                    No
                    @endif
                </td>
                <td>{{$v['created_at']}}</td>

                <td>
                    <a href="users/edit/{{$v['id']}}" class="btn btn-primary">Edit</a>
                    <a href="users/delete/{{$v['id']}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
@endsection