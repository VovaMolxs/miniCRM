@extends('layouts.app')
@section('title', 'Edit Role')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-10 col-md-10 col-sm-10">
            <h1 class="text-center mb-4">Roles</h1>
            <a href="roles/create" class="btn btn-primary">Create Roles</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role Name</th>
                        <th>Role Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $k=>$v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['role_name']}}</td>
                        <td>{{$v['role_description']}}</td>
                        <td>
                            <a href="/roles/edit/{{$v['id']}}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="/roles/delete/{{$v['id']}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection