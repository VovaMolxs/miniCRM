@extends('layouts.app')
@section('title', 'Create Pages')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="text-center mb-4">Create Page</h1>
            <form action="store" method="POST">
                <div class="mb-3">
                    <label for="page_title">Page title</label>
                    <input type="text" class="form-control" id="page_title" name="page_title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="page_slug" >Page slug</label>
                    <textarea class="form-control" id="page_slug" name="page_slug" required></textarea>
                </div>
                <div class="mb-3">
                    @php

                    @endphp
                    @foreach($roles as $k=>$v)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="roles[]" value="{{$v['id']}}">
                            <label for="roles" class="form-check-label">{{$v['role_name']}}</label>
                        </div>
                    @endforeach
                </div>


                <button type="submit" class=" btn btn-success">Create Page</button>
            </form>
        </div>
    </div>
@endsection