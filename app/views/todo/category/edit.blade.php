@extends('layouts.app')
@section('title', 'Edit RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="text-center mb-4">Update Category</h1>
            <form action="../update" method="POST">
                <input type="hidden" name="id" value="{{$todoCategory['id']}}">
                <div class="mb-3">
                    <label for="title">Category title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$todoCategory['title']}}" required>
                </div>
                <div class="mb-3">
                    <label for="description">Category description</label>
                    <textarea class="form-control" id="description" name="description"  required>{{$todoCategory['title']}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="description">Category usability</label>
                    <input type="checkbox" class="form-check" id="usability" name="usability" value="1"
                    @if($todoCategory['usability'] == 1) checked @else    @endif
                        >
                </div>

                <button type="submit" class="btn btn-success">Update Category</button>
            </form>
        </div>
    </div>
@endsection