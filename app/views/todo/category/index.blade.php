@extends('layouts.app')
@section('title', 'Edit RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-10 col-md-10 col-sm-10">
            <h1 class="text-center mb-4">ToDo Categorys</h1>
            <a href="category/create" class="btn btn-primary">Create Category</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Title</th>
                        <th>Category Description</th>
                        <th>Category Usability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($category as $k=>$v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['title']}}</td>
                        <td>{{$v['description']}}</td>
                        <td>{{$v['usability']}}</td>
                        <td>
                            <a href="/todo/category/edit/{{$v['id']}}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="/todo/category/delete/{{$v['id']}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection