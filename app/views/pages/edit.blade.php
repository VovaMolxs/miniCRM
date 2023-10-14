@extends('layouts.app')
@section('title', 'Edit RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="text-center mb-4">Update Page</h1>
            <form action="../update" method="POST">
                <input type="hidden" name="id" value="{{$page['id']}}">
                <div class="mb-3">
                    <label for="role_name">Page title</label>
                    <input type="text" class="form-control" id="page_title" name="page_title" value="{{$page['title']}}" required>
                </div>
                <div class="mb-3">
                    <label for="role_description">Page slug</label>
                    <textarea class="form-control" id="page_slug" name="page_slug"  required>{{$page['slug']}}</textarea>
                </div>
                <div class="mb-3">
                    @foreach($roles as $k=>$v)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="roles[]" value="{{$v['id']}}">
                            <label for="roles" class="form-check-label">{{$v['role_name']}}</label>
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn-success">Update Page</button>
            </form>
        </div>
    </div>
@endsection