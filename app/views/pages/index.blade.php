@extends('layouts.app')
@section('title', 'Edit RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-10 col-md-10 col-sm-10">
            <h1 class="text-center mb-4">Pages</h1>
            <a href="pages/create" class="btn btn-primary">Create Page</a>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Page Title</th>
                    <th>Page slug</th>
                    <th>Page role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $k=>$v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['title']}}</td>
                        <td>{{$v['slug']}}</td>
                        <td>{{$v['role']}}</td>
                        <td>
                            <a href="/pages/edit/{{$v['id']}}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="/pages/delete/{{$v['id']}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection