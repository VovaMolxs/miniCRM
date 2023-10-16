@extends('layouts.app')
@section('title', 'Create RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="mb-4">Task create</h1>
            <form method="POST" action="/todo/tasks/store">
                <div class="row">
                    <!-- Title field -->
                    <div class="mb-3 col-12 col-md-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                </div>
                <div class="row">
                    <!-- Category field -->
                    <div class="col-12 col-md-6 mb-3">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            @foreach($categories as $k=>$v)
                            <option value="{{$v['id']}}">{{$v['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Finish date field -->
                    <div class="col-12 col-md-6 mb-3">
                        <label for="finish_date">Finish Date</label>
                        <input type="datetime-local" class="form-control" id="finish_date" name="finish_date">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Task</button>
            </form>
        </div>
    </div>
@endsection