@extends('layouts.app')
@section('title', 'Create RoleModel')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <h1 class="text-center mb-4">Create category</h1>
            <form action="/store" method="POST">
                <div class="mb-3">
                    <label for="title">Category Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="description" >Category description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="usability" >Category usability</label>
                    <input type="text" class="form-control" id="usability" name="usability" required>
                </div>

                <button type="submit" class=" btn btn-success">Create Category</button>
            </form>
        </div>
    </div>
@endsection